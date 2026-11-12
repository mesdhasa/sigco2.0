<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 ini_set('error_reporting', E_STRICT); 
 require_once APPPATH."/third_party/Pdf/html2pdf/html2pdf.class.php"; 
 class Pdf extends HTML2PDF 
		{ 
		public function __construct() 
			{ 
				parent::__construct(); 
			} 
		} 
?>