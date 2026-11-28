<?php
if(isset($_SESSION['droit']['a41']) and $_SESSION['droit']['a41']=="1"  ) {
}else{
	redirect('home/pas_access');
}
?>

<div class="page-header">
  <h1>
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Archives des numeros d'AWB
      </small>
    </h1>
  </div>

	<div class="page-content">

    <?php if($this->session->flashdata('sms2')){ ?>
    <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong><?php echo e($this->session->flashdata('sms2'));?></strong>
    </div>
    <?php } ?>

	<div class="row">
		<div class="col-sm-5">
			<form autocomplete="off" class="form-inline" action="<?php echo base_url()?>archives-awb" method="GET">
				<div class="form-group">
					<input type="text" class="form-control input-sm" name="q" value="<?php echo e(isset($recherche)?$recherche:'')?>" placeholder="Numero d'AWB" style="width:200px">
				</div>
				<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-search"></i> Rechercher</button>
				<a href="<?php echo base_url()?>archives-awb" class="btn btn-sm btn-default">Tout</a>
			</form>
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<?php if (isset($sigco_pag) && is_array($sigco_pag)) { ?>
			<div class="sigco-pagination-barre"><?php echo $sigco_pag['selecteur']; ?>
				<span class="text-muted"><?php echo (int) $sigco_pag['total']; ?> AWB archive(s) &ndash; page <?php echo (int) $sigco_pag['page']; ?> / <?php echo (int) $sigco_pag['pages']; ?></span>
				<?php echo $sigco_pag['liens']; ?></div>
			<?php } ?>
			<table data-sigco-pagination="serveur" class="table table-striped table-condensed table-bordered table-hover">
				<thead>
					<tr><th>#</th><th>N&deg; AWB</th><th>Shipper</th><th>Consignee</th><th>Vol</th><th>Archive le</th><th>Archive par</th><th>Motif</th><th></th></tr>
				</thead>
				<tbody>
				<?php $r = (isset($sigco_pag) && is_array($sigco_pag)) ? $sigco_pag['offset'] : 0;
				foreach((isset($archives) ? $archives : array()) as $a){ $r++; ?>
					<tr>
						<td><?php echo $r; ?></td>
						<td><strong><?php echo e($a->awb_number); ?></strong></td>
						<td><?php echo e($a->name_shipper); ?></td>
						<td><?php echo e($a->name_consignee); ?></td>
						<td><?php echo e($a->flight); ?></td>
						<td><?php echo e(sigco_date($a->archive_le)); ?></td>
						<td><?php echo e($a->archive_par_nom); ?></td>
						<td><?php echo e($a->motif); ?></td>
						<td><a href="<?php echo base_url()?>detail-archive-awb/<?php echo (int)$a->id_archive; ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a></td>
					</tr>
				<?php } ?>
				<?php if(empty($archives)){ ?>
					<tr><td colspan="9" class="text-center text-muted">Aucun AWB archive.</td></tr>
				<?php } ?>
				</tbody>
			</table>
			<?php if (isset($sigco_pag) && is_array($sigco_pag)) { ?>
			<div class="sigco-pagination-barre"><?php echo $sigco_pag['liens']; ?></div>
			<?php } ?>
		</div>
	</div>

	</div><!-- /.page-content -->
