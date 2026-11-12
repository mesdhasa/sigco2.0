<?php
?>




<div class="page-header">
<h1>

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


<form autocomplete="off" class="form-horizontal" action="<?php echo base_url()?>" method="POST">


<div class="form-group">
<label class="control-label col-sm-3" for="awblnum"><strong>No AWBL:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="consi_name"><strong>Consignee Name:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="consi_name" placeholder="Consignee Name" name="consi_name" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="consi_addresse"><strong>Consignee Address:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="consi_addresse" placeholder="Consignee Address" name="consi_addresse" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="accounting_information"><strong>Accounting Information:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="accounting_information" placeholder="Accounting Information" name="accounting_information" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="inssuing_carrier_agent"><strong>Inssuing Carrier’s Agent:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="inssuing_carrier_agent" placeholder="Inssuing Carrier’s Agent" name="inssuing_carrier_agent" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="inssuing_carrier_city"><strong>Inssuing Carrier’s City:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="inssuing_carrier_city" placeholder="Inssuing Carrier’s City" name="inssuing_carrier_city" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="pwd"><strong>Pre-paid:</strong></label>
<div class="col-sm-8">
<input id="a" onchange="Clkppcl('','b','c')" class="choixcb" type="checkbox">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="pwd"><strong>Collect:</strong></label>
<div class="col-sm-8">
<input id="b" onchange="Clkppcl('','a','c')" class="choixcb" type="checkbox">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="pwd"><strong>No chage:</strong></label>
<div class="col-sm-8">
<input id="c" onchange="Clkppcl('','a','b')" class="choixcb" type="checkbox">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="airport_of_departure"><strong>Airport Of Departure:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="airport_of_departureairport_of_departure" placeholder="Airport Of Departure" name="airport_of_departure" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="airport_of_destination"><strong>Airport of Destination:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="airport_of_destination" placeholder="Airport of Destination" name="airport_of_destination" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="flight_number"><strong>Flight Number:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="flight_number" placeholder="Flight Number" name="flight_number" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="dateflt"><strong>Date:</strong></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="datecustum" placeholder="Date Flight" name=" dateflt" value=""  />
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="currency"><strong>Currency:</strong></label>
<div class="col-sm-2">
<input type="text" class="form-control" id="currency" placeholder="Currency" name="currency" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="handling_information"><strong>Handling Information:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="handling_information" placeholder="Handling Information" name="handling_information" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="quantity_pcs"><strong>Quantity PCS:</strong></label>
<div class="col-sm-3">
<input type="text" class="form-control" id="quantity_pcs" placeholder="Quantity PCS" name="quantity_pcs" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="gross_weight_Kgs"><strong>Gross Weight in (Kgs):</strong></label>
<div class="col-sm-3">
<input type="text" class="form-control" id="gross_weight_Kgs" placeholder="Gross Weight in (Kgs)" name="gross_weight_Kgs" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="gross_weight_lbs"><strong>Gross Weight in (Lbs):</strong></label>
<div class="col-sm-3">
<input type="text" class="form-control" id="gross_weight_lbs" placeholder="Gross Weight in (Lbs)" name="gross_weight_lbs" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="chargeable_Weight"><strong>Chargeable Weight:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="chargeable_Weight" placeholder="Chargeable Weight" name="chargeable_Weight" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="rate_charge"><strong>Rate Charge:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="rate_charge" placeholder="Rate Charge" name="rate_charge" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="total"><strong>Total:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="total" placeholder="Total" name="total" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="total_agent"><strong>Total Other Charge Due Agent
:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="total_agent" placeholder="Total Other Charge Due Agent
" name="total_agent" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="total_carrier"><strong>Total Other Charge Due Carrier
:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="total_carrier" placeholder="Total Other Charge Due Carrier
" name="total_carrier" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="total_col"><strong>Total Prepaid or Collect
:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="total_col" placeholder="Total Prepaid or Collect
" name="total_col" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="nature_goods"><strong>Nature of Goods
:</strong></label>
<div class="col-sm-8">
<input type="text" class="form-control" id="nature_goods" placeholder="Nature of Goods
" name="nature_goods" value="">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="notify_adress"><strong>Remarque:</strong></label>
<div class="col-sm-8">
<textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"></textarea>
</div>
</div>
<div class="form-group">
<input type="hidden" id="idsegment" name="idsegment" value="">
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
jQuery(function($){
$("#awblnum").mask("999-99999999");
});
</script>
