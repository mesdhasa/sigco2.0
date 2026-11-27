<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";

/**
 * Gestion des utilisateurs (Bloc 02 : AUDIT-002, AUDIT-004).
 * - Droits verifies cote serveur (a24 = gerer, a25 = lister, a28 = groupes).
 * - Plus de mot de passe par defaut "password" : mot de passe temporaire aleatoire,
 *   change obligatoirement a la premiere connexion.
 * - Un utilisateur ne peut ni changer son propre groupe ni se desactiver.
 * - Changements de groupe, d'etat et de mot de passe journalises.
 */
class Utilisateur extends MY_Controller {

	protected $acces = array(
		'index'             => 'a24',
		'ajouter'           => 'a24',
		'mod_utilisateur'   => 'a24',
		'reset_utilisateur' => 'a24',
		'lister'            => 'a25',
		'modifier'          => array('a24', 'a25'),
		'groupe'            => 'a28',
		'mod_passe'         => self::SESSION,
		'mod_de_passe'      => self::SESSION,
	);

	protected $post_requis = array('ajouter', 'mod_utilisateur', 'reset_utilisateur', 'mod_de_passe');

	public function index()
	{
		$data['act']		=	"u";
		$data['y']			=	"add";
		$data['lesgroupes']= 	$this->Parser_utilisateur->get_utilisateur_all();
		$this->load->view('ajouterutilisateur',$data);
	}

	public function mod_passe()
	{
		$this->load->view('mod_de_passe');
	}

	public function mod_de_passe()
	{
		$id = $_SESSION['account']['id'];
		$user = $this->db->where('identreprise', $id)->limit(1)->get('entreprise')->row();

		if ( ! $user OR ! $this->auth->verifier_mot_de_passe((string) $this->input->post('mpa'), $user))
		{
			$this->session->set_flashdata('sms2','Erreur mot de passe actuel');
			redirect('utilisateur/mod_passe');
		}

		$nouveau = (string) $this->input->post('nmp');
		if ($nouveau !== (string) $this->input->post('cnmp'))
		{
			$this->session->set_flashdata('sms2','Les mots de passe sont differents');
			redirect('utilisateur/mod_passe');
		}

		$erreur = $this->auth->valider_nouveau_mot_de_passe($nouveau);
		if ($erreur === NULL && $this->auth->verifier_mot_de_passe($nouveau, $user))
		{
			$erreur = 'Le nouveau mot de passe doit etre different de l\'ancien.';
		}
		if ($erreur !== NULL)
		{
			$this->session->set_flashdata('sms2', $erreur);
			redirect('utilisateur/mod_passe');
		}

		$this->Parser_utilisateur->set_a_testuser($id, array(
			'mpasse'        => $this->auth->hacher($nouveau),
			'mdp_a_changer' => 0,
		));
		$this->auth->journaliser('mot_de_passe_change', $id);
		$this->session->set_flashdata('sms','success');
		// Comme avant : deconnexion apres changement du mot de passe
		redirect('login_param/signout');
	}

	public function ajouter()
	{
		$groupe = (string) $this->input->post('groupe');
		if ( ! $this->_groupe_attribuable($groupe))
		{
			$this->session->set_flashdata('sms', 'Groupe invalide.');
			redirect('utilisateur');
		}

		$id = $this->Parser_utilisateur->get_idcode($_SESSION['account']['parent']);
		$temporaire = $this->auth->mot_de_passe_temporaire();

		$data = array(
				'identreprise' => $id,
				'telephones' => $this->input->post('telephone1'),
				'adresse_email'=> $this->input->post('email'),
				'uadmin' => $this->input->post('user'),
				'mpasse'=> $this->auth->hacher($temporaire),
				'mdp_a_changer' => 1,
				'agroupe'=> $groupe,
				'date_activation'=> $this->input->post('salutation'),
				'letat' => '1',
				'account'=> '1',
				'monnaie'=> 'GDES;USD',
				'nompers' => $this->input->post('nomp'),
				'prenompers' => $this->input->post('prenom'),
				'salutation'=> $this->input->post('salutation'),
				'tel2'=> $this->input->post('telephone2'),
			);
		$this->Parser_utilisateur->ajouter($data);
		$this->auth->journaliser('utilisateur_cree', $id, array('uadmin' => $data['uadmin'], 'groupe' => $groupe));

		$this->session->set_flashdata('sms', 'Utilisateur cr&eacute;&eacute;. Mot de passe temporaire (&agrave; transmettre &agrave; l\'utilisateur, il devra le changer) : <code>'.html_escape($temporaire).'</code>');
		redirect('utilisateur/modifier/u/liste_utilisateur/'.rawurlencode($id));
	}

