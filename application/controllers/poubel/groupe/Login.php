<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if($this->session->identreprise != ""){
			redirect('app');
		}else{
			$this->load->view('login');
		}
	}

	public function signin()

	{
		//Connexion ADMIN sur ENTREPRISE
		$trouve = false;
		$users = $this->Parser_login->sign_in(str_replace("-","",$_POST['username']),md5($_POST['pwd']));

		foreach($users as $luser){

		$_SESSION['account']['id']  			= $luser->identreprise;
		$_SESSION['account']['nom'] 			= strtoupper($luser->nompers);
		$_SESSION['account']['prenom'] 			= $luser->prenompers;
		$_SESSION['account']['email'] 			= $luser->adresse_email;
		$_SESSION['account']['institution'] 	= $luser->entreprise;
		$_SESSION['account']['groupe'] 			= "admin";
		$_SESSION['account']['parent'] 			= $luser->codedoralya;
		$_SESSION['account']['idlogin']			= "";
		$_SESSION['account']['code']			= $luser->uadmin;
		$_SESSION['account']['logo']			= $luser->logo;
		$_SESSION['account']['type']			= $luser->typeent;
		$_SESSION['account']['monnaie']			= $luser->monnaie;

		$_SESSION['droit']['groupe'] 		= "Administration";

		$_SESSION['droit']['a1'] = "1";
		$_SESSION['droit']['a2'] = "1";
		$_SESSION['droit']['a3'] = "1";
		$_SESSION['droit']['a4'] = "1";
		$_SESSION['droit']['a5'] = "1";
		$_SESSION['droit']['a6'] = "1";
		$_SESSION['droit']['a7'] = "1";
		$_SESSION['droit']['a8'] = "1";
		$_SESSION['droit']['a9'] = "1";
		$_SESSION['droit']['a10'] = "1";
		$_SESSION['droit']['a11'] = "1";
		$_SESSION['droit']['a12'] = "1";
		$_SESSION['droit']['a13'] = "1";
		$_SESSION['droit']['a14'] = "1";
		$_SESSION['droit']['a15'] = "1";
		$_SESSION['droit']['a16'] = "1";
		$_SESSION['droit']['a17'] = "1";
		$_SESSION['droit']['a18'] = "1";
		$_SESSION['droit']['a19'] = "1";
		$_SESSION['droit']['a20'] = "1";
		$_SESSION['droit']['a21'] = "1";
		$_SESSION['droit']['a22'] = "1";
		$_SESSION['droit']['a23'] = "1";
		$_SESSION['droit']['a24'] = "1";
		$_SESSION['droit']['a25'] = "1";
		$_SESSION['droit']['a26'] = "1";
		$_SESSION['droit']['a27'] = "1";
		$_SESSION['droit']['a28'] = "1";
		$_SESSION['droit']['a29'] = "1";
		$_SESSION['droit']['a30'] = "1";
		$_SESSION['droit']['a31'] = "1";
		$_SESSION['droit']['a32'] = "1";
		$_SESSION['droit']['a33'] = "1";
		$_SESSION['droit']['a34'] = "1";
		$_SESSION['droit']['a35'] = "1";
		$_SESSION['droit']['a36'] = "1";
		$_SESSION['droit']['a37'] = "1";
		$_SESSION['droit']['a38'] = "1";
		$_SESSION['droit']['a39'] = "1";
		$_SESSION['droit']['a40'] = "1";
		$_SESSION['droit']['a41'] = "1";
		$_SESSION['droit']['a42'] = "1";
		$_SESSION['droit']['a43'] = "1";
		$_SESSION['droit']['a44'] = "1";
		$_SESSION['droit']['a45'] = "1";
		$_SESSION['droit']['a46'] = "1";
		$_SESSION['droit']['a47'] = "1";
		$_SESSION['droit']['a48'] = "1";
		$_SESSION['droit']['a49'] = "1";
		$_SESSION['droit']['a50'] = "1";
		$_SESSION['droit']['a51'] = "1";
		$_SESSION['droit']['a52'] = "1";
		$_SESSION['droit']['a53'] = "1";
		$_SESSION['droit']['a54'] = "1";
		$_SESSION['droit']['a55'] = "1";
		$_SESSION['droit']['a56'] = "1";
		$_SESSION['droit']['a57'] = "1";
		$_SESSION['droit']['a58'] = "1";
		$_SESSION['droit']['a59'] = "1";
		$_SESSION['droit']['a60'] = "1";
		$_SESSION['droit']['a61'] = "1";
		$_SESSION['droit']['a62'] = "1";
		$_SESSION['droit']['a63'] = "1";
		$_SESSION['droit']['a64'] = "1";
		$_SESSION['droit']['a65'] = "1";
		$_SESSION['droit']['a66'] = "1";
		$_SESSION['droit']['a67'] = "1";
		$_SESSION['droit']['a68'] = "1";
		$_SESSION['droit']['a69'] = "1";
		$_SESSION['droit']['a70'] = "1";
		$_SESSION['droit']['a71'] = "1";
		$_SESSION['droit']['a72'] = "1";
		$_SESSION['droit']['a73'] = "1";
		$_SESSION['droit']['a74'] = "1";
		$_SESSION['droit']['a75'] = "1";
		$_SESSION['droit']['a76'] = "1";
		$_SESSION['droit']['a77'] = "1";
		$_SESSION['droit']['a78'] = "1";
		$_SESSION['droit']['a79'] = "1";
		$_SESSION['droit']['a80'] = "1";
		$_SESSION['droit']['a81'] = "1";
		$_SESSION['droit']['a82'] = "1";
		$_SESSION['droit']['a83'] = "1";
		$_SESSION['droit']['a84'] = "1";
		$_SESSION['droit']['a85'] = "1";
		$_SESSION['droit']['a86'] = "1";
		$_SESSION['droit']['a87'] = "1";
		$_SESSION['droit']['a88'] = "1";
		$_SESSION['droit']['a89'] = "1";
		$_SESSION['droit']['a90'] = "1";
		$_SESSION['droit']['a91'] = "1";
		$_SESSION['droit']['a92'] = "1";
		$_SESSION['droit']['a93'] = "1";
		$_SESSION['droit']['a94'] = "1";
		$_SESSION['droit']['a95'] = "1";
		$_SESSION['droit']['a96'] = "1";
		$_SESSION['droit']['a97'] = "1";
		$_SESSION['droit']['a98'] = "1";
		$_SESSION['droit']['a99'] = "1";
		$_SESSION['droit']['a100'] = "1";

			$trouve = true;
		}

		if($trouve){
			redirect('home');

		}else{

			//Connexion Utilisateur sur collaborateur
			$users = $this->Parser_login->sign_in(str_replace("-","",$_POST['username']),md5($_POST['pwd']));
			foreach($users as $luser){

			$this->session->identreprise 	= $luser->identreprise;
			$this->session->idutilisateur 	= $luser->idutilisateur;
			$this->session->entreprise 		= $luser->entreprise;
			$this->session->logo 			= $luser->entreprise;
			$this->session->nom 			= strtoupper($luser->nompers);
			$this->session->prenom 			= $luser->prenompers;
			$this->session->mpasse 			= $luser->mpasse;
			$this->session->agroupe 		= $luser->agroupe;
			$this->session->codedoralya 	= $luser->codedoralya;

				$trouve = true;

			}

			if($trouve){

				redirect('home');

			}else{
				$this->session->sess_destroy();
				redirect('login_param/failed');
			}

		}

	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function failed()
	{
		$this->session->set_flashdata('sms','Mot de passe incorrect. R&eacute;essayer ou cliquer sur " Mot de passe oubli&eacute; " pour r&eacute;initialiser.');
		redirect('login');
	}

	public function reset_mot_de_passe()
	{
			$this->load->view('login/reset');
	}


	public function send_mail()
	{
		$this->email->from('your@example.com', 'Your Name');
		$this->email->to('someone@example.com');
		$this->email->cc('another@another-example.com');
		$this->email->bcc('them@their-example.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		$this->session->set_flashdata('sms','Veuillez v&eacute;rifier votre boite aux lettres.');
		redirect('mot-de-passe-oublie');
	}



}
