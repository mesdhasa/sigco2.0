<?php
if(isset($_SESSION['droit']['a7']) and $_SESSION['droit']['a7']=="1"  ) {
}else{
	redirect('home/pas_access');
}
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


    <?php
    if($this->session->flashdata('sms_add_manifeste2')){
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong><?php echo $this->session->flashdata('sms_add_manifeste2');?></strong>
    </div>
    <?php } ?>

	<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">

                <form autocomplete="off" id="fr_manifeste"class="form-horizontal" action="<?php echo base_url()?>export/export/add_manifeste" method="POST">
                	<div class="form-group">
                      <label class="control-label col-sm-3" for="compagnie"><strong>Carrier</strong></label>
                      <div class="col-sm-9">
                        <select  required class="form-control" name="compagnie" id="compagnie" onchange="return showcompagnie();">
                        <option value="">---- Carrier ----</option>
                        <?php foreach($compagnie as $row){?>
                        <option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

                        <?php }?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="air_craft"><strong>Air craft #:</strong></label>
                      <div class="col-sm-9">
                  <input type="text" class="form-control" id="air_craft" placeholder="Air craft #" name="air_craft" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="flight"><strong>Flight:</strong></label>
                      <div class="col-sm-9">
                        <textarea name="flight" id="flight" placeholder="Flight" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                   <label class="control-label col-sm-3" for="dateflt"><strong>Date:</strong></label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" id="datecustum" placeholder="Date Flight" name="dateflt" value=""  />
                     </div>
                   </div>
                <div class="form-group">
                      <label class="control-label col-sm-3" for="country_loading"><strong>Country Loading:</strong></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="country_loading" placeholder="HTPAP" name="country_loading" value="HTPAP" disabled>
                      </div>
                    </div>
                	<div class="form-group">
                      <label class="control-label col-sm-3" for="country_unloading"><strong>Country Unloading:</strong></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="country_unloading" placeholder="Country Unloading" name="country_unloading" value="">
                      </div>
                    </div>
                    <div class="form-group">
                        	<input type="hidden" />
                        	  <button type="submit" id="btn_manifeste" class="btn btn-sm btn-primary">
                        	  <i class="ace-icon fa fa-save"></i>
                        	  Sauvegarder
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
			$('#btn_manifeste').on('click',function()
		 {

			 $(this).html('Please wait ...').attr('disabled','disabled');
			 $('#fr_manifeste').submit();

		 });


		});
		</script>
