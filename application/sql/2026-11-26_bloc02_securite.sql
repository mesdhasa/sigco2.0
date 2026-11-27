-- =====================================================================
-- SIGCO 2.0 - Bloc 02 (fondations et securite) - migration 1/2
-- A executer APRES une sauvegarde complete de la base, AVANT de deployer
-- le code du bloc 02 (le nouveau login a besoin de ces colonnes).
-- Idempotent : peut etre rejoue sans erreur (MySQL 8.0+).
-- =====================================================================

-- Les tables contiennent des dates 0000-00-00 (valeur metier) : sans cela, MySQL 8.0+/9.x
-- en mode strict refuse toute modification de structure de la table.
SET SESSION sql_mode = '';

-- AUDIT-004 : place pour password_hash() (bcrypt = 60 car., argon2 ~ 100)
ALTER TABLE entreprise MODIFY mpasse VARCHAR(255) NOT NULL;

-- AUDIT-004 : changement de mot de passe obligatoire a la prochaine connexion
SET @c := (SELECT COUNT(*) FROM information_schema.columns
           WHERE table_schema = DATABASE() AND table_name = 'entreprise' AND column_name = 'mdp_a_changer');
SET @q := IF(@c = 0, 'ALTER TABLE entreprise ADD COLUMN mdp_a_changer TINYINT(1) NOT NULL DEFAULT 0', 'SELECT 1');
PREPARE s FROM @q; EXECUTE s; DEALLOCATE PREPARE s;

-- Comptes encore sur le mot de passe par defaut "password" : changement force
-- Empreinte MD5 de "password" en dur : la fonction SQL MD5() n'existe plus dans MySQL 9.7
UPDATE entreprise SET mdp_a_changer = 1 WHERE mpasse = '5f4dcc3b5aa765d61d8327deb882cf99';

-- AUDIT-009 : limitation des tentatives de connexion
CREATE TABLE IF NOT EXISTS sigco_tentative_connexion (
	id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
	identifiant    VARCHAR(50)  NOT NULL,
	ip             VARCHAR(45)  NOT NULL,
	date_tentative DATETIME     NOT NULL,
	PRIMARY KEY (id),
	KEY idx_identifiant_date (identifiant, date_tentative),
	KEY idx_ip_date (ip, date_tentative)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- AUDIT-002 / AUDIT-019 : journal de securite (connexions, droits, mots de passe, refus)
-- Table en ajout seul : l'application n'y fait jamais d'UPDATE ni de DELETE.
CREATE TABLE IF NOT EXISTS sigco_journal_securite (
	id             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	date_evenement DATETIME     NOT NULL,
	identreprise   VARCHAR(50)  NULL,
	uadmin         VARCHAR(50)  NULL,
	ip             VARCHAR(45)  NULL,
	action         VARCHAR(64)  NOT NULL,
	cible          VARCHAR(255) NULL,
	details        TEXT         NULL,
	PRIMARY KEY (id),
	KEY idx_date (date_evenement),
	KEY idx_action (action),
	KEY idx_utilisateur (identreprise)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
