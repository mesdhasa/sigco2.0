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
			<?php echo form_open('facture/recherche_statistics_weight/f/rap_caisse6','class="form-inline"');?>
			<div class="form-group">
			<label class="control-label col-sm-4 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
			 <div class="col-sm-3">
					<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="date1" value="<?php echo $_POST['date1']; ?>" />
			 </div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>au:</strong></label>
			<div class="col-sm-3">
				 <input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Date " name="date2" value="<?php echo $_POST['date2']; ?>" />
			</div>
			</div>
				<div class="input-group">
					<!-- <input autocomplete="off" type="text" name="custum" id="custum" size="20%" class="form-control" placeholder="No de vol" value=""/> -->
					<span class="input-group-btn">
						< <select class="form-control" name="type" required>
						<option value="">---- Type ----</option>
						<option value="import">Inbound</option>
						<option value="export">Outbound</option>
						</select>
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
		<h3>Statistics Weight</h3>

		<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
				 <th class="text-center">Date</th>
				 <th class="text-center">Compagnie</th>
        <th class="text-center">Flight No</th>
		<th class="text-center">Point of Loading</th>
    <th class="text-center">Weight total</th>

      </tr>
    </thead>
    <tbody>
			<?php  $_POST['type']=""; if ($_POST['type']=='import') {?>
				<?php $t=0;foreach($lessegments as $row){$t++;?>
				      <tr>
				        <td><?php echo $t;?></td>
						<td class="text-center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
							<td width="9%"><?php echo $row->compagnie;?></td>
								<td class="text-center"><?php echo $row->Voyage_number;?></td>
				        <td class="text-center"><?php echo $row->Place_of_departure_code;?></td>
								<td width="9%"><?php echo $row->totalp;?></td>

				      </tr>
						<?php }?>
			<?php 	}else {?>
				<?php $t=0;foreach($lessegments as $row){$t++;?>
				      <tr>
				        <td><?php echo $t;?></td>
						<td class="text-center"><?php echo dateVersChainetext($row->date);?></td>
							<td width="9%"><?php echo $row->compagnie;?></td>
								<td class="text-center"><?php echo $row->flight;?></td>
				        <td class="text-center"><?php echo $row->country_loading;?></td>
								<td width="9%"><?php echo $row->totalp;?></td>

				      </tr>
						<?php }?>
		<?php } ?>


    </tbody>
  </table>
</div>
<?php  if (!empty($lessegments)) {?>

	<!-- <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>facture/due_agent_pdf/USD/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>/<?php echo $_POST['compagnie'];?>">
		<i class="ace-icon fa fa-file-pdf-o"></i>
	Import Fees USD
	</a>
	<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>facture/due_agent_pdf/HTG/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>/<?php echo $_POST['compagnie'];?>">
		<i class="ace-icon fa fa-file-pdf-o"></i>
		Import Fees HTG
	</a> -->
<?php } ?>


	</div>

	</div>
<?php require_once('pied.php');?>
