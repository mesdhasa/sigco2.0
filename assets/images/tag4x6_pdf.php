<?php

/*DATA*/

if (isset($_SESSION['droit']['a10']) and $_SESSION['droit']['a10'] == "1") {
} else {
  redirect('home/pas_access');
}
foreach ($antrepot as $rs) {
}
foreach ($awb_data as $data) {
}
$totalagent = 0;
$totalagent1 = 0;
foreach ($entitlement_agent as $row4) {
  if ($row4->type_entitlement == "prepaid") {
    $totalagent += $row4->amount;

    $other_pp = "X";
  } else {
    $totalagent1 += $row4->amount;
    $other_coll = "X";
  }
}
$totalcarrier = 0;
$totalcarrier1 = 0;
foreach ($entitlement_carrier as $row5) {
  if ($row5->type_entitlement == "prepaid") {
    $totalcarrier += $row5->amount;
  } else {
    $totalcarrier1 += $row5->amount;
  }
}
if (count($antrepot2) > 0) {

  $r = 0;
  $totalpieces = 0;
  $total = 0;
  $vo_weight = 0;
  $lb = 0;
  $totalvolum = 0;
  foreach ($antrepot2 as $row) {
    $r++;
    $t1 = round($row->dim1) * round($row->dim2) * round($row->dim3);
    $t2 = $t1 * $row->no_pieces;
    $vo_weight = $t2 / 366;
    $totalpieces += $row->no_pieces;

    $totalvolum += $vo_weight;
    $lb = $rs->gross_weight * 2.20462;


    if ($rs->gross_weight > round($totalvolum)) {
      $total = $data->rate_Charge * $rs->gross_weight;
    } else {
      $total = $data->rate_Charge * $totalvolum;
    }
  }
}

/*--------------------------------*/
/* SHIPPER */
$shipper_account    = $data->account_number_shipper;

$name       = $data->name_shipper;
$adresse    = $data->address_shipper;
$ville      = $data->ville_shipper;
$email      = $data->email_shipper;
$telephone  = $data->tel_shipper;

$shipper  = $name . "<br>" . $adresse . "<br>" . $ville . "<br>" . $email . "<br>" . $telephone;
/*--------------------*/


/* CONSIGNEE */
$consignee_account    = $data->account_number_consignee;
$name       = $data->name_consignee;
$adresse      = $data->address_consignee;
$ville    = $data->ville_consignee;
$email      = $data->email_consignee;
$telephone  = $data->tel_consignee;

$consignee  = $name . "<br>" . $adresse . "<br>" . $ville . "<br>" . $email . "<br>" . $telephone;
/*--------------------*/

/*Issuing carrier's agent*/
$account_number    = $data->account_number_agent;
$IATA_Code    = $data->iata_code_agent;

$name       = $data->name_agent;
$adresse    = $data->adress_agent;
$ville      = $data->ville_agent;


$carriers_agent  = $name . "<br>" . $adresse . "<br>" . $ville;

/*------------------------*/
$awbl1 = $data->awb_number;
$awbl = explode("-", $awbl1);
$issued_by = $rs->compagnie;

$account_information = $data->accounting_information;

$airport_of_departure = "PORT-AU-PRINCE HAITI INTE";

$optional_info1 = $data->reference_number;
$optional_info2 = $data->information1;
$optional_info3 = $data->information2;

$to_1 = $data->route_to1;
$by_1 = $data->route_first_carrier;

$to_2 = $data->route_to2;
$by_2 = $data->route_by1;

$to_3 = $data->route_to3;
$by_3 = $data->route_by2;

$currency = "USD";
$chg = $data->chcg;

if ($data->wt_val == "prepaid") {
  $wt_val_pp = "X";
} else {
  $wt_val_c0ll = "X";
}

