-- =====================================================================
-- SIGCO 2.0 - Bloc 03 (fonctionnalites) - migration
--
-- 1. Points de chargement dynamiques (table point_of_loading + colonne
--    manifeste.point_of_loading).
-- 2. Tracabilite : colonnes cree_* / modif_* sur awbl, manifeste, warehouse.
-- 4. Zone d'archives des AWB : table awbl_archive.
-- (Les fonctionnalites 3 et 5 n'ont pas besoin de changement de schema.)
--
-- PREALABLE : sauvegarde complete verifiee (mysqldump).
-- Idempotent : peut etre rejoue sans erreur.
-- Moteur InnoDB, jeu de caracteres utf8mb4 (coherent avec la migration
-- utf8mb4 du Bloc 02). Les tables contiennent des dates 0000-00-00
-- (valeur sentinelle de l'application) : on neutralise le mode strict.
-- =====================================================================

SET SESSION sql_mode = '';

-- ---------------------------------------------------------------------
-- Aide : ajoute une colonne seulement si elle n'existe pas deja.
-- ---------------------------------------------------------------------
DROP PROCEDURE IF EXISTS sigco_bloc03_colonne;
DELIMITER //
CREATE PROCEDURE sigco_bloc03_colonne(IN p_table VARCHAR(64), IN p_colonne VARCHAR(64), IN p_definition VARCHAR(255))
BEGIN
	DECLARE n INT;
	SELECT COUNT(*) INTO n FROM information_schema.columns
		WHERE table_schema = DATABASE() AND table_name = p_table AND column_name = p_colonne;
	IF n = 0 THEN
		SET @q = CONCAT('ALTER TABLE `', p_table, '` ADD COLUMN `', p_colonne, '` ', p_definition);
		PREPARE s FROM @q; EXECUTE s; DEALLOCATE PREPARE s;
	END IF;
END//
DELIMITER ;

-- ---------------------------------------------------------------------
-- 2. Tracabilite : creation et derniere modification.
--    Memes colonnes sur les trois types de documents demandes.
-- ---------------------------------------------------------------------
CALL sigco_bloc03_colonne('awbl', 'cree_par_id',    "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('awbl', 'cree_par_nom',   "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('awbl', 'cree_entreprise',"VARCHAR(200) NULL");
CALL sigco_bloc03_colonne('awbl', 'cree_ville',     "VARCHAR(100) NULL");
CALL sigco_bloc03_colonne('awbl', 'cree_le',        "DATETIME NULL");
CALL sigco_bloc03_colonne('awbl', 'modif_par_id',   "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('awbl', 'modif_par_nom',  "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('awbl', 'modif_le',       "DATETIME NULL");

CALL sigco_bloc03_colonne('manifeste', 'cree_par_id',    "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('manifeste', 'cree_par_nom',   "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('manifeste', 'cree_entreprise',"VARCHAR(200) NULL");
CALL sigco_bloc03_colonne('manifeste', 'cree_ville',     "VARCHAR(100) NULL");
CALL sigco_bloc03_colonne('manifeste', 'cree_le',        "DATETIME NULL");
CALL sigco_bloc03_colonne('manifeste', 'modif_par_id',   "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('manifeste', 'modif_par_nom',  "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('manifeste', 'modif_le',       "DATETIME NULL");

CALL sigco_bloc03_colonne('warehouse', 'cree_par_id',    "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('warehouse', 'cree_par_nom',   "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('warehouse', 'cree_entreprise',"VARCHAR(200) NULL");
CALL sigco_bloc03_colonne('warehouse', 'cree_ville',     "VARCHAR(100) NULL");
CALL sigco_bloc03_colonne('warehouse', 'cree_le',        "DATETIME NULL");
CALL sigco_bloc03_colonne('warehouse', 'modif_par_id',   "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('warehouse', 'modif_par_nom',  "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('warehouse', 'modif_le',       "DATETIME NULL");

-- ---------------------------------------------------------------------
-- 1. Points de chargement.
--    Colonne sur manifeste (country_loading conservee pour compat) +
--    table de reference editable.
-- ---------------------------------------------------------------------
CALL sigco_bloc03_colonne('manifeste', 'point_of_loading', "VARCHAR(100) NULL");

CREATE TABLE IF NOT EXISTS point_of_loading (
	id_point INT NOT NULL AUTO_INCREMENT,
	code     VARCHAR(10)  NOT NULL,
	nom      VARCHAR(100) NOT NULL,
	statut   TINYINT      NOT NULL DEFAULT 1,
	PRIMARY KEY (id_point),
	UNIQUE KEY uq_point_code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Villes de depart de base (ne rien ecraser si deja present).
INSERT INTO point_of_loading (code, nom, statut) VALUES
	('PAP', 'PORT-AU-PRINCE', 1),
	('JAC', 'JACMEL', 1),
	('CAP', 'CAP-HAITIEN', 1),
	('CAY', 'LES CAYES', 1)
ON DUPLICATE KEY UPDATE nom = VALUES(nom);

-- ---------------------------------------------------------------------
-- 4. Zone d'archives des numeros d'AWB.
--    Memes colonnes que awbl (donc inclut deja les colonnes cree_*/modif_*
--    ajoutees ci-dessus), sans cle ni auto-increment, plus des metadonnees
--    d'archivage et une cle propre id_archive.
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS awbl_archive AS SELECT * FROM awbl WHERE 1 = 0;

CALL sigco_bloc03_colonne('awbl_archive', 'id_archive',      "INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
CALL sigco_bloc03_colonne('awbl_archive', 'archive_par_id',  "VARCHAR(50) NULL");
CALL sigco_bloc03_colonne('awbl_archive', 'archive_par_nom', "VARCHAR(120) NULL");
CALL sigco_bloc03_colonne('awbl_archive', 'archive_le',      "DATETIME NULL");
CALL sigco_bloc03_colonne('awbl_archive', 'motif',           "VARCHAR(200) NULL");

ALTER TABLE awbl_archive ENGINE=InnoDB;

-- Index de recherche sur le numero archive (ajoute une seule fois).
SET @idx := (SELECT COUNT(*) FROM information_schema.statistics
	WHERE table_schema = DATABASE() AND table_name = 'awbl_archive' AND index_name = 'idx_archive_awb');
SET @q := IF(@idx = 0, 'ALTER TABLE awbl_archive ADD INDEX idx_archive_awb (awb_number)', 'SELECT 1');
PREPARE s FROM @q; EXECUTE s; DEALLOCATE PREPARE s;

-- ---------------------------------------------------------------------
DROP PROCEDURE IF EXISTS sigco_bloc03_colonne;
-- =====================================================================
-- Fin de la migration Bloc 03.
-- =====================================================================
