<?php
if(isset($_SESSION['droit']['a24']) and $_SESSION['droit']['a24']=="1"  ) {
}if(isset($_SESSION['droit']['a25']) and $_SESSION['droit']['a25']=="1"  ) {
}else{
	redirect('home');
}
require_once("tete.php");
foreach($utilisateur as $rs){}

?>
						<div class="page-header">
							<h1>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Modifer un utilisateur
								</small>
							</h1>
						</div>
					<div class="page-content">

						<div class="row">
							<?php echo form_open('utilisateur/mod_utilisateur');?>

						<input type="hidden" name="" value="ok" />
						<div class="col-lg-3 col-sm-6 col-md-3">
							<div class="form-group">
									<label for="salutation">Salutation: (*)</label>
									<select name="salutation" id="salutation" class="form-control" required>
								<option value="" 			<?php if(isset($rs->salutation) and $rs->salutation=="") 			echo " selected"?>>----</option>
								<option value="Mlle" 		<?php if(isset($rs->salutation) and $rs->salutation=="Mlle") 		echo " selected"?>>Mlle</option>
								<option value="Mme" 		<?php if(isset($rs->salutation) and $rs->salutation=="Mme") 		echo " selected"?>>Mme</option>
								<option value="M." 			<?php if(isset($rs->salutation) and $rs->salutation=="M.") 			echo " selected"?>>M.</option>
								</select>
							</div>

							<div class="form-group">
									<label for="nomp">Nom: (*)</label>
									<input type="text" class="form-control" id="nomp" placeholder="Nom" name="nomp" value="<?php echo $rs->nompers?>" required />
								</div>
							<div class="form-group">
									<label for="prenomp">Pr&eacute;nom: (*)</label>
									<input type="text" class="form-control" id="prenom" placeholder="Pr&eacute;nom" name="prenom" 	value="<?php echo $rs->prenompers?>" required />
								</div>
							<div class="form-group">
									<label for="email">E-mail:(*)</label>
									<input type="text" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $rs->adresse_email?>" required >
								</div>
						</div>
						<div class="col-lg-3 col-sm-6 col-md-3">
							<div class="form-group">
									<label for="user">Username <img src="<?php echo base_url()?>assets/images/us.png" height="20px" />:(*)</label>
									<input type="text" class="form-control" id="user" placeholder="user" name="user" value="<?php echo $rs->uadmin?>"  required>
								</div>
						<div class="form-group">
								<label for="telephone1">T&eacute;l&eacute;phone (1):</label>
								<input type="text" class="form-control" id="telephone1" placeholder="T&eacute;l&eacute;phone 1" value="<?php echo $rs->telephones?>"  name="telephone1">
							</div>
						<div class="form-group">
								<label for="telephone2">T&eacute;l&eacute;phone (2):</label>
								<input type="text" class="form-control" id="telephone2" placeholder="T&eacute;l&eacute;phone 2"  value="<?php echo $rs->tel2?>"  name="telephone2">
							</div>

						<div class="form-group">
							<label for="salutation">Goupe : (*)</label>
						  <select class="form-control" id="groupuser" name="groupuser" required>
							<option value="">---</option>
							<?php foreach($lesgroupes as $row){?>
					    <option value="<?php echo $row->idgroupe_user?>" <?php if($rs->agroupe==$row->idgroupe_user) echo " selected"?>><?php echo strtoupper($row->nom_groupe);?></option>
					    <?php }?>
						  </select>
						</div>


						</div>

						<div class="col-lg-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label for="etat">Remarque</label>
							<textarea rows="9" class="form-control"  data-toggle="tooltip" title="Information" placeholder="Information" name="information"><?php echo $rs->remarque?></textarea>
						</div>
						<div class="form-group">
					      <label for="etat">Etat</label>
					      <select name="etat" id="etat" class="form-control" required>
							<option value="1"	<?php if(isset($rs->letat) and $rs->letat=="1") 	echo " selected"?>>Activé</option>
							<option value="0"	<?php if(isset($rs->letat) and $rs->letat=="0") 	echo " selected"?>>Desactivé</option>
							</select>
						</div>

						</div>
							<div class="col-lg-12">

					<div class="modal-footer">


				<button class="btn btn-sm btn-primary">
					<i class="ace-icon fa fa-floppy-o"></i>
					Sauvegarder
				</button>



				<a href="<?php echo base_url()?>utilisateur/reset_utilisateur/<?php echo $rs->identreprise?>" onclick="" class="btn btn-sm btn-primary">
				<i class="ace-icon fa fa-cog"></i>
				R&eacute;initialiser mot de passe</a>
<!--
				<a href="#" onclick="" class="btn btn-sm btn-danger">
				<i class="ace-icon fa fa-minus-square-o"></i>
				Supprimer</a> -->
				<a href="" class="btn btn-sm">
				<i class="ace-icon fa fa-times"></i>
				Annuler</a>

				<input type="hidden" name="iduser" id="iduser" value="<?php echo $rs->identreprise?>" />
				<input type="hidden" name="" id="" value="ok" />
					</div>

					</div>

					<?php echo form_close()?>

						</div><!-- /.row -->
					</div>

					<!-- /.page-content -->

<?php
require_once("pied.php");
?>
