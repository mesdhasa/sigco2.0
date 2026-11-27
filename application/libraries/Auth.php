<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentification, droits et journal de securite (Bloc 02 : AUDIT-002, 003, 004, 009, 019).
 *
 * - Connexion : password_hash() avec migration transparente des anciens MD5.
 * - Limitation des tentatives par identifiant et par adresse IP.
 * - Session regeneree a la connexion (anti-fixation).
 * - A chaque requete, le compte et les droits sont relus en base : un compte
 *   desactive ou un groupe modifie prend effet immediatement.
 * - Les droits a1..a100 gardent exactement la logique d'origine
 *   (groupe "001A" = tous les droits, sinon ligne du groupe dans groupe_user).
 */
class Auth
{
	const GROUPE_SUPER_ADMIN = '001A';
	const NB_DROITS = 100;

	// Limitation des tentatives (AUDIT-009)
	const MAX_ECHECS_IDENTIFIANT = 5;
	const MAX_ECHECS_IP = 20;
	const FENETRE_MINUTES = 15;

	const LONGUEUR_MIN_MDP = 12;

	/** @var CI_Controller */
	protected $CI;

	protected $session_verifiee = NULL;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	/* ------------------------------------------------------------------
	 * Connexion / deconnexion
	 * ------------------------------------------------------------------ */

	/**
	 * @return string 'ok' | 'echec' | 'bloque'
	 */
	public function connecter($identifiant, $mot_de_passe)
	{
		$identifiant = (string) $identifiant;
		$mot_de_passe = (string) $mot_de_passe;
		$ip = $this->CI->input->ip_address();

		if ($this->est_bloque($identifiant, $ip))
		{
			$this->journaliser('connexion_bloquee', $identifiant, NULL, $identifiant);
			return 'bloque';
		}

		$user = NULL;
		if ($identifiant !== '' && $mot_de_passe !== '')
		{
			$user = $this->CI->db->where('uadmin', $identifiant)
				->where('letat', '1')
				->limit(1)
				->get('entreprise')
				->row();
		}

		if ( ! $user OR ! $this->verifier_mot_de_passe($mot_de_passe, $user))
		{
			$this->enregistrer_echec($identifiant, $ip);
			$this->journaliser('connexion_echec', $identifiant, NULL, $identifiant);
			return 'echec';
		}

		// Ancien hachage MD5 (ou algorithme depasse) : on re-hache maintenant que le mot de passe est connu
		if ($this->est_md5($user->mpasse) OR password_needs_rehash($user->mpasse, PASSWORD_DEFAULT))
		{
			$this->CI->db->where('identreprise', $user->identreprise)
				->update('entreprise', array('mpasse' => password_hash($mot_de_passe, PASSWORD_DEFAULT)));
		}

		$this->effacer_echecs($identifiant);

		// Anti-fixation : nouvel identifiant de session, l'ancienne est detruite
		$this->CI->session->sess_regenerate(TRUE);
		$this->charger_session($user);

		// Mot de passe par defaut ou reinitialise : changement obligatoire
		$_SESSION['mdp_a_changer'] = ( ! empty($user->mdp_a_changer) OR $mot_de_passe === 'password');

		$this->journaliser('connexion', $user->uadmin);
		return 'ok';
	}

	public function deconnecter()
	{
		if ($this->connecte())
		{
			$this->journaliser('deconnexion');
		}
		$this->CI->session->sess_destroy();
		$this->session_verifiee = FALSE;
	}

	/**
	 * Remplit $_SESSION['account'] et $_SESSION['droit'] comme le faisait Login::signin.
	 */
	public function charger_session($luser)
	{
		$_SESSION['account']['id']          = $luser->identreprise;
		$_SESSION['account']['nom']         = strtoupper((string) $luser->nompers);
		$_SESSION['account']['prenom']      = $luser->prenompers;
		$_SESSION['account']['email']       = $luser->adresse_email;
		$_SESSION['account']['institution'] = $luser->entreprise;
		$_SESSION['account']['idgroupe']    = $luser->agroupe;
		$_SESSION['account']['parent']      = $luser->codedoralya;
		$_SESSION['account']['code']        = $luser->uadmin;

		$_SESSION['droit'] = $this->droits_du_groupe($luser->agroupe);
		$this->session_verifiee = TRUE;
	}

	/**
	 * Meme logique que l'ancien Login::signin :
	 * groupe 001A = tous les droits ; sinon les colonnes a1..a100 du groupe.
	 * Un groupe inexistant ne donne aucun droit.
	 */
	public function droits_du_groupe($agroupe)
	{
		$droits = array();

		if ($agroupe === self::GROUPE_SUPER_ADMIN)
		{
			$droits['groupe'] = 'Administration';
			for ($i = 1; $i <= self::NB_DROITS; $i++)
			{
				$droits['a'.$i] = '1';
			}
			return $droits;
		}

		$row = $this->CI->db->where('idgroupe_user', (string) $agroupe)->limit(1)->get('groupe_user')->row_array();
		if ($row)
		{
			$droits['groupe'] = $row['nom_groupe'];
			for ($i = 1; $i <= self::NB_DROITS; $i++)
			{
				$droits['a'.$i] = isset($row['a'.$i]) ? (string) $row['a'.$i] : '0';
			}
		}
		return $droits;
	}

	/* ------------------------------------------------------------------
	 * Etat de la session et droits
	 * ------------------------------------------------------------------ */

	public function connecte()
	{
		return ! empty($_SESSION['account']['code']) && ! empty($_SESSION['account']['id']);
	}