$d_value_carriage = $data->value_for_carriage;
$d_value_customs = $data->value_for_customs;
$airport_of_destination = $data->destination;
$requested_flight = $data->flight;
$requested_date = $data->date_flight;
$amount_of_insurance = $data->amount_of_insurance;
$handling_information = $data->requirements;
$sci = $data->sci;
$no_of_pieces_rep = $totalpieces;
$gross_weight1 = $rs->gross_weight;
$gross_weight2 = round($lb);
$kg_lb1 = "KG";
$kg_lb2 = "LB";
$rate_class = $data->rate_class;
$Commdity_item_no = $data->commdity_item_no;
if ($rs->gross_weight > round($totalvolum)) {
  $chargeable_weight = round($rs->gross_weight);
} else {
  $chargeable_weight = round($totalvolum);
}
$rate_charge = $data->rate_Charge;
$total1 = round($total, 2);
$nature_and_quantity_of_goods = $rs->nature_and_quantity;
$no_of_pieces_rep1 = round($totalpieces);
$gross_weight3 = round($rs->gross_weight);
$total2 = round($total, 2);

if ($data->wt_val == "prepaid") {
  if (round($total, 2) == "0") {
    $weight_charge_pp = "";
  } else {
    $weight_charge_pp = round($total, 2);
  }
}
if ($data->wt_val == "collect") {
  if (round($total, 2) == "0") {
    $weight_charge_cc = "";
  } else {
    $weight_charge_cc = round($total, 2);
  }
}
if ($data->wt_val == "prepaid") {
  if ($data->valuation_charge_pp == "0") {
    $valuation_charge_pp = "";
  } else {
    $valuation_charge_pp = $data->valuation_charge_pp;
  }
}
if ($data->wt_val == "collect") {
  if ($data->valuation_charge_pp == "0") {
    $valuation_charge_cc = "";
  } else {
    $valuation_charge_cc = $data->valuation_charge_pp;
  }
}
if ($data->wt_val == "prepaid") {
  if ($data->tax_pp == "0") {
    $tax_pp = "";
  } else {
    $tax_pp = $data->tax_pp;
  }
}
if ($data->wt_val == "collect") {
  if ($data->tax_pp == "0") {
    $tax_cc = "";
  } else {
    $tax_cc = $data->tax_pp;
  }
}
if ($totalagent == "0") {
  $other_charges_due_agent_pp = "";
} else {
  $other_charges_due_agent_pp = $totalagent;
}
if ($totalagent1 == "0") {
  $other_charges_due_agent_cc = "";
} else {
  $other_charges_due_agent_cc = $totalagent1;
}
if ($totalcarrier == "0") {
  $other_charges_due_carrier_pp = "";
} else {
  $other_charges_due_carrier_pp = $totalcarrier;
}
if ($totalcarrier1 == "0") {
  $other_charges_due_carrier_cc = "";
} else {
  $other_charges_due_carrier_cc = $totalcarrier1;
}
if (round($weight_charge_pp + $totalagent + $totalcarrier, 2) == "0") {
  $total_pp = "";
} else {
  $total_pp = round($weight_charge_pp + $totalagent + $totalcarrier + $tax_pp + $valuation_charge_pp, 2);
}
if (round($weight_charge_cc + $totalagent1 + $totalcarrier1, 2) == "0") {
  $total_cc = "";
} else {
  $total_cc = round($weight_charge_cc + $totalagent1 + $totalcarrier1 + $tax_cc + $valuation_charge_cc, 2);
}
if (count($entitlement2) > 0) {

  $rs = 0;
  foreach ($entitlement2 as $row2) {
    $rs++;
    $other_charges .= $row2->description . "&nbsp;" . $row2->amount . "; ";
  }
}
$date = date('Y-m-d');
$newdate = date("d-M", strtotime($date));
$date2 = date($requested_date);
$newdate2 = date("d-M", strtotime($date2));

// if(ISSET($_POST['generate'])){
//   $code="810-239485140001";
//   echo "<center><img alt='testing' src='barcode.php?codetype=Code128&size=50&text=".$code."&print=false'/></center>";
// }
$code = "810-239485140001";

$bar = base_url() . "application/views/pdf/export/barcode.php?codetype=Code128&size=50&text=" . $code . "&print=false";






/*---------------------------*/

