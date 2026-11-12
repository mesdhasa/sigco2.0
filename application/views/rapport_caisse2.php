<?php
if(isset($_SESSION['droit']['a17']) and $_SESSION['droit']['a17']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php'); ?>
<div class="page-content">
	<?php
	if($this->session->flashdata('sms')){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('sms');?></strong>
	</div>
	<?php } ?>
	<div class="row">

		<div class="row">
			<div class="col-lg-4 col-lg-push-4">
			<?php echo form_open('facture/recherche_no/','class="form-inline"');?>

				<div class="input-group">
					<div class="form-group">
					<div class="col-sm-3">
					<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="daterapport" value=""/>
					</div>
					</div>
					<span class="input-group-btn">
					<!-- <select class="form-control" name="norapport" required>
					<option value="">----No Rapport----</option>
					<?php foreach($norapport as $row2){?>
					<option value="<?php echo $row2->num?>"><?php echo strtoupper($row2->num)?>....<?php echo dateVersChainetext($row2->daterapport)?></option>

				<?php } ?>
					</select> -->
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
	<div class="col-lg-12 col-md-6 col-sm-12">
		<h3>Rapport caisse</h3>

		<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th width="9%">No Rapport</th>
        <th>Compagnie</th>
        <th>Airport Fees</th>
		<th>Redevences Inf</th>
		<th>Fret</th>
    <th>Droit depot</th>
    <th>Due agent<?php echo $this->input->post('norapport');?></th>
    <th>Total</th>
      </tr>
    </thead>
    <tbody>
	<?php
	$i=0;foreach($lesfactures_caisse as $row){$i++;

	?>
      <tr>
        <td><?php echo $i;?></td>
		<td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
	<?php }?>
    </tbody>
  </table>
</div>
<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>facture/caissepdf_usd/USD/<?php echo $this->session->numrapport;?>/<?php echo $this->session->ladate;?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
Rapport caisse USD
</a>
<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>facture/caissepdf_htg/HTG/<?php echo $this->session->numrapport;?>/<?php echo $this->session->ladate;?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
Rapport caisse HTG
</a>
	</div>

	</div>
</div>
<?php require_once('pied.php');?>
