<?php
?>


<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
Reservation
</small>

    </h1>

					<div class="page-content">

            <?php
            if($this->session->flashdata('sms_ajouter_reservation')){
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $this->session->flashdata('sms_ajouter_reservation');?></strong>
            </div>
            <?php } ?>
						<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">


<form class="form-horizontal" autocomplete="off"  action="<?php echo base_url()?>export/export/ajouter_reservation" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-3" for="compagnie"><strong>Carrier:</strong></label>
        <div class="col-sm-9">
          <select  required class="form-control" name="compagnie" id="compagnie" onchange="return showcompagnie();">
          <option value="">---- Carrier ----</option>
          <?php foreach($compagnie as $row){?>
          <option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

          <?php }?>
          </select>
        </div>
      </div>
<span id="span1" style="display: none">
  <div class="form-group" >
      <label class="control-label col-sm-3" for="no_reservation"><strong>Reservation N0:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="no_reservation" placeholder="No Réservation" name="no_reservation">
      </div>
    </div>
</span>
    <div class="form-group">
        <label class="control-label col-sm-3" for="awblnum"><strong>AWBL N0:</strong></label>
        <div class="col-sm-9">
    <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="" required>
        </div>
      </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="shipper"><strong>Shipper:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="shipper" placeholder="Shipper" name="shipper" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="consignee"><strong>Consignee:</strong></label>
      <div class="col-sm-9">
        <textarea name="consignee" id="consignee" placeholder="Consignee" class="form-control"></textarea>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-3" for="code_destination"><strong>Dest:</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="code_destination" placeholder="Dest" name="code_destination" value="">
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="code_origine"><strong>Origin:</strong></label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="code_origine" placeholder="HTPAP" name="code_origine" value="" disabled>
        </div>
      </div>
    <div class="form-group">
          <label class="control-label col-sm-3" for="pwd"><strong>Pre-paid:</strong></label>
          <div class="col-sm-9">
            <input type="checkbox" name="pp" value="1">
    	  </div>
        </div>
    <div class="form-group">
          <label class="control-label col-sm-3" for="pwd"><strong>Collect:</strong></label>
          <div class="col-sm-9">
            <input type="checkbox" name="cc" value="1">
    	  </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="pwd"><strong>No chage:</strong></label>
          <div class="col-sm-9">
            <input type="checkbox" name="nc" value="1">
        </div>
        </div>
<div class="form-group">
      <label class="control-label col-sm-3" for="nature_of_goods"><strong>Nature of Goods:</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="nature_of_goods" placeholder="Nature of Goods" name="nature_of_goods" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="notify_adress"><strong>Remarque:</strong></label>
      <div class="col-sm-9">
        <textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"></textarea>
      </div>
    </div>

    <div class="form-group">
    <input type="hidden" id="" name="" value="">
    <input type="hidden" name="received" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />
    <button type="submit" class="btn btn-sm btn-primary">
    <i class="ace-icon fa fa-save"></i>
    Sauvegarder
    </button>

     <a href="<?php echo base_url()?>" class="btn btn-sm btn-primary">
    <i class="ace-icon fa fa-close"></i>
    Fermer
    </a>
      </div>
  </form>
</div>
										</div>


					</div><!-- /.page-content -->

<script>
function showcompagnie(){
var selectBox = document.getElementById('compagnie');
var userInput = selectBox.options[selectBox.selectedIndex].value;
if (userInput == "2"){
document.getElementById('span1').style.display = 'block';
    }else{
document.getElementById('span1').style.display = 'none';
}
return false;}

</script>
