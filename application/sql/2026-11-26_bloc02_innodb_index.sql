-- =====================================================================
-- SIGCO 2.0 - Bloc 02 (fondations et securite) - migration 2/2
-- AUDIT-012 : conversion MyISAM -> InnoDB (transactions reelles, pas de
--             corruption de table apres un arret brutal, verrous par ligne).
-- AUDIT-011 / AUDIT-016 : index sur les colonnes de jointure.
--
-- PREALABLE OBLIGATOIRE : sauvegarde complete verifiee (mysqldump).
-- Duree observee sur la copie de production (~90 Mo) : quelques minutes.
-- Aucune donnee n'est modifiee ; le jeu de caracteres n'est pas change
-- (passage en utf8mb4 = recommandation hors perimetre, section 9).
-- Idempotent : peut etre rejoue.
-- =====================================================================

-- Les tables contiennent des dates 0000-00-00 (valeur sentinelle de l'application) :
-- la copie des lignes doit se faire sans mode strict, comme en production.
SET SESSION sql_mode = '';

DELIMITER //
DROP PROCEDURE IF EXISTS sigco_bloc02_innodb//
CREATE PROCEDURE sigco_bloc02_innodb()
BEGIN
	DECLARE fini INT DEFAULT 0;
	DECLARE t VARCHAR(64);
	DECLARE c CURSOR FOR
		SELECT table_name FROM information_schema.tables
		WHERE table_schema = DATABASE() AND engine = 'MyISAM' AND table_type = 'BASE TABLE';
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fini = 1;
	OPEN c;
	boucle: LOOP
		FETCH c INTO t;
		IF fini = 1 THEN LEAVE boucle; END IF;
		SET @q = CONCAT('ALTER TABLE `', t, '` ENGINE=InnoDB');
		PREPARE s FROM @q; EXECUTE s; DEALLOCATE PREPARE s;
	END LOOP;
	CLOSE c;
END//

DROP PROCEDURE IF EXISTS sigco_ajouter_index//
CREATE PROCEDURE sigco_ajouter_index(IN p_table VARCHAR(64), IN p_index VARCHAR(64), IN p_colonnes VARCHAR(255))
BEGIN
	IF (SELECT COUNT(*) FROM information_schema.statistics
	    WHERE table_schema = DATABASE() AND table_name = p_table AND index_name = p_index) = 0 THEN
		SET @q = CONCAT('ALTER TABLE `', p_table, '` ADD INDEX `', p_index, '` (', p_colonnes, ')');
		PREPARE s FROM @q; EXECUTE s; DEALLOCATE PREPARE s;
	END IF;
END//
DELIMITER ;

CALL sigco_bloc02_innodb();

-- Tableau de bord et rapports : jointures buil <-> segment, factures par type
CALL sigco_ajouter_index('buil', 'idx_buil_segmentid', 'segmentid');
CALL sigco_ajouter_index('tbl_facture', 'idx_facture_awbl_type', 'awbl, awbl_type');
-- Jointures export (warehouse, colis, autres charges) relevees dans l'evaluation
CALL sigco_ajouter_index('warehouse', 'idx_warehouse_no_awbl', 'no_awbl');
CALL sigco_ajouter_index('warehouse', 'idx_warehouse_no_warehouse', 'no_warehouse');
CALL sigco_ajouter_index('warehouse_colis', 'idx_wc_id_warehouse', 'id_warehouse');
CALL sigco_ajouter_index('tbl_other_charges', 'idx_other_id_other', 'id_other');
CALL sigco_ajouter_index('awbl', 'idx_awbl_awb_number', 'awb_number');
CALL sigco_ajouter_index('awbl', 'idx_awbl_id_manifeste', 'id_manifeste');

DROP PROCEDURE sigco_bloc02_innodb;
DROP PROCEDURE sigco_ajouter_index;

-- Controle : doit renvoyer 0 ligne
SELECT table_name, engine FROM information_schema.tables
WHERE table_schema = DATABASE() AND engine <> 'InnoDB' AND table_type = 'BASE TABLE';
