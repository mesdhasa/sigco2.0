<?php
if(isset($_SESSION['droit']['a41']) and $_SESSION['droit']['a41']=="1"  ) {
}else{
	redirect('home/pas_access');
}
$a = $archive;
?>

<div class="page-header">
  <h1>
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        AWB archive <?php echo e($a->awb_number); ?>
        <span class="label label-warning">ARCHIV&Eacute;</span>
      </small>
    </h1>
  </div>

	<div class="page-content">
		<p>
			<a href="<?php echo base_url()?>archives-awb" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Retour aux archives</a>
		</p>

		<div class="alert alert-warning">
			Cet enregistrement est <strong>archiv&eacute;</strong> : son num&eacute;ro d'AWB a &eacute;t&eacute; lib&eacute;r&eacute; et peut avoir &eacute;t&eacute; r&eacute;utilis&eacute;.
			Donn&eacute;es conserv&eacute;es pour consultation uniquement.
		</div>

		<table class="table table-bordered table-condensed">
			<tr><th style="width:25%">N&deg; AWB</th><td><strong><?php echo e($a->awb_number); ?></strong></td></tr>
			<tr><th>Shipper</th><td><?php echo e($a->name_shipper).' &ndash; '.e($a->ville_shipper); ?></td></tr>
			<tr><th>Consignee</th><td><?php echo e($a->name_consignee).' &ndash; '.e($a->ville_consignee); ?></td></tr>
			<tr><th>Agent</th><td><?php echo e($a->name_agent); ?></td></tr>
			<tr><th>Vol / Date</th><td><?php echo e($a->flight).' &ndash; '.e($a->date_flight); ?></td></tr>
			<tr><th>Destination</th><td><?php echo e($a->destination); ?></td></tr>
			<tr><th>Cr&eacute;&eacute; par</th><td><?php echo e($a->cree_par_nom); ?> <?php echo $a->cree_le ? '('.e(sigco_date($a->cree_le)).')' : ''; ?> <?php echo ($a->cree_entreprise||$a->cree_ville)?' &ndash; '.e(trim($a->cree_entreprise.' '.$a->cree_ville)):''; ?></td></tr>
			<tr class="warning"><th>Archiv&eacute; le</th><td><?php echo e(sigco_date($a->archive_le)); ?></td></tr>
			<tr class="warning"><th>Archiv&eacute; par</th><td><?php echo e($a->archive_par_nom); ?></td></tr>
			<tr class="warning"><th>Motif</th><td><?php echo e($a->motif); ?></td></tr>
		</table>

	</div><!-- /.page-content -->
