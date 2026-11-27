-- =====================================================================
-- SIGCO 2.0 - Bloc 02 - migration 3/3 : jeu de caracteres utf8mb4
-- MySQL 8.0+ et 9.x : utf8mb3 ("utf8") est deprecie et sera retire.
-- Collation utf8mb4_general_ci = memes regles de comparaison que
-- l'ancienne utf8mb3_general_ci (insensible a la casse et aux accents) :
-- aucun changement de comportement des recherches ni des doublons.
--
-- PREALABLES : sauvegarde complete ; migrations 1 et 2 deja appliquees (InnoDB).
-- Idempotent : peut etre rejoue.
-- =====================================================================

SET SESSION sql_mode = '';

-- Base courante (ALTER DATABASE n'est pas accepte dans une requete preparee)
ALTER DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

DELIMITER //
DROP PROCEDURE IF EXISTS sigco_bloc02_utf8mb4//
CREATE PROCEDURE sigco_bloc02_utf8mb4()
BEGIN
	DECLARE fini INT DEFAULT 0;
	DECLARE t VARCHAR(64);
	DECLARE c CURSOR FOR
		SELECT table_name FROM information_schema.tables
		WHERE table_schema = DATABASE() AND table_type = 'BASE TABLE'
		  AND table_collation <> 'utf8mb4_general_ci';
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET fini = 1;
	OPEN c;
	boucle: LOOP
		FETCH c INTO t;
		IF fini = 1 THEN LEAVE boucle; END IF;
		SET @q = CONCAT('ALTER TABLE `', t, '` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci');
		PREPARE s FROM @q; EXECUTE s; DEALLOCATE PREPARE s;
	END LOOP;
	CLOSE c;
END//
DELIMITER ;

CALL sigco_bloc02_utf8mb4();
DROP PROCEDURE sigco_bloc02_utf8mb4;

-- Controle : doit renvoyer 0 ligne
SELECT table_name, table_collation FROM information_schema.tables
WHERE table_schema = DATABASE() AND table_type = 'BASE TABLE' AND table_collation <> 'utf8mb4_general_ci';
SELECT table_name, column_name, character_set_name FROM information_schema.columns
WHERE table_schema = DATABASE() AND character_set_name IS NOT NULL AND character_set_name <> 'utf8mb4';
