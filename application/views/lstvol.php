<?php require_once('tete.php');
if(isset($_SESSION['droit']['a4']) and $_SESSION['droit']['a4']=="1"){

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
						<?php
						if($this->session->flashdata('sms')){
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong><?php echo $this->session->flashdata('sms');?></strong>
						</div>
						<?php } ?>
						<?php
						if($this->session->flashdata('sms2')){
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong><?php echo $this->session->flashdata('sms2');?></strong>
						</div>
						<?php } ?>
						<div class="row">
							<div class="col-lg-12">
							<?php echo form_open('import/recherchevol/i/lister','class="form-inline"');?>
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
								  <input autocomplete="off" type="text" name="custum" id="custum" size="20%" class="form-control" placeholder="No de vol" value=""/>
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
		<th>Date departure</th>
		<th>Date arrival</th>
		<th>Compagnie</th>
		<th>No de douane</th>
		<th>Flight NO</th>
		<th>Registration number transport</th>
		<th>Point of Loading</th>
		<th>View AWB</th>
		<th>Add AWB</th>
		<th></th>
		<th></th>
      </tr>
    </thead>
    <tbody>

<?php
if(count($lessegments)>0){
$t=0;foreach($lessegments as $row){$t++;?>
	<tr>
        <td><?php echo $t;?></td>
        <td class="center"><?php echo dateVersChainetext($row->Date_of_departure);?></td>
		<td class="center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
		<td><?php echo strtoupper($row->compagnie);?></td>
		<td><?php echo $row->custum;?></td>
		<td><?php echo $row->Voyage_number;?></td>
		<td class="center"><?php echo $row->Registration_number_of_transport_code;?></td>
		<td class="center"><?php echo $row->Place_of_departure_code;?></td>
		<td class="center">
		<a href="<?php echo base_url()?>import/awbl/i/lister/<?php echo $row->id;?>" class="btn btn-xs btn-info" role="button">
		<i class="ace-icon fa fa-eye bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
		<a href="<?php echo base_url()?>import/ajouterawbl/i/lister/<?php echo $row->id;?>" class="btn btn-xs btn-success" role="button">
		<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
		<a href="<?php echo base_url()?>import/editcustum/i/ajouter/<?php echo $row->id;?>" class="btn btn-xs btn-primary" role="button">
		<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
		</a>
		</td>
		<td class="center">
			<a class="btn btn-xs btn-danger" href="#" onclick="confirmation_lien('Do you want to delete ?','<?php echo base_url()?>import/deletecustum/i/ajouter/<?php echo $row->id;?>')">
		<i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
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