	public function mod_utilisateur()
	{
		$utilisateur_code = (string) $this->input->post('iduser');
		$actuel = $this->db->where('identreprise', $utilisateur_code)->limit(1)->get('entreprise')->row();
		if ( ! $actuel)
		{
			show_404();
		}

		$groupe = (string) $this->input->post('groupuser');
		$etat = ((string) $this->input->post('etat') === '1') ? '1' : '0';

		// Interdiction de modifier son propre groupe ou de se desactiver
		if ($utilisateur_code === (string) $_SESSION['account']['id'])
		{
			$groupe = $actuel->agroupe;
			$etat = (string) $actuel->letat;
		}
		elseif ($groupe !== $actuel->agroupe && ! $this->_groupe_attribuable($groupe))
		{
			$this->session->set_flashdata('sms2', 'Groupe invalide.');
			redirect("utilisateur/modifier/u/liste_utilisateur/".rawurlencode($utilisateur_code));
		}

		$data = array(
				'telephones' => $this->input->post('telephone1'),
				'adresse_email'=> $this->input->post('email'),
				'uadmin' => $this->input->post('user'),
				'agroupe'=> $groupe,
				'date_activation'=> $this->input->post('salutation'),
				'letat' =>  $etat,
				'account'=> '1',
				'monnaie'=> 'GDES;USD',
				'nompers' => $this->input->post('nomp'),
				'prenompers' => $this->input->post('prenom'),
				'remarque' => $this->input->post('information'),
				'salutation'=> $this->input->post('salutation'),
				'tel2'=> $this->input->post('telephone2'),
			);
		$this->Parser_utilisateur->set_a_utilisateur($utilisateur_code,$data);

		if ($groupe !== $actuel->agroupe OR $etat !== (string) $actuel->letat)
		{
			$this->auth->journaliser('utilisateur_droits_modifies', $utilisateur_code, array(
				'groupe_avant' => $actuel->agroupe, 'groupe_apres' => $groupe,
				'etat_avant' => $actuel->letat, 'etat_apres' => $etat,
			));
		}
		$this->session->set_flashdata('sms','Votre contact est enregistré avec succès.');
		redirect("utilisateur/modifier/u/liste_utilisateur/".rawurlencode($utilisateur_code));
	}

	public function reset_utilisateur()
	{
		$utilisateur_code = (string) $this->uri->segment(3);
		if (count($this->Parser_utilisateur->get_utilisateur($utilisateur_code)) === 0)
		{
			show_404();
		}
		$temporaire = $this->auth->mot_de_passe_temporaire();
		$this->Parser_utilisateur->set_a_password($utilisateur_code, array(
			'mpasse'        => $this->auth->hacher($temporaire),
			'mdp_a_changer' => 1,
		));
		$this->auth->journaliser('mot_de_passe_reinitialise', $utilisateur_code);
		$this->session->set_flashdata('sms', 'Mot de passe temporaire (&agrave; transmettre &agrave; l\'utilisateur, il devra le changer &agrave; la connexion) : <code>'.html_escape($temporaire).'</code>');
		redirect("utilisateur/modifier/u/liste_utilisateur/".rawurlencode($utilisateur_code));
	}

	public function lister()
	{
		$data['act']		=	$this->uri->segment(3);
		$data['y']			=	$this->uri->segment(4);
		$data['lesutilisateurs']= 	$this->Parser_utilisateur->get_all_utilisateur();
		$this->load->view('listeutilisateur',$data);
	}

	public function modifier()
	{
		$data['act']		=	$this->uri->segment(3);
		$data['y']			=	$this->uri->segment(4);
		$data['lesgroupes']= 	$this->Parser_utilisateur->get_utilisateur_all();
		$data['utilisateur']	    = 	$this->Parser_utilisateur->get_utilisateur($this->uri->segment(5));
		$this->load->view('modutilisateur',$data);
	}

	public function groupe()
	{
		$data['act']		=	$this->uri->segment(3);
		$data['y']			=	$this->uri->segment(4);
		$this->load->view('groupe',$data);
	}

	/**
	 * Groupe existant dans groupe_user. Le groupe "super administrateur" 001A
	 * (tous les droits, sans ligne en base) n'est attribuable que par un membre de 001A.
	 */
	private function _groupe_attribuable($groupe)
	{
		if ($groupe === Auth::GROUPE_SUPER_ADMIN)
		{
			return $_SESSION['account']['idgroupe'] === Auth::GROUPE_SUPER_ADMIN;
		}
		return $this->db->where('idgroupe_user', $groupe)->count_all_results('groupe_user') > 0;
	}
}
