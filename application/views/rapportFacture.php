<?php
if(isset($_SESSION['droit']['a16']) and $_SESSION['droit']['a16']=="1"  ) {
}else{
	redirect('home');
}
 require_once('tete.php'); ?>
<div class="page-content">
	<div class="row">


	<div class="col-lg-12 col-md-6 col-sm-12">
		<h3>Liste des factures impayées <small><?php echo (int) $pagination['total'];?> factures &ndash; page <?php echo (int) $pagination['page'];?> / <?php echo (int) $pagination['pages'];?></small></h3>
		<?php echo $pagination['liens'];?>

		<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th>Date</th>
		<th>No facture</th>
        <th>Awbl</th>
		<th>client</th>
		<th>Package</th>
		<th>Montant</th>
		<th>Status</th>

      </tr>
    </thead>
    <tbody>
	<?php
	$i=$pagination['offset'];foreach($lesfactures as $row){$i++;
		$status="Impayée";
		if(diff_date($row->date,date('Y-m-d')) > 30){
			$status="<strong>DUE DATE</strong>";
		}

	?>
      <tr>
        <td><?php echo $i;?></td>
		<td><?php echo dateverschainetext($row->date);?></td>
        <td><?php echo e($row->nofacture);?></td>
        <td><?php echo e($row->awbl);?></td>
		<td><?php echo e($row->societe);?></td>
		<td><?php echo e($row->package);?></td>
		<td>$<?php echo round($row->balance,2);?> USD</td>
		<td><?php echo $status;?></td>
      </tr>
	<?php }?>
    </tbody>
  </table>
</div>
<?php echo $pagination['liens'];?>
	</div>

	</div>
</div>
<?php require_once('pied.php');?>
