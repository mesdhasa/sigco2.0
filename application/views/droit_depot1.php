<?php
if(isset($_SESSION['droit']['a31']) and $_SESSION['droit']['a31']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
								Droit Depot

								</small>

							</h1>

						</div>

					<div class="page-content">


            <div class="row">
              <div class="col-lg-12">
              <?php echo form_open('Rapports/larecherche/droit','class="form-inline"');?>
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
                  <input autocomplete="off" type="text" name="awbl" id="awbl" size="20%" class="form-control" placeholder="Recherche" value=""/>
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
