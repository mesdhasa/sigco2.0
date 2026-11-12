<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Anniversaire extends CI_Controller {

	public function index()
		{

		}
	public function liste_anniv()
		{

		 	$data['lesanniv']= 	$this->Parser->get_all_anniv();
			// 	 echo "<pre>";
			// print_r($data['lesanniv']);
			// echo "</pre>";
			foreach($data['lesanniv'] as $row){
				$num = mt_rand(1,5);
$message='<!doctype html>
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <title></title>
  <style type="text/css">
  body {
width: 100%;
margin: 0;
padding: 0;
-webkit-font-smoothing: antialiased;
}
@media only screen and (max-width: 600px) {
table[class="table-row"] {
float: none !important;
width: 98% !important;
padding-left: 20px !important;
padding-right: 20px !important;
}
table[class="table-row-fixed"] {
float: none !important;
width: 98% !important;
}
table[class="table-col"], table[class="table-col-border"] {
float: none !important;
width: 100% !important;
padding-left: 0 !important;
padding-right: 0 !important;
table-layout: fixed;
}
td[class="table-col-td"] {
width: 100% !important;
}
table[class="table-col-border"] + table[class="table-col-border"] {
padding-top: 12px;
margin-top: 12px;
border-top: 1px solid #E8E8E8;
}
table[class="table-col"] + table[class="table-col"] {
margin-top: 15px;
}
td[class="table-row-td"] {
padding-left: 0 !important;
padding-right: 0 !important;
}
table[class="navbar-row"] , td[class="navbar-row-td"] {
width: 100% !important;
}
img {
max-width: 100% !important;
display: inline !important;
}
img[class="pull-right"] {
float: right;
margin-left: 11px;
            max-width: 125px !important;
padding-bottom: 0 !important;
}
img[class="pull-left"] {
float: left;
margin-right: 11px;
max-width: 125px !important;
padding-bottom: 0 !important;
}
table[class="table-space"], table[class="header-row"] {
float: none !important;
width: 98% !important;
}
td[class="header-row-td"] {
width: 100% !important;
}
}
@media only screen and (max-width: 480px) {
table[class="table-row"] {
padding-left: 16px !important;
padding-right: 16px !important;
}
}
@media only screen and (max-width: 320px) {
table[class="table-row"] {
padding-left: 12px !important;
padding-right: 12px !important;
}
}
@media only screen and (max-width: 608px) {
td[class="table-td-wrap"] {
width: 100% !important;
}
}
  </style>
 </head>
 <body style="font-family: Arial, sans-serif; font-size:13px; color: #444444; min-height: 200px;" bgcolor="#E4E6E9" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
 <table width="100%" height="100%" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0">
 <tr><td width="100%" align="center" valign="top" bgcolor="#E4E6E9" style="background-color:#E4E6E9; min-height: 200px;">
<table><tr><td class="table-td-wrap" align="center" width="608">

<table class="table-space" height="6" style="height: 6px; font-size: 0px; line-height: 0; width: 600px; background-color: #e4e6e9;" width="600" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="6" style="height: 6px; width: 600px; background-color: #e4e6e9;" width="600" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table>
<table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 600px; background-color: #ffffff;" width="600" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 600px; background-color: #ffffff;" width="600" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

<table class="table-row" width="600" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 24px; padding-right: 24px;" valign="top" align="left">
 <table class="table-col" align="left" width="552" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="552" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">
<div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">
<img src="https://doralya.com/best_email/cartes/'.$num.'.jpg" style="border: 0px none #444444; vertical-align: middle; display: block; padding-bottom: 9px;width:100%" hspace="0" vspace="0" border="0">
</div>
 </td></tr></tbody></table>
</td></tr></tbody></table>



<table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 600px; background-color: #ffffff;" width="600" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 600px; background-color: #ffffff;" width="600" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
<table class="table-row" width="600" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
   <table class="table-col" align="left" width="528" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="528" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">

   </td></tr></tbody></table>
</td></tr></tbody></table>

<table class="table-row" width="600" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">


</td></tr></tbody></table>
<table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 600px; background-color: #ffffff;" width="600" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 600px; background-color: #ffffff;" width="600" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>


<table class="table-space" height="6" style="height: 6px; font-size: 0px; line-height: 0; width: 600px; background-color: #e4e6e9;" width="600" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="6" style="height: 6px; width: 600px; background-color: #e4e6e9;" width="600" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table>
<table class="table-row" width="600" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
 <table class="table-col" align="left" width="528" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="528" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">
<table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 528px; background-color: #ffffff;" width="528" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 528px; background-color: #ffffff;" width="528" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
<div style="font-family: Arial, sans-serif; line-height: 19px; color: #777777; font-size: 14px; text-align: center;">&copy; '.date("Y").' by MESDHASA</div>
<table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 528px; background-color: #ffffff;" width="528" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 528px; background-color: #ffffff;" width="528" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

 </td></tr></tbody></table>
</td></tr></tbody></table>
<table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 600px; background-color: #e4e6e9;" width="600" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 600px; background-color: #e4e6e9;" width="600" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table></td></tr></table>
</td></tr>
 </table>
 </body>
 </html>';
				$message = str_replace("&","ttzz_ARTHUR_zztt",$message);
$sujet="Anniversaire";
		$sujet = str_replace("&","ttzz_ARTHUR_zztt",$sujet);
		$le_entreprise = "MESDHASA";
		// $lesMails =  $row->email;
    $lesMails =  "ljeanmardy@mesdhasa.com";

		$ch = curl_init();                    // initiate curl
		$url = "https://doralya.com/best_email/mesdhasa.php"; // where you want to post data
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
		curl_setopt($ch, CURLOPT_POSTFIELDS, "message=".$message."&email=".$lesMails."&objet=".$sujet."&ent=".$le_entreprise); // define what you want to post
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
		$output = curl_exec ($ch); // execute

		curl_close ($ch); // close curl handle
			}
		}

}
?>
