<?php
require_once("tete.php");
?>
						<div class="page-header">
							<h1>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Modifer un Client
								</small>
							</h1>
						</div>
					<div class="page-content">

						<div class="row">										
						<form enctype="multipart/form-data" role="form" data-toggle="validator" id="form1" name="form1" method="post" action="">
						<input type="hidden" name="photo" value="" />
						<input type="hidden" name="id" value="" />
						<div class="col-lg-3 col-sm-6 col-md-3">
						<div class="form-group">
							<img id="bik01" src="assets/images/avatars/iconevide.png" height="150" alt="Image preview..." />150px x 150px
						</div>
						
						<div class="form-group">
							<input type="file" onchange="previewFile()" name="ledoc" id="ledoc" class="form-control" />
						</div>
						
						<div class="form-group">
							<input class="form-control" data-toggle="tooltip" title="Nomentreprise" placeholder="Nom de l'entreprise (*)" name="nomentreprise" type="text" value="" required data-error-msg="The email is required in valid format!">
						</div>
						
						<div class="form-group">
							<input class="form-control" data-toggle="tooltip" title="Nom" placeholder="Nom (*)" name="nom" type="text" value="" required data-error-msg="The email is required in valid format!">
						</div>
						
						<div class="form-group">
							<input class="form-control" data-toggle="tooltip" title="Pr&eacute;nom" placeholder="Pr&eacute;nom (*)" name="prenom" type="text" value="" required>
						</div>
						
						<div class="form-group">
							<input class="form-control" data-toggle="tooltip" title="Cin" placeholder="Cin" name="cin" type="text" value="">
						</div>
						</div>
						<div class="col-lg-3 col-sm-6 col-md-3">
						
						<div class="form-group">
							<input class="form-control" data-toggle="tooltip" title="Nif" placeholder="Nif" name="nif" type="text" value="">
						</div>
						
						<div class="form-group">
							<textarea class="form-control" data-toggle="tooltip" title="Adresse" placeholder="Adresse" name="adressepostale"></textarea>
						</div>
						
						<div class="form-group">
						<input class="form-control" data-toggle="tooltip" title="Code postal" placeholder="Code postal" name="cpostal" type="text" value="">
						</div>
						<div class="form-group">
						<input class="form-control" data-toggle="tooltip" title="Ville" placeholder="Ville (*)" name="villeadresse" type="text" value="" required>
						</div>
					
						<div class="form-group">
						<input class="form-control" data-toggle="tooltip" title="T&eacute;l&eacute;phone" placeholder="T&eacute;l&eacute;phone (*)" name="telephone" type="text" value="" required>
						</div>
						
						<div class="form-group">
						<input class="form-control" data-toggle="tooltip" title="T&eacute;l&eacute;phone 2" placeholder="T&eacute;l&eacute;phone 2" name="portable" type="text" value="">
						</div>
						<div class="form-group">
						<input class="form-control" data-toggle="tooltip" title="E-mail" placeholder="E-mail (*)" name="email" type="text" value="" required>
						</div>						
					
						</div>
						
						<div class="col-lg-6 col-sm-6 col-md-6">
						<div class="form-group">
							<textarea rows="9" class="form-control" placeholder="Informations" name="information"></textarea>
						</div>
						
						</div>
							<div class="col-lg-12">
	
					<div class="modal-footer">

	
				<button class="btn btn-sm btn-primary">
					<i class="ace-icon fa fa-floppy-o"></i>
					Sauvegarder
				</button>
				
				<a href="#" onclick="" class="btn btn-sm btn-danger">
				<i class="ace-icon fa fa-minus-square-o"></i>
				Supprimer</a>
				<a href="" class="btn btn-sm">
				<i class="ace-icon fa fa-times"></i>
				Annuler</a>
							
				<input type="hidden" name="" id="" value="ok" />
				<input type="hidden" name="" id="" value="ok" />
					</div>
					
					</div>
						
								
					</form>
						</div><!-- /.row -->
					</div>
					
					<!-- /.page-content -->
					
<?php
require_once("pied.php");
?>