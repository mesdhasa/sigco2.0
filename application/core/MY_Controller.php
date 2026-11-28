<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controleur de base SIGCO (Bloc 02 : AUDIT-002, AUDIT-003, AUDIT-007).
 *
 * Toute methode appelee par une URL passe par _remap() :
 *   1. la methode doit exister et etre publique (sinon 404) ;
 *   2. la regle d'acces de la methode est cherchee dans $acces,
 *      puis $acces_defaut ; sans regle => REFUS (refus par defaut) ;
 *   3. sauf regle PUBLIQUE : session valide obligatoire (compte relu en base) ;
 *   4. sauf regle SESSION : le droit (a1..a100) est verifie cote serveur ;
 *   5. les methodes de $post_requis refusent tout ce qui n'est pas un POST
 *      (le POST est lui-meme protege par le jeton CSRF de CodeIgniter).
 *
 * Exemple dans un controleur :
 *   protected $acces_defaut = 'a21';
 *   protected $acces = array('etat_compte' => array('a21', 'a22'), 'lst' => 'a22');
 *   protected $post_requis = array('supprimerclient');
 */
#[\AllowDynamicProperties]
class MY_Controller extends CI_Controller
{
	/** Aucune session requise. */
	const PUBLIQUE = '@publique';
	/** Session valide requise, aucun droit particulier. */
	const SESSION = '@session';
	/** Tache planifiee : ligne de commande, ou URL avec ?jeton= egal a cron_token (env.php). */
	const CRON = '@cron';

	/** @var array methode => droit | array(droits, l'un suffit) | self::SESSION | self::PUBLIQUE */
	protected $acces = array();

	/** @var string|array|NULL regle des methodes absentes de $acces ; NULL = refus */
	protected $acces_defaut = NULL;

	/** @var array methodes qui modifient des donnees : POST obligatoire */
	protected $post_requis = array();

	/** @var array methodes encore accessibles quand un changement de mot de passe est exige */
	private $autorise_si_mdp_a_changer = array('utilisateur/mod_passe', 'utilisateur/mod_de_passe', 'login/signout', 'login/index', 'login/signin');

	public function __construct()
	{
		parent::__construct();

		// HTTPS obligatoire en production (AUDIT-009, SRS 6) : force_https dans env.php
		if (sigco_env('force_https', FALSE) && ! is_cli() && ! is_https())
		{
			$hote = parse_url(base_url(), PHP_URL_HOST);
			if ($hote)
			{
				redirect('https://'.$hote.$this->input->server('REQUEST_URI'), 'location', 301);
			}
		}

		// Mode SQL explicite : meme comportement sur MySQL 8.0, 8.4 et 9.x (voir config.php)
		$this->db->query('SET SESSION sql_mode = ?', array((string) config_item('sigco_sql_mode')));

		$this->load->library('auth');
		$this->acces = array_change_key_case($this->acces, CASE_LOWER);
		$this->post_requis = array_map('strtolower', $this->post_requis);
	}

	public function _remap($method, $params = array())
	{
		$reelle = $this->_methode_reelle($method);
		if ($reelle === NULL)
		{
			show_404();
		}
		$cle = strtolower($reelle);
		$regle = array_key_exists($cle, $this->acces) ? $this->acces[$cle] : $this->acces_defaut;

		if ($regle === NULL)
		{
			log_message('error', 'SIGCO acces refuse : aucune regle pour '.get_class($this).'::'.$reelle);
			$this->_refuser($reelle);
		}

		if ($regle === self::CRON)
		{
			$jeton = (string) sigco_env('cron_token', '');
			$fourni = (string) $this->input->get('jeton');
			if ( ! is_cli() && ($jeton === '' OR strlen($jeton) < 32 OR ! hash_equals($jeton, $fourni)))
			{
				show_404();
			}
		}
		elseif ($regle !== self::PUBLIQUE)
		{
			if ( ! $this->auth->verifier_session())
			{
				$this->_non_connecte();
			}

			// Mot de passe par defaut / reinitialise : seule la page de changement est accessible
			if ( ! empty($_SESSION['mdp_a_changer'])
				&& ! in_array(strtolower(get_class($this)).'/'.$cle, $this->autorise_si_mdp_a_changer, TRUE))
			{
				if ($this->input->is_ajax_request())
				{
					$this->_stop(403, 'Changement de mot de passe requis.');
				}
				$this->session->set_flashdata('sms2', 'Vous devez choisir un nouveau mot de passe avant de continuer.');
				redirect('utilisateur/mod_passe');
			}

			if ($regle !== self::SESSION && ! $this->auth->a_un_droit((array) $regle))
			{
				$this->_refuser($reelle, $regle);
			}
		}

		if (in_array($cle, $this->post_requis, TRUE) && $this->input->method() !== 'post')
		{
			$this->_stop(405, 'Methode non autorisee : cette action doit etre confirmee depuis l\'application.');
		}

		// Toute action d'ecriture ($post_requis) rend perimes les calculs en cache (tableau de bord,
		// factures impayees). Les recherches en POST n'invalident rien. Invalidation avant l'action
		// et a la fin de la requete (l'action peut se terminer par redirect()).
		if (in_array($cle, $this->post_requis, TRUE) && get_class($this) !== 'Login')
		{
			sigco_cache_invalider();
			register_shutdown_function('sigco_cache_invalider');
		}

		return call_user_func_array(array($this, $reelle), $params);
	}

	/**
	 * Retrouve le nom exact d'une methode publique propre au controleur
	 * (insensible a la casse, comme le routage CodeIgniter).
	 */
	private function _methode_reelle($method)
	{
		if ( ! is_string($method) OR $method === '' OR $method[0] === '_')
		{
			return NULL;
		}
		if ( ! method_exists($this, $method))
		{
			return NULL;
		}
		$r = new ReflectionMethod($this, $method);
		if ( ! $r->isPublic() OR $r->isStatic() OR $r->isConstructor())
		{
			return NULL;
		}
		$declarant = $r->getDeclaringClass()->getName();
		if ($declarant === 'CI_Controller' OR $declarant === 'MY_Controller')
		{
			return NULL;
		}
		return $r->getName();
	}

	private function _non_connecte()
	{
		if ($this->input->is_ajax_request())
		{
			$this->_stop(401, 'Session expiree. Veuillez vous reconnecter.');
		}
		redirect('login');
	}

	private function _refuser($methode, $regle = NULL)
	{
		if ($this->auth->connecte())
		{
			$this->auth->journaliser('acces_refuse', get_class($this).'::'.$methode, $regle === NULL ? NULL : array('droit' => $regle));
		}
		if ($this->input->is_ajax_request() OR ! $this->auth->connecte())
		{
			$this->_stop(403, 'Acces refuse.');
		}
		redirect('home/pas_access');
	}

	private function _stop($code, $message)
	{
		set_status_header($code);
		echo html_escape($message);
		exit;
	}
}
