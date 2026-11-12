<?php 
$this->session->userdata('MesdhassaWebBase');

if (!isset($_SESSION)) {
  session_start();
}
require_once APPPATH."/third_party/ctools.php";

if(!isset($_SESSION['account']['code']) or $_SESSION['account']['code'] == ""){
	redirect('login');
}
?>
<!DOCTYPE html>

<html lang="fr">

		<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Mesdhasa</title>

		<meta name="description" content="Restyling jQuery UI Widgets and Elements" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/my/awb.js" /> -->
		<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/my/nocache.js" /> -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/mycss.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url()?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
<link rel="stylesheet" href="<?php echo base_url()?>assets/mytools/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/mytools/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/mytools/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		
	</head>



	<body class="no-skin">

		



		<div class="main-container ace-save-state" id="main-container">

			<script type="text/javascript">

				try{ace.settings.loadState('main-container')}catch(e){}

			</script>
								

			<div class="main-content">

				<div class="main-content-inner">