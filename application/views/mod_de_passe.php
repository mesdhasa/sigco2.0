<?php
require_once("tete.php");
?>
<div class="page-header">
							<h1>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Modifier mon mot de passe
								</small>
							</h1>
						</div>
					<div class="page-content">

						<div class="row">
						<div id="reponse"></div>
						<div class="col-lg-4 col-md-6 col-xs-12 pricing-box">
										<div class="widget-box">

										<div class="widget-body">
										<div class="widget-main">
											<?php echo form_open('utilisateur/mod_de_passe');?>
										<ul class="list-unstyled spaced2">
											<?php
											if($this->session->flashdata('sms')){
											?>
											<div class="alert alert-success alert-dismissible" role="alert">
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											  <strong><?php echo $this->session->flashdata('sms');?></strong>
											</div>
											<?php } ?>
										<?php	if($this->session->flashdata('sms2')){
											?>
											<div class="alert alert-danger alert-dismissible" role="alert">
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											  <strong><?php echo $this->session->flashdata('sms2');?></strong>
											</div>
											<?php } ?>
										<li>
										<div class="form-group">
										<label>Mot de passe actuel</label>
										<input class="form-control" name="mpa" id="mpa" type="password" value="" required>
										</div>
										</li>
										<li>
										<div class="form-group">
										<label>Nouveau mot de passe</label>
										<input class="form-control" name="nmp" id="nmp" type="password" value="" required>
										</div>
										</li>
										<li>
										<div class="form-group">
										<label>Confirmer votre nouveau mot de passe</label>
										<input class="form-control" name="cnmp" id="cnmp" type="password" value="" required>
										</div>
										</li>
										<li>
										</li>
										</ul>


										</div>
										</div>


											</div>
										</div>
										<div class="col-lg-12"></br>
											<div class="modal-footer">

											<button class="btn btn-sm btn-primary">
												<i class="ace-icon fa fa-floppy-o"></i>
												Sauvegarder
											</button>

											<a href="<?php echo base_url()?>lister-les-contacts" class="btn btn-sm" data-dismiss="modal">
												<i class="ace-icon fa fa-times"></i>
												Fermer
											</a>

										</div>
										</div>
									</div>
						</div><!-- /.row -->

<?php
require_once("pied.php");
?>
