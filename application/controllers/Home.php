<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tableau de bord.
 * Bloc 02 - AUDIT-002/003 : session obligatoire (MY_Controller).
 * Bloc 02 - AUDIT-011 : les compteurs sont calcules par MySQL (agregation) et mis en cache
 * 5 minutes, au lieu de charger toutes les factures impayees a chaque connexion (35 s, 1 Go).
 */
class Home extends MY_Controller {

	protected $acces_defaut = self::SESSION;

	const CACHE_TABLEAU_DE_BORD = 'sigco_tableau_de_bord';
	const DUREE_CACHE = 300;

	public function index()
	{
		$this->load->driver('cache', array('adapter' => 'file'));
		$compteurs = $this->cache->get(self::CACHE_TABLEAU_DE_BORD);
		if ( ! is_array($compteurs))
		{
			$compteurs = array_merge(
				$this->Parser->compteurs_awbl(),
				$this->Parser->compteurs_factures_impayees()
			);
			$stock = $this->Parser->get_stock();
			$compteurs['stock'] = isset($stock[0]->total) ? $stock[0]->total : 0;
			$this->cache->save(self::CACHE_TABLEAU_DE_BORD, $compteurs, self::DUREE_CACHE);
		}

		$data['lessegments']	= 	$this->Parser->get_Pointage();
		$data['awblnone']		= 	(int) $compteurs['awblnone'];
		$data['awblpp']			= 	(int) $compteurs['awblpp'];
		$data['awblcc']			= 	(int) $compteurs['awblcc'];
		$data['awblnc']			= 	(int) $compteurs['awblnc'];
		$data['awblnonlivre']	= 	(int) $compteurs['awblnonlivre'];
		$data['awblretard']		= 	(int) $compteurs['awblretard'];
		$data['awblimport']		= 	(int) $compteurs['awblimport'];
		$data['awblexport']		= 	(int) $compteurs['awblexport'];
		$data['impayee']		= 	(int) $compteurs['impayee'];
		$data['duedate']		= 	(int) $compteurs['duedate'];
		$data['stock_total']	= 	$compteurs['stock'];

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

	public function pas_access()
	{
		$this->load->view('pas_access');
	}
}
