<?php

if(isset($_SESSION['droit']['a15']) and $_SESSION['droit']['a15']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
$val = "";
if(isset($_SESSION['sesnumber'])){
	$val = $_SESSION['sesnumber'];
}

?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Rechercher un AWB

								</small>

							</h1>

						</div>

					<div class="page-content">
						<?php
						if($this->session->flashdata('sms2')){
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong><?php echo $this->session->flashdata('sms2');?></strong>
						</div>
						<?php } ?>

						<div class="row">
							   <div class="col-lg-7">
							<div class="col-lg-6 col-lg-push-5">
							<?php echo form_open('facture/recherche','class="form-inline"');?>

								<div class="input-group">
								  <input autocomplete="off" type="text" name="noawbl" id="noawbl" size="20%" class="form-control" placeholder="" value="" required />
								  <span class="input-group-btn">
									<button class="btn btn-sm btn-primary" type="submit">
													   <i class="ace-icon fa fa-search"></i>
													Recherche
													</button>

								  </span>
								</div>

									<?php echo form_close();?>

														  </br>



								</div>
								<div class="col-lg-6 col-lg-push-5">
                  <?php echo form_open('facture/add_awb_export','class="form-inline"');?>

                    <div class="input-group">
                      <input autocomplete="off" type="text" name="awblnum" id="awblnum" size="20%" class="form-control" placeholder="" value="" required />
                      <span class="input-group-btn">
                      <button class="btn btn-sm btn-primary" type="submit">
                                 <i class="ace-icon fa fa-plus"></i>
                            Ajouter
                              </button>

                      </span>
                    </div>

                      <?php echo form_close();?>

                                  </br>
                  </div>
						</div>
					</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								TAG
<!-- <span class="label label-default">Default</span> -->
<!-- <span class="label label-primary">Primary</span> -->
<!-- <span class="badge badge-secondary">Secondary</span> -->
<span class="badge badge-success">Export</span>
<span class="label label-danger">Deliver</span>
<!-- <span class="badge badge-warning">Warning</span> -->
<!-- <span class="badge badge-info">Info</span> -->
<span class="badge badge-light">Import</span>
<!-- <span class="badge badge-dark">Dark</span> -->
							<div class="table-responsive">
<table id="simple-table" class="table  table-bordered table-hover table-condensed">
										<p></p>
											<thead>
												<tr>
													<th class="center"></th>
													<th class="center">AWB No.</th>
													<th class="center">Qty</th>
													<th class="center">Consignee</th>
													<th class="center">Package</th>
													<th class="center">Weight (KGS)</th>
													<th class="center">Freight</th>
													<th class="center">Weight charge</th>
													<th class="center">Currency</th>
													<th class="center">PP</th>
													<th class="center">CC</th>
													<th class="center">NC</th>
													<th class="center"></th>
												</tr>
											</thead>


											<tbody><?php  if  ( $data['data'] == ""){ ?>
											<?php } else {?>
												<?php $g=0;foreach ($data['data'] as $row) {$g++;?>
													<?php if($row->datelivre=="" AND $row->typeawbl=="import") {?>
													<?php if( $row->shot=="1") {?>
														<tr >
															<td class="center"><?php 	echo $g;?></td>
															<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
															<td class="center"><?php 	echo $row->qty;?></td>
															<td class="left"><?php 		echo $row->consignee;?></td>
															<td class="left"><?php 		echo $row->package;?></td>
															<td class="center"><?php 	echo $row->weight;?></td>
															<td class="center"><?php 	echo $row->freight;?></td>
															<td class="center"><?php 	echo $row->weight_charge;?></td>
															<td class="center"><?php 	echo $row->currency;?></td>
															<td class="center">
															<?php if($row->prepaid=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->collect=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->nocharge=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center" style="width:5%">
																<!-- <?php if($row->typeawbl=="import"){?>
																	<a href="javascript:void(0)" class="btn btn-sm btn-primary" disabled>
																		 <i class="fa fa-credit-card" aria-hidden="true"></i>
																	Facturer
																	</a>
																<?php }?> -->
															</td>
														</tr>
													<?php }else{?>
														<tr >
															<td class="center"><?php 	echo $g;?></td>
															<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
															<td class="center"><?php 	echo $row->qty;?></td>
															<td class="left"><?php 		echo $row->consignee;?></td>
															<td class="left"><?php 		echo $row->package;?></td>
															<td class="center"><?php 	echo $row->weight;?></td>
															<td class="center"><?php 	echo $row->freight;?></td>
															<td class="center"><?php 	echo $row->weight_charge;?></td>
															<td class="center"><?php 	echo $row->currency;?></td>
															<td class="center">
															<?php if($row->prepaid=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->collect=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->nocharge=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center" style="width:5%">
																<?php if($row->typeawbl=="import"){?>
																	<a href="<?php echo base_url()?>facture/facturerbill/f/rech/<?php 	echo $row->awbl;?>/<?php 	echo $row->segmentid;?>" class="btn btn-sm btn-primary">
																		 <i class="fa fa-credit-card" aria-hidden="true"></i>
																	Facturer
																	</a>
																<?php }?>
															</td>
														</tr>
													<?php }  ?>
													<?php }  ?>
													<?php if($row->datelivre!="" AND $row->typeawbl=="import") {?>
													<?php if( $row->shot=="1") {?>
														<tr class="danger">
															<td class="center"><?php 	echo $g;?></td>
															<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
															<td class="center"><?php 	echo $row->qty;?></td>
															<td class="left"><?php 		echo $row->consignee;?></td>
															<td class="left"><?php 		echo $row->package;?></td>
															<td class="center"><?php 	echo $row->weight;?></td>
															<td class="center"><?php 	echo $row->freight;?></td>
															<td class="center"><?php 	echo $row->weight_charge;?></td>
															<td class="center"><?php 	echo $row->currency;?></td>
															<td class="center">
															<?php if($row->prepaid=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->collect=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->nocharge=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center" style="width:5%">
																<!-- <?php if($row->typeawbl=="import"){?>
																	<a href="javascript:void(0)" class="btn btn-sm btn-primary" disabled>
																		 <i class="fa fa-credit-card" aria-hidden="true"></i>
																	Facturer
																	</a>
																<?php }?> -->
															</td>
														</tr>
													<?php }else{?>
														<tr class="danger">
															<td class="center"><?php 	echo $g;?></td>
															<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
															<td class="center"><?php 	echo $row->qty;?></td>
															<td class="left"><?php 		echo $row->consignee;?></td>
															<td class="left"><?php 		echo $row->package;?></td>
															<td class="center"><?php 	echo $row->weight;?></td>
															<td class="center"><?php 	echo $row->freight;?></td>
															<td class="center"><?php 	echo $row->weight_charge;?></td>
															<td class="center"><?php 	echo $row->currency;?></td>
															<td class="center">
															<?php if($row->prepaid=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->collect=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->nocharge=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center" style="width:5%">
																<?php if($row->typeawbl=="import"){?>
																	<a href="<?php echo base_url()?>facture/facturerbill/f/rech/<?php 	echo $row->awbl;?>/<?php 	echo $row->segmentid;?>" class="btn btn-sm btn-primary">
																		 <i class="fa fa-credit-card" aria-hidden="true"></i>
																	Facturer
																	</a>
																<?php }?>
															</td>
														</tr>
													<?php }  ?>
													<?php }  ?>
													<!-- <?php if($row->datelivre!="" AND $row->typeawbl=="import") {?>
														<tr class="danger">
															<td class="center"><?php 	echo $g;?></td>
															<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
															<td class="center"><?php 	echo $row->qty;?></td>
															<td class="left"><?php 		echo $row->consignee;?></td>
															<td class="left"><?php 		echo $row->package;?></td>
															<td class="center"><?php 	echo $row->weight;?></td>
															<td class="center"><?php 	echo $row->freight;?></td>
															<td class="center"><?php 	echo $row->weight_charge;?></td>
															<td class="center"><?php 	echo $row->currency;?></td>
															<td class="center">
															<?php if($row->prepaid=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->collect=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->nocharge=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center" style="width:5%">
																<?php if($row->typeawbl=="import"){?>
																	<a href="<?php echo base_url()?>facture/facturerbill/f/rech/<?php 	echo $row->awbl;?>/<?php 	echo $row->segmentid;?>" class="btn btn-sm btn-primary">
																		 <i class="fa fa-credit-card" aria-hidden="true"></i>
																	Facturer
																	</a>
																	<?php }?>

															</td>
														</tr>
													<?php }  ?> -->
													<?php if($row->nolivraison=="OK-export" AND $row->typeawbl=="export") {?>
														<?php if($row->void=="1"){?>
															<tr class="success" style="text-decoration: line-through;">
																	<td class="center"><?php 	echo $g;?></td>
																	<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
																	<td class="center"><?php 	echo $row->qty;?></td>
																	<td class="left"><?php 		echo $row->consignee;?></td>
																	<td class="left"><?php 		echo $row->package;?></td>
																	<td class="center"><?php 	echo $row->weight;?></td>
																	<td class="center"><?php 	echo $row->freight;?></td>
																	<td class="center"><?php 	echo $row->weight_charge;?></td>
																	<td class="center"><?php 	echo $row->currency;?></td>
																	<td class="center">
																	<?php if($row->prepaid=="1"){?>
																	<i class="fa fa-check" aria-hidden="true"></i>
																	<?php }?>
																	</td>
																	<td class="center">
																	<?php if($row->collect=="1"){?>
																	<i class="fa fa-check" aria-hidden="true"></i>
																	<?php }?>
																	</td>
																	<td class="center">
																	<?php if($row->nocharge=="1"){?>
																	<i class="fa fa-check" aria-hidden="true"></i>
																	<?php }?>
																	</td>
																	<td class="center" style="width:5%">
																		<?php if($row->typeawbl=="export"){?>
																			<a href="<?php echo base_url()?>facture/facturerbill_ex/f/rech/<?php 	echo $row->awbl;?>/<?php 	echo $row->segmentid;?>" class="btn btn-sm btn-primary">
																				 <i class="fa fa-credit-card" aria-hidden="true"></i>
																			Facturer
																			</a>
																			<?php }?>

																	</td>
																</tr>
														<?php }else{?>
															<tr class="success">
																<td class="center"><?php 	echo $g;?></td>
																<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
																<td class="center"><?php 	echo $row->qty;?></td>
																<td class="left"><?php 		echo $row->consignee;?></td>
																<td class="left"><?php 		echo $row->package;?></td>
																<td class="center"><?php 	echo $row->weight;?></td>
																<td class="center"><?php 	echo $row->freight;?></td>
																<td class="center"><?php 	echo $row->weight_charge;?></td>
																<td class="center"><?php 	echo $row->currency;?></td>
																<td class="center">
																<?php if($row->prepaid=="1"){?>
																<i class="fa fa-check" aria-hidden="true"></i>
																<?php }?>
																</td>
																<td class="center">
																<?php if($row->collect=="1"){?>
																<i class="fa fa-check" aria-hidden="true"></i>
																<?php }?>
																</td>
																<td class="center">
																<?php if($row->nocharge=="1"){?>
																<i class="fa fa-check" aria-hidden="true"></i>
																<?php }?>
																</td>
																<td class="center" style="width:5%">
																	<?php if($row->typeawbl=="export"){?>
																		<a href="<?php echo base_url()?>facture/facturerbill_ex/f/rech/<?php 	echo $row->awbl;?>/<?php 	echo $row->segmentid;?>" class="btn btn-sm btn-primary">
																			 <i class="fa fa-credit-card" aria-hidden="true"></i>
																		Facturer
																		</a>
																		<?php }?>

																</td>
															</tr>
														<?php }?>

													<?php }  ?>
													<?php if($row->nolivraison=="OK-MESDHASA2" AND $row->typeawbl=="MESDHASA2") {?>
														<tr class="warning">
															<td class="center"><?php 	echo $g;?></td>
															<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
															<td class="center"><?php 	echo $row->qty;?></td>
															<td class="left"><?php 		echo $row->consignee;?></td>
															<td class="left"><?php 		echo $row->package;?></td>
															<td class="center"><?php 	echo $row->weight;?></td>
															<td class="center"><?php 	echo $row->freight;?></td>
															<td class="center"><?php 	echo $row->weight_charge;?></td>
															<td class="center"><?php 	echo $row->currency;?></td>
															<td class="center">
															<?php if($row->prepaid=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->collect=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center">
															<?php if($row->nocharge=="1"){?>
															<i class="fa fa-check" aria-hidden="true"></i>
															<?php }?>
															</td>
															<td class="center" style="width:5%">
																<?php if($row->typeawbl=="MESDHASA2"){?>
																	<a href="<?php echo base_url()?>facture/facturerbill_mesdhasa/f/rech/<?php 	echo $row->awbl;?>/<?php 	echo $row->segmentid;?>" class="btn btn-sm btn-primary">
																		 <i class="fa fa-credit-card" aria-hidden="true"></i>
																	Facturer
																	</a>
																	<?php }?>

															</td>
														</tr>
													<?php }  ?>
												<?php } ?>

										<?php	}?>

											</tbody>
										</table>
								</div>
							</div>

						</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>

<script>
jQuery(function($){
   $("#noawbl").mask("999-99999999");
});
</script>
