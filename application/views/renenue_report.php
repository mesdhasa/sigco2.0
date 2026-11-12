<?php
if(isset($_SESSION['droit']['a32']) and $_SESSION['droit']['a32']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
Revenue Report
								</small>

							</h1>

						</div>

					<div class="page-content">


            <div class="row">
              <div class="col-lg-12">
              <?php echo form_open('Rapports/rec_revenue_report/revenue','class="form-inline"');?>
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
                  <!-- <input autocomplete="off" type="text" name="awbl" id="awbl" size="20%" class="form-control" placeholder="Recherche" value=""/> -->
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
													<th class="center">Date</th>
													<th class="center">Airbill N0</th>
													<th class="center">Origin</th>
													<th class="center">Dest</th>
													<th class="center">Consignee</th>
													<th class="center">Weight Charges</th>
													<th class="center">Charges Due agent</th>
													<th class="center">Charges Due Carrier</th>
													<th class="center">TOTAL Dollars</th>
													<th class="center"></th>
												</tr>
											</thead>
											<?php
											if(count($lesrevenue)>0){
												$g=0;foreach ($lesrevenue as $res) {$g++;
										?>
<tbody>


  <td class="center"><?php 	echo dateVersChainetext($res->Date_of_arrival);?></td>
  <td class="center"><?php 	echo $res->awbl;?></td>
  <td class="center"><?php 	echo $res->Place_of_departure_code;?></td>
  <td class="center"><?php 	echo $res->Place_of_destination_code;?></td>
  <td class="center"><?php 	echo $res->consignee;?></td>
  <td class="center"><?php 	echo $res->weight_charge;?></td>
  <td class="center"></td>
  <td class="center"></td>
  <td class="center"><?php 	echo $res->freight;?></td>
  <td class="center"></td>
<?php }} if(count($lesrevenue)>0){
?>

</tbody>


<a class="btn btn-sm btn-success" target="_blank" style=" margin-bottom: 10px;" href="<?php echo base_url()?>rapports/revenue_report_pdf_total/<?php 	echo $_POST['date1'];?>/<?php 	echo $_POST['date2']?>">
<i class="ace-icon fa fa-print"></i>
Imprimer
</a>
<?php }?>
										</table>

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
