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

<div class="col-lg-12 col-md-12 col-xs-12">
	<table class="table table-bordered">
		<thead>
		  <tr>
			<th style="width: 1px;" ></th>
			<th  style="width: 150px;">Autorisation de livraison</th>
			<th  style="width: 100px;">AWB</th>
			<th  style="width: 120px;">AWB DE</th>
			<th style="width: 180px;" >Colis livr&eacute; &agrave; (*):</th>
			<th style="width: 180px;" >NIF:</th>
			<th style="width: 1px;" >Livrer</th>
		  </tr>
		</thead>
		<?php echo form_open('livraison/livrer2','id="f1"');?>

		<tbody>
		<?php
		if(isset($_SESSION['lesno'])){
		for($i=0;$i<count($_SESSION['lesno']['no']);$i++){?>

		  <tr>
			<td><?php echo ($i+1);?></td>
			<td><?php echo $_SESSION['lesno']['no'][$i]?></td>
			<td><?php echo $_SESSION['lesno']['awbl'][$i]?></td>
			<input type="hidden" name="lesid[]" value="<?php echo $_SESSION['lesno']['awbl_id'][$i]?>">
			<input type="hidden" name="awbl_de<?php echo $_SESSION['lesno']['awbl_id'][$i]?>" value="<?php echo $_SESSION['lesno']['awbl_de'][$i]?>">
			<input type="hidden" name="autorisation<?php echo $_SESSION['lesno']['awbl_id'][$i]?>" value="<?php echo $_SESSION['lesno']['no'][$i]?>">
			<td><?php echo $_SESSION['lesno']['awbl_de'][$i]?></td>
			<td style="width: 180px;" ><input autocomplete="off" type="text" class="form-control" id="receveur" name="receveur<?php echo $_SESSION['lesno']['awbl_id'][$i]?>" required></td>
			<td style="width: 180px;" ><input autocomplete="off" type="text" class="form-control" id="nif" name="nif<?php echo $_SESSION['lesno']['awbl_id'][$i]?>"></td>
			<td ><input type="checkbox" value="<?php echo $_SESSION['lesno']['awbl_id'][$i]?>" id="livrer" name="livrer[]"   class="choixcb">
</td>
		  </tr>
		<?php }}?>
		</tbody>
	  </table>

<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>livraison/vider_nolivraison">
   <i class="ace-icon fa fa-close"></i>
Vider le tableau
</a>
<!-- <?php if(isset($_SESSION['lesno']) and count($_SESSION['lesno']['no']>0)){?> -->
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
