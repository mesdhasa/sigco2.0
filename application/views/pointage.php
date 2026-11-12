<?php require_once('tete.php');
if(isset($_SESSION['droit']['a5']) and $_SESSION['droit']['a5']=="1"  ) {
}else{
	redirect('home');
}
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Pointage

								</small>

							</h1>

						</div>

					<div class="page-content">
					<?php
if($this->session->flashdata('sms')){
	?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>

<?php }
?>
						<div class="row">
							<div class="col-lg-6 col-lg-push-3">
							<?php echo form_open('import/add_pointage','class="form-inline"');?>

								<div class="input-group">

								  <input autocomplete="off" type="text" name="qty" id="qty" size="10%" class="form-control" placeholder="Qty" value="" required />
								  <span class="input-group-btn">
										<input autocomplete="off" type="text" name="ofqty" id="ofqty" size="10%" class="form-control" placeholder="Of Qty" value="" required />
										<span class="input-group-btn">
								  <input autocomplete="off" type="text" name="custum" id="custum" size="25%" class="form-control" placeholder="AWB" value="" required />

									<button class="btn btn-sm btn-primary" type="submit">
													   <i class="ace-icon fa fa-search"></i>
													Ajouter
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
		<th>Qty</th>
		<th>Of Qty</th>
		<th>AWB</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
<?php $t=0;foreach($lessegments as $row){$t++;?>
	<tr>
        <td><?php echo $t;?></td>
		<td class="center"><?php echo dateVersChainetext($row->pointerle);?></td>
		<td><?php echo $row->qty;?></td>
		<td><?php echo $row->of_qty;?></td>
		<td><?php echo $row->awbl;?></td>
		<td style="width:5px">
		<a href="#" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>import/deletepointage/<?php echo $row->id;?>')" class="btn btn-xs btn-danger" role="button">
		<i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
		</a>
		</td>
      </tr>
<?php }?>
    </tbody>
  </table>
								</div>
							</div>
						</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
