<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Utilisateur extends CI_Controller {

	public function index()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	"u";
			$data['y']			=	"add";
			$data['lesgroupes']= 	$this->Parser_utilisateur->get_utilisateur_all();
			$this->load->view('ajouterutilisateur',$data);
		}
		public function mod_passe()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$this->load->view('mod_de_passe');
			}
			public function mod_de_passe()
				{
					if($_SESSION['account']['code'] == ""){
						redirect('login');
					}
					$id2 = $_SESSION['account']['id'];
					$data1 = array();
$id = $_SESSION['account']['id'];
$passe = md5($_POST['mpa']);
$data['testuser']= 	$this->Parser_utilisateur->testuser ($id,$passe);

if (count($data['testuser']) > 0){

	if ($_POST['nmp']==$_POST['cnmp']){
		$data = array(
			'mpasse' =>md5($_POST['nmp']),
			);

		$this->Parser_utilisateur->set_a_testuser($id2,$data);
		$this->session->set_flashdata('sms','success');
		// redirect('utilisateur/mod_passe');
		redirect('login_param/signout');
	}
	else{
		$this->session->set_flashdata('sms2','Les mots de passe sont differents');
		redirect('utilisateur/mod_passe');
	}

}else{
	$this->session->set_flashdata('sms2','Erreur mot de passe actuel');
	redirect('utilisateur/mod_passe');
}
				}
		public function ajouter()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$this->session->set_flashdata('sms','Votre contact est enregistré avec succès.');

			$id = $this->Parser_utilisateur->get_idcode($_SESSION['account']['parent']);

			$data = array(
					'identreprise' => $id,
					'telephones' => $_POST['telephone1'],
					'adresse_email'=> $_POST['email'],
					'uadmin' => $_POST['user'],
					'mpasse'=>md5('password'),
					'agroupe'=> $_POST['groupe'],
					'date_activation'=> $_POST['salutation'],
					'letat' => '1',
					'account'=> '1',
					'monnaie'=> 'GDES;USD',
					'nompers' => $_POST['nomp'],
					'prenompers' => $_POST['prenom'],
					'salutation'=> $_POST['salutation'],
					'tel2'=> $_POST['telephone2'],
				);
				$this->Parser_utilisateur->ajouter($data);
				redirect('afficher-un-contact/'.$id);
		}

		public function mod_utilisateur()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$this->session->set_flashdata('sms','Votre contact est enregistré avec succès.');
			$utilisateur_code = $_POST['iduser'];
			$data = array(
					'telephones' => $_POST['telephone1'],
					'adresse_email'=> $_POST['email'],
					'uadmin' => $_POST['user'],
					'agroupe'=> $_POST['groupuser'],
					'date_activation'=> $_POST['salutation'],
					'letat' =>  $_POST['etat'],
					'account'=> '1',
					'monnaie'=> 'GDES;USD',
					'nompers' => $_POST['nomp'],
					'prenompers' => $_POST['prenom'],
					'remarque' => $_POST['information'],
					'salutation'=> $_POST['salutation'],
					'tel2'=> $_POST['telephone2'],
				);
				$this->Parser_utilisateur->set_a_utilisateur($utilisateur_code,$data);
				redirect("utilisateur/modifier/u/liste_utilisateur/".$utilisateur_code);
		}
		public function reset_utilisateur()
			{
				if($_SESSION['account']['code'] == ""){
					redirect('login');
				}
				$utilisateur_code				= $this->uri->segment(3);
				// $data['identreprise']		= $utilisateur_code;
				$data = array(
						'mpasse'=>md5('password'),
					);

					$this->Parser_utilisateur->set_a_password($utilisateur_code,$data);
					redirect("utilisateur/modifier/u/liste_utilisateur/".$utilisateur_code);
			}
			public function lister()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['lesutilisateurs']= 	$this->Parser_utilisateur->get_all_utilisateur();
			$this->load->view('listeutilisateur',$data);
		}
			public function modifier()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$data['lesgroupes']= 	$this->Parser_utilisateur->get_utilisateur_all();
			$data['utilisateur']	    = 	$this->Parser_utilisateur->get_utilisateur($this->uri->segment(5));
			$this->load->view('modutilisateur',$data);
		}
			public function groupe()
		{
			if($_SESSION['account']['code'] == ""){
				redirect('login');
			}
			$data['act']		=	$this->uri->segment(3);
			$data['y']			=	$this->uri->segment(4);
			$this->load->view('groupe',$data);
		}
}
?>
