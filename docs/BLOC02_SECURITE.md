# SIGCO 2.0 — Bloc 02 : fondations et sécurité

Contrat CT-2026-1014 · suite du rapport d'évaluation du 19/11/2026 (constats AUDIT-xxx).
Branche Git : `bloc02-securite`. Plateforme cible : **PHP 8.2 à 8.5**, **MySQL 8.0 à 9.7**.

> Ce dossier `docs/` n'est pas servi par Apache (`.htaccess`).

---

## 0. Mise à jour des plateformes (2e passe du bloc 02)

| Élément | Avant | Après |
|---|---|---|
| Framework | CodeIgniter 3.1.5 (puis 3.1.13, dernière officielle, non maintenue) | **CodeIgniter 3.4.9**, fork maintenu `pocketarc/codeigniter` (MIT, PHP 5.4 → 8.7), installé par Composer dans `application/vendor/pocketarc/codeigniter/system` (`index.php` → `$system_path`). Mise à jour future : `composer update pocketarc/codeigniter`. |
| PHP | 7.2 | Testé sous **8.3.28** (Apache WAMP), **8.4.15** et **8.5.13** (lint de 1 325 fichiers + exécution réelle). |
| MySQL | 8.0.25 (prod), 8.4 (local) | Testé sous **8.4.7** et **9.7.4** (mode SQL par défaut, compte `caching_sha2_password` à droits limités). |
| jQuery | 2.1.4 | **3.8.0** + jQuery Migrate 3.6.0 (jQuery 4 est refusé par Bootstrap 3) |
| jQuery UI | 1.11.4 | **1.14.2** |
| Bootstrap | 3.3.6 | **3.4.1** (dernière 3.x, base du thème ACE) |
| Chart.js | 2.6.0 (494 Ko non minifié) | **2.9.4** minifié (226 Ko), API v2 du tableau de bord |
| Font Awesome | 4.5.0 | **4.7.0** |
| PhpSpreadsheet / html2pdf / TCPDF | — | 5.12.0 / 5.3.3 / 6.11.4 (TCPDF 7 refusé par html2pdf) |

**Mode SQL** : l'application fixe elle-même son `sql_mode` à chaque connexion (`config.php` → `sigco_sql_mode`, appliqué par `MY_Controller`) :
`ONLY_FULL_GROUP_BY, ERROR_FOR_DIVISION_BY_ZERO, NO_ENGINE_SUBSTITUTION`. Elle se comporte donc pareil quel que soit le réglage du serveur.
- `ONLY_FULL_GROUP_BY` est **actif** : les 15 requêtes groupées ont été réécrites avec `ANY_VALUE()` (helper `sigco_colonnes_any_value()`), résultats vérifiés identiques sur 19 pages/PDF/Excel.
- Les comparaisons `col != '0000-00-00'` sont écrites `YEAR(col) <> 0` (identiques, et valables sous `NO_ZERO_DATE`).
- `STRICT_TRANS_TABLES` et `NO_ZERO_DATE` restent désactivés : `0000-00-00` est une valeur métier (16 182 AWBL « non notifiés ») et des formulaires envoient `''` pour des nombres. À activer après validation des saisies (AUDIT-028).

**Base** : migration 3 `application/sql/2026-11-26_bloc02_utf8mb4.sql` (utf8mb3 déprécié → utf8mb4, collation `utf8mb4_general_ci` = mêmes comparaisons). Les 3 migrations ont été rejouées sur MySQL 9.7 depuis la sauvegarde d'origine, et rejouées une 2e fois sans erreur. MySQL 9.7 n'a plus la fonction SQL `MD5()` ; la migration 1 n'en dépend plus.

**Production MySQL 9** : le plugin `mysql_native_password` n'existe plus. Le compte applicatif doit être en `caching_sha2_password` (testé avec PHP 8.5 / mysqlnd).

---

## 1. Ce qui a changé

