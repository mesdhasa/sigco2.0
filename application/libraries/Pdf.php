<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

/*
 * Generation PDF (Bloc 02 / AUDIT-013).
 *
 * Avant : html2pdf 4.03 + TCPDF 5.0.002 (third_party/Pdf), incompatibles PHP 8
 *         (erreur fatale tcpdf.php ligne 2005 sous PHP 8.0 et 8.3).
 * Apres : spipu/html2pdf 5.3 + TCPDF 6.x installes par Composer (application/vendor).
 *
 * Les vues PDF existantes font  new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15')
 * puis ->WriteHTML() et ->Output() : la signature du constructeur de la version 5 est
 * identique, la classe HTML2PDF ci-dessous assure donc la compatibilite sans modifier les vues.
 */
if ( ! class_exists('HTML2PDF', FALSE))
{
	class HTML2PDF extends \Spipu\Html2Pdf\Html2Pdf
	{
		public function __construct($orientation = 'P', $format = 'A4', $lang = 'fr', $unicode = TRUE, $encoding = 'UTF-8', $margins = array(5, 5, 5, 8), $pdfa = FALSE)
		{
			parent::__construct($orientation, $format, $lang, $unicode, $encoding, $margins, $pdfa);
			// Les images (logos, codes-barres) sont chargees depuis le site lui-meme :
			// html2pdf 5 refuse par defaut toute URL distante, on n'autorise que l'hote de l'application.
			$this->setTestIsImage(FALSE);
			$hote = parse_url(base_url(), PHP_URL_HOST);
			if ($hote)
			{
				$this->getSecurityService()->addAllowedHost($hote);
			}
		}

		/**
		 * La version 4 affichait les erreurs dans la page ; la version 5 leve une exception.
		 * On journalise l'erreur et on affiche un message lisible plutot qu'une page blanche.
		 * Les avertissements internes de la bibliotheque (HTML imparfait des modeles, toleres
		 * par la version 4) sont journalises au lieu d'etre ecrits au milieu du PDF.
		 */
		public function writeHTML($html)
		{
			set_error_handler(function ($niveau, $message, $fichier, $ligne) {
				if (strpos(str_replace('\\', '/', $fichier), '/vendor/') === FALSE)
				{
					return FALSE; // erreur du code applicatif : traitement normal
				}
				log_message('debug', 'SIGCO PDF (avertissement html2pdf) : '.$message.' - '.$fichier.':'.$ligne);
				return TRUE;
			}, E_WARNING | E_NOTICE | E_DEPRECATED | E_USER_WARNING | E_USER_NOTICE | E_USER_DEPRECATED);

			// Images statiques du site (fonds AWB, logos) lues sur le disque plutot que par HTTP :
			// plus rapide et sans requete du serveur vers lui-meme. Les scripts (cb.php) restent en HTTP.
			$prefixe = preg_quote(base_url(), '#');
			$html = preg_replace_callback('#(\b(?:src|backimg)\s*=\s*["\'])'.$prefixe.'(assets/[^"\'?]+\.(?:png|jpe?g|gif))(["\'])#i', function ($m) {
				$local = FCPATH.str_replace('/', DIRECTORY_SEPARATOR, $m[2]);
				return is_file($local) ? $m[1].$local.$m[3] : $m[0];
			}, (string) $html);

			try
			{
				$resultat = parent::writeHTML($html);
				restore_error_handler();
				return $resultat;
			}
			catch (Html2PdfException $e)
			{
				restore_error_handler();
				$this->clean();
				$formatter = new ExceptionFormatter($e);
				log_message('error', 'SIGCO PDF : '.$formatter->getMessage());
				set_status_header(500);
				echo (ENVIRONMENT === 'development')
					? $formatter->getHtmlMessage()
					: 'Le document PDF n\'a pas pu etre genere. L\'erreur a ete journalisee.';
				exit;
			}
		}

		/** Ancienne API : Output() sans argument = affichage dans le navigateur. */
		public function output($name = 'document.pdf', $dest = 'I')
		{
			if ($name === '' OR $name === NULL)
			{
				$name = 'document.pdf';
			}
			// Tout ce qui aurait ete affiche avant (espaces, avertissements) corromprait le PDF
			while (ob_get_level() > 0)
			{
				ob_end_clean();
			}
			return parent::output($name, $dest);
		}
	}
}

class Pdf extends HTML2PDF
{
	public function __construct()
	{
		parent::__construct();
	}
}
