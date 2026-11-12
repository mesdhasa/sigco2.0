<?php
if(isset($_SESSION['droit']['a7']) and $_SESSION['droit']['a7']=="1"  ) {
}else{
	redirect('home/pas_access');
}
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									 Vol export

								</small>

							</h1>

						</div>

					<div class="page-content">
						<?php
						if($this->session->flashdata('sms_add_manifeste')){
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong><?php echo $this->session->flashdata('sms_add_manifeste');?></strong>
						</div>
						<?php } ?>
						<div class="row">
							<div class="col-lg-7">

							<div class="col-lg-4 col-lg-push-8">
									<span class="input-group-btn">
													<a href="<?php echo base_url()?>creer-un-manifeste" class="btn btn-sm btn-primary" role="button">
													<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false">	Créer un manifeste</i>
													</a>
									</span>
															</br>
								</div>

								</div>
						</div>


						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
							<div class="table-responsive">
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr>
		<th></th>
		<th>Date</th>
		<th>Carrier</th>
		<th>Air craft #</th>
		<th>flt #</th>
		<th>Country Loading</th>
		<th>Country Unloading</th>
		<th>Add AWB</th>
		<th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>
			<?php $m=0;foreach($lesmanifeste as $row){$m++;?>
	<tr>
		<td class="center"><?php echo $m;?></td>
		<td class="center"><?php echo dateVersChainetext($row->date);?></td>
		<td class="center"><?php echo strtoupper($row->compagnie);?></td>
		<td class="center"><?php echo $row->air_craft;?></td>
		<td class="center"><?php echo $row->flight;?></td>
		<td class="center"><?php echo $row->country_loading;?></td>
		<td class="center"><?php echo $row->country_unloading;?></td>
		<td class="center">
		<a href="<?php echo base_url()?>lister_awb/<?php echo $row->idcompagnie;?>/<?php echo $row->id_manifeste;?>" class="btn btn-xs btn-danger" role="button">
		<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
		<a href="<?php echo base_url()?>modifier_un_manifeste/<?php echo $row->id_manifeste;?>" class="btn btn-xs btn-primary" role="button">
		<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
		<button onclick="confirmation_lien('Voulez-vous supprimer?','<?php echo base_url()?>manifeste_supp/<?php echo $row->id_manifeste;?>')" class="btn btn-xs btn-danger" role="button">
		<i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
		</button>
		</td>

      </tr>
			<?php }?>
    </tbody>
  </table>
								</div>
							</div>

						</div>


					</div><!-- /.page-content -->
