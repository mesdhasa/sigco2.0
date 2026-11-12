<style>


legend
{
font-size:13px;
font-weight:bold;
margin-bottom: 0px;
width: auto;
border: 1px solid #ddd;
border-radius: 4px;
padding: 5px 5px 5px 10px;
background-color: #ffffff;
}
fieldset {
display: block;
margin-inline-start: 2px;
margin-inline-end: 2px;
padding-block-start: 0.35em;
padding-inline-start: 0.75em;
padding-inline-end: 0.75em;
padding-block-end: 0.625em;
min-inline-size: min-content;
border-width: 2px;
border-style: groove;
border-color: threedface;
border-image: initial;
}
/**
* The file contains styles for GWT widgets in the Clean theme.
*/
td, select, button {
font-family: Arial Unicode MS, Arial, sans-serif;
font-size: small;
}
input[type=text] {
margin: 2px 2px 2px 2px;
}
</style>
<div class="page-header">
<h1>
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Compagnie : 
		<select>
			<?php foreach($compagnie as $row){?>
			<option><?php echo $row->compagnie?></option>
			<?php }?>
		</select>
	</small>
</h1>
</div>
<div class="page-content">
						<!-- /.page-header -->
<div class="row">

<div class="col-lg-6">
	<fieldset class="formElement-Grow-1">
	<legend>Shipper</legend>
	<div style="position: relative;"><table>
	<colgroup><col></colgroup><tbody><tr><td>
	<div class="gwt-Label">Account number</div></td><td>
	<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="account_number_shipper"  name="account_number_shipper" value="">
	</td><td>
	<div class="gwt-Label">Code Client</div></td><td>
	<select name="codec1"  style="width: 80px;  font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="codec1">
	<option value="">---</option>
	<?php foreach($clientcode as $rowc){?>
	<option value=""><?php echo $rowc->reference?></option>
	<?php }?>
	</select>
	</td></tr><tr><td>

	</td> </tr><tr><td>
	<div class="gwt-HTML">Name</div></td><td>
	<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="name_shipper"  name="name_shipper" value="">
	</td></tr><tr><td>
	<div class="gwt-HTML">Adress</div></td><td>
	<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="ville_shipper"  name="ville_shipper" value="">
	</td></tr><tr><td>
	<div class="gwt-HTML">Ville</div></td><td>
	<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="address_shipper"  name="address_shipper" value="">
	</td>
	</tr>
	<tr><td>
	<div class="gwt-HTML">E-mail</div></td><td>
	<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="email_shipper"  name="email_shipper" value="">
	</td></tr><tr><td>
	<div class="gwt-HTML">Tel</div></td><td>
	<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel_shipper"  name="tel_shipper" value="">
	</td>
	</tr>
	</tbody></table>
	</div>
	</fieldset>
	
<br/>
<fieldset class="formElement-Grow-1" style="">
<legend>Consignee</legend>
<div style="position: relative;"><table>
<colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Account number</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="account_number_consignee"  name="account_number_consignee" value="">
</td><td>
<div class="gwt-Label">Code Client</div></td><td>
<select name="codec2"  style="width: 80px;  font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="codec2">
<option value=""></option>
<option value=""></option>
</select>
</td></tr><tr><td>

</td> </tr>
<tr><td>
<div class="gwt-HTML">Name</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="name_consignee"  name="name_consignee" value="">
</td></tr><tr><td>
<div class="gwt-HTML"> Adress</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="ville_consignee"  name="ville_consignee" value="">
</td></tr><tr><td>
<div class="gwt-HTML">Ville</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="address_consignee"  name="address_consignee" value="">
</td>
</tr>
<tr><td>
<div class="gwt-HTML">E-mail</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="email_consignee"  name="email_consignee" value="">
</td></tr><tr><td>
<div class="gwt-HTML">Tel</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel_consignee"  name="tel_consignee" value="">
</td>
</tr>
</tbody></table>
</div>
</fieldset>	
<br />
<fieldset class="formElement-Grow-1" style="">
<legend>Issuing carrier's agent</legend>
<div style="position: relative;"><table>
<colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Account number</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="account_number_agent"  name="account_number_agent" value="">
</td><td>
<div class="gwt-Label">Code Client</div></td><td>
<select name="codec3"  style="width: 80px;  font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="codec3">
<option value=""></option>
<option value=""></option>

</select>
</td></tr><tr><td>

