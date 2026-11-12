<?php
//	=======================================================
//      ECODER ET DECODER
//		UNE CHAINE DE CARACTERRE
//	====================================================

function Messa_encrypt($data) {
    $key = "htu3mpV";  // Clé de 8 caractères max
    $data = serialize($data);
    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td,$key,$iv);
    $data = base64_encode(mcrypt_generic($td, '!'.$data));
    mcrypt_generic_deinit($td);
    return $data;
}
function mois_full($valeur){
$mois = "";
$el = intval($valeur);
    switch($el){
        case 1 : $mois = "Janvier";
        break;
        case 2 : $mois = "Février";
        break;
        case 3 : $mois = "Mars";
        break;
        case 4 : $mois = "Avril";
        break;
        case 5 : $mois = "Mai";
        break;
        case 6 : $mois = "Juin";
        break;
        case 7 : $mois = "Juillet";
        break;
        case 8 : $mois = "Août";
        break;
        case 9 : $mois = "Septembre";
        break;
        case 10 : $mois = "Octobre";
        break;
        case 11 : $mois = "Novembre";
        break;
        case 12 : $mois = "Décembre";
        break;
    }
return $mois;
}

function Messa_decrypt($data) {
    $key = "htu3mpV";
    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td,$key,$iv);
    $data = mdecrypt_generic($td, base64_decode($data));
    mcrypt_generic_deinit($td);

    if (substr($data,0,1) != '!')
        return false;

    $data = substr($data,1,strlen($data)-1);
    return unserialize($data);
}
//==========================================
function addhttp($url) {
    if (!preg_match("@^[hf]tt?ps?://@", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
//=======================================
// TRONQUER UNE CHAINE DE CARACTERE
//======================================

function tronquer($texte, $nbrChar, $append='...') {
    if(strlen($texte) > $nbrChar) {
        $texte = substr($texte, 0, $nbrChar);
        $texte .= $append;
    }

    return $texte;

}
 function verticletext($string)
    {
       $txt = "";
	   $tlen = strlen($string);
       for($i=0;$i<$tlen;$i++)
       {
            $txt .= substr($string,$i,1)."<br />";
       }

	   return $txt;
    }
// ===========================================
//     EXTRAIRE LES CARACTERES DANS UNE CHAINE
//============================================


function clean($texte)
{

    $aremplacer = array("{","}","<",">","$","/","\\","'"," ","-");

    $enremplacement = "";

    $mots = trim(str_replace($aremplacer, $enremplacement, $texte));

    return $mots;
}
// ===========================================
//     CONTROL DES CARACTERES DANS UNE CHAINE
//============================================
function date_fr($date=0)
{
  if(!$date)
    $date=date("Y-m-d H:i:s A"); //Timestamp courant par défaut

    $a = substr($date, 0, 4);
    $m = substr($date, 5, 2);
    $j = substr($date, 8, 2);
    $h = substr($date, 11, 2);
    $min = substr($date, 14, 2);
    $s = substr($date, 17, 2);
	$a1 = substr($date, 20, 2);
 $datefr=$j.'/'.$m.'/'.$a;
 $heurefr=$h.':'.$min." ".$a1;
        return array("date"=>$datefr,"heure"=>$heurefr);
}
function TronqueHtml($chaine, $max, $separateur = ' ', $suffix = ' ...') {
    return $chaine;
}
function mois($valeur){
$mois = "";
$el = intval($valeur);
	switch($el){
		case 1 : $mois = "jan";
		break;
		case 2 : $mois = "fev";
		break;
		case 3 : $mois = "mars";
		break;
		case 4 : $mois = "avr";
		break;
		case 5 : $mois = "mai";
		break;
		case 6 : $mois = "juin";
		break;
		case 7 : $mois = "juil";
		break;
		case 8 : $mois = "aout";
		break;
		case 9 : $mois = "sept";
		break;
		case 10 : $mois = "oct";
		break;
		case 11 : $mois = "nov";
		break;
		case 12 : $mois = "dec";
		break;
	}
return $mois;
}
function chaineVersDate($chaine){
$el = explode(" ",$chaine);
$chaine = $el[0];
if ($chaine == "") $chaine = "00/00/0000";
$valeur = explode("/", $chaine);
return
$valeur[2]."-".$valeur[1]."-".$valeur[0];
}

function dateVersChaine($chaine){
$el = explode(" ",$chaine);
$chaine = $el[0];
if ($chaine == "") $chaine = "0000-00-00";
$valeur = explode("-", $chaine);
return
$valeur[2]."/".$valeur[1]."/".$valeur[0];
}

function dateVersChainetext($chaine){
$el = explode(" ",$chaine);
$chaine = $el[0];
if ($chaine == "") $chaine = "0000-00-00";
$valeur = explode("-", $chaine);
return
$valeur[2]."-".mois($valeur[1])."-".$valeur[0];
}

function Age($d1,$d2){

	$dStart = new DateTime($d1);
	$dEnd  = new DateTime($d2);
   	$dDiff = $dStart->diff($dEnd);
   	$dDiff->format('%r'); // use for point out relation: smaller/greater
   	return
	$dDiff->days." jour(s)";

}

function diff_date($d1,$d2){

	$dStart = new DateTime($d1);
	$dEnd  = new DateTime($d2);
   	$dDiff = $dStart->diff($dEnd);
   	$dDiff->format('%r'); // use for point out relation: smaller/greater
   	return
	$dDiff->days;

}

function Age2($naiss)  {
  list($annee, $mois, $jour) = explode('-', $naiss);
  $today['mois'] = date('n');
  $today['jour'] = date('j');
  $today['annee'] = date('Y');
  $annees = $today['annee'] - $annee;
  if ($today['mois'] <= $mois) {
    if ($mois == $today['mois']) {
      if ($jour > $today['jour'])
        $annees--;
      }
    else
      $annees--;
    }
  return $annees;
  }

function dec($chaine){
	return utf8_decode($chaine);
}
function enc($chaine){
	return utf8_encode($chaine);
}

function Enfr($chaine){
	return html_entity_decode($chaine, ENT_COMPAT, "UTF-8");
}
function U8($chaine){
	return htmlentities($chaine, ENT_QUOTES, "UTF-8");
}



function wd_remove_accents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}
function valeur_n_chiffres($valeur,$n){
$taille = strlen($valeur);
$element = "";
		for($i=1;$i<=($n-$taille);$i++){
		$element .= "0";
		}
		$element .=$valeur;
		return
		$element;
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


?>
