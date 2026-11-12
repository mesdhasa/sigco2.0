<?php
if(isset($_SESSION['droit']['a12']) and $_SESSION['droit']['a12']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php'); ?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
								POD  Report

								</small>

							</h1>

						</div>
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
			<div class="col-lg-12">
			<?php echo form_open('livraison/pod_report_date','class="form-inline"');?>
			<div class="form-group">
			<label class="control-label col-sm-4 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
			 <div class="col-sm-3">
					<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="date1" value="" required />
			 </div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>au:</strong></label>
			<div class="col-sm-3">
				 <input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Date " name="date2" value=""  required/>
			</div>
			</div>
				<div class="input-group">
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
	<div class="col-lg-12 col-md-6 col-sm-12">
		<h3>POD Report</h3>

		<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th>Arrival Date</th>
        <th>Compagnie</th>
        <th>AWB No.</th>
		<th>Qty</th>
		<th>Package</th>
    <th>Consignee</th>
    <th>Weight (KGS)</th>
    <th>Delivered </th>
		<th>Delivered by</th>
		<th>Received by</th>
      </tr>
    </thead>
    <tbody>
			<?php
			$i=0;foreach($leslivraisons as $row){$i++;

			?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo dateverschainetext($row->Date_of_arrival);?></td>
        <td><?php echo $row->compagnie;?></td>
				<td><?php echo $row->awbl;?></td>
        <td><?php echo $row->qtytotal;?></td>
        <td><?php echo $row->package;?></td>
        <td><?php echo $row->consignee;?></td>
        <td><?php echo $row->weight;?></td>
        <td><?php echo dateverschainetext($row->datelivre);?></td>
        <td><?php echo $row->livrepar;?></td>
        <td><?php echo $row->recupar;?>/<?php echo $row->nif;?></td>

      </tr>
				<?php }?>
				<?php
			foreach($degroup as $row2){$i++;
if ($row2->iddeg!='') {

				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo dateverschainetext($row2->Date_of_arrival);?></td>
					<td><?php echo $row2->compagnie;?></td>
					<td><?php echo $row2->awbl;?>./.<?php echo $row2->nobuil;?></td>
					<td>1</td>
					<td><?php echo $row2->package;?></td>
					<td><?php echo $row2->consignee;?></td>
					<td><?php echo $row2->poids;?></td>
					<td><?php echo dateverschainetext($row2->livrer_le);?></td>
					<td><?php echo $row2->livrepar2;?></td>
					<td><?php echo $row2->recupar2;?>/<?php echo $row2->nif2;?></td>

				</tr>
					<?php }}?>
    </tbody>
  </table>
</div>
<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>livraison/pod_report/<?php echo $this->session->ladate;?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
POD Report
</a>
	</div>

	</div>
</div>
<?php require_once('pied.php');?>
