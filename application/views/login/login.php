<?php
session_name('MesdhassaWebBase'); 
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo config_item('titre_projet');?> - Identification</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets_app/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets_app/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets_app/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets_app/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets_app/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url()?>assets_app/css/ace-rtl.min.css" />
		<link rel="icon" type="image/png" href="<?php echo base_url()?>assets_app/images/favicon.png" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets_app/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets_app/js/html5shiv.min.js"></script>
		<script src="assets_app/js/respond.min.js"></script>
		<![endif]-->
		
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
								
								<img src="<?php echo base_url()?>assets_app/images/logo.png" />
								
								</h1>
							</div>

							<div class="space-6"></div>
						
							
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Authetification
											</h4>

											<div class="space-6"></div>

											<?php echo form_open('login_param/signin');?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="Identifiant" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="pwd" class="form-control" placeholder="Mot depasse" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>	
													<div class="space"></div>
													
													<div class="clearfix">
														<button type="submit" class="width-55 pull-right btn btn-sm btn-success">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Se connecter</span>
														</button>

													</div>

													<div class="space-4"></div>
												</fieldset>
											<?php echo form_close();?>


											
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix" style="background-color:#2e8965">
											
											<div>
												<a href="<?php echo base_url()?>mot-de-passe-oublie" style="color:#ffffff">Mot de passe oubli&eacute;</a>
											</div>
											
										</div>
										
									</div><!-- /.widget-body -->
									
								</div><!-- /.login-box -->


								
							</div><!-- /.position-relative -->

							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url()?>assets_app/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets_app/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets_app/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
		</script>
	</body>
</html>