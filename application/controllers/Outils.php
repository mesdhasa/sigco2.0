<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Outils d'exploitation, en LIGNE DE COMMANDE uniquement (jamais par le web).
 *
 *   php index.php outils mots_de_passe_par_defaut C:/chemin/hors/site/mdp_temporaires.csv
 *
 * Bloc 02 - AUDIT-004 : les comptes encore sur le mot de passe par defaut "password"
 * recoivent un mot de passe temporaire aleatoire (hache), avec changement obligatoire
 * a la prochaine connexion. Le fichier CSV produit est a transmettre aux utilisateurs
 * par MESDHASA puis a SUPPRIMER. Il ne doit jamais etre place dans le dossier du site.
 */
class Outils extends MY_Controller {

	protected $acces_defaut = NULL;

	protected $acces = array(
		'mots_de_passe_par_defaut' => self::CRON,
	);

	public function mots_de_passe_par_defaut()
	{
		if ( ! is_cli())
		{
			show_404();
		}
		// Argument brut : CodeIgniter decoupe les arguments CLI sur "/" (chemins Windows et Linux)
		$fichier = isset($_SERVER['argv'][3]) ? (string) $_SERVER['argv'][3] : '';
		if ($fichier === '')
		{
			echo "Usage : php index.php outils mots_de_passe_par_defaut <fichier.csv hors du site>\n";
			exit(1);
		}
		$reel_site = realpath(FCPATH);
		$dossier = realpath(dirname($fichier));
		if ($dossier === FALSE)
		{
			echo "Dossier introuvable : ".dirname($fichier)."\n";
			exit(1);
		}
		if (stripos($dossier.DIRECTORY_SEPARATOR, $reel_site.DIRECTORY_SEPARATOR) === 0)
		{
			echo "Refuse : le fichier doit etre HORS du dossier du site ($reel_site).\n";
			exit(1);
		}

		$comptes = $this->db->select('identreprise, uadmin, nompers, prenompers, mpasse')
			->where('letat', '1')
			->get('entreprise')
			->result();

		$csv = fopen($fichier, 'x');
		if ( ! $csv)
		{
			echo "Impossible de creer $fichier (existe deja ?)\n";
			exit(1);
		}
		fputcsv($csv, array('identifiant', 'nom', 'prenom', 'mot_de_passe_temporaire'), ';');

		$n = 0;
		foreach ($comptes as $c)
		{
			if ( ! $this->auth->verifier_mot_de_passe('password', $c))
			{
				continue;
			}
			$temporaire = $this->auth->mot_de_passe_temporaire();
			$this->db->where('identreprise', $c->identreprise)->update('entreprise', array(
				'mpasse'        => $this->auth->hacher($temporaire),
				'mdp_a_changer' => 1,
			));
			fputcsv($csv, array($c->uadmin, $c->nompers, $c->prenompers, $temporaire), ';');
			$this->auth->journaliser('mot_de_passe_reinitialise', $c->identreprise, 'outil ligne de commande (AUDIT-004)', 'cli');
			$n++;
		}
		fclose($csv);
		echo "$n compte(s) reinitialise(s). Fichier : $fichier\n";
		echo "Transmettre les mots de passe aux utilisateurs, puis SUPPRIMER ce fichier.\n";
	}
}
