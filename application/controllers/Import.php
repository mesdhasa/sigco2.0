<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Import extends CI_Controller {



	public function index()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
		  $data['act']		='i';
			$data['y']			='ajouter';
			$data['lessegments']= 	$this->Parser->get_segments();
			$data['compagnie']	= 	$this->Parser->get_compagnie();
			$this->load->view('import',$data);
		}

	public function creer()
		{
			if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
			$data['act']		='i';
			$data['y']			='ajouter';
			$data['lessegments']= 	$this->Parser->get_segments();
			$data['compagnie']	= 	$this->Parser->get_compagnie();
			$this->load->view('import',$data);
		}
	public function manifest()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['id']		=	$this->uri->segment(5);
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			$this->load->view('traitement',$data);
		}
	public function xml()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['idxml']	=	$this->uri->segment(5);
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			$data['lessegments']= 	$this->Parser->get_segments();
			$this->load->view('controlxml',$data);
		}
	public function add()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
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

			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
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
	// echo "<pre>";
	// 		print_r($data);
	// 		echo "</pre>";
	//
	// 		die();

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
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['lessegments']	= 	$this->Parser->get_Pointage();
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$this->load->view('pointage',$data);
		}
	public function add_pointage()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);

			$insert = array();
			$insert['awbl']			= $this->input->post('custum');
			$insert['qty']			= $this->input->post('qty');
			$insert['of_qty']			= $this->input->post('ofqty');
			$insert['pointerle']	= $this->session->ladate;
			$insert['xmlle']		= "0000-00-00";
			$insert['status']		= "0";

			$result			= $this->Parser->set_Pointage($insert);

			$this->session->set_flashdata('sms','AWBL ajout&eacute; avec succ&egrave;s.');
			redirect('/import/pointage/i/ptg');
		}
	public function awbl()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$idsegment			=	$this->uri->segment(5);
			$data['idvol']		= 	$idsegment;
			$data['lessegments']= 	$this->Parser->get_awbl($idsegment);
			$this->load->view('awbl',$data);
		}
	public function manifestxls()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			
			//$this->load->library('Excel');

			$idvol				= $this->uri->segment(3);
			$data['idvol']		= $idvol;
			$data['lesawb']	= $this->Parser->get_awbl($idvol);
			$this->load->view('xls/xlsmanifest',$data);
		}
	public function manifestpdf()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$this->load->library('Pdf');
			
			$idvol				= $this->uri->segment(3);
			// $data['lemanifeste'] 	= $this->Parser_export->get_lemanifeste2($id);
			$data['lesawb']	= $this->Parser->get_awbl($idvol);
			$this->load->view('pdf/pdfmanifest_import',$data);
		}

	public function recherchevol()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['lessegments']= 	array();
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			if(!empty($_POST['custum']) && empty($_POST['date1']) && empty($_POST['date2']) ){
				$data['lessegments']= 	$this->Parser->recherche_vol($_POST['custum']);
				$this->session->no = $_POST['custum'];
			}else{
				if(empty($_POST['custum']) && !empty($_POST['date1']) && !empty($_POST['date2']) ){
					$data['lessegments']= 	$this->Parser->recherche_vol_date(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
					$this->session->no = chaineVersDate($_POST['date1']);
		      $this->session->no = chaineVersDate($_POST['date2']);
				}
			}
			// print_r($data['lessegments']);
			$this->load->view('lstvol',$data);
		}
	public function supprimerVol()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
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
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			if(isset($_POST['custum'])){
				$data['lessegments']= 	$this->Parser->recherche_vol2($_POST['custum']);
			}else{
				$data['lessegments']= 	array();
			}
			$this->load->view('prepaid',$data);
		}

	public function prepaidcollect()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
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
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['lesegment']	= 	$this->Parser->get_a_segment($this->uri->segment(5));
			$data['compagnie']	= 	$this->Parser->get_compagnie();
			$this->load->view('editcustum',$data);
		}
		public function deletecustum()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$idsegment			=	$this->uri->segment(5);
				$data['lesaswb']= 	$this->Parser->get_awbl($idsegment);
				foreach($data['lesaswb'] as $row){
					$lespaiements			= 	$this->Parser->get_paiement_awbl_detail($row->awbl);
					foreach($lespaiements as $row2){
						// echo "<pre>";
						// print_r($lespaiements);
						// 		echo "</pre>";
						// switch ($row2->codetx != PMT) {
						// 	case
						// 	   $this->Parser->delete1_fac($idsegment);
						// 			$this->Parser->delete2_buil($idsegment);
						// 			$this->Parser->delete_vol($idsegment);
						// 			redirect('import/recherchevol/i/lister');
						// 			break;
						// 		default:
						// 		$this->session->set_flashdata('sms','Error Delete.......');
						//  redirect('import/recherchevol/i/lister');
						// 					break;
						// }
						// if($row2->codetx != 'PMT' ){
						// 	// echo "ok";
					 //
						// 	$this->Parser->delete1_fac($idsegment);
						// 	$this->Parser->delete2_buil($idsegment);
						// 	$this->Parser->delete_vol($idsegment);
						// 	redirect('import/recherchevol/i/lister');
						//  }
						// else {
						//  $this->session->set_flashdata('sms','Error Delete.......');
						// 	 redirect('import/recherchevol/i/lister');
					 //
					 // }

				 	 redirect('import/recherchevol/i/lister');

					}
				}



			}
		public function updatebill()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				if(isset($_POST['lesid'])){
					foreach($_POST['lesid'] as $row){
						$shot='0';
						$ladate = "";
						if(isset($_POST["datem".$row])){
							$ladate = chaineversdate($_POST['datenotification'.$row]);
						}
						if(isset($_POST["shot".$row]) AND $_POST["shot".$row]=="1"){
							$shot = "1";
						}
						$databill[]=array(
						'consignee'	=>$_POST['consignee'.$row],
						'freight'	=>$_POST['freight'.$row],
						'weight_charge'	=>$_POST['charge'.$row],
						'qty'	=>$_POST['qty'.$row],
						'shot'	=>$shot,
						'qtytotal'	=>$_POST['qtytotal'.$row],
						'id'		=>$row
						);
					}
					// 	 echo "<pre>";
					// print_r($databill);
					//    echo "</pre>";
					$this->Parser->set_les_bills2($databill);
				}
				redirect("import/awbl/i/lister/".$_POST['idvol']);
			}
			public function notifbill()
				{
					if($_SESSION['account']['code'] == ""){
						redirect('login');
					}
					if(isset($_POST['lesid'])){
						foreach($_POST['lesid'] as $row){
							$ladate = "";
							$timeno = "";
							if(isset($_POST["datenotification".$row])){
								$ladate = chaineversdate($_POST['datenotification'.$row]);
								$timeno=$_POST['timenotif'.$row];
							}
							$databill[]=array(
							'datenotification'	=>$ladate,
							'id'		=>$row,
							'heure_notication' 			=>$timeno,
							'person_notif'	=>$_POST['person_notif'.$row]
							);
						}
						// 	 echo "<pre>";
						// print_r($databill);
						//    echo "</pre>";

						$this->Parser->set_les_bills2($databill);
					}
					redirect("import/prepaidcollect/i/precol/".$_POST['idvol']);
				}

	public function updatecustum()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$id = $_POST['id'];

			$data = array(

				'Date_of_arrival' 	=> chaineversdate($_POST['Date_of_arrival']),
				'idcompagnie' 		=> $_POST['compagnie'],
				'custum' 			=> $_POST['custum'],
				'refdouane' 			=> $_POST['refdouane'],
				'Voyage_number' 	=> $_POST['Voyage_number'],
				'Registration_number_of_transport_code' => $_POST['Registration_number_of_transport_code'],
				'Place_of_departure_code' 	=> $_POST['Place_of_departure_code'],
				'Place_of_destination_code' 	=> $_POST['Place_of_destination_code']


				);


			$this->Parser->set_a_segment($id,$data);
			redirect('import/editcustum/i/ajouter/'.$id);
		}


	public function ajouterawbl()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['id']				=	$this->uri->segment(5);
			$data['lesegment']	= 	$this->Parser->get_a_segment($this->uri->segment(5));
			$this->load->view('addawbl',$data);
		}

	function deletepointage()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
		$id = $this->uri->segment(3);
		$this->Parser->supprimerPointage($id);
		redirect('import/pointage/i/ptg');
	}

	public function newawbl()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$val = $this->uri->segment(5);
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['idsegment']		=	$this->uri->segment(5);

			$this->load->view('addawbl',$data);
		}
		public function add_awbl()
		{
			$id=$_POST['idsegment'];
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
		$addawbl	=	$this->input->post('awblnum');

			$value=$this->Parser->verify_awbl($addawbl);

			if($value){
				$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave;');
				redirect('import/awbl/i/lister/'.$id);
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
						redirect('import/awbl/i/lister/'.$id);
				}else{
						$this->session->set_flashdata('sms','Veuillez contacter.......');
						redirect('import/creer/i/ajouter');
				}
			}
		}

	public function set_numRapport()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$t = $this->Parser->add_numRapport(date('Y-m-d'));
			if($t==1){
				$this->session->set_flashdata('sms','<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Une numéro existe pour ce jour.');
			}
			redirect('home');
		}

	public function detail()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$val = $this->uri->segment(5);
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['id']				=	$this->uri->segment(5);
			// $data['lessegments']	= 	$this->Parser->get_Un_awbl($val);
			$this->load->view('detail_bill',$data);
		}


			public function notif_buill()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
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


		public function Set_memo()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['l_id'] = $this->uri->segment(3);
			$idawb =	$this->uri->segment(3);
			$data['awbl_notif']= 	$this->Parser->get_awbl_notif($idawb);
			$this->load->view('v_memo',$data);
		}

		public function add_memo()
			{

	   	$id =	$_POST['idmemo'];
				if(isset($_POST['memo'])){
					$data = array(
						'remarque_notifcation' 			=> $_POST['memo'],
					);
				    $this->Parser->add_memo($data,$id);
				}
				redirect('import/Set_memo/'.$id);
			}
			public function recherche_notification1()
				{
					if($_SESSION['account']['code'] == ""){
						redirect('login');
					}
					$notif	= ($_POST['noawbl']);
					$data['notif']	= $this->Parser->recherche_notification1($_POST['noawbl']);
					// 	 echo "<pre>";
					// print_r($data['notif']);
					// echo "</pre>";
if(count($data['notif'])==0){
		redirect('import/precol/i/precol');

}else{
	foreach($data['notif'] as $row){
	 redirect('import/recherche_notification2/'.$row->awbl."/".$row->segmentid);

		}
}
				}
				public function recherche_notification2()
					{
						if($_SESSION['account']['code'] == ""){
							redirect('login');
						}
						$norapport	=$this->uri->segment(3);
						$data['act']	=	'i';
						$data['y']		=	'precol';
						$idsegment			=	$this->uri->segment(4);
						$data['idvol']		= 	$idsegment;
				  	$data['lessegments']	= $this->Parser->recherche_notification1($norapport);
					
						$this->load->view('notif_awbl',$data);
					}
					public function set_notification3()
						{
							if($_SESSION['account']['code'] == ""){
								redirect('login');
							}
							if(isset($_POST['lesid'])){
									$ladate = "";
									$timeno = "";
									if(isset($_POST["datenotification"])){
										$ladate = chaineversdate($_POST['datenotification']);
										$timeno=$_POST['timenotif'];
									}
									$databill=array(
									'datenotification'	=>$ladate,
									'heure_notication' 			=>$timeno,
									'person_notif'	=>$_POST['person_notif']
									);
								// 	 echo "<pre>";
								// print_r($databill);
								// 	 echo "</pre>";

								$this->Parser->set_notif3($_POST['lesid'],$databill);
							}
							redirect('import/recherche_notification2/'.$_POST['awb_num']."/".$_POST['idvol']);
						}

}

?>
