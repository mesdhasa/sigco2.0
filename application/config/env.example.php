<?php
isset($GLOBALS['SIGCO_ENV']) OR exit('No direct script access allowed');
/*
 * MODELE de configuration propre a un serveur.
 * Copier ce fichier en application/config/env.php (non versionne) et le remplir.
 * Ne JAMAIS mettre de vrais secrets dans ce fichier-ci.
 *
 * Generer une cle :  php -r "echo bin2hex(random_bytes(32));"
 */
return array(
	// development | testing | production
	'environment'    => 'production',
	'base_url'       => 'https://example.org/sigco/',
	// true en production : cookies "Secure" et redirection HTTP -> HTTPS
	'force_https'    => TRUE,

	'db_hostname'    => 'localhost',
	'db_port'        => 3306,
	'db_username'    => '',
	'db_password'    => '',
	'db_database'    => '',

	// 64 caracteres hexadecimaux aleatoires, differents sur chaque serveur
	'encryption_key' => '',

	// Dossier des fichiers de session, hors du dossier temporaire partage
	// (laisser vide pour application/cache/sessions)
	'sess_save_path' => '',

	// Taches planifiees appelees par URL (?jeton=...) : 64 caracteres aleatoires.
	// Vide = taches planifiees uniquement en ligne de commande (recommande).
	'cron_token'     => '',
);
