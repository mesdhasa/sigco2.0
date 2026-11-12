<?php
foreach($lareservation as $rs){}
?>

<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
Réservation
</small>

    </h1>

					<div class="page-content">

						<?php
if($this->session->flashdata('sms_ajouter_reservation')){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms_ajouter_reservation');?></strong>
</div>
<?php } ?>
						<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">


<form class="form-horizontal" autocomplete="off" action="<?php echo base_url()?>export/export/edit_reservation" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-3" for="compagnie"><strong>Carrier:</strong></label>
        <div class="col-sm-9">
          <select class="form-control" name="compagnie" id="compagnie" onchange="return showcompagnie();">
          <option value="">---- Carrier ----</option>
          <?php foreach($compagnie as $row){?>
            <option value="<?php echo $row->idcompagnie?>" <?php if($rs->idcompagnie==$row->idcompagnie) echo " selected"?>><?php echo strtoupper($row->compagnie);?></option>
          <?php }?>
          </select>
        </div>
      </div>
<span id="span1" style="display: none">
  <div class="form-group" >
      <label class="control-label col-sm-3" for="no_reservation"><strong>Reservation N0:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="no_reservation" placeholder="Reservation N0" name="no_reservation" value="<?php echo $rs->no_reservation?>">
      </div>
    </div>
</span>
    <div class="form-group">
        <label class="control-label col-sm-3" for="awblnum"><strong>AWBL N0:</strong></label>
        <div class="col-sm-9">
    <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="<?php echo $rs->no_awbl?>" required>
        </div>
      </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="shipper"><strong>Shipper:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="shipper" placeholder="Shipper" name="shipper" value="<?php echo $rs->shipper?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="consignee"><strong>Consignee:</strong></label>
      <div class="col-sm-9">
        <textarea name="consignee" id="consignee" placeholder="Consignee" class="form-control"><?php echo $rs->consignee?></textarea>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-3" for="code_destination"><strong>Dest:</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="code_destination" placeholder="Dest" name="code_destination" value="<?php echo $rs->code_destinataire?>">
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="code_origine"><strong>Origin:</strong></label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="code_origine" placeholder="Origin" name="code_origine" value="<?php echo $rs->code_origine?>" >
        </div>
      </div>
      <div class="form-group">
            <label class="control-label col-sm-3" for="pwd"><strong>Pre-paid:</strong></label>
            <div class="col-sm-9">
              <input id="<?php echo $rs->no_awbl?>a" <?php if($rs->prepaid=="1") echo "checked=\"checked\"";?> onchange="Clkppcl_export('<?php echo $rs->no_awbl?>','b','c')" class="choixcb" type="checkbox">
      	  </div>
          </div>

              <div class="form-group">
                    <label class="control-label col-sm-3" for="pwd"><strong>collect:</strong></label>
                    <div class="col-sm-9">
                      <input id="<?php echo $rs->no_awbl?>b" <?php if($rs->collect=="1") echo "checked=\"checked\"";?> onchange="Clkppcl_export('<?php echo $rs->no_awbl?>','a','c')" class="choixcb" type="checkbox">
                  </div>
                  </div>

        <div class="form-group">
              <label class="control-label col-sm-3" for="pwd"><strong>no charge:</strong></label>
              <div class="col-sm-9">
                <input id="<?php echo $rs->no_awbl?>c" <?php if($rs->nocharge=="1") echo "checked=\"checked\"";?> onchange="Clkppcl_export('<?php echo $rs->no_awbl?>','a','b')" class="choixcb" type="checkbox">
            </div>
            </div>
<div class="form-group">
      <label class="control-label col-sm-3" for="nature_of_goods"><strong>Nature of Goods:</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="nature_of_goods" placeholder="Nature of Goods" name="nature_of_goods" value="<?php echo $rs->description_colis?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="notify_adress"><strong>Remarque:</strong></label>
      <div class="col-sm-9">
        <textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"><?php echo $rs->remarque?></textarea>
      </div>
    </div>
	<div class="form-group">
    <input type="hidden" id="id" name="id" value="<?php echo $rs->id_reservation?>" />
    <input type="hidden" id="code_reser" name="code_reser" value="<?php echo $rs->no_reservation?>" />
    <input type="hidden" name="received" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />
  <button type="submit" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-save"></i>
Modifier
  </button>

  <a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>reservation.pdf/<?php echo $rs->id_reservation?>">
  	<i class="ace-icon fa fa-file-pdf-o"></i>
  	Imprimer
  </a>

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
jQuery(function($){
   $("#awblnum").mask("999-99999999");
});

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
