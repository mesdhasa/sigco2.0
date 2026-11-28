<?php
if(isset($_SESSION['droit']['a40']) and $_SESSION['droit']['a40']=="1"  ) {
}else{
	redirect('home/pas_access');
}
?>

<div class="page-header">
  <h1>
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Points de chargement (villes de depart)
      </small>
    </h1>
  </div>

	<div class="page-content">

    <?php if($this->session->flashdata('sms_point')){ ?>
    <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong><?php echo e($this->session->flashdata('sms_point'));?></strong>
    </div>
    <?php } ?>

	<div class="row">
		<div class="col-sm-5">
			<form autocomplete="off" class="form-inline" action="<?php echo base_url()?>ajouter-point-chargement" method="POST">
				<div class="form-group">
					<input type="text" class="form-control input-sm" name="code" maxlength="10" placeholder="Code (ex. JAC)" style="width:110px" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" name="nom" maxlength="100" placeholder="Ville (ex. JACMEL)" required>
				</div>
				<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus"></i> Ajouter</button>
			</form>
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-8">
			<?php if (isset($sigco_pag) && is_array($sigco_pag)) { ?>
			<div class="sigco-pagination-barre"><?php echo $sigco_pag['selecteur']; ?>
				<span class="text-muted"><?php echo (int) $sigco_pag['total']; ?> ville(s) &ndash; page <?php echo (int) $sigco_pag['page']; ?> / <?php echo (int) $sigco_pag['pages']; ?></span>
				<?php echo $sigco_pag['liens']; ?></div>
			<?php } ?>
			<table data-sigco-pagination="serveur" class="table table-striped table-condensed table-bordered table-hover">
				<thead>
					<tr><th>#</th><th>Code</th><th>Ville</th><th>Statut</th></tr>
				</thead>
				<tbody>
				<?php $r = (isset($sigco_pag) && is_array($sigco_pag)) ? $sigco_pag['offset'] : 0;
				foreach((isset($points) ? $points : array()) as $pt){ $r++; ?>
					<tr>
						<td><?php echo $r; ?></td>
						<td><strong><?php echo e($pt->code); ?></strong></td>
						<td><?php echo e($pt->nom); ?></td>
						<td><?php echo ($pt->statut == 1) ? 'Actif' : 'Inactif'; ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php if (isset($sigco_pag) && is_array($sigco_pag)) { ?>
			<div class="sigco-pagination-barre"><?php echo $sigco_pag['liens']; ?></div>
			<?php } ?>
		</div>
	</div>

	</div><!-- /.page-content -->
