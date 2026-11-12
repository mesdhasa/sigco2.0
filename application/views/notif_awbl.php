<?php require_once('tete.php');
if(isset($_SESSION['droit']['a3']) and $_SESSION['droit']['a3']=="1"){
$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));

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
													<th class="center">Date of arrival</th>
													<th class="center">Compagnie</th>
													<th class="center" style="min-width:110px;">AWB No.</th>
													<th class="center">Qty</th>
													<th class="center">Weight (KGS)</th>
													<th class="center">Consignee</th>
													<th class="center">Total freight</th>
													<th class="center">Notification</th>
													<th class="center">Notified person</th>
													<th class="center">Memo</th>
												</tr>
											</thead>
										<?php echo form_open('import/set_notification3');?>


											<tbody>
												<?php $g=0;foreach ($lessegments as $row) {$g++;?>
													<?php if($row->typeawbl=="import") {?>

												<tr>
													<td class="center"><?php 	echo $g;?></td>
													<td class="center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
													<td class="center"><?php echo strtoupper($row->Carrier_name);?></td>
													<?php if($row->indice=="NULL"){?>
														<td class="center"><?php 	echo $row->awbl;?></td>
														<?php }?>
													<td class="center"><?php 	echo $row->indice;?><?php 	echo $row->awbl;?></td>
													<input type="hidden" name="lesid" value="<?php echo $row->idbuil?>">
													<td class="center"><?php 	echo $row->qty;?></td>
													<td class="center"><?php 	echo $row->weight;?></td>
													<td class="left"><?php 		echo $row->consignee;?></td>
														<?php if($row->prepaid=="1"){?>
															<td class="center">
															</td>
														<?php }else if ($row->nocharge=="1"){?>
															<td class="center">
															</td>
														<?php }else {?>
															<td class="left"><?php 		echo $row->freight;?></td>
															<?php }?>


												<?php if( $row->datenotification =="0000-00-00"){?>
													<td class="center">
												<!-- <input type="checkbox" value="1" id="datem<?php echo $row->idbuil?>" name="datem<?php echo $row->idbuil?>" <?php if (validateDate($row->datenotification)== true) echo "checked=\"checked\"";?> class="choixcb"> -->
												<!-- <strong>Date: <?php echo dateVersChainetext($row->datenotification)?></strong> -->
												<input type="text" name="datenotification"  id="b11<?php echo $g;?>" autocomplete="off" />
												<input type="hidden" name="timenotif" value="<?php echo $date->format('h:i:s A')?>" />
               					</td>
													<?php }else {?>
														<td class="center">
													<!-- <input type="checkbox" value="1" id="datem<?php echo $row->idbuil?>" name="datem<?php echo $row->idbuil?>" <?php if (validateDate($row->datenotification)== true) echo "checked=\"checked\"";?> class="choixcb"> -->
													<strong>Date: <?php echo dateVersChainetext($row->datenotification)?>/<?php echo $row->heure_notication?></strong>
													<input type="hidden" name="datenotification"  id="b11<?php echo $g;?>" value="<?php echo dateVersChaine($row->datenotification)?>" />
													<input type="hidden" name="timenotif" value="<?php echo $row->heure_notication?>" />
													</td>
														<?php }?>
												<td class="center">
													<input type="text" size="12%"  class="form-control" id="person_notif" placeholder="Notified person" name="person_notif" value="<?php echo $row->person_notif?>">
												</td>
												<td class="center">
<a class="various" data-fancybox-type="iframe" href="<?php echo base_url()?>import/Set_memo/<?php echo $row->idbuil?>"><i class="fa fa-comment fa-2x" aria-hidden="true"></i></a>

												</td>
												</tr>
											<?php }?>
													<?php }?>
											</tbody>
										</table>


<span class="form-group">
	<input type="hidden" id="idvol" name="idvol" value="<?php echo $idvol;?>" />
<input type="hidden" id="awb_num" name="awb_num" value="<?php echo $row->awbl;?>" />
  <button type="submit" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-save"></i>
  Sauvegarder
  </button>
  </span>
<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>import/precol/i/precol">
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
