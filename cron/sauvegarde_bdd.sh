#!/bin/sh
# =====================================================================
# SIGCO 2.0 - Sauvegarde quotidienne de la base (Bloc 02 - AUDIT-026)
#
# - mysqldump coherent (--single-transaction : tables InnoDB depuis le bloc 02)
# - compression gzip puis chiffrement AES-256 (openssl)
# - conservation 30 jours
# - copie hors serveur : a configurer (COPIE_DISTANTE), voir docs/BLOC02_SECURITE.md
#
# Installation (crontab de l'utilisateur du site, PAS root) :
#   15 2 * * * /chemin/sigco/cron/sauvegarde_bdd.sh >> /chemin/hors-site/sauvegardes/sauvegarde.log 2>&1
#
# Prerequis, HORS du dossier web :
#   ~/.sigco-mysql.cnf   (chmod 600)  :  [client]  user=...  password=...  host=localhost
#   ~/.sigco-backup.key  (chmod 600)  :  phrase secrete longue (openssl rand -base64 48)
# =====================================================================
set -eu

BASE="${SIGCO_DB_NAME:-doralyac_mesd}"
MYCNF="${SIGCO_MYCNF:-$HOME/.sigco-mysql.cnf}"
CLE="${SIGCO_BACKUP_KEY:-$HOME/.sigco-backup.key}"
DOSSIER="${SIGCO_BACKUP_DIR:-$HOME/sauvegardes/sigco}"
CONSERVATION_JOURS="${SIGCO_BACKUP_DAYS:-30}"
# Exemple : "rclone copy" ou "scp -q" vers un stockage externe. Vide = pas de copie distante.
COPIE_DISTANTE="${SIGCO_BACKUP_REMOTE:-}"

umask 077
mkdir -p "$DOSSIER"
HORODATAGE=$(date +%Y%m%d_%H%M%S)
FICHIER="$DOSSIER/${BASE}_${HORODATAGE}.sql.gz.enc"

[ -r "$MYCNF" ] || { echo "$(date) ERREUR : $MYCNF illisible"; exit 1; }
[ -r "$CLE" ]   || { echo "$(date) ERREUR : $CLE illisible"; exit 1; }

mysqldump --defaults-extra-file="$MYCNF" --single-transaction --routines --triggers \
	--default-character-set=utf8mb4 "$BASE" \
	| gzip -9 \
	| openssl enc -aes-256-cbc -pbkdf2 -salt -pass file:"$CLE" -out "$FICHIER"

# Controle : le fichier se dechiffre et se decompresse, et le dump est complet
if ! openssl enc -d -aes-256-cbc -pbkdf2 -pass file:"$CLE" -in "$FICHIER" | gunzip | tail -n 1 | grep -q "Dump completed"; then
	echo "$(date) ERREUR : sauvegarde invalide $FICHIER"
	exit 1
fi

if [ -n "$COPIE_DISTANTE" ]; then
	# shellcheck disable=SC2086
	$COPIE_DISTANTE "$FICHIER"
fi

find "$DOSSIER" -name "${BASE}_*.sql.gz.enc" -type f -mtime +"$CONSERVATION_JOURS" -delete

echo "$(date) OK : $FICHIER ($(du -h "$FICHIER" | cut -f1))"
