<?php
$totalusd=0;
$totalhtg=0;
$totalfacusd=0;
$totalfachtg=0;
$totaldueusd=0;
$totalduehtg=0;
foreach($lesdepots as $row){}
$datecomp = $row->droitdepot;
	$datedepot ="";
	$datelivre = "";
	$resul = "";
	$calcul_date = "";
	
$content = "
<style>
table {
border-collapse: collapse;
font-size:12px;
}

table {
border: 1px solid black;
padding:3px;
}
 th, td {
border: 1px solid black;
padding:3px;
}
.color{
background-color:#F5F5F5;
}
.color2{
background-color:#B0C4DE;
}
.span1{
font-size: 25px;
font-weight: bold;
font-style: italic;
}
.b{font-weight: bold;}
.color4{
    background-color:#cdedb5;
    }
    .color5{
      background-color:#f7e5e5;
      }
.span2{
font-size: 15px;
font-weight: bold;
font-style: italic;
text-align: center;
}
.p3{
font-size: 15px;
font-weight: bold;
font-style: italic;
}
.size_txt{
font-size: 15px;

}
.width10{
	width: 140px;}
</style>
<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"10mm\" backright=\"2mm\" footer=\"page\">
<span class='span1'>MESDHASA</span><br/>
<span class='span2'>Storage Fees</span><br/>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3))." ".au." ".dateVersChainetext($this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6))."<br/><br/> </p></span>
<table>
<thead>
<tr>
<th align='center'></th>
<th align='center'>Date Arrival</th>
<th align='center'>Airbill N0</th>
<th align='center'>Origin</th>
<th align='center'>Date notication</th>
<th align='center'>Consignee</th>
<th align='center'>Weight (Kg)</th>
<th align='center'>Weight (Lb)</th>
<th align='center'>Storage Rate</th>
<th align='center'>Code</th>
<th align='center'>Paid Date</th>
<th align='center'>Total Days</th>
<th align='center'>Due Days</th>
<th align='center'>Amt Due</th>
<th align='center'>Amt Fac</th>
<th align='center'>Amt Paid</th>
<th align='center'>Currency</th>
</tr>
</thead>
<tbody>";
if(count($lesdepots)>0){
	$g=0;foreach ($lesdepots as $res) {$g++;
	switch(true){

				  case ($res->datenotification !="0000-00-00" && $res->datelivre =="NULL" or $res->datenotification !="" && $res->datelivre ==""):
				  $datedepot = diff_date($res->datenotification,$this->session->ladate);
				  break;

				  case ($res->datenotification !="0000-00-00" && $res->datelivre !="NULL" or $res->datenotification !="" && $res->datelivre !=""):
				  $datedepot = diff_date($res->datenotification,$res->datelivre);
				  break;



				  default:
				  break;
	}
	switch(true){



				  case ($res->datenotification =="0000-00-00" && $res->datelivre !="NULL" or $res->datenotification =="" && $res->datelivre !=""):
				  $datedepot = '0';
				  break;

				  case ($res->datenotification =="0000-00-00" && $res->datelivre =="NULL" or$res->datenotification =="" && $res->datelivre ==""):
				  $datedepot ='0';
				  break;

				  default:
				  break;
	}
	$total_poids = 0;
	$result = $this->Parser->get_degroupage($res->awb);
	if(count($result)>0){
	foreach($result as $r){
	$total_poids += $r->poids;
	}
}
	$restant=$res->weight* 2.20462-$total_poids;
	if ($datedepot > $datecomp){
		$calcul_date=$datedepot-$datecomp;
$resul = $calcul_date*$row->prix_lbs*$restant;
if ($resul<10) $resul = 10;
$code="";
if($res->prepaid=="1"){
	$code="PX";
}
if($res->collect=="1"){
	$code="CP";
}
if($res->nocharge=="1"){
	$code="NC";
}
$content .= "<tr  class=\"color\" >
<td  align='center'>".$g."</td>
<td align='center'>".dateVersChainetext($res->Date_of_arrival)."</td>
<td align='center'>".$res->awb."</td>
<td align='center'>".$res->Place_of_departure_code."</td>
<td align='center'>".dateVersChainetext($res->datenotification)."</td>
<td class='width10' align='center'>".$res->consignee."</td>
<td align='center'>".$res->weight."</td>
<td align='center'>".$restant."</td>
<td align='center'>".round($row->prix_lbs,2)."</td>
<td align='center'>".$code."</td>
<td align='center'>".dateVersChainetext($res->date_hc)."</td>
<td align='center'>".$datedepot."</td>
<td align='center'>".$calcul_date."</td>
<td align='center'>".round($resul,2) ."</td>
<td align='center'>".$res->montant_hc1."</td>
<td align='center'>".$res->montant_hc."</td>
<td align='center'>".$res->monnaie."</td>

</tr>";
if($res->monnaie=="USD"){
	$totalusd+=$res->montant_hc;
	$totalfacusd+=$res->montant_hc1;
	$totaldueusd+=round($resul,2);

}
if($res->monnaie=="HTG"){
	$totalhtg+=$res->montant_hc;
	$totalfachtg+=$res->montant_hc1;
	$totalduehtg+=round($resul,2);
}

		}
	}
}


if($res->monnaie=="USD"){

$content .= "<tr  class=\"color4\" >
<td  class=\"color4 b\" colspan='13' align='right'>Total </td>
<td class=\"color4\" align='center'>".$totaldueusd."</td>
<td class=\"color4\" align='center'>".$totalfacusd."</td>
<td class=\"color4\" align='center' >".$totalusd."</td>
<td class=\"color4\" align='center'>USD</td>
</tr>";
}
if($res->monnaie=="HTG"){
	
$content .= "<tr  class=\"color5\" >
<td  class=\"color5 b\" colspan='13' align='right'>Total </td>
<td class=\"color4\" align='center'>".$totalduehtg."</td>
<td class=\"color4\" align='center'>".$totalfachtg."</td>
<td class=\"color4\" align='center' >".$totalhtg."</td>
<td class=\"color5\" align='center'>HTG</td>
</tr>";
}
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('L','Legal','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