</td> </tr>
<tr><td>
<div class="gwt-HTML">Name</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="name_agent"  name="name_agent" value="">
</td></tr><tr>
<td>
<div class="gwt-HTML">Adress</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="adress_agent"  name="adress_agent" value="">
</td></tr>
<tr>
<td>
<div class="gwt-HTML">Ville</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="ville_agent"  name="ville_agent" value="">
</td></tr>
<tr><td>
<div class="gwt-HTML">IATA Code</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="iata_code_agent"  name="iata_code_agent" value="">
</td>
</tr>
</tbody></table>
</div>
</fieldset>
<br/>	
<fieldset class="formElement-Grow-1" style="">
<legend>Routing and flight bookings</legend>
<table><colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Departure</div>
</td><td>
<input type="text" class="gwt-TextBox" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="departure"  name="departure" value="">
</td></tr>
<tr><td>
<div class="gwt-Label">Route</div>
</td>
<td><div>
<div class="gwt-Label" style="display: inline-block;">To</div>
<input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_to1"  name="route_to1" value="">
<div class="gwt-Label" style="display: inline-block; margin-left: 8px;">By first carrier</div>
<input type="text" class="gwt-TextBox" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_first_carrier"  name="route_first_carrier" value="">
</div></td></tr>
<tr><td>
<div class="gwt-Label"></div>
</td><td>
<div>
<div class="gwt-Label" style="display: inline-block;">To</div>
<input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_to2"  name="route_to2" value="">
<div class="gwt-Label" style="display: inline-block; margin-left: 8px;">By</div>
<input type="text" class="gwt-TextBox" style="width: 40px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_by1"  name="route_by1" value="">
<div class="gwt-Label" style="display: inline-block; margin-left: 8px;">To</div>
<input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_to3"  name="route_to3" value="">
<div class="gwt-Label" style="display: inline-block; margin-left: 8px;">By</div>
<input type="text" class="gwt-TextBox" style="width: 40px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_by2"  name="route_by2" value="">
</div></td></tr>
<tr><td>
<div class="gwt-Label">Destination</div>
</td><td>
<input type="text" class="gwt-TextBox" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="destination"  name="destination" value="">
</td></tr>
<tr><td>
<div class="gwt-Label">Flight/Date</div>
</td>
<td><div>
<input type="text" class="gwt-TextBox" style="width: 95px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="flight"  name="flight" value="">
<input type="text" class="gwt-TextBox" style="width: 95px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="date_flight"  name="date_flight" value="">
</div></td></tr></tbody></table>
</fieldset>

<br>	

</div>

<div class="col-lg-6">
<fieldset class="formElement-Grow-1" style="">
<legend>AWB consigment details</legend>
<table>
<colgroup>
<col>
</colgroup>
<tbody>
<tr>
<td>
<div class="gwt-Label">AWB number</div>
</td>
<td>
<div>

<input type="text" autocomplete="off" type="readonly" class="gwt-TextBox" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="awb_number"  name="awb_number" value="" readonly>
</div>
</td>
</tr>
<tr>
<td>
<div class="gwt-Label">Airport of departure</div>
</td>
<td>
<input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="airport_of_departure"  name="airport_of_departure" value="">
</td>
</tr>
</tbody></table></fieldset>
<br/>

<br/>
<fieldset style="">
<legend>Accounting information</legend>
<table><colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-HTML">Details</div></td><td>
<textarea class="gwt-TextArea form" rows="7" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="accounting_information"  name="accounting_information" value="">
</textarea></td></tr></tbody></table>
</fieldset>

<br/>

<fieldset style=""><legend>Shipment referente information</legend>
<table><colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Reference number</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 150px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="reference_number"  name="reference_number" value="">
</td></tr><tr><td>
<div class="gwt-Label">Information</div>
</td><td><div>
<input type="text" class="gwt-TextBox" style="width: 132px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="information1"  name="information1" value="">
<input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, I?php echo strtoupper($row->code);?>nconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="information2"  name="information2" value="">
</div></td></tr></tbody></table>
</fieldset>

<br/>
<fieldset style=""><legend>Charges declaration</legend>
<table><colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Currency</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="currency"  name="currency" value=""></td><td>
<div class="gwt-Label">CHCG</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 40px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="chcg"  name="chcg" value=""></td></tr><tr><td>
<div class="gwt-Label">Value for carriage</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 132px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="value_for_carriage"  name="value_for_carriage" value=""></td><td>
<div class="gwt-Label">WT/VAL</div></td><td>
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="wt_val_pp_col"  name="wt_val_pp_col" >
<option value="">---</option>
<option value="" ></option>
</select>


