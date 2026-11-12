<?php require_once('tete.php');
if(isset($_SESSION['droit']['a2']) and $_SESSION['droit']['a2']=="1"){

}else{
	redirect('home/pas_access');
}
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Cr&eacute;er un vol

								</small>

							</h1>

						</div>

					<div class="page-content">
<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
<?php
if($this->session->flashdata('sms2')){
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms2');?></strong>
</div>
<?php } ?>

						<div class="row">
							<div class="col-lg-4 col-lg-push-3">
							<?php echo form_open('import/add','class="form-inline"');?>

								<div class="input-group">
								  <input autocomplete="off" type="text" name="custum" id="custum" size="30%" class="form-control" placeholder="No de douane" value="" required />
								  <span class="input-group-btn">
								  <select class="form-control" name="compagnie" required>
									<option value="">---- Compagnie ----</option>
									<?php foreach($compagnie as $row){?>
									<option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

									<?php }?>
								  </select>
									<button class="btn btn-sm btn-primary" type="submit">
													   <i class="ace-icon fa fa-plus"></i>
													Ajouter
													</button>
								  </span>
								</div>

									<?php echo form_close();?>


														  </br>
								</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
							<div class="table-responsive">
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr>
		<th></th>
		<th>Date departure</th>
		<th>Date</th>
		<th>Compagnie</th>
		<th>No de douane</th>
		<th>Flight NO</th>
		<th>Registration number transport</th>
		<th>Point of Loading</th>
		<th>Add Manifest</th>
		<th>View AWB</th>
		<th>Add AWB</th>
		<th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>
<?php $t=0;foreach($lessegments as $row){$t++;?>
	<tr>
        <td><?php echo $t;?></td>
        <td class="center"><?php echo dateVersChainetext($row->Date_of_departure);?></td>
		<td class="center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
		<td><?php echo strtoupper($row->compagnie);?></td>
		<td><?php echo $row->custum;?></td>
		<td><?php echo $row->Voyage_number;?></td>
		<td class="center"><?php echo $row->Registration_number_of_transport_code;?></td>
		<td class="center"><?php echo $row->Place_of_departure_code;?></td>
		<td class="center">
		<?php if($row->status == 0){?>
		<a style="pointer-events: none; display: inline-block;" href="<?php echo base_url()?>import/manifest/i/ajouter/<?php echo $row->id;?>" class="btn btn-xs btn-success" role="button" disabled>
		<i class="ace-icon fa fa-upload bigger-120" aria-hidden="false"></i>
		</a>
		<?php }?>
		<?php if($row->status == 1){?>
		<a href="<?php echo base_url()?>import/manifest/i/ajouter/<?php echo $row->id;?>" class="btn btn-xs btn-success" role="button">
		<i class="ace-icon fa fa-upload bigger-120" aria-hidden="false"></i>
		</a>
		<?php }?>
		</td>
		<td class="center">
		<a style="pointer-events: none; display: inline-block;" href="<?php echo base_url()?>import/awbl/i/ajouter/<?php echo $row->id;?>" class="btn btn-xs btn-info" role="button">
		<i class="ace-icon fa fa-eye bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
			<?php if($row->status == 1){?>
		<a style="pointer-events: none; display: inline-block;" href="<?php echo base_url()?>import/newawbl/i/ajouter/<?php echo $row->id;?>" class="btn btn-xs btn-danger" role="button">
		<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false"></i>
		</a>
			<?php }?>

		</td>
		<td class="center">
		<a href="<?php echo base_url()?>import/editcustum/i/ajouter/<?php echo $row->id;?>" class="btn btn-xs btn-primary" role="button">
		<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
		<button onclick="confirmation_lien('Voulez-vous supprimer ce vol?','<?php echo base_url()?>import/supprimerVol/<?php echo $row->id;?>')" class="btn btn-xs btn-danger" role="button">
		<i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
		</button>
		</td>

      </tr>
<?php }?>
    </tbody>
  </table>
								</div>
							</div>

						</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
jQuery(function($){
   $("#custum").mask("ME9999-M99999I");
});
</script>
