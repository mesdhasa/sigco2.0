<?php
$b=" "; 

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
			<?php echo form_open('rapports/commission_weight_search2/rapports/comm','class="form-inline"');?>
			<div class="form-group">
			<label class="control-label col-sm-4 col-lg-pull-0" for="date1"><strong>Date du:</strong></label>
			 <div class="col-sm-3">
					<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date " name="date1" value="<?php echo $_POST['date1']; ?>" />
			 </div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>au:</strong></label>
			<div class="col-sm-3">
				 <input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Date " name="date2" value="<?php echo $_POST['date2']; ?>" />
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-2 col-lg-pull-0" for="date2"><strong>Percentage:</strong></label>
			<div class="col-sm-4 col-sm-push-3">
				<input autocomplete="off" type="text" name="custum" id="custum" size="7%" class="form-control" placeholder="Percentage" value="<?php echo $_POST['custum'];?>"  />
			</div>
			</div>
				<div class="input-group">
					<!-- <input autocomplete="off" type="text" name="custum" id="custum" size="20%" class="form-control" placeholder="No de vol" value=""/> -->
					<span class="input-group-btn">
						<select class="form-control" name="type" required>
					 <option value="">---- Type ----</option>
					 <option value="import" <?php if(isset($_POST['type']) and $_POST['type']=='import') 		echo " selected"?>>Inbound</option>
					 <option value="export" <?php if(isset($_POST['type']) and $_POST['type']=="export") 		echo " selected"?>>Outbound</option>
					 </select>
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
			<h3>COMMISSION ON WEIGHT CHARGES (Inbound)</h3>

		<div class="table-responsive">
<table class="table table-striped">

    <thead>
      <tr>
        <th></th>
				 <th class="text-center">Date</th>
        <th class="text-center">AWB #</th>
				<th class="text-center">Wt/Ch</th>
				<?php if($_POST['custum']==""){
					$b=1;
				}else {
					$b=$_POST['custum'];
				} ?>
		<th class="text-center"><?php  echo $b; ?>%</th>
    <th class="text-center">REMARKS</th>

      </tr>
    </thead>
    <tbody>
				<?php $t=0;foreach($lessegments as $row){$t++;
$a=($row->weight_charge*trim($b))/100;
					?>
				      <tr>
				        <td><?php echo $t;?></td>
						<td class="text-center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
								<td class="text-center"><?php echo $row->awbl;?></td>
				        <td class="text-center">$<?php echo $row->weight_charge;?></td>
								<td width="9%">$<?php  echo round($a,2); ?></td>
								<td width="9%"><?php echo $row->remarque2;?></td>

				      </tr>
						<?php } ?>


    </tbody>
  </table>
</div>
<?php } ?>
<?php  if ($_POST['type']=='export') {?>

	<h3>COMMISSION ON WEIGHT CHARGES (Outbound)</h3>

<div class="table-responsive">
<table class="table table-striped">

<thead>
      <tr>
        <th></th>
				 <th class="text-center">Date</th>
        <th class="text-center">AWB #</th>
				<th class="text-center">Wt/Ch</th>
				<?php if($_POST['custum']==""){
					$b=1;
				}else {
					$b=$_POST['custum'];
				} ?>
		<th class="text-center"><?php  echo $b; ?>%</th>
    <th class="text-center">REMARKS</th>

      </tr>
    </thead>

<tbody>
				<?php $t=0;foreach($lessegments as $row){$t++;

				

					?>
								<?php if($row->void=="1"){?>
						<?php }else{

						
if ($row->gross_weight > round($row->totalvolum)){
  $weight=$row->rate_Charge*$row->gross_weight;
 } 
 if ($row->gross_weight < round($row->totalvolum)){
	$weight=$row->rate_Charge*$row->totalvolum;
   } 
   $a=($weight*trim($b))/100;
							?>
				      <tr>
				        <td><?php echo $t;?></td>
						<td class="text-center"><?php echo dateVersChainetext($row->date);?></td>
								<td class="text-center"><?php echo $row->awb_number;?></td>
				        <td class="text-center">$<?php echo round($weight,2);?></td>
								<td width="9%">$<?php  echo round($a,2); ?></td>
								<td width="9%"><?php echo $row->remarque2;?></td>

				      </tr>
						<?php }} ?>


    </tbody>
</table>
</div>
<?php } ?>
<?php  if (!empty($lessegments) and $_POST['type']=='import') {?>
	<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>rapports/commission_weight_search_pdf1/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>/<?php  echo $b; ?>">
		<i class="ace-icon fa fa-file-pdf-o"></i>
COMMISSION ON WEIGHT CHARGES (Inbound)</a>
<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>rapports/commission_weight_search_excel/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>/<?php  echo $b; ?>">
		<i class="ace-icon fa fa-file-excel-o"></i>
COMMISSION ON WEIGHT CHARGES (Inbound)</a>
	<?php }  ?>
	<?php  if (!empty($lessegments) and $_POST['type']=='export') {?>

		<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>rapports/commission_weight_search_pdf2/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>/<?php  echo $b; ?>">
			<i class="ace-icon fa fa-file-pdf-o"></i>
		COMMISSION ON WEIGHT CHARGES (Outbound)
		</a>
		<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>rapports/commission_weight_search_excel2/<?php echo chaineVersDate($_POST['date1']);?>/<?php echo chaineVersDate($_POST['date2']);?>/<?php  echo $b; ?>">
		<i class="ace-icon fa fa-file-excel-o"></i>
		COMMISSION ON WEIGHT CHARGES (Outbound)
		</a>
		<?php }  ?>

		
	
	</div>

	</div>
<?php require_once('pied.php');?>
