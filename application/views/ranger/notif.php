<?php
require_once('tete.php');
foreach($lessegments as $row){}

?>

<div class="page-header">
<h1>
 <a href="javascript:history.go(-2)"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
                <small>

                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Notification

                </small>

              </h1>

  <div class="col-lg-5 col-lg-offset-7">
    <p style="text-align:right; margin-top:-30px;">
  <strong style="font-size:20px; text-align:right;"> <?php echo $row->compagnie?>  <?php echo dateVersChainetext($row->Date_of_arrival);?>  <?php echo $row->typeawbl?></strong>
</p>
</div>
</div>

					<div class="page-content">


						<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">
<strong style="font-size:20px;">[ <?php echo $row->awbl?> ] </strong>

<form class="form-horizontal" action="<?php echo base_url()?>import/notif_buill" method="POST">
    <input type="hidden" value="<?php echo $row->awbl?>" name="awbl" />
	<div class="form-group">
      <label class="control-label col-sm-2" for="consignee"><strong>Consignee:</strong></label>
      <div class="col-sm-10">
        <input autocomplete="off" type="text" class="form-control" id="consignee" placeholder="Consignee" name="consignee" value="<?php echo $row->consignee?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="notify_adress"><strong>Notify adress:</strong></label>
      <div class="col-sm-10">
        <textarea name="notify_adress" id="notify_adress" placeholder="Notify adress" class="form-control"><?php echo $row->notify_adress?></textarea>
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="qty"><strong>Qty:</strong></label>
      <div class="col-sm-2">
        <input autocomplete="off" type="text" class="form-control" id="qty" placeholder="Qty" name="qty" value="<?php echo $row->qty?>">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="qtytotal"><strong>Qty of:</strong></label>
      <div class="col-sm-2">
        <input autocomplete="off" type="text" class="form-control" id="qtytotal" placeholder="Of" name="qtytotal" value="<?php echo $row->qtytotal?>">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="package"><strong>Description:</strong></label>
      <div class="col-sm-10">
        <input autocomplete="off" type="text" class="form-control" id="package" placeholder="Description" name="package" value="<?php echo $row->package?>">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="weight"><strong>Weight:</strong></label>
      <div class="col-sm-2">
        <input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" value="<?php echo $row->weight?>">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="freight"><strong>Freight:</strong></label>
      <div class="col-sm-2">
        <input autocomplete="off" type="text" class="form-control" id="freight" placeholder="Freight" name="freight" value="<?php echo $row->freight?>">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="currency"><strong>Currency:</strong></label>
      <div class="col-sm-2">
        <input autocomplete="off"type="text" class="form-control" id="currency" placeholder="Currency" name="currency" value="<?php echo $row->currency?>">
      </div>
    </div>

<div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><strong>Pre-paid:</strong></label>
      <div class="col-sm-10">
<input id="<?php echo $row->awbl;?>a" <?php if($row->prepaid=="1") echo "checked=\"checked\"";?> onchange="Clkppcl('<?php echo $row->awbl;?>','b','c')" class="choixcb" type="checkbox">
	  </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><strong>Collect:</strong></label>
      <div class="col-sm-10">
    <input id="<?php echo $row->awbl;?>b" <?php if($row->collect=="1") echo "checked=\"checked\"";?>  onchange="Clkppcl('<?php echo $row->awbl;?>','a','c')" class="choixcb" type="checkbox">
	  </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><strong>No charge:</strong></label>
      <div class="col-sm-10">
<input id="<?php echo $row->awbl;?>c" <?php if($row->nocharge=="1") echo "checked=\"checked\"";?>  onchange="Clkppcl('<?php echo $row->awbl;?>','a','b')" class="choixcb" type="checkbox">
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2 col-lg-pull-0" for="datenotification"><strong>Notification:</strong></label>
      <div class="col-sm-3">
         <input type="text" class="form-control" id="datecustum" placeholder="Date Notification" name=" datenotification" value="<?php echo dateVersChaine($row->datenotification)?>"  required/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="notify_adress"><strong>Remarque:</strong></label>
      <div class="col-sm-10">
        <textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"><?php echo $row->remarque?></textarea>
      </div>
    </div>
	<div class="form-group">
  <button type="submit" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-save"></i>
  Sauvegarder
  </button>

   <a href="<?php echo base_url()?>import/prepaidcollect/i/precol/<?php echo $row->id;?>" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-close"></i>
  Fermer
  </a>
    </div>
  </form>
</div>



					</div>
          </div><!-- /.page-content -->
<?php require_once('pied.php');?>