| Constat | Correction |
|---|---|
| AUDIT-013 / 020 | CodeIgniter **3.1.13** officiel dans `system/` (vérifié identique à l'archive officielle). `system1/2/3`, `vendor2`, `vendorBCK`, anciennes copies `*.php2/3/4`, `poubel/` et bibliothèques PDF/Excel PHP 7 retirés. |
| AUDIT-013 / 014 / 031 | Composer réduit aux paquets utilisés : PhpSpreadsheet 5.12, spipu/html2pdf 5.3.3, TCPDF 6.11. `composer audit` : aucune faille connue. `composer.lock` versionné. |
| AUDIT-013 | PDF : `libraries/Pdf.php` fournit une classe `HTML2PDF` compatible, basée sur html2pdf 5 : les 29 vues PDF n'ont pas changé d'API. Excel : `setCellValueByColumnAndRow()` (supprimé) remplacé par `setCellValue([col, ligne])`. Corrections PHP 8 dans les vues PDF (constantes non définies `au`, `PP`…, accumulateurs non initialisés, `<td>` hors `<tr>`). |
| AUDIT-002 / 003 | `application/core/MY_Controller.php` : **chaque** méthode appelée par URL passe par une règle d'accès déclarée dans le contrôleur (`$acces`, `$acces_defaut`). Sans règle = refus. Session vérifiée et compte relu en base à chaque requête (compte désactivé ou groupe modifié = effet immédiat). Refus journalisés. |
| AUDIT-002 | Utilisateurs/groupes : droits a24/a25/a27/a28 vérifiés côté serveur ; impossible de modifier ou supprimer **son propre** groupe, de changer son propre groupe ou de se désactiver ; groupe attribué vérifié ; changements de droits journalisés (avant → après). |
| AUDIT-004 | `password_hash()` ; les anciens MD5 sont convertis automatiquement à la connexion. Plus de mot de passe par défaut : mot de passe temporaire aléatoire, changement obligatoire (12 caractères, lettres + chiffres). Les comptes encore sur « password » sont forcés à changer. |
| AUDIT-009 | Session régénérée à la connexion, blocage après 5 échecs par identifiant / 20 par IP (15 min), cookies `HttpOnly` + `SameSite=Lax` (+ `Secure` si `force_https`), sessions dans `application/cache/sessions`, redirection HTTPS si `force_https`. |
| AUDIT-007 | CSRF CodeIgniter activé. `assets/js/sigco-securite.js` ajoute le jeton à tous les formulaires POST et appels AJAX ; `confirmation_lien()` envoie désormais un **POST**. Les actions d'écriture (`$post_requis`) refusent le GET. |
| AUDIT-001 | ~40 requêtes SQL paramétrées (`?` liés) dans `Parser.php` / `Parser_export.php`, sans changer leur logique ; `LIMIT` convertis en entiers ; échappement maison supprimé. |
| AUDIT-005 / 027 | Secrets hors du code : `application/config/env.php` (non versionné, modèle `env.example.php`). Identifiants de production retirés de `database.php`. Nouvelle clé de chiffrement. |
| AUDIT-006 / 010 | `.htaccess` : fichiers cachés (`.git`, `.ftpconfig`…), listing, dossiers internes, `*.sql`, `composer.*`, scripts PHP de `assets/` (dont `barcode.php` qui permettait d'écrire un fichier arbitraire) bloqués. Environnement **production par défaut** (aucune erreur détaillée affichée), `db_debug` uniquement en développement, journal d'erreurs activé. |
| AUDIT-008 | Sorties encodées : listes clients, listes AWB (import/export), recherche, messages flash contenant une saisie. |
| AUDIT-011 / 016 | Tableau de bord : compteurs calculés par MySQL (résultats vérifiés identiques à l'ancien code) + cache 5 min. Mesure locale : **36 s → 3,7 s** (1er affichage) / **0,07 s** (cache). |
| AUDIT-012 / 016 | 27 tables converties en **InnoDB** (transactions de l'import XML désormais effectives) + index de jointure. |
| AUDIT-018 (partiel) | Pagination serveur : rapport des factures impayées (**23 s → 2,8 s**, 50/page), liste des clients (50/page + recherche). |
| AUDIT-019 (partiel) | Tables `sigco_journal_securite` (connexions, échecs, refus, droits, mots de passe) et `sigco_tentative_connexion`. |
| AUDIT-025 | `Anniversaire` (envoi d'e-mails) n'est plus déclenchable anonymement : ligne de commande ou jeton `cron_token`. `Excel` (démo) et `export/verifierphp` (phpinfo) inaccessibles. |
| AUDIT-026 | `cron/sauvegarde_bdd.sh` : sauvegarde quotidienne compressée, chiffrée, vérifiée, 30 jours. |

## 2. Mise en production — ordre obligatoire

1. **Sauvegarde complète** code + base, et test de restauration (art. 7).
2. Hébergeur : passer le site en **PHP 8.3, 8.4 ou 8.5** (8.2 minimum). Extensions : mysqli, mbstring, gd, zip, xml, intl recommandée.
3. Base : exécuter dans l'ordre
   `application/sql/2026-11-26_bloc02_securite.sql`, `application/sql/2026-11-26_bloc02_innodb_index.sql`, puis `application/sql/2026-11-26_bloc02_utf8mb4.sql`
   (environ 1 min chacune pour les deux dernières ; contrôles finaux = 0 ligne).
4. Sur le serveur, créer `application/config/env.php` depuis `env.example.php` :
   `environment = production`, `base_url`, `force_https = TRUE`, identifiants MySQL **nouveaux**, `encryption_key` aléatoire (64 hex).
5. Déployer en **SFTP/FTPS** (pas FTP). Ne jamais envoyer : `.git/`, `.ftpconfig`, `env.php` local, `test/`, `www`.
6. Rendre `application/cache/`, `application/cache/sessions/` et `application/logs/` inscriptibles par PHP.
7. Mots de passe par défaut (en SSH) :
   `php index.php outils mots_de_passe_par_defaut /chemin/hors/site/mdp.csv`
   → MESDHASA transmet les mots de passe temporaires, puis **supprime** le fichier.
8. Sauvegardes : installer `cron/sauvegarde_bdd.sh` (voir l'en-tête du script) et configurer la copie hors serveur.
9. Tâche « anniversaires » : `php index.php anniversaire liste_anniv` en tâche planifiée (ou URL avec `?jeton=` si l'hébergeur n'a pas de cron CLI).

## 3. Actions qui relèvent de MESDHASA (accès hébergeur / GitHub)

- **Changer le mot de passe MySQL de production et le mot de passe FTP** : ils figurent dans l'historique Git (commit 3725a25) et dans `.ftpconfig`.
- Vérifier la visibilité et les accès du dépôt `mesdhasa/sigco2.0`, puis **purger l'historique** (réécriture + push forcé : à planifier ensemble).
- Restreindre `/pma` (phpMyAdmin) par adresse IP ou authentification supplémentaire.
- Compte MySQL applicatif limité à SELECT, INSERT, UPDATE, DELETE (pas de FILE ni DDL ; les migrations se font avec un compte d'administration).

## 4. Points d'attention

- Les droits côté serveur reprennent ceux **déjà testés par les vues** (ex. liste des clients = a21 comme la vue, rapports hebdomadaires = a17). La cartographie complète des 100 droits est à valider avec l'IT Manager. Elle se lit dans chaque contrôleur (`$acces`).
- Les groupes `005001A` et `006001A` (16 comptes) n'existent pas dans `groupe_user` : ces comptes n'ont aucun droit, comme avant.
- Le formulaire « mot de passe oublié » n'envoie plus d'e-mail de test factice : il invite à contacter l'administrateur (réinitialisation par lien e-mail = hors périmètre, section 9 du rapport).
- `reservation` (menu désactivé) renvoie une erreur 500 : ses vues n'existent pas dans le code (inchangé).
- Statistiques de poids (`facture/statistics_weight`) : la vue force `$_POST['type'] = ""`, donc « Inbound » s'affiche avec les colonnes « Outbound » (date, vol, pays vides). Bogue existant signalé, non corrigé (rapports = bloc 03 / AUDIT-017).
- Bootstrap 3.4.1 garde deux avis XSS (attributs `data-*`, tooltip/popover) corrigés uniquement en Bootstrap 5, ce qui imposerait de refaire le thème ACE. Risque limité : SIGCO n'alimente pas ces attributs avec des saisies.
- Gros PDF sur de longues périodes (ex. *informatics/import fees* sur 2 mois ≈ 70 s) : limite de html2pdf sur de très grands tableaux, à traiter avec l'optimisation des rapports (bloc 03 / section 9).
- Des avertissements PHP 8 subsistent dans certaines vues (variables non définies au premier affichage) : masqués en production, journalisés. Ils seront traités avec la préparation PHP 8.3 du bloc 04.

## 5. Tests réalisés (instance locale, PHP 8.3.28, MySQL 8.4)

- Anonyme : 17 URL sensibles (anciennes failles, `.git`, `.ftpconfig`, `env.php`, `*.sql`, `barcode.php`, listing) → 403/404/redirection login.
- POST sans jeton CSRF → 403.
- Compte sans droits : 8 pages d'administration et 5 écritures sensibles (avec jeton valide) → refusées et journalisées, aucune écriture.
- Administrateur : 39 pages du menu → OK (hors `reservation`, voir ci-dessus).
- 18 PDF et 4 exports Excel générés et vérifiés (`%PDF-`, fichier XLS valide).
- Tableau de bord : 10 compteurs identiques à l'ancien code (comparaison automatique).
- InnoDB : nombre de lignes identique avant / après sur toutes les tables principales.
