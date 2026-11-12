<?php
/*DATA*/
if(isset($_SESSION['droit']['a10']) and $_SESSION['droit']['a10']=="1"  ) {
}else{
  redirect('home/pas_access');
}
foreach($antrepot as $rs){}
foreach($awb_data as $data){}
 $totalagent=0; $totalagent1=0;foreach($entitlement_agent as $row4){
   if($row4->type_entitlement=="prepaid"){
     $totalagent+=$row4->amount;

     $other_pp="X";
   }else {
     $totalagent1+=$row4->amount;
     $other_coll="X";

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

/*--------------------------------*/
/* SHIPPER */
$shipper_account    = $data->account_number_shipper;

$name       = $data->name_shipper;
$adresse    = $data->address_shipper;
$ville      = $data->ville_shipper;
$email      = $data->email_shipper;
$telephone  = $data->tel_shipper;

$shipper  = $name."<br>".$adresse."<br>".$ville."<br>".$email."<br>".$telephone;
/*--------------------*/


/* CONSIGNEE */
$consignee_account    = $data->account_number_consignee;
$name       = $data->name_consignee;
$adresse      = $data->address_consignee;
$ville    = $data->ville_consignee;
$email      = $data->email_consignee;
$telephone  = $data->tel_consignee;

$consignee  = $name."<br>".$adresse."<br>".$ville."<br>".$email."<br>".$telephone;
/*--------------------*/

/*Issuing carrier's agent*/
  $account_number    = $data->account_number_agent;
  $IATA_Code    = $data->iata_code_agent;

  $name       = $data->name_agent;
  $adresse    = $data->adress_agent;
  $ville      = $data->ville_agent;


$carriers_agent  = $name."<br>".$adresse."<br>".$ville;

/*------------------------*/
$awbl1=$data->awb_number;
$awbl = explode("-",$awbl1);
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

$currency= "USD";
$chg=$data->chcg;

if ($data->wt_val=="prepaid") {
  $wt_val_pp="X";
} else {
  $wt_val_c0ll="X";
}

$d_value_carriage=$data->value_for_carriage;
$d_value_customs=$data->value_for_customs;
$airport_of_destination=$data->destination;
$requested_flight=$data->flight;
$requested_date=$data->date_flight;
$amount_of_insurance=$data->amount_of_insurance;
$handling_information=$data->requirements;
$sci=$data->sci;
$no_of_pieces_rep=$totalpieces;
$gross_weight1=$rs->gross_weight;
$gross_weight2=round($lb);
$kg_lb1="KG";
$kg_lb2="LB";
$rate_class=$data->rate_class;
$Commdity_item_no=$data->commdity_item_no;
if ($rs->gross_weight > round($totalvolum)){
$chargeable_weight=round($rs->gross_weight) ;
}else{
$chargeable_weight=round($totalvolum) ;
}
$rate_charge=$data->rate_Charge;
$total1=round($total,2);
$nature_and_quantity_of_goods=$rs->nature_and_quantity;
$no_of_pieces_rep1=round($totalpieces);
$gross_weight3=round($rs->gross_weight);
$total2=round($total,2);

if($data->wt_val=="prepaid"){
  if (round($total,2)=="0") {
    $weight_charge_pp="";
  }else {
    $weight_charge_pp=round($total,2);
 }
}
if ($data->wt_val=="collect"){
  if (round($total,2)=="0") {
    $weight_charge_cc="";
  }else {
    $weight_charge_cc=round($total,2);
 }
}
if($data->wt_val=="prepaid"){
  if ($data->valuation_charge_pp=="0") {
    $valuation_charge_pp="";
  }else {
    $valuation_charge_pp=$data->valuation_charge_pp;
 }
}
if ($data->wt_val=="collect"){
  if ($data->valuation_charge_pp=="0") {
    $valuation_charge_cc="";
  }else {
    $valuation_charge_cc=$data->valuation_charge_pp;
 }
}
if($data->wt_val=="prepaid"){
  if ($data->tax_pp=="0") {
  $tax_pp="";
  }else {
  $tax_pp=$data->tax_pp;
 }

}
if ($data->wt_val=="collect"){
  if ($data->tax_pp=="0") {
  $tax_cc="";
  }else {
  $tax_cc=$data->tax_pp;
 }
}
if ($totalagent=="0") {
$other_charges_due_agent_pp="";
}else {
  $other_charges_due_agent_pp=$totalagent;
}
if ($totalagent1=="0") {
$other_charges_due_agent_cc="";
}else {
  $other_charges_due_agent_cc=$totalagent1;
}
if ($totalcarrier=="0") {
$other_charges_due_carrier_pp="";
}else {
  $other_charges_due_carrier_pp=$totalcarrier;
}
if ($totalcarrier1=="0") {
$other_charges_due_carrier_cc="";
}else {
  $other_charges_due_carrier_cc=$totalcarrier1;
}
if (round($weight_charge_pp+$totalagent+$totalcarrier,2)=="0") {
$total_pp="";
}else {
  $total_pp=round($weight_charge_pp+$totalagent+$totalcarrier+$tax_pp+$valuation_charge_pp,2);
}
if (round($weight_charge_cc+$totalagent1+$totalcarrier1,2)=="0") {
$total_cc="";
}else {
  $total_cc=round($weight_charge_cc+$totalagent1+$totalcarrier1+$tax_cc+$valuation_charge_cc,2);
}
if(count($entitlement2)>0){

$rs=0;  foreach($entitlement2 as $row2){$rs++;
$other_charges .=$row2->description."&nbsp;".$row2->amount. "; " ;
}
}


/*---------------------------*/

$style = "<style>
div{
font-family:courier;
}

.shipper{
position: absolute;
top: 53px;
left: 45px;
font-size:13px;
width: 330px;
}

.shipper_account{
position: absolute;
top: 40px;
left: 270px;
font-size:13px;
}

.consignee{
position: absolute;
top: 147px;
left: 45px;
font-size:13px;
width: 330px;
}

.consignee_account{
position: absolute;
top: 135px;
left: 270px;
font-size:13px;


}

.account_number{
position: absolute;
top: 293px;
left: 220px;
font-size:13px;
}

.iata_code{
position: absolute;
top: 293px;
left: 45px;
font-size:13px;
}

.carriers_agent{
position: absolute;
top: 230px;
left: 45px;
font-size:13px;
width: 330px;

}

.awbl{
position: absolute;
top: 10px;
left: 45px;
}

.awbl_1{
position: absolute;
top: 10px;
left: 45px;
font-size:14px;
}

.awbl_2{
position: absolute;
top: 10px;
left: 120px;
font-size:14px;
}

.awbl_3{
position: absolute;
top: 0px;
left: 520px;
font-weight:bold;
font-size:30px;
}
.issued_by{
  position: absolute;
  top: 45px;
  left: 500px;
  font-weight:bold;
  font-size:30px;
}
.account_information{
position: absolute;
top: 230px;
left: 385px;
font-size:13px;
width: 347px;
}

.airport_of_departure{
position: absolute;
top: 325px;
left: 45px;
font-size:13px;
width: 330px;
}

.optional_info{
position: absolute;
font-size:13px;
text-align: center;
}

.optional_info1{
top: 325px;
left: 385px;
width: 125px;
}

.optional_info2{
top: 325px;
left: 515px;
width: 110px;
}

.optional_info3{
top: 325px;
left: 630px;
width: 110px;
}

.to_1{
position: absolute;
top: 352px;
left: 45px;
font-size:13px;
width: 30px;
}

.by_1{
position: absolute;
top: 352px;
left: 80px;
font-size:13px;
width: 165px;
text-align: center;
}

.to_2{
position: absolute;
top: 352px;
left: 180px;
font-size:13px;
width: 165px;
text-align: center;
}


.by_2{
position: absolute;
top: 352px;
left: 220px;
font-size:13px;
width: 165px;
text-align: center;
}

.to_3{
position: absolute;
top: 352px;
left: 247px;
font-size:13px;
width: 165px;
text-align: center;
}

.by_3{
position: absolute;
top: 352px;
left: 283px;
font-size:13px;
width: 165px;
text-align: center;
}

.currency{
position: absolute;
top: 352px;
left: 320px;
font-size:13px;
width: 165px;
text-align: center;
}

.chg{
position: absolute;
top: 352px;
left: 347px;
font-size:13px;
width: 165px;
text-align: center;
}

.wt_val_pp{
position: absolute;
top: 354px;
left: 365px;
font-size:13px;
width: 165px;
text-align: center;
}

.wt_val_coll{
position: absolute;
top: 354px;
left: 383px;
font-size:13px;
width: 165px;
text-align: center;
}

.other_pp{
position: absolute;
top: 354px;
left: 403px;
font-size:13px;
width: 165px;
text-align: center;
}

.other_coll{
position: absolute;
top: 354px;
left: 423px;
font-size:13px;
width: 165px;
text-align: center;
}

.d_value_carriage{
position: absolute;
top: 352px;
left: 486px;
font-size:13px;
width: 165px;
text-align: center;
}

.d_value_customs{
position: absolute;
top: 354px;
left: 600px;
font-size:13px;
text-align: center;
}

.airport_of_destination{
position: absolute;
top: 387px;
left: 45px;
font-size:13px;
text-align: center;
}

.requested_flight{
position: absolute;
top: 387px;
left: 220px;
font-size:13px;
text-align: center;
}

.requested_date{
position: absolute;
top: 387px;
left: 300px;
font-size:13px;
text-align: center;
}

.amount_of_insurance{
position: absolute;
top: 387px;
left: 380px;
font-size:13px;
}

.handling_information{
position: absolute;
top: 420px;
left: 45px;
font-size:13px;
width: 570px;

}

.sci{
position: absolute;
top: 450px;
left: 600px;
font-size:13px;

}
.no_of_pieces_rep{
  position: absolute;
  top: 504px;
  left: 45px;
  font-size:13px;
  text-align: center;
}
.gross_weight1{
  position: absolute;
  top: 504px;
  left: 80px;
  font-size:13px;
  text-align: center;
}
.gross_weight2{
  position: absolute;
  top: 520px;
  left: 80px;
  font-size:13px;
  text-align: center;
}
.kg_lb1{
  position: absolute;
  top: 504px;
  left: 142px;
  font-size:13px;
  text-align: center;
}
.kg_lb2{
  position: absolute;
  top: 520px;
  left: 142px;
  font-size:13px;
  text-align: center;
}
.rate_class{
  position: absolute;
  top: 504px;
  left: 163px;
  font-size:13px;
  text-align: center;
}
.Commdity_item_no{
  position: absolute;
  top: 504px;
  left: 183px;
  font-size:13px;
  text-align: center;
}
.chargeable_weight{
  position: absolute;
  top: 504px;
  left: 259px;
  font-size:13px;
  text-align: center;
}
.rate_charge{
  position: absolute;
  top: 504px;
  left: 333px;
  font-size:13px;
  text-align: center;
}
.total1{
  position: absolute;
  top: 504px;
  left: 420px;
  font-size:13px;
  text-align: center;
}
.nature_and_quantity_of_goods{
  position: absolute;
  top: 504px;
  left: 540px;
  font-size:13px;
  width: 190px;
}

.no_of_pieces_rep1{
  position: absolute;
  top: 703px;
  left: 45px;
  font-size:13px;
  text-align: center;
}
.gross_weight3{
  position: absolute;
  top: 703px;
  left: 80px;
  font-size:13px;
  text-align: center;
}
.total2{
  position: absolute;
  top: 703px;
  left: 420px;
  font-size:13px;
  text-align: center;
}
.weight_charge_pp{
  position: absolute;
  top: 736px;
  left: 50px;
  font-size:13px;
  text-align: center;
}
.weight_charge_cc{
  position: absolute;
  top: 736px;
  left: 185px;
  font-size:13px;
  text-align: center;
}
.valuation_charge_pp{
  position: absolute;
  top: 766px;
  left: 50px;
  font-size:13px;
  text-align: center;
}
.valuation_charge_cc{
  position: absolute;
  top: 766px;
  left: 185px;
  font-size:13px;
  text-align: center;
}
.tax_pp{
  position: absolute;
  top: 796px;
  left: 50px;
  font-size:13px;
  text-align: center;
}
.tax_cc{
  position: absolute;
  top: 796px;
  left: 185px;
  font-size:13px;
  text-align: center;
}
.other_charges_due_agent_pp{
  position: absolute;
  top: 829px;
  left: 50px;
  font-size:13px;
  text-align: center;
}
.other_charges_due_agent_cc{
  position: absolute;
  top: 829px;
  left: 185px;
  font-size:13px;
  text-align: center;
}
.other_charges_due_carrier_pp{
  position: absolute;
  top: 863px;
  left: 50px;
  font-size:13px;
  text-align: center;
}
.other_charges_due_carrier_cc{
  position: absolute;
  top: 863px;
  left: 185px;
  font-size:13px;
  text-align: center;
}
.total_pp{
  position: absolute;
  top: 927px;
  left: 50px;
  font-size:13px;
  text-align: center;
}
.total_cc{
  position: absolute;
  top: 927px;
  left: 185px;
  font-size:13px;
  text-align: center;
}
.other_charges{
  position: absolute;
  top: 732px;
  left: 307px;
  font-size:13px;
  width: 425px;
}
.foot{
text-align: right;
}



</style>";

$content = "
".$style."
<page backimg=\"".base_url()."assets/images/awb.png\" backtop=\"0mm\" backbottom=\"0mm\" backleft=\"0mm\" backright=\"0mm\">

  <div class=\"awbl awbl_1\">
  ".$awbl[0]."- PAP
  </div>

  <div class=\"awbl awbl_2\">
  ".$awbl[1]."
  </div>

    <div class=\"awbl awbl_3\">
    ".$awbl1."
    </div>
    <div class=\"issued_by\">
    ".$issued_by."
    </div>
  <div class=\"shipper_account\">
  ".$shipper_account."
  </div>

  <div class=\"consignee_account\">
  ".$consignee_account."
  </div>

  <div class=\"shipper\">
  ".$shipper."
  </div>

  <div class=\"consignee\">
  ".$consignee."
  </div>

  <div class=\"account_number\">
  ".$account_number."
  </div>

  <div class=\"iata_code\">
  ".$IATA_Code."
  </div>

  <div class=\"carriers_agent\">
  ".$carriers_agent."
  </div>

  <div class=\"account_information\">
  ".$account_information."
  </div>

  <div class=\"airport_of_departure\">
  ".$airport_of_departure."
  </div>

  <div class=\"optional_info optional_info1\">
  ".$optional_info1."
  </div>

  <div class=\"optional_info optional_info2\">
  ".$optional_info2."
  </div>

  <div class=\"optional_info optional_info3\">
  ".$optional_info3."
  </div>


  <div class=\"to_1\">
  ".$to_1."
  </div>
  <div class=\"by_1\">
  ".$by_1."
  </div>
  <div class=\"to_2\">
  ".$to_2."
  </div>
  <div class=\"by_2\">
  ".$by_2."
  </div>
  <div class=\"to_3\">
  ".$to_3."
  </div>
  <div class=\"by_3\">
  ".$by_3."
  </div>
  <div class=\"currency\">
  ".$currency."
  </div>
  <div class=\"chg\">
  ".$chg."
  </div>
  <div class=\"wt_val_pp\">
  ".$wt_val_pp."
  </div>
  <div class=\"wt_val_coll\">
  ".$wt_val_c0ll."
  </div>
  <div class=\"other_pp\">
  ".$other_pp."
  </div>
  <div class=\"other_coll\">
  ".$other_coll."
  </div>
  <div class=\"d_value_carriage\">
  ".$d_value_carriage."
  </div>
  <div class=\"d_value_customs\">
  ".$d_value_customs."
  </div>
  <div class=\"airport_of_destination\">
  ".$airport_of_destination."
  </div>
  <div class=\"requested_flight\">
  ".$requested_flight."
  </div>
  <div class=\"requested_date\">
  ".$requested_date."
  </div>
  <div class=\"amount_of_insurance\">
  ".$amount_of_insurance."
  </div>
  <div class=\"handling_information\">
  ".$handling_information."
  </div>
  <div class=\"sci\">
  ".$sci."
  </div>
  <div class=\"no_of_pieces_rep\">
  ".$no_of_pieces_rep."
  </div>
  <div class=\"gross_weight1\">
  ".$gross_weight1."
  </div>
  <div class=\"gross_weight2\">
  ".$gross_weight2."
  </div>
  <div class=\"kg_lb1\">
  ".$kg_lb1."
  </div>
  <div class=\"kg_lb2\">
  ".$kg_lb2."
  </div>
  <div class=\"rate_class\">
  ".$rate_class."
  </div>
  <div class=\"Commdity_item_no\">
  ".$Commdity_item_no."
  </div>
  <div class=\"chargeable_weight\">
  ".$chargeable_weight."
  </div>
  <div class=\"rate_charge\">
  ".$rate_charge."
  </div>
  <div class=\"total1\">
  ".$total1."
  </div>
  <div class=\"nature_and_quantity_of_goods\">
  ".$nature_and_quantity_of_goods."
  </div>
  <div class=\"no_of_pieces_rep1\">
  ".$no_of_pieces_rep1."
  </div>
  <div class=\"gross_weight3\">
  ".$gross_weight3."
  </div>
  <div class=\"total2\">
  ".$total2."
  </div>
  <div class=\"weight_charge_pp\">
  ".$weight_charge_pp."
  </div>
  <div class=\"weight_charge_cc\">
  ".$weight_charge_cc."
  </div>
  <div class=\"valuation_charge_pp\">
  ".$valuation_charge_pp."
  </div>
  <div class=\"valuation_charge_cc\">
  ".$valuation_charge_cc."
  </div>
  <div class=\"tax_pp\">
  ".$tax_pp."
  </div>
  <div class=\"tax_cc\">
  ".$tax_cc."
  </div>
  <div class=\"other_charges_due_agent_pp\">
  ".$other_charges_due_agent_pp."
  </div>
  <div class=\"other_charges_due_agent_cc\">
  ".$other_charges_due_agent_cc."
  </div>
  <div class=\"other_charges_due_carrier_pp\">
  ".$other_charges_due_carrier_pp."
  </div>
  <div class=\"other_charges_due_carrier_cc\">
  ".$other_charges_due_carrier_cc."
  </div>
  <div class=\"total_pp\">
  ".$total_pp."
  </div>
  <div class=\"total_cc\">
  ".$total_cc."
  </div>
  <div class=\"other_charges\">
  ".trim($other_charges, ";")."
  </div>
<page_footer class=\"foot\">
copy [[page_cu]]/[[page_nb]] </page_footer>
</page>";


    $html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
    $html2pdf->WriteHTML($content.$content.$content.$content);
    $html2pdf->Output();
?>
