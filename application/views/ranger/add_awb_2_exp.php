<?php
require_once('tete.php');
?>




<div class="page-header">
  <h1>
 <a href="<?php echo $_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
      ADD AWB
      </small>

    </h1>

					<div class="page-content">

						<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
						<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">


<form autocomplete="off" class="form-horizontal" action="<?php echo base_url()?>facture/add_awb_ex" method="POST">

	<div class="form-group">
      <label class="control-label col-sm-2" for="awblnum"><strong>Numero AWB:</strong></label>
      <div class="col-sm-10">
  <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="<?php echo $this->uri->segment(3)?>" disabled>
  <input type="hidden" id="awblnum" name="awblnum" value="<?php echo $this->uri->segment(3)?>" />

      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="consignee"><strong>Consignee:</strong></label>
      <div class="col-sm-10">
  <input type="text" class="form-control" id="consignee" placeholder="Consignee" name="consignee" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="notify_adress"><strong>Notify adress:</strong></label>
      <div class="col-sm-10">
        <textarea name="notify_adress" id="notify_adress" placeholder="Notify adress" class="form-control"></textarea>
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="qty"><strong>Qty:</strong></label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="qty" placeholder="Qty" name="qty" value="">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="qtytotal"><strong>Qty of:</strong></label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="qtytotal" placeholder="Of" name="qtytotal" value="">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-3" for="package"><strong>Nature of goods:</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="package" placeholder="Nature of goods" name="package" value="">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="weight"><strong>Weight:</strong></label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="weight" placeholder="Weight" name="weight" value="">
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-2" for="freight"><strong>Freight:</strong></label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="freight" placeholder="Freight" name="freight" value="">
      </div>
    </div>
<!-- <div class="form-group">
      <label class="control-label col-sm-2" for="currency"><strong>Currency:</strong></label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="currency" placeholder="Currency" name="currency" value="">
      </div>
    </div> -->

<!-- <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><strong>Pre-paid:</strong></label>
      <div class="col-sm-10">
        <input id="a" onchange="Clkppcl('','b','c')" class="choixcb" type="checkbox">
	  </div>
    </div> -->
<!-- <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><strong>Collect:</strong></label>
      <div class="col-sm-10">
        <input id="b" onchange="Clkppcl('','a','c')" class="choixcb" type="checkbox">
	  </div>
    </div> -->
    <!-- <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><strong>No chage:</strong></label>
      <div class="col-sm-10">
        <input id="c" onchange="Clkppcl('','a','b')" class="choixcb" type="checkbox">
    </div>
    </div> -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="notify_adress"><strong>Remarque:</strong></label>
      <div class="col-sm-10">
        <textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"></textarea>
      </div>
    </div>
	<div class="form-group">

  <button type="submit" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-save"></i>
  Sauvegarder
  </button>
<!-- import/awbl/i/lister/<?php echo $id?> -->
   <a href="<?php echo base_url()?>import/recherchevol/i/lister" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-close"></i>
  Fermer
  </a>
    </div>
  </form>
</div>
										</div>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
jQuery(function($){
   $("#awblnum").mask("999-99999999");
});
</script>
