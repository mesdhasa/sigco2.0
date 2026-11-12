<?php
if(isset($_SESSION['droit']['a17']) and $_SESSION['droit']['a17']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php'); ?>
<div class="page-content">
	<div class="row">


	<div class="col-lg-12 col-md-6 col-sm-12">
		<h3>Rapport caisse</h3>

		<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th>No Rapport</th>
        <th>Date</th>
        <th>AWB</th>
		<th>Mode de paiement</th>
		<th>Description </th>
    <th>Montant</th>
    <th>encaisse</th>
    <th></th>
		<th>Client</th>
      </tr>
    </thead>
    <tbody>
	<?php
	$i=0;foreach($lesfactures_caisse as $row){$i++;

	?>
      <tr>
        <td><?php echo $i;?></td>
		<td><?php echo $row->norapport;?></td>
        <td><?php echo dateverschainetext($row->date_hc);;?></td>
        <td><?php echo $row->awb;?></td>
        <td><?php echo $row->mode_paiement;?></td>
        <td><?php echo $row->package;?></td>
        <td><?php echo $row->montant_hc;?></td>
        <td><?php echo $row->montant_hc;?></td>
        <td><?php echo $row->monnaie;?></td>
        <td><?php echo $row->consignee;?></td>

      </tr>
	<?php }?>
    </tbody>
  </table>
</div>
<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>facture/caissepdf_usd/USD/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
Rapport caisse USD
</a>
<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>facture/caissepdf_htg/HTG/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
Rapport caisse HTG
</a>
<a href="<?php echo base_url()?>facture/rap_caisse/f/rap_caisse" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-close"></i>
Close
</a>
	</div>

	</div>
</div>
<?php require_once('pied.php');?>
