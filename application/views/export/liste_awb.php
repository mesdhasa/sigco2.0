<?php
require_once('tete.php');

if(isset($_SESSION['droit']['a7']) and $_SESSION['droit']['a7']=="1"  ) {
}if(isset($_SESSION['droit']['a8']) and $_SESSION['droit']['a8']=="1"  ) {

}else{
	redirect('home/pas_access');
}
?>
<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									 Air Way Bill

								</small>

							</h1>

						</div>

				<form class="form-horizontal" id="fr_add_awb_exp"  method="POST" action="<?php echo base_url()?>export/export/add_awb_manifest" >


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
																<!-- <th class="center">Nature of goods</th> -->
																<th class="center">Weight (KGS)</th>
																<!-- <th class="center">Consignee</th> -->
																<th class="center">Total freight</th>
																<!-- <th class="center">Weight charge</th> -->
																<!-- <th class="center">Currency</th> -->
																<th class="center"></th>
											      </tr>
											    </thead>

													<tbody>
														<?php
														if(count($lesawb)>0){
														$r=0;foreach($lesawb as $row){$r++;
					                  if($row->void=="1"){?>
															<?php }else{?>
																<tr>
																	<td class="center"><?php echo $r;?></td>
																	<td class="center"><?php echo $row->awb_number;?></td>
																	<td class="center"><?php echo $row->qty;?></td>
																	<td class="center"><?php echo $row->qty;?></td>
																	<!-- <td class="center"><?php //echo $row->nature_and_quantity;?></td> -->
																	<td class="center"><?php echo $row->gross_weight;?></td>
																	<input type="hidden" name="lesid[]" value="<?php echo $row->id_awbl?>">
																	<!-- <td class="center"><?php //echo $row->name_consignee;?></td> -->
																	<td class="center"><?php echo $row->total_freight;?></td>
																	<!-- <td class="center"><?php //echo $row->total_weight_charge;?></td> -->
																	<!-- <td class="center"><?php //echo $row->currency;?></td> -->
																	<td class="center">
																<input type="checkbox" value="<?php echo $this->uri->segment(3);?>" id="vol_valide<?php echo $row->id_awbl?>" name="vol_valide<?php echo $row->id_awbl?>"   class="choixcb">
																</td>

																		</tr>
																	<?php }}}?>

											    </tbody>
											  </table>
												<span class="form-group">
													<input type="hidden" id="idmanifeste" name="idmanifeste" value="<?php echo $this->uri->segment(3);?>" />
												<input type="hidden" id="comp" name="comp" value="<?php echo $this->uri->segment(2);?>" />

												  </span>

																	<button id="btn_add_awb_exp" type="button" class="btn btn-sm btn-primary">
																	<i class="ace-icon fa fa-save"></i>
																	Sauvegarder
																	</button>
												<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>manifeste">
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
