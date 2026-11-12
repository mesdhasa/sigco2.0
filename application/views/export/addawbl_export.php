  <?php
  if(isset($_SESSION['droit']['a10']) and $_SESSION['droit']['a10']=="1"  ) {
  }else{
    redirect('home/pas_access');
  }
  foreach($antrepot as $rs){}
  foreach($awb_data as $data){}
   $totalagent=0; $totalagent1=0;foreach($entitlement_agent as $row4){
     if($row4->type_entitlement=="prepaid"){
       $totalagent+=$row4->amount;
     }else {
       $totalagent1+=$row4->amount;

     }
    }
    $totalcarrier=0; $totalcarrier1=0;foreach($entitlement_carrier as $row5){
      if($row5->type_entitlement=="prepaid"){
        $totalcarrier+=$row5->amount;
      }else {
        $totalcarrier1+=$row5->amount;

      }
     }
    if(count($antrepot2)>0){

    $r=0;  $totalpieces =0; $total =0; $vo_weight=0; $lb=0; $totalvolum =0;foreach($antrepot2 as $row){$r++;
      $t1=round($row->dim1)*round($row->dim2)*round($row->dim3);
      $t2=$t1*$row->no_pieces;
      $vo_weight=$t2/366;
      $totalpieces +=$row->no_pieces;

    $totalvolum +=$vo_weight;
    $lb=$rs->gross_weight * 2.20462;




if ($rs->gross_weight > round($totalvolum)){
  $total=$data->rate_Charge*$rs->gross_weight ;
 } else{
   $total=$data->rate_Charge*$totalvolum ;
}
  }}

  
  ?>
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
  ADD AWB

  </small>
      </h1>
  </div>
	<?php if($data->void=="1"){?>
    <div class="page-content">
    <div class="row">
    <div class="alert alert-danger">
    <strong>AWB!</strong> is <strong>VOID </strong>contact the administration
  </div>
</div>
  </div>
    		<?php }else{?>
          <div class="page-content">
          <div class="row">
          <select class="gwt-ListBox" style="font-size: 15pt;  width: 187px;font-family: Consolas, Inconsolata, monospace;"  id="type_entitlement" disabled="disabled" name="type_entitlement" >
            <?php foreach($compagnie as $row){?>
            <option value="<?php echo $row->idcompagnie?>" <?php if($rs->idcompagnie==$row->idcompagnie) echo " selected"?>><?php echo strtoupper($row->compagnie);?></option>
            <?php }?>
          </select><br/>

          <form class="form-horizontal" autocomplete="off" id="fr_add_awb" action="<?php echo base_url()?>export/export/addawbl_export" method="POST">


          <div class="col-lg-6 col-md-6 col-xs-12">
            <br/>
          <fieldset class="formElement-Grow-1" style="">
          <legend>Shipper</legend>
          <div style="position: relative;"><table>
          <colgroup><col></colgroup><tbody><tr><td>
            <div class="gwt-Label">Account number</div></td><td>
              <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="account_number_shipper"  name="account_number_shipper" value="<?php echo $data->account_number_shipper?>">
            </td><td>
                <div class="gwt-Label">Code Client</div></td><td>
                  <select name="codec1"  style="width: 80px;  font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="codec1">
                   <option value=""></option>
                   <?php foreach($clientcode as $code){?>
                   <option value="<?php echo $code->codeclient."|".$code->reference."|".$code->societe."|".$code->adresse."|".$code->ville."|".$code->email."|".$code->phone;?>"><?php echo $code->reference?></option>

                 <?php } ?>
                   </select>
                </td></tr><tr><td>

          </td> </tr><tr><td>
          <div class="gwt-HTML">Name</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="name_shipper"  name="name_shipper" value="<?php echo $data->name_shipper?>">
          </td></tr><tr><td>
          <div class="gwt-HTML">Adress</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="ville_shipper"  name="ville_shipper" value="<?php echo $data->ville_shipper?>">
          </td></tr><tr><td>
          <div class="gwt-HTML">Ville</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="address_shipper"  name="address_shipper" value="<?php echo $data->address_shipper?>">
          </td>
          </tr>
          <tr><td>
          <div class="gwt-HTML">E-mail</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="email_shipper"  name="email_shipper" value="<?php echo $data->email_shipper?>">
          </td></tr><tr><td>
          <div class="gwt-HTML">Tel</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel_shipper"  name="tel_shipper" value="<?php echo $data->tel_shipper?>">
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
              <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="account_number_consignee"  name="account_number_consignee" value="<?php echo $data->account_number_consignee?>">
            </td><td>
                <div class="gwt-Label">Code Client</div></td><td>
                  <select name="codec2"  style="width: 80px;  font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="codec2">
                   <option value=""></option>
                   <?php foreach($clientcode as $code){?>
                   <option value="<?php echo $code->codeclient."|".$code->reference."|".$code->societe."|".$code->adresse."|".$code->ville."|".$code->email."|".$code->phone;?>"><?php echo $code->reference?></option>

                 <?php } ?>
                   </select>
                </td></tr><tr><td>

          </td> </tr>
          <tr><td>
          <div class="gwt-HTML">Name</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="name_consignee"  name="name_consignee" value="<?php echo $data->name_consignee?>">
          </td></tr><tr><td>
          <div class="gwt-HTML"> Adress</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="ville_consignee"  name="ville_consignee" value="<?php echo $data->ville_consignee?>">
          </td></tr><tr><td>
          <div class="gwt-HTML">Ville</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="address_consignee"  name="address_consignee" value="<?php echo $data->address_consignee?>">
          </td>
          </tr>
          <tr><td>
          <div class="gwt-HTML">E-mail</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="email_consignee"  name="email_consignee" value="<?php echo $data->email_consignee?>">
          </td></tr><tr><td>
          <div class="gwt-HTML">Tel</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel_consignee"  name="tel_consignee" value="<?php echo $data->tel_consignee?>">
          </td>
          </tr>
          </tbody></table>
          </div>
          </fieldset>
          <br/>
          <fieldset class="formElement-Grow-1" style="">
          <legend>Issuing carrier's agent</legend>
          <div style="position: relative;"><table>
          <colgroup><col></colgroup><tbody><tr><td>
            <div class="gwt-Label">Account number</div></td><td>
              <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="account_number_agent"  name="account_number_agent" value="<?php echo $data->account_number_agent?>">
            </td><td>
                <div class="gwt-Label">Code Client</div></td><td>
                  <select name="codec3"  style="width: 80px;  font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="codec3">
                   <option value=""></option>
                   <?php foreach($clientcode as $code){?>
                   <option value="<?php echo $code->codeclient."|".$code->reference."|".$code->societe."|".$code->adresse."|".$code->ville."|".$code->email."|".$code->phone;?>"><?php echo $code->reference?></option>

                 <?php } ?>
                   </select>
                </td></tr><tr><td>

          </td> </tr>
          <tr><td>
          <div class="gwt-HTML">Name</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="name_agent"  name="name_agent" value="<?php echo $data->name_agent?>">
          </td></tr><tr>
            <td>
          <div class="gwt-HTML">Adress</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="adress_agent"  name="adress_agent" value="<?php echo $data->adress_agent?>">
          </td></tr>
          <tr>
            <td>
          <div class="gwt-HTML">Ville</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="ville_agent"  name="ville_agent" value="<?php echo $data->ville_agent?>">
          </td></tr>
        <tr><td>
          <div class="gwt-HTML">IATA Code</div></td><td>
          <input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="iata_code_agent"  name="iata_code_agent" value="<?php echo $data->iata_code_agent?>">
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
          <input type="text" class="gwt-TextBox" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="departure"  name="departure" disabled value="PORT-AU-PRINCE HAITI INTE">
          </td></tr>
          <tr><td>
          <div class="gwt-Label">Route</div>
          </td>
          <td><div>
          <div class="gwt-Label" style="display: inline-block;">To</div>
          <input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_to1"  name="route_to1" value="<?php echo $data->route_to1?>">
          <div class="gwt-Label" style="display: inline-block; margin-left: 8px;">By first carrier</div>
          <input type="text" class="gwt-TextBox" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_first_carrier"  name="route_first_carrier" value="<?php echo $data->route_first_carrier?>">
          </div></td></tr>
          <tr><td>
          <div class="gwt-Label"></div>
          </td><td>
          <div>
          <div class="gwt-Label" style="display: inline-block;">To</div>
          <input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_to2"  name="route_to2" value="<?php echo $data->route_to2?>">
          <div class="gwt-Label" style="display: inline-block; margin-left: 8px;">By</div>
          <input type="text" class="gwt-TextBox" style="width: 40px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_by1"  name="route_by1" value="<?php echo $data->route_by1?>">
          <div class="gwt-Label" style="display: inline-block; margin-left: 8px;">To</div>
          <input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_to3"  name="route_to3" value="<?php echo $data->route_to3?>">
          <div class="gwt-Label" style="display: inline-block; margin-left: 8px;">By</div>
          <input type="text" class="gwt-TextBox" style="width: 40px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="route_by2"  name="route_by2" value="<?php echo $data->route_by2?>">
          </div></td></tr>
          <tr><td>
          <div class="gwt-Label">Destination</div>
          </td><td>
          <input type="text" class="gwt-TextBox" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="destination"  name="destination" value="<?php echo $data->destination?>">
          </td></tr>
          <tr><td>
          <div class="gwt-Label">Flight/Date</div>
          </td>
          <td><div>
          <input type="text" class="gwt-TextBox" style="width: 95px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="flight"  name="flight" value="<?php echo $data->flight?>">
          <input type="text" class="gwt-TextBox" style="width: 95px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="date_flight"  name="date_flight" value="<?php echo $data->date_flight?>">
          </div></td></tr></tbody></table>
          </fieldset>
          <br/>
          </div>
          <div class="col-lg-6 col-md-6 col-xs-12">
      <br/>
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

            <input type="text" autocomplete="off" type="readonly" class="gwt-TextBox" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="awb_number"  name="awb_number" value="<?php echo $data->awb_number?>" readonly>
          </div>
          </td>
          </tr>
          <tr>
          <!-- <td>
          <div class="gwt-Label">Airport of departure</div>
          </td> -->
          <!-- <td>
          <input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="airport_of_departure"  name="airport_of_departure" value="<?php echo $data->airport_of_departure?>">
          </td> -->
          </tr>
          </tbody></table></fieldset>
          <br/>


          <br/>
          <fieldset style="">
            <legend>Accounting information</legend>
            <table><colgroup><col></colgroup><tbody><tr><td>
              <div class="gwt-HTML">Details</div></td><td>
                <textarea class="gwt-TextArea" rows="7" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="accounting_information"  name="accounting_information" value=""><?php echo $data->accounting_information?>
                </textarea></td></tr></tbody></table></fieldset>

          <br/>

          <fieldset style=""><legend>Shipment referente information</legend>
            <table><colgroup><col></colgroup><tbody><tr><td>
              <div class="gwt-Label">Reference number</div></td><td>
                <input type="text" class="gwt-TextBox" style="width: 150px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="reference_number"  name="reference_number" value="<?php echo $data->reference_number?>">
              </td></tr><tr><td>
                <div class="gwt-Label">Information</div>
              </td><td><div>
                <input type="text" class="gwt-TextBox" style="width: 132px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="information1"  name="information1" value="<?php echo $data->information1?>">
                <input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase; margin-left: 4px;" id="information2"  name="information2" value="<?php echo $data->information2?>">
              </div></td></tr></tbody></table></fieldset>
          <br/>
          <fieldset style=""><legend>Charges declaration</legend>
            <table><colgroup><col></colgroup><tbody><tr><td>
              <div class="gwt-Label">Currency</div></td><td>
                <input type="text" class="gwt-TextBox" style="width: 49px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="currency"  name="currency" disabled value="USD"></td><td>
                  <div class="gwt-Label">CHCG</div></td><td>
                    <select class="gwt-ListBox" style="font-size: 11pt; width: 55px; font-family: Consolas, Inconsolata, monospace;"  id="chcg"  name="chcg" value="">
                      <option value="">--</option>
                      <?php foreach($lescharges_codes as $row){?>
                      <option value="<?php echo $row->charges_codes?>" <?php if($data->chcg==$row->charges_codes) echo " selected"?>><?php echo strtoupper($row->charges_codes);?></option>
                      <?php }?>
                    </select>
              </td></tr><tr><td>
                      <div class="gwt-Label">Value for carriage</div></td><td>
                        <input type="text" class="gwt-TextBox" style="width: 132px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="value_for_carriage"  name="value_for_carriage" value="<?php echo $data->value_for_carriage?>"></td><td>
                          <div class="gwt-Label">WT/VAL</div></td><td>
                            <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="wt_val_pp_col"  name="wt_val_pp_col" >
                              <option value="">---</option>
                              <?php foreach($other_charges as $row){?>
                              <option value="<?php echo $row->drescription?>" <?php if($data->wt_val==$row->drescription) echo " selected"?>><?php echo strtoupper($row->code);?></option>
                              <?php }?>
                            </select>


                          </td></tr><tr><td>
                            <div class="gwt-Label">Value for customs</div>
                          </td>
                          <td>
                            <input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="value_for_customs"  name="value_for_customs" value="<?php echo $data->value_for_customs?>">
                          </td>
                          <!-- <td>
                              <div class="gwt-Label">Other</div>
                            </td> -->
                            <!-- <td>
                              <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="other_pp_col"  name="other_pp_col" value="mm">
                                <option value="">---</option>
                                <?php foreach($other_charges as $row){?>
                                <option value="<?php echo $row->drescription?>" <?php if($data->other==$row->drescription) echo " selected"?>><?php echo strtoupper($row->code);?></option>
                                <?php }?>
                              </select>
                            </td> -->
                          </tr><tr><td>
                              <div class="gwt-Label">Amount of insurance</div>
                            </td><td>
                              <input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="amount_of_insurance"  name="amount_of_insurance" value="<?php echo $data->amount_of_insurance?>">
                            </td></tr></tbody></table></fieldset>
          </div>

          <fieldset style=""><legend>Handling information</legend>
            <table><colgroup><col></colgroup><tbody><tr><td>
              <div class="gwt-HTML">Requirements</div></td>
              <td rowspan="2">
                <textarea class="gwt-TextArea" rows="4" style="width: 592px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="requirements"  name="requirements" ><?php echo $data->requirements?></textarea>
              </td><td>&nbsp;&nbsp;&nbsp;<div class="gwt-Label">SCI</div></td><td>
                <input type="text" class="gwt-TextBox" style="width: 113px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="sci"  name="sci" value="<?php echo $data->sci?>">
              </td></tr><td></td>
                </tbody></table></fieldset><br/>

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
                        <input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 40px; margin-right:  -65px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="qt"  name="qt" value="<?php echo   $totalpieces?>" readonly>
                        </span>
                        </td>
                        <td class="center">
                        <span class="input-group center">
                          <input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 80px; margin-right:  -100px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="gross_weight1"  name="gross_weight1" value="<?php echo $rs->gross_weight?>" readonly></br>
                          <input type="text" class="gwt-TextBox" type="readonly" autocomplete="off" style="width: 80px; margin-right:  -100px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="gross_weight2"  name="gross_weight2" value="<?php echo  round( $lb);?>" readonly >

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
                            <?php foreach($rateclass as $row){?>
                            <option value="<?php echo $row->rate_class?>" <?php if($data->rate_class==$row->rate_class) echo " selected"?>><?php echo strtoupper($row->rate_class);?></option>
                            <?php }?>
                          </select>
                        </span>
                        </td>
                        <td class="center">
                        <span class="input-group center">
                          <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="commdity"  name="commdity" value="">
                            <option value="">--</option>
                            <?php foreach($lescommodity as $row){?>
                            <option value="<?php echo $row->commodity?>" <?php if($data->commdity_item_no==$row->commodity) echo " selected"?>><?php echo strtoupper($row->commodity);?></option>
                            <?php }?>
                          </select>
                        </span>
                        </td>
                        <?php if ($rs->gross_weight > round($totalvolum)){

                        ?>
                        <td class="center">
                        <span class="input-group center">
                        <input type="text" autocomplete="off" type="readonly" name="dim42" id="dim42" size="8%" class="form-control" placeholder=""  value="<?php echo round($rs->gross_weight)?>" readonly>
                        </span>
                        </td>
                        <?php }else{?>
                          <td class="center">
                          <span class="input-group center">
                          <input type="text" autocomplete="off" type="readonly" name="dim42" id="dim42" size="8%" class="form-control" placeholder=""  value="<?php echo round($totalvolum)?>" readonly>
                          </span>
                          </td>
                        <?php }?>

                        <td class="center">
                        <span class="input-group center">
                        <input type="text" autocomplete="off"  name="rate_Charge" id="Rate_Charge" size="8%" class="form-control" value="<?php echo $data->rate_Charge?>" >
                        </span>
                        </td>
                        <td class="center">
                        <span class="input-group center">
                        <input type="text" autocomplete="off" type="readonly" name="dim44" id="dim44" size="8%" class="form-control" placeholder="" value="<?php echo round($total,2)?>" readonly>
                        </span>
                        </td>
                        <td class="center">
                        <span class="input-group center">
                          <textarea  readonly  class="gwt-TextArea" rows="3" style="width: 132px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"  id="dim45"  name="dim45" readonly ><?php echo $rs->nature_and_quantity?></textarea>

                        <!-- <input type="text" autocomplete="off" type="readonly" name="dim45" id="dim45" size="8%" class="form-control" placeholder="" value="" readonly> -->
                        </span>
                        </td>
                        </tr>
                        <tr>
                          <td   align="center"><strong><?php echo   round($totalpieces)?></strong></td>
                          <td   align="center"><strong><?php echo round($rs->gross_weight)?></strong></td>
                          <td   align="center"><strong></strong></td>
                          <td   align="center"><strong></strong></td>
                          <td   align="center"><strong></strong></td>
                          <td   align="center"><strong></strong></td>
                          <td   align="center"><strong></strong></td>
                          <td   align="center"><strong><?php echo round($total,2)?></strong></td>
                          <td   align="center"><strong></strong></td>
                        </tr>

                        </table>

            </fieldset><br/>
          <div class="col-lg-6 col-md-6 col-xs-12">
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

              <?php if($data->wt_val=="prepaid"){?>
                <td>
                <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="<?php echo round($total,2)?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
                <input type="hidden" id="weight_charge_pp" name="weight_charge_pp" value="<?php echo round($total,2)?>">

                </td>
                <td>
                <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
                </td>
              <?php }else if ($data->wt_val=="collect"){?>
                <td>
                <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
                </td>
                <td>
                <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="<?php echo round($total,2)?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
                </td>
              <?php }else {?>
                <td>
                <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
                </td>
                <td>
                <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="weight_charge_pp" id="weight_charge_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
                </td>
                <?php }?>
          </tr>
          <tr>
          <td>
          <div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Valuation charge</div>
          </td>
          <?php if($data->wt_val=="prepaid"){?>
            <td>
            <input type="text" class="gwt-TextBox"  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value="<?php echo $data->valuation_charge_pp?>"  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <td>
            <input type="text" class="gwt-TextBox"  disabled=""  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value=""  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
          <?php }else if ($data->wt_val=="collect"){?>
            <td>
            <input type="text" class="gwt-TextBox"  disabled=""  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value=""  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <td>
            <input type="text" class="gwt-TextBox"  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value="<?php echo $data->valuation_charge_pp?>"  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
          <?php }else {?>
            <td>
            <input type="text" class="gwt-TextBox"  disabled=""  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value=""  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <td>
            <input type="text" class="gwt-TextBox"  disabled=""  autocomplete="off" name="valuation_charge_pp" id="valuation_charge_pp" size="8%" class="form-control" placeholder="" value=""  style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <?php }?>
          </tr>
          <tr>
          <td>
          <div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Tax</div>
          </td>
          <?php if($data->wt_val=="prepaid"){?>
            <td>
            <input type="text" class="gwt-TextBox" autocomplete="off" name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="<?php echo $data->tax_pp?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <td>
            <input type="text" class="gwt-TextBox" autocomplete="off"  disabled=""  name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
          <?php }else if ($data->wt_val=="collect"){?>
            <td>
            <input type="text" class="gwt-TextBox" autocomplete="off"  disabled="" name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <td>
            <input type="text" class="gwt-TextBox" autocomplete="off" name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="<?php echo $data->tax_pp?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
          <?php }else {?>
            <td>
            <input type="text" class="gwt-TextBox" autocomplete="off"  disabled=""  name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <td>
            <input type="text" class="gwt-TextBox" autocomplete="off"   disabled="" name="tax_pp" id="tax_pp" size="8%" class="form-control" placeholder="" value="" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <?php }?>
          <td>
          </tr><tr>
          <td>
          <div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Other charges due agent</div>
          </td>
            <td>
            <input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="<?php echo $totalagent?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            <input type="hidden" id="other_charges_due_carrier_cc" name="other_charges_due_carrier_cc" value="<?php echo $totalagent?>">

            </td>
            <td>
            <input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="<?php echo $totalagent1?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
        </tr><tr><td><div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Other charges due carrier</div>
          </td>
            <td>
            <input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="<?php echo $totalcarrier?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
            <input type="hidden" id="other_charges_due_carrier_cc1" name="other_charges_due_carrier_cc1" value="<?php echo $totalcarrier?>">

            <td>
            <input type="text" class="gwt-TextBox" disabled=""  autocomplete="off" name="other_charges_due_carrier_cc" id="other_charges_due_carrier_cc" size="8%" class="form-control" placeholder="" value="<?php echo $totalcarrier1?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
            </td>
        </tr><tr><td>
          <div class="gwt-HTML" style="display: inline-block; vertical-align: text-bottom;">Total</div>
          <?php $total_pp=0; $total_cc=0;
          if($data->wt_val=="prepaid"){
            $total_pp=$total+$data->valuation_charge_pp+ $data->tax_pp;
            }else if ($data->wt_val=="collect"){
              $total_cc=$total+$data->valuation_charge_pp+ $data->tax_pp;
               }else {
                 }
          ?>
          </td><td>
          <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="total_pp" id="total_pp" size="8%" class="form-control" placeholder="" value="<?php echo round($total_pp+$totalagent+$totalcarrier,2)?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
          </td><td>
          <input type="text" class="gwt-TextBox" disabled="" autocomplete="off" name="total_cc" id="total_pp" size="8%" class="form-control" placeholder="" value="<?php echo round($total_cc+$totalagent1+$totalcarrier1,2)?>" style="width: 123px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;">
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
          <div class="form-group">
            <input type="hidden" id="id_awbl" name="id_awbl" value="<?php echo $data->id_awbl?>">
            <input type="hidden" id="qty_awbl2" name="qty_awbl2" value="<?php echo   $totalpieces?>">
            <input type="hidden" id="package_awbl2" name="package_awbl2" value="<?php echo $rs->nature_and_quantity?>">
            <input type="hidden" id="weight_awbl2" name="weight_awbl2" value="<?php echo $rs->gross_weight?>">
            <input type="hidden" id="weight_charge_awbl2" name="weight_charge_awbl2" value="<?php echo round($totalvolum)?>">
            <?php 
          if($data->wt_val=="prepaid"){?>
            <input type="hidden" id="freight_awbl2" name="freight_awbl2" value="<?php echo round($total_pp+$totalagent+$totalcarrier,2)?>">
            <?php  }else if ($data->wt_val=="collect"){?>
            <input type="hidden" id="freight_awbl2" name="freight_awbl2" value="<?php echo round($total_cc+$totalagent1+$totalcarrier1,2)?>">

            <?php  }else {
                 }
          ?>

          <input type="hidden" name="entered_by" id="entered_by" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />
          <button type="submit" id="btn_add_awb" class="btn btn-sm btn-primary">
          <i class="ace-icon fa fa-save"></i>
          Save
          </button>
          <a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>export/export/awb_pdf/<?php echo $data->awb_number?>">
            <i class="ace-icon fa fa-file-pdf-o"></i>
            Print
          </a>
          <a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>export/export/tag4x6/<?php echo $data->awb_number?>">
            <i class="ace-icon fa fa-file-pdf-o"></i>
         Print Labels
          </a>

          <?php
if(isset($_SESSION['droit']['a36']) and $_SESSION['droit']['a36']=="1"){?>
  <a href="#" onclick="confirmation_lien('Voulez-vous Supprimer ce AWB ? ','<?php echo base_url()?>export/export/deleteAwb/<?php echo $data->awb_number?>')"
  class="btn btn-sm btn-warning">
  <i class="ace-icon fa fa-trash bigger-120" aria-hidden="false">Delete</i>
  </a>
  <?php } ?>

        <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="void_awb()">
        <i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
          VOID
        </a>

          

          </div>
          </div>
        </form>

            <div class="col-lg-6 col-md-6 col-xs-12">
              <form class="form-inline" id="fr_add_other_charges" action="<?php echo base_url()?>export/export/add_other_charges" method="POST">
              <div class="form-group">
                <label for="description"></label>
                <input autocomplete="off" type="text" name="description" id="description" size="8%" class="form-control" placeholder="Description" value="" required />
              </div>
              <div class="form-group">
                <label for="amount"></label>
                <input autocomplete="off" type="text" name="amount" id="amount" size="6%" class="form-control" placeholder="Amount" value="" required />
              </div>
              <div class="form-group">
                <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="entitlement"  name="entitlement" value="" required>
                  <option value="">--</option>
                  <?php foreach($entitlement as $row){?>
                  <option value="<?php echo $row->entitlement?>" <?php if($data->rate_class==$row->entitlement) echo " selected"?>><?php echo strtoupper($row->entitlement);?></option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="type_entitlement"  name="type_entitlement"required >
                  <option value="">---</option>
                  <?php foreach($other_charges as $row){?>
                  <option value="<?php echo $row->drescription?>" <?php if($data->rate_class==$row->drescription) echo " selected"?>><?php echo strtoupper($row->code);?></option>
                  <?php }?>
                </select>
              </div>

              <input type="hidden" id="awblnum" name="awblnum" value="<?php echo $data->awb_number;?>" />

              <button class="btn btn-sm btn-primary" type="submit" id="btn_add_other_charges">
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
                    <?php
                    if(count($entitlement2)>0){

                    $r=0;  $totalpieces =0; $vo_weight=0;  $totalvolum =0;foreach($entitlement2 as $row2){$r++;

                      ?>

                    <tr>
                    <td>
                  <input autocomplete="off" type="text" disabled="" name="dim2" id="dim2" size="1%" class="form-control" placeholder="" value="<?php echo $row2->description;?>"/>
                  </td>
                  <td>
                <input autocomplete="off" type="text" disabled="" name="dim2" id="dim2" size="1%" class="form-control" placeholder="" value="<?php echo $row2->amount;?>"/>
                </td>
                <td>
                  <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="entitlement" disabled=""  name="entitlement" value="">
                    <option value="">--</option>
                    <?php foreach($entitlement as $row){?>
                    <option value="<?php echo $row->entitlement?>" <?php if($row2->entitlement==$row->entitlement) echo " selected"?>><?php echo strtoupper($row->entitlement);?></option>
                    <?php }?>
                  </select>
                </td>
                <td>
                  <select class="gwt-ListBox" style="font-size: 11pt; font-family: Consolas, Inconsolata, monospace;"  id="type_entitlement" disabled="" name="type_entitlement" >
                    <option value="">---</option>
                    <?php foreach($other_charges as $row){?>
                    <option value="<?php echo $row->drescription?>" <?php if($row2->type_entitlement==$row->drescription) echo " selected"?>><?php echo strtoupper($row->code);?></option>
                    <?php }?>
                  </select>
                </td>
                <td >
                  <a href="#" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>export/export/delete_other_charges/<?php echo $row2->id;?>/<?php echo $data->awb_number;?>')"
                class="btn btn-xs btn-danger">
                <i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
                </button>

                </td>
                    </tr>
                  <?php } }?>

                  </tbody>
                </table>
              </fieldset>
            </div>


          </div>
          </div>
        <?php }?>
        <script>
        $(function()
        {
          $('#btn_add_awb').on('click',function()
         {

           $(this).html('Please wait ...').attr('disabled','disabled');
           $('#fr_add_awb').submit();

         });

         $('#btn_add_other_charges').on('click',function()
        {

          $(this).html('Please wait ...').attr('disabled','disabled');
          $('#fr_add_other_charges').submit();

        });

       });
      </script>