</td></tr><tr><td>
<div class="gwt-Label">Value for customs</div>
</td>
<td>
<input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="value_for_customs"  name="value_for_customs" value="">
</td>
<!-- <td>?php echo strtoupper($row->code);?>
<div class="gwt-Label">Other</div>
</td> -->
<!-- <td>
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="other_pp_col"  name="other_pp_col" value="mm">
<option value="">---</option>?php echo strtoupper($row->code);?>

</select>
</td> -->
</tr><tr><td>
<div class="gwt-Label">Amount of insurance</div>
</td><td>
<input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="amount_of_insurance"  name="amount_of_insurance" value="">
</td></tr></tbody></table>
</fieldset>

</div>
<div class="col-lg-12">
<fieldset style=""><legend>Handling information</legend>
<table><colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-HTML">Requirements</div></td>
<td rowspan="2">
<textarea class="gwt-TextArea" rows="4" style="width: 592px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="requirements"  name="requirements" ></textarea>
</td><td>&nbsp;&nbsp;&nbsp;<div class="gwt-Label">SCI</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="sci"  name="sci" value="">
</td></tr><td></td>
</tbody></table></fieldset>
<br />
</div>
<div class="col-lg-12">
<fieldset style=""><legend>Rate description</legend>

<table class="table table-striped table-condensed table-bordered table-hover">
<tr>
<th  class="col-1" align="center" width="2%" >No.of Pieces Rep</th>
<th   width="5%" align="center">Gross Weight</th>
<th  width="1%">Kg/Lb</th>
<th  width="2%">Rate Class</th>
<th  width="2%">Commdity</br> Item No.</th>
<th  width="5%">Chargeable Weight</th>
<th  width="5%">Rate/Charge</th>
<th  width="5%">Total</th>
<th  width="5%">Nature And Quantity of Goods</th>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 40px; margin-right:  -65px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="qt"  name="qt" value="" readonly>
</span>
</td>
<td class="center">
<span class="input-group center">
<input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 80px; margin-right:  -100px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="gross_weight1"  name="gross_weight1" value="" readonly></br>
<input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 80px; margin-right:  -100px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="gross_weight2"  name="gross_weight2" value="" readonly >

</span>
</td>
<td class="center">
<span class="input-group center">
<input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 40px; margin-right:  -25px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="kg_lb1"  name="kg_lb1" value="kg" readonly></br>
<input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 40px; margin-right:  -25px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="kg_lb2"  name="kg_lb2" value="lb" readonly>

</span>
</td>
<td class="center">
<span class="input-group center">
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="rate_class"  name="rate_class" value="">
<option value="">--</option>
<option value="" ></option>
</select>
</span>
</td>
<td class="center">
<span class="input-group center">
<input type="text" class="gwt-TextBox" autocomplete="off" style="width: 80px; margin-right: -90px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="commdity"  name="commdity" value="">
</span>
</td>
<td class="center">
<span class="input-group center">
<input type="text" autocomplete="off" type="readonly" name="dim42" id="dim42" size="8%" class="form-control" placeholder=""  value="" readonly>

</span>
</td>
<td class="center">
<span class="input-group center">
<input type="text" autocomplete="off"  name="rate_Charge" id="Rate_Charge" size="8%" class="form-control" value="" >
</span>
</td>
<td class="center">
<span class="input-group center">
<input type="text" autocomplete="off" type="readonly" name="dim44" id="dim44" size="8%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
<td class="center">
<span class="input-group center">
<textarea  readonly  class="gwt-TextArea" rows="3" style="width: 132px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="dim45"  name="dim45" readonly ></textarea>

<!-- <input type="text" autocomplete="off" type="readonly" name="dim45" id="dim45" size="8%" class="form-control" placeholder="" value="" readonly> -->
</span>
</td>
</tr>
<tr>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
<td   align="center"><strong></strong></td>
</tr>

</table>

</fieldset>
</div>



<div class="col-lg-6">

<div class="formPanel-FlexVertical formElement-Grow-1" style="position: relative;">
<fieldset class="formElement-Grow-1" style="">
<legend>Charges summary</legend>
<table><colgroup><col></colgroup>
<tbody><tr><td></td>
<td>
<div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Prepaid</div>
</td>
<td>
<div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Collect</div>
</td>
</tr>
<tr>
<td>
<div class="gwt-HTML"  style="display: inline-block; vertical-align: text-bottom;">Weight charge</div>
</td>

