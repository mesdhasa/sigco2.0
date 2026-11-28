<?php
if(isset($_SESSION['droit']['a42']) and $_SESSION['droit']['a42']=="1"  ) {
}else{
	redirect('home/pas_access');
}
$types = array('awb'=>'AWB (Export)', 'manifeste'=>'Manifestes', 'warehouse'=>'Warehouses');
?>

<div class="page-header">
  <h1>
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Journal de tra&ccedil;abilit&eacute; des documents
      </small>
    </h1>
  </div>

	<div class="page-content">

	<form autocomplete="off" class="form-inline" action="<?php echo base_url()?>audit" method="GET">
		<div class="form-group">
			<label>Type :</label>
			<select class="form-control input-sm" name="type">
			<?php foreach($types as $k=>$lib){ ?>
				<option value="<?php echo $k?>"<?php echo ($type===$k?' selected':'')?>><?php echo e($lib)?></option>
			<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label>Transporteur :</label>
			<select class="form-control input-sm" name="compagnie">
				<option value="">Tous</option>
				<?php $cc = isset($compagnie_choisie)?(string)$compagnie_choisie:''; foreach((isset($compagnie)?$compagnie:array()) as $row){?>
				<option value="<?php echo $row->idcompagnie?>"<?php echo ($cc!==''&&(string)$row->idcompagnie===$cc)?' selected':''?>><?php echo e(strtoupper($row->compagnie))?></option>
				<?php }?>
			</select>
		</div>
		<div class="form-group">
			<label>Cr&eacute;&eacute; du :</label>
			<input type="text" class="form-control input-sm" name="date1" value="<?php echo e(isset($date1)?$date1:'')?>" placeholder="jj/mm/aaaa" style="width:110px">
			<label>au :</label>
			<input type="text" class="form-control input-sm" name="date2" value="<?php echo e(isset($date2)?$date2:'')?>" placeholder="jj/mm/aaaa" style="width:110px">
		</div>
		<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-search"></i> Filtrer</button>
	</form>
	<br>

	<?php if (isset($sigco_pag) && is_array($sigco_pag)) { ?>
	<div class="sigco-pagination-barre"><?php echo $sigco_pag['selecteur']; ?>
		<span class="text-muted"><?php echo (int) $sigco_pag['total']; ?> document(s) &ndash; page <?php echo (int) $sigco_pag['page']; ?> / <?php echo (int) $sigco_pag['pages']; ?></span>
		<?php echo $sigco_pag['liens']; ?></div>
	<?php } ?>

	<table data-sigco-pagination="serveur" class="table table-striped table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th><th>R&eacute;f&eacute;rence</th><th>Transporteur</th>
				<th>Cr&eacute;&eacute; par</th><th>Station</th><th>Cr&eacute;&eacute; le</th>
				<th>Modifi&eacute; par</th><th>Modifi&eacute; le</th>
			</tr>
		</thead>
		<tbody>
		<?php $r = (isset($sigco_pag) && is_array($sigco_pag)) ? $sigco_pag['offset'] : 0;
		foreach((isset($lignes) ? $lignes : array()) as $l){ $r++;
			$station = trim((string)$l->cree_entreprise.' '.(string)$l->cree_ville); ?>
			<tr>
				<td><?php echo $r; ?></td>
				<td><strong><?php echo e($l->reference); ?></strong></td>
				<td><?php echo e($l->transporteur); ?></td>
				<td><?php echo e($l->cree_par_nom); ?></td>
				<td><?php echo e($station); ?></td>
				<td><?php echo $l->cree_le ? e(sigco_date($l->cree_le)) : '<span class="text-muted">&ndash;</span>'; ?></td>
				<td><?php echo e($l->modif_par_nom); ?></td>
				<td><?php echo $l->modif_le ? e(sigco_date($l->modif_le)) : ''; ?></td>
			</tr>
		<?php } ?>
		<?php if(empty($lignes)){ ?>
			<tr><td colspan="8" class="text-center text-muted">Aucun document pour ce filtre.</td></tr>
		<?php } ?>
		</tbody>
	</table>
	<?php if (isset($sigco_pag) && is_array($sigco_pag)) { ?>
	<div class="sigco-pagination-barre"><?php echo $sigco_pag['liens']; ?></div>
	<?php } ?>

	<p class="text-muted"><small>Les documents ant&eacute;rieurs au Bloc 03 n'ont pas d'information de cr&eacute;ateur (tiret).</small></p>

	</div><!-- /.page-content -->
