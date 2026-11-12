<?php require_once('tete.php');
if(isset($_SESSION['droit']['a2']) and $_SESSION['droit']['a2']=="1"  ) {
}if(isset($_SESSION['droit']['a4']) and $_SESSION['droit']['a4']=="1"  ) {


}else{
	redirect('home');
}

foreach($lesegment as $rs){}
?>

<div class="page-header">

							<h1>
 <a href="<?php echo $_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Modifier un vol

								</small>

							</h1>

						</div>

	<div class="page-content">
	<div class="row">

	<?php echo form_open('import/updatecustum','class="form-horizontal"');?>

	<div class="col-lg-3 col-md-6 col-xs-12">


	<div class="form-group">
      <label for="date">Date:</label>
      <input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date" name="Date_of_arrival" value="<?php echo dateVersChaine($rs->Date_of_arrival)?>"  required/>

    </div>

    <div class="form-group">
      <label for="compagnie">Compagnie:</label>
      <select class="form-control" name="compagnie" required>
		<option value="">---- Compagnie ----</option>

		<?php foreach($compagnie as $row){?>
		<option value="<?php echo $row->idcompagnie?>" <?php if($rs->idcompagnie==$row->idcompagnie) echo " selected"?>><?php echo strtoupper($row->compagnie);?></option>
		<?php }?>
</select>
    </div>

	<div class="form-group">
      <label for="nodouane">No de douane:</label>
        <input autocomplete="off" type="text" class="form-control" id="nodouane" placeholder="No de douane" name="custum" value="<?php echo $rs->custum?>" required />
    </div>
		<div class="form-group">
	      <label for="refdouane">Référence douane:</label>
	        <input autocomplete="off" type="text" class="form-control" id="refdouane" placeholder="Référence douane" name="refdouane" value="<?php echo $rs->refdouane?>" required />
	    </div>

	<div class="form-group">
      <label for="novol">No vol:</label>
      <input autocomplete="off" type="text" class="form-control" id="novol" placeholder="No vol" name="Voyage_number" value="<?php echo $rs->Voyage_number?>" required />
    </div>

	<div class="form-group">
      <label for="rnt">Registration number transport:</label>
      <input autocomplete="off" type="text" class="form-control" id="rnt" name="Registration_number_of_transport_code" value="<?php echo $rs->Registration_number_of_transport_code?>" required />
    </div>

	<div class="form-group">
      <label for="pol">Point of Loading:</label>
      <input autocomplete="off" type="text" class="form-control" id="pol" name="Place_of_departure_code" value="<?php echo $rs->Place_of_departure_code?>" />
    </div>

	<div class="form-group">
      <label for="pou">Point of Unloading:</label>
      <input autocomplete="off" type="text" class="form-control" id="pou"  name="Place_of_destination_code" value="<?php echo $rs->Place_of_destination_code?>" />
     </div>

	</div>
	<div class="col-lg-3 col-md-6 col-xs-12">

	</div>

	<div class="col-lg-12 col-md-12 col-xs-12">
	    <div class="form-group">
		<input type="hidden" id="id" name="id" value="<?php echo $rs->id?>" />
		<button class="btn btn-sm btn-primary" type="submit">
		   <i class="ace-icon fa fa-save"></i>
				Sauvegarder
		</button>
		<a class="btn btn-sm btn-primary" href="<?php echo base_url();?>import/recherchevol/i/lister">
		   <i class="ace-icon fa fa-close"></i>
				Fermer
		</a>
    </div>
	</div>

	<?php echo form_close();?>

	</div>
	</div>
<?php require_once('pied.php');?>