<td>
<input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
<td>
<input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>

</tr>
<tr>
<td>
<div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Valuation charge</div>
</td>
<td>
<input type="text" class="gwt-TextBox"  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value=""  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
<td>
<input type="text" class="gwt-TextBox"  disabled=""  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value=""  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
</tr>
<tr>
<td>
<div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Tax</div>
</td>
<td>
<input type="text" class="gwt-TextBox" autocomplete="off" name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
<td>
<input type="text" class="gwt-TextBox" autocomplete="off"  disabled=""  name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
<td>
</tr><tr>
<td>
<div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Other charges due agent</div>
</td>
<td>
<input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
<td>
<input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
</tr><tr><td><div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Other charges due carrier</div>
</td>
<td>
<input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
<td>
<input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td>
</tr><tr><td>
<div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Total</div>

</td><td>
<input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="total_pp" id="total_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td><td>
<input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="total_cc" id="total_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td></tr></tbody>
</table>
</fieldset></br>
<!-- <fieldset class="formElement-Grow-1" style=""><legend>CC charges in destination currency</legend>
<table><colgroup><col></colgroup><tbody>
<tr><td>
<div class="gwt-Label">Currency conv. rates</div>
</td><td>
<input type="text" class="gwt-TextBox" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td></tr><tr><td>
<div class="gwt-Label">CC charges in dest.</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td></tr><tr><td>
<div class="gwt-Label">Charges at dest.</div>
</td><td>
<input type="text" class="gwt-TextBox" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td></tr><tr><td
><div class="gwt-Label">Total collect</div></td><td>
<input type="text" class="gwt-TextBox" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
</td></tr></tbody></table>
</fieldset> -->
</div></br>
</div>


<div class="col-lg-6 col-md-6 col-xs-12">
<br />
<form class="form-inline" action="<?php echo base_url()?>export/export/add_other_charges" method="POST">
<div class="form-group">
<label for="description"></label>
<input autocomplete="off" type="text" name="description" id="description" size="8%" class="form-control" placeholder="Description" value="" required />
</div>
<div class="form-group">
<label for="amount"></label>
<input autocomplete="off" type="text" name="amount" id="amount" size="6%" class="form-control" placeholder="Amount" value="" required />
</div>
<div class="form-group">
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="entitlement"  name="entitlement" value="">
<option value="">--</option>
<option value="" ></option>
</select>
</div>
<div class="form-group">
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="type_entitlement"  name="type_entitlement" >
<option value="">---</option>
<option value="" ></option>
</select>
</div>

<input type="hidden" id="awblnum" name="awblnum" value="" />

<button class="btn btn-sm btn-primary" type="submit">
<i class="ace-icon fa fa-plus"></i>
Ajouter
</button>
</form></br>
<fieldset class="formElement-Grow-1" style=""><legend>Other charges</legend>

<table class="table">
<thead>
<tr>
<th>Description</th>
<th>Amount</th>
<th>Entitlement</th>
<th>Entitlement</th>
<th></th>
</tr>
</thead>
<tbody>


<tr>
<td>
<input autocomplete="off" type="text" disabled="" name="dim2" id="dim2" size="1%" class="form-control" placeholder="" value=""/>
</td>
<td>
<input autocomplete="off" type="text" disabled="" name="dim2" id="dim2" size="1%" class="form-control" placeholder="" value=""/>
</td>
<td>
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="entitlement" disabled=""  name="entitlement" value="">
<option value="">--</option>
<option value="" ></option>
</select>
</td>
<td>
<select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="type_entitlement" disabled="" name="type_entitlement" >
<option value="">---</option>
<option value=""></option>
</select>
</td>
<td >
<a href="#" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>export/export/delete_other_charges//')"
class="btn btn-xs btn-danger">
<i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
</button>

</td>
</tr>

</tbody>
</table>
</fieldset>
</div>

<div class="col-lg-12">
<button type="submit" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-save"></i>
Sauvegarder
</button>
<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>export/export/awb_pdf/">
<i class="ace-icon fa fa-file-pdf-o"></i>
Imprimer
</a>
<a href="<?php echo base_url()?>" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-close"></i>
Fermer
</a>
</div>




<!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->