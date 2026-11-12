<?php
if(isset($_SESSION['droit']['a21']) and $_SESSION['droit']['a21']=="1"  ) {
}else{
	redirect('home/pas_access');
}
 require_once('tete.php');?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Ajouter un client

								</small>

							</h1>

						</div>

<div class="page-content">
	<div class="row">
		<div class="col-lg-6 col-md-12 col-xs-12">
		<?php echo form_open('client/addclient',array('id'=>'fr_client','method'=>'post'));?>

		  <div class="form-group">
			<label for="ref">Code (*):</label>
			<input autocomplete="off" type="text" class="form-control" id="ref" name="ref" required >
		  </div>
		  <div class="form-group">
			<label for="societe">Nom client ou Soci&eacute;t&eacute; (*):</label>
			<input autocomplete="off" type="text" class="form-control" id="societe" name="societe"required >
		  </div>
		  <div class="form-group">
			<label for="adresse">Adresse (*):</label>
			<textarea id="adresse" name="adresse" class="form-control" required ></textarea>
		  </div>
			<div class="form-group">
			<label for="Ville">Ville (*):</label>
			<textarea id="ville" name="ville" class="form-control" required ></textarea>
			</div>
		  <div class="form-group">
			<label for="email">Adresse email (*):</label>
			<input autocomplete="off" type="email" class="form-control" id="email" name="email"required >
		  </div>
		  <div class="form-group">
			<label for="phone">T&eacute;l&eacute;phone (*):</label>
			<input autocomplete="off" type="text" class="form-control" id="phone" name="phone"required >
		  </div>
		  <div class="form-group">
			<label for="memo">Memo:</label>
			<textarea id="memo" name="memo" class="form-control" ></textarea>
		  </div>

		  <button type="button" id="btn_client"  class="btn btn-primary">
		  <i class="ace-icon fa fa-save"></i>
	Sauvegarder
		  </button>

		<?php echo form_close();?>
		</div>
	</div>


</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
$(function()
{
  $('#btn_client').on('click',function()
  {
    if($('#ref').val() == "" || $('#societe').val() == ""){
			AlertMessa('ok');
	}else{
		$(this).html('Please wait ...').attr('disabled','disabled');
    $('#fr_client').submit();
	}

  });

});
</script>
