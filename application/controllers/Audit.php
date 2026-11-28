<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bloc 03 - Journal de tracabilite (page d'audit).
 * Reserve aux administrateurs (droit a42). Liste les documents (AWB, manifestes,
 * warehouses) avec leur createur, date, station et dernier modificateur.
 * Controle d'acces cote serveur via MY_Controller.
 */
class Audit extends MY_Controller {

	protected $acces_defaut = 'a42';

	protected $acces = array();

	protected $post_requis = array();

	public function index()
	{
		$this->load->model('Parser_export');

		$type = $this->input->get('type');
		if ( ! in_array($type, array('awb', 'manifeste', 'warehouse'), TRUE))
		{
			$type = 'awb';
		}
		$compagnie = $this->input->get('compagnie');
		$date1 = (string) $this->input->get('date1');
		$date2 = (string) $this->input->get('date2');
		// Les dates arrivent en jj/mm/aaaa : converties en aaaa-mm-jj pour le modele.
		$d1 = ($date1 !== '') ? chaineVersDate($date1) : '';
		$d2 = ($date2 !== '') ? chaineVersDate($date2) : '';

		$total = $this->Parser_export->compter_audit($type, $compagnie, $d1, $d2);
		$pagination = sigco_pagination($total);

		$data['sigco_pag']    = $pagination;
		$data['lignes']       = $this->Parser_export->get_audit_page($type, $compagnie, $d1, $d2, $pagination['par_page'], $pagination['offset']);
		$data['type']         = $type;
		$data['compagnie']    = $this->Parser_export->get_compagnie();
		$data['compagnie_choisie'] = (string) $compagnie;
		$data['date1']        = $date1;
		$data['date2']        = $date2;
		$data['act']          = '';
		$data['y']            = 'audit';
		$data['page']         = 'audit';
		$this->load->view('template', $data);
	}
}
