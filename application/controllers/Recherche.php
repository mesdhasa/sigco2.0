<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle d'acces cote serveur (Bloc 02 - AUDIT-002/003/007, voir MY_Controller).
 * Recherche : a13 (comme les vues), suppressions en POST.
 */
class Recherche extends MY_Controller {

	protected $acces_defaut = 'a13';

	protected $acces = array();

	protected $post_requis = array(
		'deleteFacture_detail', 'deleteFacture_detail1',
	);


	public function index()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
		    $data['act']	=	$this->uri->segment(3);
				$data['lessegments']= 	array();

		$this->load->view('recherche',$data);
	}

	public function larecherche()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
		    $data['act']	=	$this->uri->segment(3);
			// Pagination serveur (une recherche large renvoyait 50 000 lignes, 54 Mo) ;
			// la valeur cherchee est gardee en session pour les liens de pages.
			if(isset($_POST['custum'])){
				$this->session->set_userdata('sigco_rech_awb', (string) $_POST['custum']);
			}
			$critere = $this->session->userdata('sigco_rech_awb');
			if(isset($_POST['custum']) || ($critere !== NULL && ($this->input->get('page') !== NULL || $this->input->get('par_page') !== NULL))){
				$data['pagination'] = sigco_pagination($this->Parser->recherche_total_compter($critere));
				$data['lessegments']= 	$this->Parser->recherche_total_page($critere, $data['pagination']['par_page'], $data['pagination']['offset']);
			}else{
				$data['lessegments']= 	array();
			}

		$this->load->view('recherche',$data);
	}
	public function detail()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['lessegments']= 	array();
			$val = $this->uri->segment(4);
			$val2 = $this->uri->segment(5);
			$data['act']			=	$this->uri->segment(2);
			$data['y']				=	$this->uri->segment(3);
			$data['id']				=	$this->uri->segment(4);
			$data['lessegments']	= 	$this->Parser->get_Un_awbl($val,$val2);
			$lespaiements			= 	$this->Parser->get_paiement_awbl_detail($val);
			$data['lespaiements']	= 	$lespaiements;
			foreach ($lespaiements as $pmt) {}
			$data['lespaiments_efec']= 	$this->Parser->get_paiement_effectue($pmt->nofacture);


			$this->load->view('detail_bill',$data);
		}
		public function detail_ex()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$data['act']			=	'recherche';
				// $data['y']				=	'index';
				$data['lessegments']= 	array();
				$val = $this->uri->segment(4);
				$val2 = $this->uri->segment(5);
				$data['act']			=	$this->uri->segment(2);
				$data['y']				=	$this->uri->segment(3);
				$data['id']				=	$this->uri->segment(4);
				$data['lessegments']	= 	$this->Parser->get_Un_awbl_export($val,$val2);
				$lespaiements			= 	$this->Parser->get_paiement_awbl_detail_ex($val);
				$data['lespaiements']	= 	$lespaiements;
				foreach ($lespaiements as $pmt) {}
				$data['lespaiments_efec']= 	$this->Parser->get_paiement_effectue($pmt->nofacture);

				$this->load->view('detail_bill_ex',$data);
			}
			public function deleteFacture_detail()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$id = $this->uri->segment(3);
				$this->Parser->deleteFacture_detail1($id);
				$this->Parser->deleteFacture_detail2($id);
				redirect('Recherche/detail_ex/recherche/'.$this->uri->segment(4).'/'.$this->uri->segment(5));

			}
			public function deleteFacture_detail1()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$id = $this->uri->segment(3);
				$this->Parser->deleteFacture_detail1($id);
				$this->Parser->deleteFacture_detail2($id);
				redirect('Recherche/detail/recherche/'.$this->uri->segment(4).'/'.$this->uri->segment(5));

			}
}
?>