	/**
	 * Verifie la session ET relit le compte en base (une fois par requete).
	 * Compte supprime ou desactive => session detruite.
	 */
	public function verifier_session()
	{
		if ($this->session_verifiee !== NULL)
		{
			return $this->session_verifiee;
		}
		if ( ! $this->connecte())
		{
			return $this->session_verifiee = FALSE;
		}

		$user = $this->CI->db->where('identreprise', (string) $_SESSION['account']['id'])
			->where('letat', '1')
			->limit(1)
			->get('entreprise')
			->row();

		if ( ! $user OR $user->uadmin !== $_SESSION['account']['code'])
		{
			$this->CI->session->sess_destroy();
			return $this->session_verifiee = FALSE;
		}

		// Droits relus a chaque requete : un changement de groupe s'applique tout de suite
		$_SESSION['account']['idgroupe'] = $user->agroupe;
		$_SESSION['droit'] = $this->droits_du_groupe($user->agroupe);
		return $this->session_verifiee = TRUE;
	}

	public function a_droit($droit)
	{
		return isset($_SESSION['droit'][$droit]) && (string) $_SESSION['droit'][$droit] === '1';
	}

	/** Vrai si l'utilisateur a au moins un des droits donnes. */
	public function a_un_droit(array $droits)
	{
		foreach ($droits as $d)
		{
			if ($this->a_droit($d))
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function utilisateur_id()
	{
		return isset($_SESSION['account']['id']) ? $_SESSION['account']['id'] : NULL;
	}

	/* ------------------------------------------------------------------
	 * Mots de passe (AUDIT-004)
	 * ------------------------------------------------------------------ */

	public function hacher($mot_de_passe)
	{
		return password_hash((string) $mot_de_passe, PASSWORD_DEFAULT);
	}

	public function verifier_mot_de_passe($mot_de_passe, $user)
	{
		$stocke = (string) $user->mpasse;
		if ($this->est_md5($stocke))
		{
			return hash_equals(strtolower($stocke), md5($mot_de_passe));
		}
		return password_verify($mot_de_passe, $stocke);
	}

	protected function est_md5($hash)
	{
		return (bool) preg_match('/^[a-f0-9]{32}$/i', (string) $hash);
	}

	/**
	 * @return string|NULL message d'erreur, NULL si le mot de passe est acceptable
	 */
	public function valider_nouveau_mot_de_passe($mdp)
	{
		$mdp = (string) $mdp;
		if (strlen($mdp) < self::LONGUEUR_MIN_MDP)
		{
			return 'Le mot de passe doit contenir au moins '.self::LONGUEUR_MIN_MDP.' caracteres.';
		}
		if (strtolower($mdp) === 'password' OR ! preg_match('/[A-Za-z]/', $mdp) OR ! preg_match('/[0-9]/', $mdp))
		{
			return 'Le mot de passe doit contenir des lettres et des chiffres.';
		}
		return NULL;
	}

	/** Mot de passe temporaire aleatoire (remplace l'ancien "password" fixe). */
	public function mot_de_passe_temporaire()
	{
		$alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
		$mdp = '';
		for ($i = 0; $i < 14; $i++)
		{
			$mdp .= $alphabet[random_int(0, strlen($alphabet) - 1)];
		}
		// garantit au moins un chiffre
		return $mdp.random_int(2, 9);
	}

	/* ------------------------------------------------------------------
	 * Limitation des tentatives (AUDIT-009)
	 * ------------------------------------------------------------------ */

	protected function depuis()
	{
		return date('Y-m-d H:i:s', time() - self::FENETRE_MINUTES * 60);
	}

	public function est_bloque($identifiant, $ip)
	{
		$depuis = $this->depuis();
		$par_id = $this->CI->db->where('identifiant', (string) $identifiant)
			->where('date_tentative >=', $depuis)
			->count_all_results('sigco_tentative_connexion');
		if ($par_id >= self::MAX_ECHECS_IDENTIFIANT)
		{
			return TRUE;
		}
		$par_ip = $this->CI->db->where('ip', (string) $ip)
			->where('date_tentative >=', $depuis)
			->count_all_results('sigco_tentative_connexion');
		return $par_ip >= self::MAX_ECHECS_IP;
	}

	protected function enregistrer_echec($identifiant, $ip)
	{
		$this->CI->db->insert('sigco_tentative_connexion', array(
			'identifiant'    => substr((string) $identifiant, 0, 50),
			'ip'             => substr((string) $ip, 0, 45),
			'date_tentative' => date('Y-m-d H:i:s'),
		));
		// menage des tentatives anciennes
		$this->CI->db->where('date_tentative <', date('Y-m-d H:i:s', time() - 86400))
			->delete('sigco_tentative_connexion');
	}

	protected function effacer_echecs($identifiant)
	{
		$this->CI->db->where('identifiant', (string) $identifiant)->delete('sigco_tentative_connexion');
	}

	/* ------------------------------------------------------------------
	 * Journal de securite (AUDIT-002, AUDIT-019)
	 * ------------------------------------------------------------------ */

	public function journaliser($action, $cible = NULL, $details = NULL, $uadmin = NULL)
	{
		if (is_array($details) OR is_object($details))
		{
			$details = json_encode($details, JSON_UNESCAPED_UNICODE);
		}
		$this->CI->db->insert('sigco_journal_securite', array(
			'date_evenement' => date('Y-m-d H:i:s'),
			'identreprise'   => isset($_SESSION['account']['id']) ? $_SESSION['account']['id'] : NULL,
			'uadmin'         => $uadmin !== NULL ? substr((string) $uadmin, 0, 50) : (isset($_SESSION['account']['code']) ? $_SESSION['account']['code'] : NULL),
			'ip'             => $this->CI->input->ip_address(),
			'action'         => substr((string) $action, 0, 64),
			'cible'          => $cible !== NULL ? substr((string) $cible, 0, 255) : NULL,
			'details'        => $details,
		));
	}
}
