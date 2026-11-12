<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Facture extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('page');
	}

	public function index()
		{
			$val = "";
			if(isset($_POST['noawbl'])){
				$this->session->set_userdata('sesnumber', $_POST['noawbl']);
			}
			if($this->session->userdata('sesnumber') != ""){
				$val = $this->session->userdata('sesnumber');
			}

			$data['act']		='f';
			$data['y']			='rech';
			$data['lessegments']= 	$this->Parser->get_awblFacture($val);
			$this->session->client = "";
			$data['data']=$this->page->loadpage('getData','Parser','facture/index',1,'getDataCount');
			$this->load->view('facturation',$data);
		}



	public function recherche()
		{
			$val = "";
			if(isset($_POST['noawbl'])){
				$this->session->set_userdata('sesnumber', $_POST['noawbl']);
			}
			if($this->session->userdata('sesnumber') != ""){
				$val = $this->session->userdata('sesnumber');
			}

			$data['act']		='f';
			$data['y']			='rech';
			$data['lessegments']= 	$this->Parser->get_awblFacture($val);
			$this->session->client = "";
			$getDataCountBy=$this->Parser->getDataCountBy($this->input->post('noawbl'));
$data['data']=$this->page->search('noawbl',null,'facture','Parser',1,'getData',$getDataCountBy);
			$this->load->view('facturation',$data);
		}
	public function degrouper()
		{
			$awbl2		=	$this->input->post('no_bill');
			$value=$this->Parser->verify_awbl2($awbl2);
						if($value){
							$this->session->set_flashdata('sms','AWBL: '.$awbl2.' existe d&eacute;j&agrave;');
							redirect('facture/facturerbill/f/rech/'.$_POST['awbl_1']);
						}else{
			if(isset($_POST['no_bill'])){
				$resul = 0;
				if ($_POST['d_depot'] > $_POST['d_depot_comp']){
				$resul = $_POST['d_depot'] * 0.03* $_POST['poids'];
				if ($resul<10) $resul = 10;
				}
				$data = array(
				'idbuil' 	=> $_POST['awbl_1'],
				'nobuil' 	=> $_POST['no_bill'],
				'poids' 	=> $_POST['poids'],
				'datecreated'	=> date('y-m-d'),
			'norapport'	=> 	$this->session->numrapport,
				'montant' 	=> $resul
				);
				$this->Parser->set_degroupage($data);
			}
			redirect('facture/facturerbill/f/rech/'.$_POST['awbl_1']);
		}
		}
		public function update_degrouper()
			{
        	$id = $this->uri->segment(5);
					$data = array(
					'montant' => $this->uri->segment(6)
					);
					$this->Parser->set_a_degroupage($id,$data);
					redirect('facture/facturerbill/f/rech/'.$this->uri->segment(7));
			}
	public function del_degrouper()
		{
				$this->Parser->del_degroupage($this->uri->segment(6));
				redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5));
		}

	public function facturerbill()
		{


			$val = $this->uri->segment(5);
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['id']				=	$this->uri->segment(5);
			$data['lessegments']	= 	$this->Parser->get_Un_awbl($val);
			$lespaiements			= 	$this->Parser->get_paiement_awbl($val);
			$data['lespaiements']	= 	$lespaiements;
			$data['frais']			= 	$this->Parser->get_frais();
			$data['client']			= 	$this->Parser->get_client_client();
			$data['clientcode'] = 	$this->Parser->get_allclient();

			foreach($lespaiements as $pmt){
				if($pmt->nofacture != ""){
					$data['nofacture']		= 	$pmt->nofacture;
				}
			}


			if(!isset($this->session->client) or $this->session->client==""){
				$this->session->client = $pmt->codeclient;
			}

			$this->load->view('factbill',$data);
		}
	public function ajouterMontant(){

		$data['act']			=	$this->uri->segment(3);
		$data['y']				=	$this->uri->segment(4);
		$data['id']				=	$this->uri->segment(5);

		if(isset($_POST['montant'])){
			$data = array(
				'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
				'codetx' 		=> 'FAC',
				'description' 	=> $_POST['description'],
				'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
				'monnaie_apayer'=> 'USD',
				'description' 	=> $_POST['description'],
				'awbl' 			=> $this->uri->segment(5),
				'norapport'		=>$this->session->numrapport
			);
			$this->Parser->set_paiement_awbl($data);
		}

		redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5));
	}


	public function getclient()
	{
		if(isset($_POST['client'])){
			$this->session->client = $_POST['client'];
		}
		redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5));
	}

	public function deleteFacture()
	{
		$id = $this->uri->segment(5);
		$this->Parser->deletePaiement($id);
		redirect('facture/facturerbill/f/rech/'.$this->uri->segment(6));
	}

	public function validerfacture()
	{
		$nofacture = $this->uri->segment(7);
		if(strlen($nofacture)<15){}else{
			$nofacture = $this->Parser->give_num_fac();
		}

		$data = array(
        'nofacture' 	=> $nofacture,
        'date' 			=> date('Y-m-d'),
        'status' 		=> '1',
		'codeclient' 	=> $this->uri->segment(5)
		);

		$this->Parser->valider_facture($this->uri->segment(6),$data);
		redirect('facture/facturerbill/f/rech/'.$this->uri->segment(6).'/'.$nofacture);
	}

	public function update_buill()
	{

		$id = $_POST['awbl'];

		$numlivraison = "--";
		if(isset($_POST['nolivraison'])){
			if($_POST['numlivre']=="--"){
				$numlivraison = $this->Parser->give_num_livraison();
			}else{
				$numlivraison = $_POST['numlivre'];
			}

		}
		$data=array(
				'qty'			=>$_POST['qty'],
				'qtytotal'		=>$_POST['qtytotal'],
				'package'		=>$_POST['package'],
				'weight'		=>$_POST['weight'],
				'consignee'		=>$_POST['consignee'],
				'freight'		=>$_POST['freight'],
				'currency'		=>$_POST['currency'],
				'notify_code'	=>$_POST['notify_code'],
				'notify_name'	=>$_POST['notify_name'],
				'notify_adress'	=>$_POST['notify_adress'],
				'datenotification'	=>chaineversdate($_POST['datenotification']),
				'remarque'		=>$_POST['remarque'],
				'nolivraison'	=>$numlivraison
		);

		$data2=array(
				'codeclient'	=> $this->session->client
			);
			$this->Parser->update_buill($id,$data);
			$this->Parser->update_num_client($id,$data2);
			redirect('facture/facturerbill/f/rech/'.$id);

	}

	public function facturepdf()
		{
			$this->load->library('Pdf');

			$id						= $this->uri->segment(3);
			$data['information']	= $this->Parser->get_facture($id);
			$this->load->view('pdf/pdffacture',$data);
		}
	public function facturehtml()
		{
			$id						= $this->uri->segment(3);
			$data['information']	= $this->Parser->get_facture($id);
			$this->load->view('facturehtml',$data);
		}

	public function searchFacture()
		{
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['id']				=	$this->uri->segment(5);

			$data['lessegments']= 	$this->Parser->get_paiement_awbl_or_fac($this->uri->segment(5));
			$this->load->view('paiement',$data);
		}
	public function searchFac()
		{
			$key = "";
			if(isset($_POST['noawbl'])){
				$key = $_POST['noawbl'];
			}

				redirect('facture/searchFacture/p/rechp/'.$key);
		}

	public function payerfacture()
		{
			$data = array(
			'idtx' 			=> date('YmdHis'),
			'codetx' 		=> 'PMT',
			'description' 	=> 'Paiement',
			'payer' 		=> $_POST['montant'],
			'taux' 			=> $_POST['htaux'],
			'encaisse' 		=> $_POST['montantenc'],
			'monnaie' 		=> $_POST['monnaie'],
			'monnaie_apayer'=> $_POST['monnaie_apayer'],
			'nofacture' 	=> $_POST['nofacture'],
			'nopaiement' 	=> $this->Parser->give_num_pmt(),
			'typepmt' 		=> $_POST['type'],
			'awbl' 			=> $_POST['awbl'],
			'date' 			=> date('Y-m-d'),
			'codeclient' 	=> $_POST['codeclient'],
			'memo' 			=> $_POST['memo'],
			'norapport'		=>$this->session->numrapport,
			'status' 		=> '1'

			);

			$this->Parser->set_paiement_awbl($data);

			redirect('facture/searchFacture/p/rechp/'.$this->uri->segment(5));
		}

	public function imprimerecu()
		{
			$this->load->library('Pdf');
			$data['id']				=	$this->uri->segment(3);

			$data['lessegments']= 	$this->Parser->get_paiement_recu($this->uri->segment(3));
			$this->load->view('recuhtml',$data);
		}

	public function rapport()
		{
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['lesfactures']	= 	$this->Parser->get_factures();
			$this->load->view('rapportFacture',$data);
		}


		public function todo(){
			echo $_POST['action']." Programmeur";
		}
}
?>
