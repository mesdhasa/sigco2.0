<?php
if(isset($_SESSION['droit']['a8']) and $_SESSION['droit']['a8']=="1"  ) {

}else{
	redirect('home/pas_access');
}
?>
<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
										Recherche un manifeste

								</small>

							</h1>

						</div>

					<div class="page-content">

						<div class="row">
							<div class="col-lg-12">
							<?php echo form_open('export/export/rech_manifeste','class="form-inline"');?>
							<div class="form-group">
							<label class="control-label col-sm-4 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
							 <div class="col-sm-3">
									<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="date1" value="" />
							 </div>
							</div>
							<div class="form-group">
							<label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>au:</strong></label>
							<div class="col-sm-3">
								 <input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Date " name="date2" value="" />
							</div>
							</div>
								<div class="input-group">
								  <input autocomplete="off" type="text" name="custum" id="custum" size="20%" class="form-control" placeholder="" value=""/>
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
												<th>View AWB</th>
				            		<th></th>
				                  </tr>
                    </thead>
                    <tbody>
											<?php
											if(count($lesmanifeste)>0){
											$t=0;foreach($lesmanifeste as $row){$t++;?>
                	<tr>
                		<td class="center"><?php echo $t;?></td>
                		<td class="center"><?php echo dateVersChainetext($row->date);?></td>
										<td class="center"><?php echo strtoupper($row->compagnie);?></td>
										<td class="center"><?php echo $row->air_craft;?></td>
										<td class="center"><?php echo $row->flight;?></td>
										<td class="center"><?php echo $row->country_loading;?></td>
										<td class="center"><?php echo $row->country_unloading;?></td>
										<?php if ($row->vol_fermer=="0") {?>
										<td class="center">
										<a href="<?php echo base_url()?>lister_awb/<?php echo $row->idcompagnie;?>/<?php echo $row->id_manifeste;?>" class="btn btn-xs btn-danger" role="button">
										<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false"></i>
										</a>
										</td>
									<?php }else{?>
										<td class="center">
										<a href="javascript:void(0)" class="btn btn-xs btn-danger" role="button" disabled>
										<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false"></i>
										</a>
										</td>
									<?php } ?>
										<td class="center">
										<a href="<?php echo base_url()?>lister_awb_vol/<?php echo $row->idcompagnie;?>/<?php echo $row->id_manifeste;?>" class="btn btn-xs btn-info" role="button">
										<i class="ace-icon fa fa-eye bigger-120" aria-hidden="false"></i>
										</a>
										</td>
											<?php if ($row->vol_fermer=="0") {?>
										<td class="center">
										<a href="<?php echo base_url()?>modifier_un_manifeste/<?php echo $row->id_manifeste;?>" class="btn btn-xs btn-primary" role="button">
										<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
										</a>
										</td>
									<?php }else{?>
										<td class="center">
										<a href="javascript:void(0)" class="btn btn-xs btn-danger" role="button" disabled>
											<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
										</a>
										</td>
									<?php } ?>
                      </tr>
										<?php }}?>

                    </tbody>
                  </table>
								</div>
							</div>
						</div>


					</div><!-- /.page-content -->
