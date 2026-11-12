<?php
if(isset($_SESSION['droit']['a27']) and $_SESSION['droit']['a27']=="1"  ) {
}else{
	redirect('home');
}
?>
<div class="page-content">
						<div class="page-header">
							<h1>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Gestion des groupes
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
<?php if($this->session->flashdata('sms')){?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
<?php echo form_open('groupe_param/ajouter_groupe');?>
<div class="col-lg-5 col-md-12 col-xs-12">

    <div class="form-group">
      <label for="nom_groupe">Nom du groupe:</label>
      <input type="text" class="form-control" id="nom_groupe" placeholder="Nom du groupe" name="nom_groupe">
    </div>


</div>

<div class="col-lg-12">

	<div class="modal-footer">

	<button class="btn btn-sm btn-primary">
		<i class="ace-icon fa fa-floppy-o"></i>
		Sauvegarder
	</button>

	<a href="<?php echo base_url()?>gestion-groupe" class="btn btn-sm" data-dismiss="modal">
		<i class="ace-icon fa fa-times"></i>
		Fermer
	</a>

	</div>

	</div>
<?php echo form_close()?>
						</div><!-- /.row -->
					</div><!-- /.page-content -->
