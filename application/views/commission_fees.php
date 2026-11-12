<?php

if(isset($_SESSION['droit']['a17']) and $_SESSION['droit']['a17']=="1"  ) {
}else{
	redirect('home');

}
require_once('tete.php'); ?>
<div class="page-content">
	<?php
	if($this->session->flashdata('sms')){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('sms');?></strong>
	</div>
	<?php } ?>

		<div class="row">
			<div class="col-lg-12">
			<?php echo form_open('rapports/commission_fees_search2/rapports/fees','class="form-inline"');?>

			<div class="form-group">
			<label class="control-label col-sm-6 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
			 <div class="col-sm-1  col-lg-pull-3">
					<input autocomplete="off" type="text" class="form-control" size="15%" id="datecustum" placeholder="Date " name="date1" value="<?php echo $_POST['date1']; ?>" required/>
			 </div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-1 col-lg-pull-2" for="date2"><strong>au:</strong></label>
			<div class="col-sm-1 col-lg-pull-1">
				 <input autocomplete="off" type="text" class="form-control" size="15%" id="datecustum2" placeholder="Date " name="date2" value="<?php echo $_POST['date2']; ?>"  required/>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-1 col-lg-pull-4"><strong>Amount:</strong></label>
			<div class="col-sm-1 col-sm-pull-1">
				<input autocomplete="off" type="text" name="custum" id="custum" size="7%" class="form-control" placeholder="Amount" value="<?php echo $_POST['custum'];?>"  />
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-1 col-lg-pull-6"><strong>G/L:</strong></label>
			<div class="col-sm-1 col-sm-pull-5">
				<input autocomplete="off" type="text" name="custum2" id="custum2" size="10%" class="form-control" placeholder="G/L #" value="<?php echo $_POST['custum2'];?>"  />
			</div>
			</div>
			<div class="form-group" style="margin-top: -57px; margin-left: 720px;">
			<label class="control-label col-sm-1 col-lg-pull-0" ><strong>VOUCHER:</strong></label>
			<div class="col-sm-1 col-sm-push-3">
				<input autocomplete="off" type="text" name="custum3" id="custum3" size="10%" class="form-control" placeholder="VOUCHER #" value="<?php echo $_POST['custum2'];?>"  />
			</div>
			</div>
				<div class="input-group" style="margin-top: -57px;margin-left: -25px;">
					<!-- <input autocomplete="off" type="text" name="custum" id="custum" size="20%" class="form-control" placeholder="No de vol" value=""/> -->
					<span class="input-group-btn">
						<!-- <select class="form-control" name="type" req59uired>
					 <option value="">---- Type ----</option>
					 <option value="import" <?php if(isset($_POST['type']) and $_POST['type']=='import') 		echo " selected"?>>Inbound</option>
				 </select>  -->
				 <input type="hidden" name="type" value="import">
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
	<div class="col-lg-12 col-md-6 col-sm-12">
		<?php  if ($_POST['type']=='import') {?>
			<h3>COMMISSION (Handling FEES) (Inbound)</h3>
<form action="<?php echo base_url();?>rapports/savecheck" method="post" target="_blank">

		<div class="table-responsive">
<table class="table table-striped">

    <thead>
      <tr>
				<th></th>
        <th></th>
				<th class="text-center">Date</th>
				<th class="text-center">Flight #</th>
				 <th class="text-center">Company</th>
				 <th class="text-center">Aircraft</th>
				<?php if($_POST['custum']=="" AND $_POST['custum2']=="" AND $_POST['custum3']==""){
					$b=1;
					$c=1;
					$d=1;
				}else {
					$b=$_POST['custum'];
					$c=$_POST['custum2'];
					$d=$_POST['custum3'];
				} ?>
		<th class="text-center">Amount (<?php  echo $b; ?>)</th>

      </tr>
    </thead>
    <tbody>
				<?php $t=0;foreach($lessegments as $row){$t++;
$a=trim($b);
					?>

				      <tr>
				        <td><?php echo $t;?></td>
								<td><input type="checkbox" name="choice[]" value="<?php echo $row->id;?>"  class="choixcb"  ></td>
						<td class="text-center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
						<td class="text-center"><?php echo $row->Voyage_number;?></td>
						<td class="text-center"><?php echo $row->compagnie;?></td>
								<td class="text-center"><?php echo $row->Registration_number_of_transport_code;?></td>
								<td width="9%">$<?php  echo round($a,2); ?></td>

				      </tr>



						<?php } ?>


    </tbody>
  </table>
</div>
<?php } ?>

<?php  if (!empty($lessegments) and $_POST['type']=='import') {?>
	<!-- <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>rapports/commission_handling_pdf1">
		<i class="ace-icon fa fa-file-pdf-o"></i>
COMMISSION (Handling FEES) (Inbound)</a> -->

							<input type="hidden" name="date1" id="date1" value="<?php echo chaineVersDate($_POST['date1']); ?>" />
							<input type="hidden" name="date2" id="date2" value="<?php echo chaineVersDate($_POST['date2']); ?>" />
							<input type="hidden" name="amount" id="amount" value="<?php echo $_POST['custum'];?>" />
							<input type="hidden" name="gl" id="gl" value="<?php echo $_POST['custum2'];?>" />
							<input type="hidden" name="voucher" id="voucher" value="<?php echo $_POST['custum3'];?>" />
							<button type="submit"  target="_blank" class="btn btn-primary">
								<i class="ace-icon fa fa-file-pdf-o"></i>
						COMMISSION (Handling FEES) (Inbound)
							</button>
</form>
<?php }  ?>
	</div>

	</div>
<?php require_once('pied.php');?>
