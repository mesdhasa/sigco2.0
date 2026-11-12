<?php
if(isset($_SESSION['droit']['a13']) and $_SESSION['droit']['a13']=="1"  ) {
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

					<div class="row">
							<div class="col-lg-4 col-lg-push-4">
							<?php echo form_open('Recherche/larecherche/recherche','class="form-inline"');?>

								<div class="input-group">
								  <input autocomplete="off" type="text" name="custum" id="custum" size="30%" class="form-control" placeholder="Recherche" value="" required />
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
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								TAG
<!-- <span class="label label-default">Default</span> -->
<!-- <span class="label label-primary">Primary</span> -->
<!-- <span class="badge badge-secondary">Secondary</span> -->
<span class="badge badge-success">Export</span>
<!-- <span class="label label-danger">Deliver</span> -->
<!-- <span class="badge badge-warning">Warning</span> -->
<!-- <span class="badge badge-info">Info</span> -->
<span class="badge badge-light">Import</span>
<!-- <span class="badge badge-dark">Dark</span> -->

							<div class="table-responsive"><br>
<table id="simple-table" class="table  table-bordered table-hover table-condensed">
											<thead>
												<tr>
													<th class="center"></th>
													<th class="center">AWB No.</th>
													<th class="center">Qty</th>
													<th class="center">Package</th>
													<th class="center">Consignee</th>
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


											<tbody>
												<?php $r=0; foreach($lessegments as $row){$r++;?>
													<?php if( $row->nolivraison=="OK-export" AND $row->typeawbl=="export") {?>

												<tr class="success">
													<td class="center"><?php echo $r;?></td>
													<td class="center"><?php echo $row->awbl;?></td>
													<td class="center"><?php echo $row->qty;?></td>
													<td class="left"><?php echo $row->package;?></td>
													<td class="left"><?php echo $row->consignee;?></td>
													<td class="center"><?php echo $row->weight;?></td>
													<td class="center"><?php echo $row->freight;?></td>
													<td class="center"><?php echo $row->weight_charge;?></td>
													<td class="center"><?php echo $row->currency;?></td>
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
													<td class="center">
													<a href="<?php echo base_url()?>Recherche/detail_ex/recherche/<?php 	echo $row->awbl.'/'.$row->segmentid;?>" class="btn btn-xs btn-primary" role="button">
													<i class="ace-icon fa fa-asterisk bigger-120" aria-hidden="false"></i>
													Details
													</a>
													</td>												</tr>
												<?php }?>
												<?php if($row->typeawbl=="import") {?>

											<tr>
												<td class="center"><?php echo $r;?></td>
												<td class="center"><?php echo $row->awbl;?></td>
												<td class="center"><?php echo $row->qty;?></td>
												<td class="left"><?php echo $row->package;?></td>
												<td class="left"><?php echo $row->consignee;?></td>
												<td class="center"><?php echo $row->weight;?></td>
												<td class="center"><?php echo $row->freight;?></td>
												<td class="center"><?php echo $row->weight_charge;?></td>
												<td class="center"><?php echo $row->currency;?></td>
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
												<td class="center">
												<a href="<?php echo base_url()?>Recherche/detail/recherche/<?php 	echo $row->awbl.'/'.$row->segmentid;?>" class="btn btn-xs btn-primary" role="button">
												<i class="ace-icon fa fa-asterisk bigger-120" aria-hidden="false"></i>
												Details
												</a>
												</td>												</tr>
											<?php }?>
											<?php }  ?>

											</tbody>
										</table>
								</div>
							</div>
						</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
