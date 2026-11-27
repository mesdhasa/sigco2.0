<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Connexion / deconnexion (Bloc 02 : AUDIT-004, AUDIT-009).
 * La logique des droits a1..a100 est conservee dans Auth::droits_du_groupe().
 */
class Login extends MY_Controller {

	protected $acces = array(
		'index'              => self::PUBLIQUE,
		'signin'             => self::PUBLIQUE,
		'failed'             => self::PUBLIQUE,
		'reset_mot_de_passe' => self::PUBLIQUE,
		'send_mail'          => self::PUBLIQUE,
		'signout'            => self::PUBLIQUE,
	);

	protected $post_requis = array('signin', 'send_mail');

	public function index()
	{
		if ($this->auth->verifier_session())
		{
			redirect('home');
		}
		$this->load->view('login');
	}

	public function signin()
	{
		// Meme normalisation de l'identifiant qu'avant (les tirets sont ignores)
		$identifiant = str_replace('-', '', (string) $this->input->post('username'));
		$resultat = $this->auth->connecter($identifiant, (string) $this->input->post('pwd'));

		if ($resultat === 'ok')
		{
			if ( ! empty($_SESSION['mdp_a_changer']))
			{
				$this->session->set_flashdata('sms2', 'Votre mot de passe doit etre change avant de continuer.');
				redirect('utilisateur/mod_passe');
			}
			redirect('home');
		}

		if ($resultat === 'bloque')
		{
			$this->session->set_flashdata('sms', 'Trop de tentatives de connexion. Reessayez dans '.Auth::FENETRE_MINUTES.' minutes.');
			redirect('login');
		}

		redirect('login_param/failed');
	}

	public function signout()
	{
		$this->auth->deconnecter();
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

	/**
	 * L'ancienne version envoyait un e-mail de test a des adresses factices.
	 * La reinitialisation par lien e-mail est hors perimetre (rapport, section 9) :
	 * c'est l'administrateur qui genere un mot de passe temporaire.
	 */
	public function send_mail()
	{
		$this->session->set_flashdata('sms','Contactez l\'administrateur SIGCO : il vous remettra un mot de passe temporaire.');
		redirect('mot-de-passe-oublie');
	}
}
