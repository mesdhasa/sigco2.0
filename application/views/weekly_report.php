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
			<?php echo form_open('rapports/weekly_search2/rapports/weekly','class="form-inline"');?>
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
						 <select class="form-control" name="type" required>
						<option value="">---- Type ----</option>
						<option value="import" <?php if(isset($_POST['type']) and $_POST['type']=='import') 		echo " selected"?>>Inbound</option>
						<option value="export" <?php if(isset($_POST['type']) and $_POST['type']=="export") 		echo " selected"?>>Outbound</option>
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
		<?php  if ($_POST['type']=='import') {?>
			<h3>WEEKLY REPORTS (Inbound)</h3>

		<div class="table-responsive">
<table class="table table-striped">

    <thead>
      <tr>
        <th></th>
				 <th class="text-center">Date</th>
        <th class="text-center">AWB #</th>
		<th class="text-center">TTL CC</th>
    <th class="text-center">REMARKS</th>

      </tr>
    </thead>
    <tbody>
				<?php $t=0;foreach($lessegments as $row){$t++;?>
				      <tr>
				        <td><?php echo $t;?></td>
						<td class="text-center"><?php echo dateVersChainetext($row->date_hc);?></td>
								<td class="text-center"><?php echo $row->awbl;?></td>
				        <td class="text-center">$<?php echo $row->freight;?></td>
								<td width="9%"><?php echo $row->remarque2;?></td>

				      </tr>
						<?php } ?>


    </tbody>
  </table>
</div>
<?php } ?>
<?php  if ($_POST['type']=='export') {?>

	<h3>WEEKLY REPORTS (Outbound)</h3>

<div class="table-responsive">
<table class="table table-striped">

<thead>
	<tr>
		<th></th>
		 <th class="text-center">Date</th>
		<th class="text-center">AWB #</th>
<th class="text-center">TTL PP</th>
<th class="text-center">REMARKS</th>

	</tr>
</thead>
<tbody>
		<?php $t=0;foreach($lessegments as $row){$t++;?>
					<tr>
						<td><?php echo $t;?></td>
				<td class="text-center"><?php echo dateVersChainetext($row->datecreated);?></td>
						<td class="text-center"><?php echo $row->awbl;?></td>
						<td class="text-center">$<?php echo round($row->total,2);?></td>
						<td width="9%"><?php echo $row->remarque;?></td>

					</tr>
				<?php } ?>


</tbody>
</table>
</div>
<?php } ?>
<?php  if (!empty($lessegments) and $_POST['type']=='import') {?>
	<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>rapports/weekly_search_pdf/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>">
		<i class="ace-icon fa fa-file-pdf-o"></i>
WEEKLY REPORTS (Inbound)
</a>
	<?php }  ?>
	<?php if (!empty($lessegments) and $_POST['type']=='export')  {?>

		<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>rapports/weekly_search_pdf2/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>">
			<i class="ace-icon fa fa-file-pdf-o"></i>
			WEEKLY REPORTS (Outbound)
		</a>
<?php } ?>
	</div>

	</div>
<?php require_once('pied.php');?>
