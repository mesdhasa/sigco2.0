<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tableau de bord.
 * Bloc 02 - AUDIT-002/003 : session obligatoire (MY_Controller).
 * Bloc 02 - AUDIT-011 : les compteurs sont calcules par MySQL (agregation) et mis en cache.
 * La page s'affiche toujours immediatement : si les compteurs en cache sont perimes (plus de
 * 5 minutes, ou une ecriture a eu lieu depuis), la page affiche les dernieres valeurs connues
 * et le navigateur demande le recalcul en arriere-plan (methode compteurs) puis met a jour les graphiques.
 */
class Home extends MY_Controller {

	protected $acces_defaut = self::SESSION;

	const CLE_CACHE = 'tableau_de_bord';
	const DUREE_CACHE = 300;

	public function index()
	{
		$cache = sigco_cache_lire(self::CLE_CACHE, self::DUREE_CACHE);
		$compteurs = $cache ? $cache['donnees'] : $this->_compteurs_vides();

		$data = $this->_donnees_vue($compteurs);
		$data['lessegments']		= $this->Parser->get_Pointage();
		$data['tdb_a_rafraichir']	= ! ($cache && $cache['a_jour']);
		$data['tdb_calcule_le']		= $cache ? $cache['calcule_le'] : NULL;

		$taux = $this->Parser->get_taux();
		foreach($taux as $res){
			$this->session->taux	= $res->taux;
		}
		$num = $this->Parser->get_noRapport();
		foreach($num as $row){
			$this->session->ladate 		= $row->daterapport;
			$this->session->numrapport 	= $row->num;
		}

		$this->load->view('home',$data);
	}

	/**
	 * Recalcule les compteurs (si necessaire) et les renvoie en JSON.
	 * Appelee en arriere-plan par la page d'accueil.
	 */
	public function compteurs()
	{
		$cache = sigco_cache_lire(self::CLE_CACHE, self::DUREE_CACHE);
		if ($cache && $cache['a_jour'])
		{
			$compteurs = $cache['donnees'];
		}
		else
		{
			// le calcul continue meme si l'utilisateur quitte la page entre-temps
			ignore_user_abort(TRUE);
			$compteurs = array_merge(
				$this->Parser->compteurs_awbl(),
				$this->Parser->compteurs_factures_impayees()
			);
			$stock = $this->Parser->get_stock();
			$compteurs['stock'] = isset($stock[0]->total) ? $stock[0]->total : 0;
			sigco_cache_ecrire(self::CLE_CACHE, $compteurs);
		}
		$this->output
			->set_content_type('application/json')
			->set_header('Cache-Control: no-store')
			->set_output(json_encode($this->_donnees_vue($compteurs)));
	}

	public function pas_access()
	{
		$this->load->view('pas_access');
	}

	private function _compteurs_vides()
	{
		return array_fill_keys(array('awblnone', 'awblpp', 'awblcc', 'awblnc', 'awblnonlivre', 'awblretard',
			'awblimport', 'awblexport', 'impayee', 'duedate', 'stock'), 0);
	}

	private function _donnees_vue(array $c)
	{
		return array(
			'awblnone'		=> (int) $c['awblnone'],
			'awblpp'		=> (int) $c['awblpp'],
			'awblcc'		=> (int) $c['awblcc'],
			'awblnc'		=> (int) $c['awblnc'],
			'awblnonlivre'	=> (int) $c['awblnonlivre'],
			'awblretard'	=> (int) $c['awblretard'],
			'awblimport'	=> (int) $c['awblimport'],
			'awblexport'	=> (int) $c['awblexport'],
			'impayee'		=> (int) $c['impayee'],
			'duedate'		=> (int) $c['duedate'],
			'stock_total'	=> $c['stock'],
		);
	}
}