$style = "<style>
img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 83%;
  height: 14px;
}
.codebar{

  position: absolute;
  padding:0px;
  margin:44px;
  margin-top:21px;
  }
.div1{
position: absolute;
padding:0px;
margin:92px;
font-size:6px;
margin-top:6px;
}
.div2{
position: absolute;
padding:0px;
margin:33px;
font-size:9px;
margin-top:60px;
}

.div3{
position: absolute;
padding:0px;
margin:68px;
font-weight:bold;
font-size:17px;
margin-top:55px;
}
.div4{
position: absolute;
padding:0px;
margin:162px;
font-size:7px;
margin-top:60px;
}
.div5{
position: absolute;
padding:0px;
margin:30px;
font-weight:bold;
font-size:17px;
margin-top:103px;
}
.div6{
position: absolute;
padding:0px;
margin:142px;
font-weight:bold;
font-size:10px;
margin-top:98px;
}
.div7{
position: absolute;
padding:0px;
margin:41px;
font-weight:bold;
font-size:9px;
margin-top:157px;
}

.div8{
position: absolute;
padding:0px;
margin:149px;
min-width: 5px;
font-weight:bold;
font-size:7px;
margin-top:156px;
}
.div9{
position: absolute;
padding:0px;
margin:149px;
font-weight:bold;
font-size:7px;
margin-top:169px;
}
.div10{
position: absolute;
padding:0px;
margin:57px;
font-weight:bold;
font-size:7px;
margin-top:192px;
}
.div11{
position: absolute;
padding:0px;
margin:96px;
font-weight:bold;
font-size:7px;
margin-top:192px;
}
.div12{
position: absolute;
padding:0px;
margin:116px;
font-weight:bold;
font-size:7px;
margin-top:192px;
}
.div13{
position: absolute;
padding:0px;
margin:57px;
font-weight:bold;
font-size:7px;
margin-top:202px;
}
.div14{
position: absolute;
padding:0px;
margin:96px;
font-weight:bold;
font-size:7px;
margin-top:202px;
}
.div15{
position: absolute;
padding:0px;
margin:116px;
font-weight:bold;
font-size:7px;
margin-top:202px;
}
.div16{
  position: absolute;
  padding:0px;
  margin:145px;
  font-weight:bold;
  font-size:7px;
  margin-top:225px;
  }

</style>";
for ($x = 1; $x <= $no_of_pieces_rep; $x++) {
}
$content .= "
" . $style . "
<page backimg=\"" . base_url() . "assets/images/LABELFORM.png\" backtop=\"0mm\" backbottom=\"0mm\" backleft=\"0mm\" backright=\"0mm\">
<div class=\"div1\">
$newdate
</div> ";
$content .= "
<div class=\"codebar\">


<img src=\"" . base_url() . "assets/images/cb.php?code=810-642302350001 \" />

</div>";
$content .= "
<div class=\"div2\">
PAP
</div>
<div class=\"div3\">
$awbl[1]
</div>
<div class=\"div4\">
$newdate
</div>
<div class=\"div5\">
$to_1
</div>
<div class=\"div6\">
$Commdity_item_no
</div>

";
$content .= "
<div class=\"div7\">
$x of $no_of_pieces_rep
</div>
";
$content .= "
<div class=\"div8\">
$gross_weight1 K
</div>
<div class=\"div9\">
$gross_weight2 L
</div>
<div class=\"div10\">
PAP - $to_1
</div>
<div class=\"div11\">
$by_1
</div>
<div class=\"div12\">
$requested_flight $newdate2
</div>
<div class=\"div13\">
  $to_1 - $to_2  
</div>
<div class=\"div14\">
$by_2
</div>
<div class=\"div15\">

</div>
<div class=\"div16\">
$Commdity_item_no
</div>
<page_footer class=\"foot\">
</page_footer>
</page>";

$html2pdf = new HTML2PDF('P', array(86, 54), 'fr', false, 'ISO-8859-15', array(0, 3, 0, 0));
$html2pdf->pdf->SetTitle('Tag');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
