<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
{
		parent::__construct();
}

	public function index()
	{
		if($this->session->identreprise != ""){
			redirect('home');
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
		$_SESSION['account']['idgroupe'] 		= $luser->agroupe;
		$_SESSION['account']['parent'] 			= $luser->codedoralya;
		$_SESSION['account']['code']			= $luser->uadmin;


		if($luser->agroupe == "001A"){
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
		}else{

			$users_groupe = $this->Parser_login->sign_groupe($luser->agroupe);

			foreach($users_groupe as $row){
				$_SESSION['droit']['groupe'] = $row->nom_groupe;
				$_SESSION['droit']['a1'] = $row->a1;
				$_SESSION['droit']['a2'] = $row->a2;
				$_SESSION['droit']['a3'] = $row->a3;
				$_SESSION['droit']['a4'] = $row->a4;
				$_SESSION['droit']['a5'] = $row->a5;
				$_SESSION['droit']['a6'] = $row->a6;
				$_SESSION['droit']['a7'] = $row->a7;
				$_SESSION['droit']['a8'] = $row->a8;
				$_SESSION['droit']['a9'] = $row->a9;
				$_SESSION['droit']['a10'] = $row->a10;
				$_SESSION['droit']['a11'] = $row->a11;
				$_SESSION['droit']['a12'] = $row->a12;
				$_SESSION['droit']['a13'] = $row->a13;
				$_SESSION['droit']['a14'] = $row->a14;
				$_SESSION['droit']['a15'] = $row->a15;
				$_SESSION['droit']['a16'] = $row->a16;
				$_SESSION['droit']['a17'] = $row->a17;
				$_SESSION['droit']['a18'] = $row->a18;
				$_SESSION['droit']['a19'] = $row->a19;
				$_SESSION['droit']['a20'] = $row->a20;
				$_SESSION['droit']['a21'] = $row->a21;
				$_SESSION['droit']['a22'] = $row->a22;
				$_SESSION['droit']['a23'] = $row->a23;
				$_SESSION['droit']['a24'] = $row->a24;
				$_SESSION['droit']['a25'] = $row->a25;
				$_SESSION['droit']['a26'] = $row->a26;
				$_SESSION['droit']['a27'] = $row->a27;
				$_SESSION['droit']['a28'] = $row->a28;
				$_SESSION['droit']['a29'] = $row->a29;
				$_SESSION['droit']['a30'] = $row->a30;
				$_SESSION['droit']['a31'] = $row->a31;
				$_SESSION['droit']['a32'] = $row->a32;
				$_SESSION['droit']['a33'] = $row->a33;
				$_SESSION['droit']['a34'] = $row->a34;
				$_SESSION['droit']['a35'] = $row->a35;
				$_SESSION['droit']['a36'] = $row->a36;
				$_SESSION['droit']['a37'] = $row->a37;
				$_SESSION['droit']['a38'] = $row->a38;
				$_SESSION['droit']['a39'] = $row->a39;
				$_SESSION['droit']['a40'] = $row->a40;
				$_SESSION['droit']['a41'] = $row->a41;
				$_SESSION['droit']['a42'] = $row->a42;
				$_SESSION['droit']['a43'] = $row->a43;
				$_SESSION['droit']['a44'] = $row->a44;
				$_SESSION['droit']['a45'] = $row->a45;
				$_SESSION['droit']['a46'] = $row->a46;
				$_SESSION['droit']['a47'] = $row->a47;
				$_SESSION['droit']['a48'] = $row->a48;
				$_SESSION['droit']['a49'] = $row->a49;
				$_SESSION['droit']['a50'] = $row->a50;
				$_SESSION['droit']['a51'] = $row->a51;
				$_SESSION['droit']['a52'] = $row->a52;
				$_SESSION['droit']['a53'] = $row->a53;
				$_SESSION['droit']['a54'] = $row->a54;
				$_SESSION['droit']['a55'] = $row->a55;
				$_SESSION['droit']['a56'] = $row->a56;
				$_SESSION['droit']['a57'] = $row->a57;
				$_SESSION['droit']['a58'] = $row->a58;
				$_SESSION['droit']['a59'] = $row->a59;
				$_SESSION['droit']['a60'] = $row->a60;
				$_SESSION['droit']['a61'] = $row->a61;
				$_SESSION['droit']['a62'] = $row->a62;
				$_SESSION['droit']['a63'] = $row->a63;
				$_SESSION['droit']['a64'] = $row->a64;
				$_SESSION['droit']['a65'] = $row->a65;
				$_SESSION['droit']['a66'] = $row->a66;
				$_SESSION['droit']['a67'] = $row->a67;
				$_SESSION['droit']['a68'] = $row->a68;
				$_SESSION['droit']['a69'] = $row->a69;
				$_SESSION['droit']['a70'] = $row->a70;
				$_SESSION['droit']['a71'] = $row->a71;
				$_SESSION['droit']['a72'] = $row->a72;
				$_SESSION['droit']['a73'] = $row->a73;
				$_SESSION['droit']['a74'] = $row->a74;
				$_SESSION['droit']['a75'] = $row->a75;
				$_SESSION['droit']['a76'] = $row->a76;
				$_SESSION['droit']['a77'] = $row->a77;
				$_SESSION['droit']['a78'] = $row->a78;
				$_SESSION['droit']['a79'] = $row->a79;
				$_SESSION['droit']['a80'] = $row->a80;
				$_SESSION['droit']['a81'] = $row->a81;
				$_SESSION['droit']['a82'] = $row->a82;
				$_SESSION['droit']['a83'] = $row->a83;
				$_SESSION['droit']['a84'] = $row->a84;
				$_SESSION['droit']['a85'] = $row->a85;
				$_SESSION['droit']['a86'] = $row->a86;
				$_SESSION['droit']['a87'] = $row->a87;
				$_SESSION['droit']['a88'] = $row->a88;
				$_SESSION['droit']['a89'] = $row->a89;
				$_SESSION['droit']['a90'] = $row->a90;
				$_SESSION['droit']['a91'] = $row->a91;
				$_SESSION['droit']['a92'] = $row->a92;
				$_SESSION['droit']['a93'] = $row->a93;
				$_SESSION['droit']['a94'] = $row->a94;
				$_SESSION['droit']['a95'] = $row->a95;
				$_SESSION['droit']['a96'] = $row->a96;
				$_SESSION['droit']['a97'] = $row->a97;
				$_SESSION['droit']['a98'] = $row->a98;
				$_SESSION['droit']['a99'] = $row->a99;
				$_SESSION['droit']['a100'] = $row->a100;

				//===================================

			}





		}


			$trouve = true;
		}

		if($trouve){
			redirect('home');

		}else{

			$this->session->sess_destroy();
			redirect('login_param/failed');

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
