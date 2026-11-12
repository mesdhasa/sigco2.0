<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['lessegments']	= 	$this->Parser->get_Pointage();
			$data['awblnone']		= 	$this->Parser->awbl_none();
			$data['awblpp']			= 	$this->Parser->awbl_pp();
			$data['awblcc']			= 	$this->Parser->awbl_cc();
			$data['awblnc']			= 	$this->Parser->awbl_nc();
			$data['awblnonlivre']	= 	$this->Parser->awbl_nonlivre();
			$data['awblretard']		= 	$this->Parser->awbl_retard();
			$data['awblimport']		= 	$this->Parser->awbl_type('import');
			$data['awblexport']		= 	$this->Parser->awbl_type2('export');
			$data['lesfactures']	= 	$this->Parser->get_factures();
			$data['stock']			= 	$this->Parser->get_stock();



$taux=$this->Parser->get_taux();
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
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$this->load->view('pas_access');
		}
}
?>
