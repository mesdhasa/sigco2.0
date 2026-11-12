<?php require_once('tete.php');
if(isset($_SESSION['droit']['a4']) and $_SESSION['droit']['a4']=="1"){

}else{
	redirect('home');
}
foreach($lessegments as $row){}
$datesession = $this->session->ladate;
?>

<div class="page-header">
<h1>
<a href="<?php echo $_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
<small><i class="ace-icon fa fa-angle-double-right"></i>Air Way Bill</small></h1>
</div>
<div class="col-lg-7 col-lg-offset-5">
<p style="text-align:right; margin-top:-30px;">
<strong style="font-size:20px; text-align:right;"> <?php echo $row->compagnie?> | <?php echo $row->custum?> | <?php echo $row->refdouane?> | <?php echo dateVersChainetext($row->Date_of_arrival);?> </strong>

</p>
</div>
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

							<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive">
										<table id="simple-table" class="table  table-bordered table-hover table-condensed">
										<p></p>
											<thead>
												<tr>
													<th class="center"></th>
													<th class="center" style="min-width:110px;">Awb No.</th>
													<th class="left">Qty</th>
													<th class="left">Of</th>
													<th class="center">Nature of goods</th>
													<th class="center">Weight (KGS)</th>
													<th class="center">Consignee</th>
													<th class="center">Total freight</th>
													<th class="center">Weight charge</th>
													<th class="center">Currency</th>
													<th class="center">PP</th>
													<th class="center">CC</th>
													<th class="center">NC</th>
													<th class="center">Shot</th>
													<th class="center">Notification</th>
												</tr>
											</thead>
										<?php echo form_open('import/updatebill');?>


											<tbody>
												<?php $g=0;foreach ($lessegments as $row) {$g++;?>
													<?php if($row->typeawbl=="import") {?>

												<tr>
													<td class="center"><?php 	echo $g;?></td>
													<td class="center"><?php 	echo $row->awbl;?></td>

													<input type="hidden" name="lesid[]" value="<?php echo $row->idbuil?>">
													<td class="center">
													<span class="input-group">
														<input autocomplete="off" type="text" size="7%"  class="form-control" id="qty" placeholder="qty" name="qty<?php echo $row->idbuil?>" value="<?php echo $row->qty?>">
														</span>
													</td>
													<td class="center">
													<span class="input-group">
														<input  autocomplete="off" type="text" size="7%" class="form-control" id="qtytotal" placeholder="qtytotal" name="qtytotal<?php echo $row->idbuil?>" value="<?php echo $row->qtytotal?>">
														</span>
													</td>
													<td class="left"><?php 		echo $row->package;?></td>
													<td class="center"><?php 	echo $row->weight;?></td>
													<td class="left">
														<span class="input-group">
														<textarea autocomplete="off" id="consignee" name="consignee<?php echo $row->idbuil?>" class="form-control"><?php echo $row->consignee?></textarea>
														</span>
													</td>

													<?php if($row->prepaid=="1"){?>
														<td class="center">
															<input  autocomplete="off" type="hidden" size="8%"  class="form-control" id="freight" placeholder="freight" name="freight<?php echo $row->idbuil?>" value="<?php echo $row->freight?>">
														</td>
													<?php }else if ($row->nocharge=="1"){?>
														<td class="center">
															<input autocomplete="off" type="hidden" size="8%"  class="form-control" id="freight" placeholder="freight" name="freight<?php echo $row->idbuil?>" value="<?php echo $row->freight?>">
														</td>
													<?php }else {?>
														<td class="center">
														<span class="input-group">
															<input autocomplete="off" type="text" size="8%"  class="form-control" id="freight" placeholder="freight" name="freight<?php echo $row->idbuil?>" value="<?php echo $row->freight?>">
															</span>
														</td>
														<?php }?>
           								<?php if( $row->weight_charge=="0.00"){?>
														<td class="center">
														<span class="input-group">
															<input autocomplete="off" type="text" size="8%"  class="form-control" id="charge" placeholder="weight charge" name="charge<?php echo $row->idbuil?>" value="">
															</span>
															</td>
														<?php }else {?>
															<td class="center">
															<span class="input-group">
																<input autocomplete="off" type="text" size="8%"  class="form-control" id="charge" placeholder="weight charge" name="charge<?php echo $row->idbuil?>" value="<?php echo $row->weight_charge?>">
																</span>
																</td>
															<?php }?>
													<td class="center"><?php 	echo $row->currency;?></td>
													<td class="center">
													<!-- <?php if($row->prepaid=="1"){?>
													<i class="fa fa-check" aria-hidden="true"></i>
													<?php }?> -->
													<input id="<?php echo $row->awbl;?>a" <?php if($row->prepaid=="1") echo "checked=\"checked\"";?> onchange="Clkppcl('<?php echo $row->awbl;?>','b','c')" class="choixcb" type="checkbox">

													</td>
													 <td class="center">
													<!-- <?php if($row->collect=="1"){?>
													<i class="fa fa-check" aria-hidden="true"></i>
													<?php }?> -->
													<input id="<?php echo $row->awbl;?>b" <?php if($row->collect=="1") echo "checked=\"checked\"";?>  onchange="Clkppcl('<?php echo $row->awbl;?>','a','c')" class="choixcb" type="checkbox">

													</td>
													<td class="center">
													<!-- <?php if($row->nocharge=="1"){?>
													<i class="fa fa-check" aria-hidden="true"></i>
													<?php }?> -->
													<input id="<?php echo $row->awbl;?>c" <?php if($row->nocharge=="1") echo "checked=\"checked\"";?>  onchange="Clkppcl('<?php echo $row->awbl;?>','a','b')" class="choixcb" type="checkbox">

													</td>
													<td class="center">
													<input type="checkbox" value="1" id="shot<?php echo $row->idbuil?>" name="shot<?php echo $row->idbuil?>"   <?php if ($row->shot== "1") echo "checked=\"checked\"";?> class="choixcb">

													</td>

													<td class="center">

												<strong>Date: <?php echo dateVersChainetext($row->datenotification)?></strong>

												<?php }?>

												<?php }?>
													</td>


												</tr>
											</tbody>
										</table>
<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>import/manifestxls/<?php echo $idvol;?>">
	<i class="ace-icon fa fa-file-excel-o"></i>
	Exporter vers Excel
</a>
<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>import/manifestpdf/<?php echo $idvol;?>">
	<i class="ace-icon fa fa-file-pdf-o"></i>
	Imprimer
</a>
<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>import/ajouterawbl/i/lister/<?php echo $idvol;?>">
	<i class="ace-icon fa fa-plus"></i>
	Ajouter un AWB
</a>
<span class="form-group">
<input type="hidden" id="idvol" name="idvol" value="<?php echo $idvol;?>" />
  <button type="submit" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-save"></i>
  Sauvegarder
  </button>
  </span>
<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>import/recherchevol/i/lister">
<i class="ace-icon fa fa-close"></i>
Fermer
</a>
										</div>
										<?php echo form_close();?>

									</div><!-- /.span -->
								</div><!-- /.row -->

				<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
