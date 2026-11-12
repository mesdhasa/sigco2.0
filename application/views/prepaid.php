<?php require_once('tete.php');
if(isset($_SESSION['droit']['a3']) and $_SESSION['droit']['a3']=="1"){

}else{
	redirect('home');
}
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Rechercher un vol

								</small>

							</h1>

						</div>

					<div class="page-content">

						<div class="row">
							<div class="col-lg-4 col-lg-push-2">
							<?php echo form_open('import/precol/i/precol','class="form-inline"');?>

								<div class="input-group">
								  <input autocomplete="off" type="text" name="custum" id="custum" size="30%" class="form-control" placeholder="No de vol" value="" required />
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
								<div class="col-lg-4 col-lg-push-2">
									<?php echo form_open('import/recherche_notification1','class="form-inline"');?>

										<div class="input-group">
										  <input autocomplete="off" type="text" name="noawbl" id="noawbl" size="20%" class="form-control" placeholder="NO AWB" value="" required />
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
		<!-- <th>Date Created</th> -->
		<th>Date</th>
		<th>Customs number</th>
		<th>Flight NO</th>
		<th>Registration number transport</th>
		<th>Point of Loading</th>
		<th>Point of Unloading</th>
		<th>View AWB</th>
      </tr>
    </thead>
    <tbody>

<?php
if(count($lessegments)>0){
$t=0;foreach($lessegments as $row){$t++;?>
	<tr>
        <td><?php echo $t;?></td>
        <!-- <td class="center"><?php echo dateVersChainetext($row->datecreated);?></td> -->
		<td class="center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
		<td><?php echo $row->custum;?></td>
		<td class="center"><?php echo $row->Voyage_number;?></td>
		<td class="center"><?php echo $row->Registration_number_of_transport_code;?></td>
		<td class="center"><?php echo $row->Place_of_departure_code;?></td>
		<td class="center"><?php echo $row->Place_of_destination_code;?></td>
		<td class="center">
		<a href="<?php echo base_url()?>import/prepaidcollect/i/precol/<?php echo $row->id;?>" class="btn btn-xs btn-info" role="button">
		<i class="ace-icon fa fa-eye bigger-120" aria-hidden="false"></i>
		</a>
		</td>
      </tr>
<?php }}?>
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
