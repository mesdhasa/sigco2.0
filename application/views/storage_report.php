<?php
if(isset($_SESSION['droit']['a31']) and $_SESSION['droit']['a31']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
$val = "";
if(isset($_SESSION['sesnumber'])){
	$val = $_SESSION['sesnumber'];
}
foreach($lesdepots as $row){}

?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
						Storage Fees

								</small>

							</h1>

						</div>

					<div class="page-content">

            <div class="row">
              <div class="col-lg-12">
              <?php echo form_open('Rapports/larecherche/storage','class="form-inline"');?>
              <div class="form-group">
              <label class="control-label col-sm-4 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
               <div class="col-sm-3">
                  <input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="date1" value="<?php 	echo $_POST['date1'];?>" />
               </div>
              </div>
              <div class="form-group">
              <label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>au:</strong></label>
              <div class="col-sm-3">
                 <input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Date " name="date2" value="<?php 	echo $_POST['date2'];?>" />
              </div>
              </div>
                <div class="input-group">
                  <input autocomplete="off" type="text" name="awbl" id="awbl" size="20%" class="form-control" placeholder="Recherche" value="<?php 	echo $_POST['awbl'];?>"/>
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
<table id="simple-table" class="table  table-bordered table-hover table-condensed">
										<p></p>
											<thead>
												<tr>
												<th></th>

													<th class="center">Date Arrival</th>
													<th class="center">Airbill N0</th>
													<th class="center">Origin</th>
													<th class="center">Date notication</th>
													<th width="13%"  class="center">Consignee</th>
													<th class="center">Weight (Kg)</th>
													<th class="center">Weight (Lb)</th>
													<th class="center">Code</th>
													<th class="center">Paid Date</th>
													<th class="center">Total Days</th>
													<th class="center">Due Days</th>
													<th class="center">Amt Due</th>
													<th class="center">Amt Paid</th>
													<th class="center"></th>
												</tr>
											</thead>


											<tbody>
												<?php
												$datecomp = $row->droitdepot;
												$datedepot ="";
												$datelivre = "";
												$resul = "";
												$calcul_date = "";
if (($row->droitdepot=='') ){
	redirect('rapports/depot/rapports/droit');

}

												?>
												<?php if(count($lesdepots)>0){
													$g=0;foreach ($lesdepots as $res) {$g++;
													switch(true){

													              case ($res->datenotification !="0000-00-00" && $res->datelivre =="NULL" or $res->datenotification !="" && $res->datelivre ==""):
													              $datedepot = diff_date($res->datenotification,$this->session->ladate);
													              break;

													              case ($res->datenotification !="0000-00-00" && $res->datelivre !="NULL" or $res->datenotification !="" && $res->datelivre !=""):
													              $datedepot = diff_date($res->datenotification,$res->datelivre);
													              break;



													              default:
													              break;
													}
													switch(true){



													              case ($res->datenotification =="0000-00-00" && $res->datelivre !="NULL" or $res->datenotification =="" && $res->datelivre !=""):
													              $datedepot = '0';
													              break;

													              case ($res->datenotification =="0000-00-00" && $res->datelivre =="NULL" or$res->datenotification =="" && $res->datelivre ==""):
													              $datedepot ='0';
													              break;

													              default:
													              break;
													}
													$total_poids = 0;
													$result = $this->Parser->get_degroupage($res->awb);
													if(count($result)>0){
													foreach($result as $r){
													$total_poids += $r->poids;
													}
												}
													$restant=$res->weight* 2.20462-$total_poids;
													?>

												<tr>
												<td><?php echo $g;?></td>

													<td class="center"><?php 	echo dateVersChainetext($res->Date_of_arrival);?></td>
													<td class="center"><?php 	echo $res->awb;?></td>
													<td class="center"><?php 	echo $res->Place_of_departure_code;?></td>
													<td class="center"><?php 	echo dateVersChainetext($res->datenotification);?></td>
													<td class="left"><?php 	echo $res->consignee;?></td>
													<td class="left"><?php 	echo $res->weight;?></td>
													<td class="left"><?php 	echo $restant;?></td>
													<td class="center">

													<?php if($res->prepaid=="1"){
															echo "PX";
													}?>
													<?php if($res->collect=="1"){
																			echo "CP";
																		}?>
													 <?php if($res->nocharge=="1"){
														 	echo "NC";
													 }?>
													</td>
													<td class="center"><?php echo dateVersChainetext($res->date_hc);?></td>
													<?php if ($datedepot > $datecomp){
															$calcul_date=$datedepot-$datecomp;
													$resul = $calcul_date*$row->prix_lbs*$restant;
													if ($resul<10) $resul = 10;
													?>
													<td class="center"><?php echo $datedepot ;?></td>
													<td class="center"><?php echo $calcul_date ;?></td>
													<td class="center"><?php echo round($resul,2) ;?></td>
													<td class="center"><?php echo $res->montant_hc;?></td>
													<td class="center">
                            <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>rapports/droit_depot_awb_pdf/<?php 	echo $res->awb;?>">
                            <i class="ace-icon fa fa-print"></i>
                            Imprimer
                            </a>
													</td>
												<?php }?>
													</tr>
													<?php

												}}?>

											</tbody>
										</table>
										<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>rapports/droit_depot_pdf_total/<?php 	echo $_POST['date1'];?>/<?php 	echo $_POST['date2'];?>">
										<i class="ace-icon fa fa-print"></i>
										Imprimer
										</a>
								</div>
							</div>
						</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
jQuery(function($){
   $("#awbl").mask("999-99999999");
});
</script>
