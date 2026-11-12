<?php
if(isset($_SESSION['droit']['a12']) and $_SESSION['droit']['a12']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
$val = "";
if(isset($_SESSION['sesnumber'])){
	$val = $_SESSION['sesnumber'];
}
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Rechercher un AWB

								</small>

							</h1>

						</div>

					<div class="page-content">

						<div class="row">
							<div class="col-lg-4 col-lg-push-4">
							<?php echo form_open('livraison/recherche/l/liv','class="form-inline"');?>

								<div class="input-group">
								  <input autocomplete="off" type="text" name="noawbl" id="noawbl" size="30%" class="form-control" placeholder="No de livraison" value="" required />
								  <span class="input-group-btn">
									<button class="btn btn-sm btn-primary" type="submit">
													   <i class="ace-icon fa fa-search"></i>
													Recherche
													</button>
								  </span>
								</div>

									<?php echo form_close();?>


														  </br>
								</div>
						</div>
						<div class="row">


						<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>

<div class="col-lg-5 col-md-12 col-xs-12">
	<table class="table table-bordered">
		<thead>
		  <tr>
			<th></th>
			<th>Autorisation de livraison</th>
			<th>AWB</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		if(isset($_SESSION['lesno'])){
		for($i=0;$i<count($_SESSION['lesno']['no']);$i++){?>
		  <tr>
			<td><?php echo ($i+1);?></td>
			<td><?php echo $_SESSION['lesno']['no'][$i]?></td>
			<td><?php echo $_SESSION['lesno']['awbl'][$i]?></td>
		  </tr>
		<?php }}?>
		</tbody>
	  </table>

<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>livraison/vider_nolivraison">
   <i class="ace-icon fa fa-close"></i>
Vider le tableau
</a>
</div>
<div class="col-lg-7 col-md-12 col-xs-12">

<!-- <?php if(isset($_SESSION['lesno']) and count($_SESSION['lesno']['no']>0)){?> -->
<?php echo form_open('livraison/livrer','id="f1"');?>
  <div class="form-group">
    <label for="receveur">Colis livr&eacute; &agrave; (*):</label>
    <input autocomplete="off" type="text" class="form-control" id="receveur" name="receveur" required>
  </div>
  <div class="form-group">
    <label for="pwd">NIF:</label>
    <input autocomplete="off" type="text" class="form-control" id="nif" name="nif">
  </div>
	<input type="hidden" name="received" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />

   <a class="btn btn-lg btn-success" href="#" onclick="confirmation_action('Voulez-vous livrer ces colis?')">
	<i class="ace-icon fa fa-save"></i>
	Livrer ces colis
</a>

<?php echo form_close();}?>
</div>
						</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
jQuery(function($){
   $("#noawbl").mask("999-99999999");
});
</script>
