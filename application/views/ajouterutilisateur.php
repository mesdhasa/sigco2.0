<?php
if(isset($_SESSION['droit']['a24']) and $_SESSION['droit']['a24']=="1"  ) {
}else{
	redirect('home');
}
require_once("tete.php");
?>
<div class="page-header">
							<h1>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Ajouter un utilisateur
								</small>
							</h1>
						</div>
					<div class="page-content">

						<div class="row">
<?php if($this->session->flashdata('sms')){?>
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
<?php echo form_open('utilisateur/ajouter');?>
<div class="col-lg-6">
	<div class="form-group">
			<label for="salutation">Salutation: (*)</label>
			<select name="salutation" id="salutation" class="form-control" required>
		<option value="">----</option>
		<option value="Mlle">Mlle</option>
		<option value="Mme">Mme</option>
		<option value="M.">M.</option>
		</select>
	</div>
	<div class="form-group">
			<label for="nomp">Nom: (*)</label>
			<input type="text" class="form-control" id="nomp" placeholder="Nom" name="nomp" required />
		</div>
	<div class="form-group">
			<label for="prenomp">Pr&eacute;nom: (*)</label>
			<input type="text" class="form-control" id="prenom" placeholder="Pr&eacute;nom" name="prenom" required />
		</div>
	<div class="form-group">
			<label for="email">E-mail:(*)</label>
			<input type="text" class="form-control" id="email" placeholder="E-mail" name="email" required >
		</div>
		<div class="form-group">
				<label for="user">Username <img src="<?php echo base_url()?>assets/images/us.png" height="20px" />:(*)</label>
				<input type="text" class="form-control" id="user" placeholder="user" name="user" required>
			</div>
	<div class="form-group">
			<label for="telephone1">T&eacute;l&eacute;phone (1):</label>
			<input type="text" class="form-control" id="telephone1" placeholder="T&eacute;l&eacute;phone 1" name="telephone1">
		</div>
	<div class="form-group">
			<label for="telephone2">T&eacute;l&eacute;phone (2):</label>
			<input type="text" class="form-control" id="telephone2" placeholder="T&eacute;l&eacute;phone 2" name="telephone2">
		</div>
		<div class="form-group">
				<label for="salutation">Groupe: (*)</label>
				<select name="groupe" id="groupe" class="form-control" required>
					<?php foreach($lesgroupes as $row){?>
						<option value="">---</option>
					<option value="<?php echo $row->idgroupe_user?>"><?php echo strtoupper($row->nom_groupe)?></option>

					<?php }?>
			</select>
		</div>
				</div>

<!-- <div class="col-lg-6">

	<div class="form-group">
			<label for="whatsapp">WhatsApp <img src="<?php echo base_url()?>assets/images/wa.png" height="25px" />:</label>
			<input type="text" class="form-control" id="whatsapp" placeholder="WhatsApp" name="whatsapp">
		</div>
	<div class="form-group">
			<label for="fax">Fax:</label>
			<input type="text" class="form-control" id="fax" placeholder="Fax" name="fax">
		</div>


		<div class="form-group">
				<label for="ville_a">Ville:</label>
				<input type="text" class="form-control" id="ville" placeholder="Ville" name="ville">
			</div>
		<div class="form-group">
				<label for="etat_a">Code postal:</label>
				<input type="text" class="form-control" id="etat_a" placeholder="Code postal" name="etat_a">
			</div>
		<div class="form-group">
				<label for="pays_a">Pays:</label>
				<input type="text" class="form-control" id="pays_a" placeholder="Pays" name="pays_a">
			</div>
	<input type="hidden" name="idclasse" id="idclasse" value="Client" />

	<div class="form-group">
		<label for="rue_b">Remarque:</label>
			<textarea rows="5" class="form-control" id="remarque" placeholder="Remarque" name="remarque"></textarea>
	</div>

</div> -->

<div class="col-lg-12">
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

							<!-- /.col -->
<?php echo form_close()?>
						</div><!-- /.row -->
					</div><!-- /.page-content -->

<?php
require_once("pied.php");
?>
