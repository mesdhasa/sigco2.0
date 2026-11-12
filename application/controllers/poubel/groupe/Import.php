<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Import extends CI_Controller {



	public function index()
		{
		    $data['act']		='i';
			$data['y']			='ajouter';
			$data['lessegments']= 	$this->Parser->get_segments();
			$data['compagnie']	= 	$this->Parser->get_compagnie();
			$this->load->view('import',$data);
		}

	public function creer()
		{
			$data['act']		='i';
			$data['y']			='ajouter';
			$data['lessegments']= 	$this->Parser->get_segments();
			$data['compagnie']	= 	$this->Parser->get_compagnie();
			$this->load->view('import',$data);
		}
	public function manifest()
		{
			$data['id']		=	$this->uri->segment(5);
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			$this->load->view('traitement',$data);
		}
	public function xml()
		{
			$data['idxml']	=	$this->uri->segment(5);
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			$this->load->view('controlxml',$data);
		}
	public function add()
		{

			$custum		=	$this->input->post('custum');
			$compagnie	=	$this->input->post('compagnie');

			$value=$this->Parser->verify($custum);

			if($value){
				$this->session->set_flashdata('sms','Ce code: '.$custum.' existe d&eacute;j&agrave;');
				redirect('import/creer/i/ajouter');
			}else{

				$insert = array();
				$insert['id'] 	  		=	null;
				$insert['custum'] 		= 	$custum;
				$insert['idcompagnie'] 	= 	$compagnie;
				$insert['typesegment'] 	= 	'Import';
				$insert['norapport'] 	= 	$this->session->numrapport;

				$is_true=false;
				$is_true=$this->Parser->set($insert);
				if($is_true){
						$this->session->set_flashdata('sms','Inserer avec success.');
						redirect('import/creer/i/ajouter');
				}else{
						$this->session->set_flashdata('sms','Veuillez contacter.......');
						redirect('import/creer/i/ajouter');
				}
			}

		}

	public function save()
		{
			$is_set=false;
			$data=array();
			$segment=array(
					'Customs_office_code'=>$_POST['Customs_office_code'],
					'Voyage_number'=>$_POST['Voyage_number'],
					'Date_of_departure'=>$_POST['Date_of_departure'],
					'Date_of_arrival'=>$_POST['Date_of_arrival'],
					'Time_of_arrival'=>$_POST['Time_of_arrival'],
					'Carrier_code'=>$_POST['Carrier_code'],
					'Carrier_name'=>$_POST['Carrier_name'],
					'Carrier_address'=>$_POST['Carrier_address'],
					'Mode_of_transport_code'=>$_POST['Mode_of_transport_code'],
					'Identity_of_transporter'=>$_POST['Identity_of_transporter'],
					'Nationality_of_transporter_code'=>$_POST['Nationality_of_transporter_code'],
					'Place_of_transporter'=>$_POST['Place_of_transporter'],
					'Registration_number_of_transport_code'=>$_POST['Registration_number_of_transport_code'],
					'Date_of_registration'=>$_POST['Date_of_registration'],
					'Master_information'=>$_POST['Master_information'],
					'Place_of_departure_code'=>$_POST['Place_of_departure_code'],
					'Place_of_destination_code'=>$_POST['Place_of_destination_code'],
					'status' => $_POST['status']
			);
			$data=array(
				'awbl'=>$_POST['ref'],
				'qty'=>$_POST['packages'],
				'qtytotal'=>$_POST['packages'],
				'package'=>$_POST['description'],
				'weight'=>$_POST['mass'],
				'consignee'=>$_POST['name'],
				'freight'=>$_POST['value'],
				'currency'=>$_POST['currency'],
				'notify_code'=>$_POST['notify_code'],
				'notify_name'=>$_POST['notify_name'],
				'notify_adress'=>$_POST['notify_address']
				);

			$is_set=$this->Parser->setBuilSegment('segment',$segment,'buil',$data,$_POST['id']);
			if($is_set){
				$this->session->set_flashdata('sms','XML upload&eacute; avec succ&egrave;s.');
				redirect('import/creer/i/ajouter');
			}
			else{
				echo "error";
			}
		}

	public function pointage()
		{
			$data['lessegments']	= 	$this->Parser->get_Pointage();
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$this->load->view('pointage',$data);
		}
	public function add_pointage()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);

			$insert = array();
			$insert['awbl']			= $this->input->post('custum');
			$insert['qty']			= $this->input->post('qty');
			$insert['pointerle']	= date('y-m-d');
			$insert['xmlle']		= "0000-00-00";
			$insert['status']		= "0";

			$result			= $this->Parser->set_Pointage($insert);

			$this->session->set_flashdata('sms','AWBL ajout&eacute; avec succ&egrave;s.');
			redirect('/import/pointage/i/ptg');
		}
	public function awbl()
		{

			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$idsegment			=	$this->uri->segment(5);
			$data['idvol']		= 	$idsegment;
			$data['lessegments']= 	$this->Parser->get_awbl($idsegment);
			$this->load->view('awbl',$data);
		}
	public function manifestxls()
		{
			$this->load->library('Excel');

			$idvol				= $this->uri->segment(3);
			$data['idvol']		= $idvol;
			$data['lesawbl']	= $this->Parser->get_awbl($idvol);
			$this->load->view('xls/xlsmanifest',$data);
		}
	public function manifestpdf()
		{
			$this->load->library('Pdf');

			$idvol				= $this->uri->segment(3);
			$data['idvol']		= $idvol;
			$data['lesawbl']	= $this->Parser->get_awbl($idvol);
			$this->load->view('pdf/pdfmanifest',$data);
		}

	public function recherchevol()
		{
			if(isset($this->session->no)){
				$data['lessegments']= 	$this->Parser->recherche_vol($this->session->no);
			}
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			if(isset($_POST['custum'])){
				$data['lessegments']= 	$this->Parser->recherche_vol($_POST['custum'],$_POST['date1'],$_POST['date2']);
				$this->session->no = $_POST['custum'];
				$this->session->no = $_POST['date1'];
				$this->session->no = $_POST['date2'];
			}else{
				$data['lessegments']= 	array();
			}
			$this->load->view('lstvol',$data);
		}
	public function supprimerVol()
		{
			$idvol				= $this->uri->segment(3);
			$data['idvol']		= $idvol;
			if(count($this->Parser->get_awbl($idvol)) > 0){
				$this->session->set_flashdata('sms','<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Erreur ce vol contient des AWBL.');
			}else{
				$this->Parser->delete_vol($idvol);
				$this->session->set_flashdata('sms','Vol supprim&eacute; avec succ&egrave;s.');
			}
			redirect('import/creer/i/ajouter');
		}
	public function precol()
		{
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			if(isset($_POST['custum'])){
				$data['lessegments']= 	$this->Parser->recherche_vol($_POST['custum']);
			}else{
				$data['lessegments']= 	array();
			}
			$this->load->view('prepaid',$data);
		}

	public function prepaidcollect()
		{

			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$idsegment			=	$this->uri->segment(5);
			$data['idvol']		= 	$idsegment;
			$data['lessegments']= 	$this->Parser->get_awbl($idsegment);
			$this->load->view('awblprecol',$data);
		}
		public function ajax_prepaidcollect()
		{
			if(isset($_POST['id'])){
			  $this->Parser->set_prepaidcollect($_POST['id'],$_POST['pp'],$_POST['cl'],$_POST['nc']);
			}
		}

	public function editcustum()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['lesegment']	= 	$this->Parser->get_a_segment($this->uri->segment(5));
			$data['compagnie']	= 	$this->Parser->get_compagnie();
			$this->load->view('editcustum',$data);
		}
		public function updatebill()
			{
				if(isset($_POST['lesid'])){

					foreach($_POST['lesid'] as $row){
						$ladate = "";
						if(isset($_POST["datem".$row])){
							$ladate = chaineversdate($_POST['datenotification'.$row]);
						}
						$databill[]=array(
						'consignee'	=>$_POST['consignee'.$row],
						'freight'	=>$_POST['freight'.$row],
						'qty'	=>$_POST['qty'.$row],
						'qtytotal'	=>$_POST['qtytotal'.$row],
						'datenotification'	=>$ladate,
						'id'		=>$row
						);
					}
					$this->Parser->set_les_bills($databill);
				}
				redirect("import/awbl/i/lister/".$_POST['idvol']);
			}

	public function updatecustum()
		{
			$id = $_POST['id'];

			$data = array(

				'Date_of_arrival' 	=> chaineversdate($_POST['Date_of_arrival']),
				'idcompagnie' 		=> $_POST['compagnie'],
				'custum' 			=> $_POST['custum'],
				'Voyage_number' 	=> $_POST['Voyage_number'],
				'Registration_number_of_transport_code' => $_POST['Registration_number_of_transport_code'],
				'Place_of_departure_code' 	=> $_POST['Place_of_departure_code'],
				'Place_of_destination_code' 	=> $_POST['Place_of_destination_code']


				);


			$this->Parser->set_a_segment($id,$data);
			redirect('import/creer/i/ajouter');
		}


	public function ajouterawbl()
		{
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['id']				=	$this->uri->segment(5);
			//$data['lesegment']	= 	$this->Parser->get_a_segment($this->uri->segment(5));
			$this->load->view('addawbl',$data);
		}

	function deletepointage(){

		$id = $this->uri->segment(3);
		$this->Parser->supprimerPointage($id);
		redirect('import/pointage/i/ptg');
	}

	public function newawbl()
		{
			$val = $this->uri->segment(5);
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['idsegment']		=	$this->uri->segment(5);

			$this->load->view('addawbl',$data);
		}
		public function add_awbl()
		{
		$addawbl	=	$this->input->post('awblnum');

			$value=$this->Parser->verify_awbl($addawbl);

			if($value){
				$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave;');
				redirect('import/creer/i/ajouter');
			}else{

				$insert = array();
				$insert['id'] 		     = 	NULL;
				$insert['awbl'] 		     = 	$addawbl;
				$insert['consignee'] 		 = 	$_POST['consignee'];
				$insert['notify_adress'] 	 = 	$_POST['notify_adress'];
				$insert['qty'] 		         = 	$_POST['qty'];
				$insert['qtytotal'] 		 = 	$_POST['qtytotal'];
				$insert['package'] 		     = 	$_POST['package'];
				$insert['weight'] 		     = 	$_POST['weight'];
				$insert['freight'] 		     = 	$_POST['freight'];
				$insert['currency'] 		 = 	$_POST['currency'];
				$insert['remarque'] 		 = 	$_POST['remarque'];
				$insert['segmentid'] 		 = 	$_POST['idsegment'];
				$insert['typeawbl'] 		 = 	'import';

				$is_true=false;
				$is_true=$this->Parser->set_addawbl($insert);
				if($is_true){
						$this->session->set_flashdata('sms','Inserer avec success.');
						redirect('import/creer/i/ajouter');
				}else{
						$this->session->set_flashdata('sms','Veuillez contacter.......');
						redirect('import/creer/i/ajouter');
				}
			}
		}

	public function set_numRapport()
		{
			$t = $this->Parser->add_numRapport(date('Y-m-d'));
			if($t==1){
				$this->session->set_flashdata('sms','<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Une numéro existe pour ce jour.');
			}
			redirect('home');
		}

	public function notif()
		{
			$val = $this->uri->segment(5);
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['id']				=	$this->uri->segment(5);
			$data['lessegments']	= 	$this->Parser->get_Un_awbl($val);
			$this->load->view('notif',$data);
		}

			public function notif_buill()
	{

		$id = $_POST['awbl'];

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
				'remarque'		=>$_POST['remarque']
		);

		$this->Parser->update_buill($id,$data);
		redirect('import/notif/i/precol/'.$id);


	}
}

?>
