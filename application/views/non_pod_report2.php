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
	               W/H INVENTORY
								</small>

							</h1>

						</div>
<div class="page-content">
	<div class="row">

		<div class="row">
			<div class="col-lg-4 col-lg-push-4">

											</br>
				</div>
		</div>
	<div class="col-lg-12 col-md-6 col-sm-12">
		<h3>W/H INVENTORY</h3>

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
      </tr>
    </thead>
    <tbody>
			<?php
			$i=0;foreach($les_non_livraisons as $row){$i++;

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

      </tr>
				<?php }?>
    </tbody>
  </table>
</div>
<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>livraison/non_livrer_pdf/<?php 	echo $_POST['date1'];?>/<?php 	echo $_POST['date2']?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
	W/H INVENTORY
</a>
<a href="<?php echo base_url()?>livraison/non_livraison/l/non" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-close"></i>
Close
</a>
	</div>

	</div>
</div>
<?php require_once('pied.php');?>
