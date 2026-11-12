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
			<div class="col-lg-12">
			<?php echo form_open('facture/recherche_informatics_fees/f/rap_caisse3','class="form-inline"');?>
			<div class="form-group">
			<label class="control-label col-sm-4 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
			 <div class="col-sm-3">
					<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="date1" value="<?php echo $_POST['date1']; ?>" required/>
			 </div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>au:</strong></label>
			<div class="col-sm-3">
				<input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Date " name="date2" value="<?php echo $_POST['date2']; ?>" required/>
			</div>
			</div>

				<div class="input-group">
					<span class="input-group-btn">
						<!-- <select class="form-control" name="compagnie" required>
						<option value="">---- Compagnie ----</option>
						<?php foreach($compagnie as $row){?>
						<option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

						<?php }?>
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
		<h3>Informatics fees</h3>

		<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
				 <th class="text-center">AWB</th>
				 <th width="9%">Compagnie</th>
				 <th class="text-center">Date of Arrival</th>
        <th width="9%">Flight No</th>
				<th class="text-center">No Rapport</th>
		<th class="text-center">Description </th>
		<th width="9%">Montant</th>
    <th width="9%">Currency</th>
      </tr>
    </thead>
    <tbody>
<?php $t=0;foreach($lessegments as $row){$t++;?>
      <tr>
        <td><?php echo $t;?></td>
		<td class="text-center"><?php echo $row->awb;?></td>
		<td width="9%"><?php echo $row->compagnie;?></td>
		<td class="text-center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
        <td width="9%"><?php echo $row->Voyage_number;?></td>
				<td class="text-center"><?php echo $row->num;?></td>
				<td class="text-center"><?php echo $row->description;?></td>
				<td width="9%"><?php echo $row->montant_hc;?></td>
        <td width="9%"><?php echo $row->monnaie;?></td>
      </tr>
		<?php }?>

    </tbody>
  </table>
</div>
<?php  if (!empty($lessegments)) {?>
	<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>facture/informatics_fees_pdf/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>">
		<i class="ace-icon fa fa-file-pdf-o"></i>
	Informatics fees
	</a>
<?php } ?>


	</div>

	</div>
</div>
<?php require_once('pied.php');?>
