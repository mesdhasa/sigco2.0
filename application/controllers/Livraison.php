<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livraison extends CI_Controller {

	public function index()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			$this->load->view('livraison',$data);
	}
	public function index_degroup()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);
			$this->load->view('livraison2',$data);
	}

	public function recherche()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
			$data['act']	=	$this->uri->segment(3);
			$data['y']		=	$this->uri->segment(4);

			if(isset($_POST['noawbl'])){
  $val=$this->Parser->verify_degroup($_POST['noawbl']);

	if ($val) {

		$numlivraison = $this->Parser->get_nolivraison($_POST['noawbl']);
		// 	 echo "<pre>";
		// print_r($numlivraison);
		// echo "</pre>";
		$colisLivre = 0;
		foreach($numlivraison as $r){
			if($r->recupar2=='n'){
			$_SESSION['lesno']['no'][] 		= $r->nolivraison;
			$_SESSION['lesno']['awbl'][] 	= $r->awbl;
			$_SESSION['lesno']['awbl_de'][] 	= $r->nobuil;
			$_SESSION['lesno']['awbl_id'][] 	= $r->iddeg;
			$_SESSION['lesno']['awbl_livrer'][] 	= $r->autorisation_livrer;
			}else{
				$colisLivre++;
				$this->session->set_flashdata('sms','colis livré   '.$colisLivre . ' sur '. count($numlivraison));

			}

		}
redirect('livraison/index_degroup/l/liv');
	}else {

		$numlivraison = $this->Parser->get_nolivraison2($_POST['noawbl']);
		foreach($numlivraison as $r){
			if($r->recupar=='n'){
			$_SESSION['lesno']['no'][] 		= $r->nolivraison;
			$_SESSION['lesno']['awbl'][] 	= $r->awbl;
			}else{
				$this->session->set_flashdata('sms','Ce colis est déjà livré.');
		redirect('livraison/index/l/liv');
			}

		};
	}

			}
			redirect('livraison/index/l/liv');

	}
	public function vider_nolivraison()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
			unset($_SESSION['lesno']);
			redirect('livraison/index/l/liv');
	}

	public function livrer()
	{
		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}
			if(isset($_POST['receveur']) and $_POST['receveur']==""){
				$this->session->set_flashdata('sms','Veuillez saisir un receveur.');
				redirect('livraison/index/l/liv');
			}else{

				for($i=0;$i<count($_SESSION['lesno']['no']);$i++){

					$data[]=array(
							'datelivre'		=>$this->session->ladate,
							'livrepar'		=>$_POST['received'],
							'recupar'		=>$_POST['receveur'],
							'nif'			=>$_POST['nif'],
							'awbl'			=>$_SESSION['lesno']['awbl'][$i],
							'nolivraison'=>$_SESSION['lesno']['no'][$i]
							);

					$datapointage[]=array(
							'awbl'		=>$_SESSION['lesno']['awbl'][$i],
							'pointerle'	=>$this->session->ladate,
							'status'	=>'1'
							);

				}

				$this->db->update_batch('buil',$data,'awbl');
				$this->db->update_batch('tbl_pointage',$datapointage,'awbl');

				unset($_SESSION['lesno']);
			}

			redirect('livraison/index/l/liv');
	}
	public function livrer2()
	{


		if($_SESSION['account']['code'] == ""){
			redirect('login');
		}

		if(isset($_POST['livrer'])){
			foreach ($_POST['livrer'] as $row) {
				$data[]=array(
						'livrer_le'		=>$this->session->ladate,
						'livrepar2'		=>$_POST['received'],
						'livrer'		=>"1",
						'recupar2'		=>$_POST['receveur'.$row],
						'nif2'			=>$_POST['nif'.$row],
						'nobuil'			=>$_POST['awbl_de'.$row],
						// 'nolivraison'=>$_POST['receveur'.$row]
						'autorisation_livrer'=>$_POST['autorisation'.$row]
						);
			}
		//
		// 	echo "<pre>";
		// print_r($data);
		// 	echo "</pre>";

		$this->db->update_batch('degroupage',$data,'nobuil');
		 unset($_SESSION['lesno']);
		 redirect('livraison/index/l/liv');

		}else {
			$this->session->set_flashdata('sms','veuillez cocher une case.');
		 redirect('livraison/index_degroup/l/liv');
		}


	}
	public function rap_livraison()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']			=	$this->uri->segment(3);
			$data['y']				=	$this->uri->segment(4);
			$data['leslivraisons']	= 	$this->Parser->get_rap_livraison($this->session->ladate);
			$data['degroup']	= 	$this->Parser->get_rap_livraison2($this->session->ladate);

			// 	echo "<pre>";
			// print_r($data['degroup']);
			// 	echo "</pre>";
			$this->load->view('pod_report',$data);
		}
		public function non_livraison()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$data['act']			=	$this->uri->segment(3);
				$data['y']				=	$this->uri->segment(4);
				$this->load->view('non_pod_report',$data);
			}
		public function pod_report()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$this->load->library('Pdf');

				$no			= $this->uri->segment(3);
				$data['leslivraisons']	= 	$this->Parser->get_rap_livraison($no);
				$data['degroup']	= 	$this->Parser->get_rap_livraison2($no);
				$this->load->view('pdf/pod_report',$data);
			}

			public function pod_report_date()
				{
					if($_SESSION['account']['code'] == ""){
						redirect('login');
					}
					$data['act']			=	'l';
					$data['y']				=	'rap';
					$date1=chaineVersDate($_POST['date1']);
					$date2=chaineVersDate($_POST['date2']);
					if(!empty($_POST['date1']) && !empty($_POST['date2']) ){
						$data['leslivraisons']= 	$this->Parser->recherche_livraison_date(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
						$data['degroup']= 	$this->Parser->recherche_livraison_date2(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
						$this->session->no = chaineVersDate($_POST['date1']);
						$this->session->no = chaineVersDate($_POST['date2']);
					}
					// $data['leslivraisons']	= 	$this->Parser->get_rap_livraison($this->session->ladate);
					$this->load->view('pod_report2',$data);
				}

				public function non_livrer_date()
					{
						if($_SESSION['account']['code'] == ""){
							redirect('login');
						}
						$data['act']			=	'l';
						$data['y']				=	'non';
						$date1=chaineVersDate($_POST['date1']);
						$date2=chaineVersDate($_POST['date2']);
						if(!empty($_POST['date1']) && !empty($_POST['date2']) ){
							$data['les_non_livraisons']= 	$this->Parser->recherche_non_livraison_date(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
							$this->session->no = chaineVersDate($_POST['date1']);
							$this->session->no = chaineVersDate($_POST['date2']);
						}
						// $data['leslivraisons']	= 	$this->Parser->get_rap_livraison($this->session->ladate);
						$this->load->view('non_pod_report2',$data);
					}
				public function pod_report_total()
					{
						if($_SESSION['account']['code'] == ""){
							redirect('login');
						}
						$this->load->library('Pdf');

						$date1			= $this->uri->segment(5).'-'.$this->uri->segment(4).'-'.$this->uri->segment(3);
						$date2		= $this->uri->segment(8).'-'.$this->uri->segment(7).'-'.$this->uri->segment(6);
						$data['leslivraisons']= 	$this->Parser->recherche_livraison_date($date1,$date2);
						$data['degroup']= 	$this->Parser->recherche_livraison_date2($date1,$date2);
						$this->session->no = chaineVersDate($_POST['date1']);
						$this->session->no = chaineVersDate($_POST['date2']);
						$this->load->view('pdf/pod_report2',$data);
					}
					public function non_livrer_pdf()
						{
							if($_SESSION['account']['code'] == ""){
								redirect('login');
							}
							$this->load->library('Pdf');

							$date1			= $this->uri->segment(5).'-'.$this->uri->segment(4).'-'.$this->uri->segment(3);
							$date2		= $this->uri->segment(8).'-'.$this->uri->segment(7).'-'.$this->uri->segment(6);
							$data['les_non_livraisons']= 	$this->Parser->recherche_non_livraison_date($date1,$date2);
							$this->session->no = chaineVersDate($_POST['date1']);
							$this->session->no = chaineVersDate($_POST['date2']);
							$this->load->view('pdf/non_livrer_pdf',$data);
						}

}
?>
