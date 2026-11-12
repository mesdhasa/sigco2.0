<?php
require_once('tete.php');
if(isset($_SESSION['droit']['a7']) and $_SESSION['droit']['a7']=="1"  ) {
}if(isset($_SESSION['droit']['a8']) and $_SESSION['droit']['a8']=="1"  ) {

}else{
	redirect('home/pas_access');
}
foreach($lemanifeste as $rs){}

?>

<div class="page-header">
	<h1>
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			 Air Way Bil
		</small>

	</h1>

</div>
<form class="form-horizontal" id="fr_add_awb_exp"  method="POST" action="<?php echo base_url()?>export/export/remove_awb_manifest" >

					<div class="page-content">




						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
							<div class="table-responsive">
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
				<tr>
					<th class="center"></th>
					<th class="center" style="min-width:110px;">Awb No.</th>
					<th class="left">Qty</th>
					<th class="left">Of</th>
					<th class="center">Nature of goods</th>
					<th class="center">Weight (KGS)</th>
					<th class="center">Shipper</th>
					<th class="center">Consignee</th>
					<th class="center">Total freight</th>
					<th class="center">Weight charge</th>
					<th class="center">Currency</th>
					<th class="center"></th>
      </tr>
    </thead>
    <tbody>
			<?php
			$resul_t=0;
			if(count($lesawb)>0){
			$r=0;$weight=0;foreach($lesawb as $row){$r++;

				?>
				<?php if($row->void=="1"){?>
						<?php }else{

						
if ($row->gross_weight > round($row->totalvolum)){
  $weight=$row->rate_Charge*$row->gross_weight;
 } 
 if ($row->gross_weight < round($row->totalvolum)){
	$weight=$row->rate_Charge*$row->totalvolum;
   } 

							?>
							<tr>
								<td class="center"><?php echo $r;?></td>
								<td class="center"><?php echo $row->awb_number;?></td>
								<td class="center"><?php echo $row->qty;?></td>
								<td class="center"><?php echo $row->qty;?></td>
								<td class="center"><?php echo $row->nature_and_quantity;?></td>
								<td class="center"><?php echo $row->gross_weight;?></td>
								<td class="center"><?php echo $row->name_shipper;?></td>
								<td class="center"><?php echo $row->name_consignee;?></td>
								<td class="center"><?php echo $row->total_freight;?></td>
								<td class="center"><?php echo round($weight,2)?></td>
								<td class="center"><?php echo $row->currency;?></td>
							<input type="hidden" name="lesid[]" value="<?php echo $row->id_awbl?>">
								<td class="center">

							<input type="checkbox" value="<?php echo $row->id_manifeste?>" id="vol_valide<?php echo $row->id_awbl?>" name="vol_valide<?php echo $row->id_awbl?>" <?php if ($row->id_manifeste == true) echo "checked=\"checked\"";?>  class="choixcb">
							</td>
						      </tr>
									<?php $resul_t+=$row->gross_weight; }?>

		<?php }}?>

    </tbody>
		<tr>
			<td colspan='3' class="left" style="font-weight: bold;font-size: 15px;">Total Weight (KGS) : <?php echo $resul_t; ?></td>
		</tr>
  </table>
	<input type="hidden" id="idmanifeste" name="idmanifeste" value="<?php echo $this->uri->segment(3);?>" />
<input type="hidden" id="comp" name="comp" value="<?php echo $this->uri->segment(2);?>" />
<?php if ($rs->vol_fermer=="0") {?>
	<button id="btn_add_awb_exp" type="button" class="btn btn-sm btn-success">
	<i class="ace-icon fa fa-save"></i>
	Sauvegarder
	</button>
<?php }else{ ?><?php }?>

	<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>export/export/manifest_pdf/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>">
		<i class="ace-icon fa fa-file-pdf-o"></i>
		Imprimer PDF
	</a>
	<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>export/export/ExpManifestxls/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>">
	<i class="ace-icon fa fa-file-excel-o"></i>
	Exporter vers Excel
</a>
	<?php if ($rs->vol_fermer=="0") {?>
	<a class="btn btn-sm btn-warning" href="<?php echo base_url()?>lister_awb/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>">
		<i class="ace-icon fa fa-plus"></i>
		Ajouter un AWB
	</a>
	<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="confirmation_lien('do you want to close this flight?','<?php echo base_url()?>export/export/fermer_vol/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>')">

	<i class="ace-icon fa fa-close  bigger-120" aria-hidden="false"></i>
	Fermer Vol
	</a>
<?php }else{ ?>
	<?php if(isset($_SESSION['droit']['a35']) and $_SESSION['droit']['a35']=="1"  ) { ?>
	<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="confirmation_lien('do you want to open this flight?','<?php echo base_url()?>export/export/ouvrir_vol/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>')">

	<i class="ace-icon fa fa-open  bigger-120" aria-hidden="false"></i>
	Ouvrir Vol
	</a>
	<?php } else {?>
	<?php } ?>
<?php }?>


	<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>recherche_un_manifeste">
	<i class="ace-icon fa fa-close"></i>
	Fermer
	</a>
								</div>
							</div>

						</div>


					</div><!-- /.page-content -->
				</form>
				<?php require_once('pied.php');?>

				<script>
				$(function()
				{
					$('#btn_add_awb_exp').on('click',function()
				 {
					 $(this).html('Please wait ...').attr('disabled','disabled');
					 $('#fr_add_awb_exp').submit();

				 });


			 });
			</script>
