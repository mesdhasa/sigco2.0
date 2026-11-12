<?php
if(isset($_SESSION['droit']['a7']) and $_SESSION['droit']['a7']=="1"  ) {
}if(isset($_SESSION['droit']['a8']) and $_SESSION['droit']['a8']=="1"  ) {

}else{
	redirect('home/pas_access');
}
foreach($lemanifeste as $rs){}
?>




<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
CARGO MANIFEST
</small>

    </h1>
  </div>

	<div class="page-content">




	<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">

                <form class="form-horizontal" id="fr_manifeste_edit" autocomplete="off" action="<?php echo base_url()?>export/export/edit_manifeste" method="POST">
                  <div class="form-group">
                      <label class="control-label col-sm-3" for="compagnie"><strong>Transporter Name</strong></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="compagnie">
                        <option value="">---- Compagnie ----</option>
                        <?php foreach($compagnie as $row){?>
                    		<option value="<?php echo $row->idcompagnie?>" <?php if($rs->idcompagnie==$row->idcompagnie) echo " selected"?>><?php echo strtoupper($row->compagnie);?></option>
                    		<?php }?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="air_craft"><strong>Air craft #:</strong></label>
                      <div class="col-sm-9">
                  <input type="text" class="form-control" id="air_craft" placeholder="Air craft #" name="air_craft" value="<?php echo $rs->air_craft?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="flight"><strong>Flight:</strong></label>
                      <div class="col-sm-9">
                        <textarea name="flight" id="flight" placeholder="Flight" class="form-control"><?php echo $rs->flight?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                   <label class="control-label col-sm-3" for="dateflt"><strong>Date:</strong></label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="datecustum" placeholder="Date Flight" name="dateflt" value="<?php echo dateVersChaine($rs->date)?>"  />
                     </div>
                   </div>
                <div class="form-group">
                      <label class="control-label col-sm-3" for="country_loading"><strong>Country Loading:</strong></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="country_loading" placeholder="PAP" name="country_loading" value="PAP"disabled>
                      </div>
                    </div>
                	<div class="form-group">
                      <label class="control-label col-sm-3" for="country_unloading"><strong>Country Unloading:</strong></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="country_unloading" placeholder="Country Unloading" name="country_unloading" value="<?php echo $rs->country_unloading?>">
                      </div>
                    </div>
                    <div class="form-group">

                        	<input type="hidden" id="id" name="id" value="<?php echo $rs->id_manifeste?>" />
                        	  <button type="submit" id="btn_manifeste_edit" class="btn btn-sm btn-primary">
                        	  <i class="ace-icon fa fa-save"></i>
                        	  Modifier
                        	  </button>
                        	<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>manifeste">
                        	<i class="ace-icon fa fa-close"></i>
                        	Fermer
                        	</a>
                      </div>
                  </form>
              </div>

		</div>

		</div><!-- /.page-content -->
		<script>
		$(function()
		{
			$('#btn_fr_manifeste_edit').on('click',function()
		 {

			 $(this).html('Please wait ...').attr('disabled','disabled');
			 $('#fr_manifeste_edit').submit();

		 });


		});
		</script>
