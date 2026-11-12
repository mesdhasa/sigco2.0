<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Client extends CI_Controller {

	public function index()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['lessegments']= 	$this->Parser->get_segments();
			$this->load->view('client',$data);
		}
	public function lst()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);

			// $data['lessegments']= 	$this->Parser->get_segments();
		 	$data['lesclients']= 	$this->Parser->get_allclient();
			$this->load->view('listeclient',$data);
		}
	public function ajouter()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['lessegments']= 	$this->Parser->get_segments();
			$this->load->view('client',$data);
		}
	public function modifier()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['client']	    = 	$this->Parser->get_client($this->uri->segment(5));
			$this->load->view('modclient',$data);
		}
		public function etat_compte()
			{
				$data['act']		=	$this->uri->segment(3);
				$data['y']			=	$this->uri->segment(4);
				$data['id']			=	$this->uri->segment(5);
				$data['lespaiement']= 	$this->Parser->get_paiement_all($this->uri->segment(5));
				$this->load->view('etat_compte',$data);
			}
		public function updateclient()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
		$codeclient = $_POST['codeclient'];

			$data = array(
			       'reference'  	=> strtoupper($_POST['ref']),
					'societe' 		=> strtoupper($_POST['societe']),
					'adresse' 		=> strtoupper($_POST['adresse']),
					'ville' 		=> strtoupper($_POST['ville']),
				'date_naissance'  => $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'],
					'email' 		=> $_POST['email'],
					'phone' 		=> $_POST['phone'],
					'memo' 			=> $_POST['memo'],

				);
			$this->Parser->set_a_client($codeclient,$data);
			redirect('client/modifier/c/liste_client/'.$codeclient);
		}
			public function supprimerclient()
		{
			$codeclient				= $this->uri->segment(3);
			$data['codeclient']		= $codeclient;
			if(count($this->Parser->get_client($codeclient)) == 0){
				$this->session->set_flashdata('sms','<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> -----.');
			}else{
				$this->Parser->delete_client($codeclient);
				$this->session->set_flashdata('sms','Client supprim&eacute; avec succ&egrave;s.');
			}
			redirect('client/lst/c/liste_client');
		}

	public function addclient()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);

			if(isset($_POST['societe'])){
				$codeclient=date('YmdHis').mt_rand(11111,99999);

				$data = array(
					'codeclient' 	=> $codeclient,
					'reference'  	=> strtoupper($_POST['ref']),
					'societe' 		=> strtoupper($_POST['societe']),
					'adresse' 		=> strtoupper($_POST['adresse']),
					'ville' 		=> strtoupper($_POST['ville']),
					'email' 		=> $_POST['email'],
					'phone' 		=> $_POST['phone'],
					'memo' 			=> $_POST['memo'],
				);
			    $this->Parser->add_client($data);
			}
			redirect('client/modifier/c/liste_client/'.$codeclient);
		}
}
?>
