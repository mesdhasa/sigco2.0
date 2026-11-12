<?php
foreach($lesdepots as $row){}
foreach($awb as $row2){}
  $total_poids = 0;
  $res = $this->Parser->get_degroupage($row->awb);
  if(count($res)>0){
  foreach($res as $r){
  $total_poids += $r->poids;
  }
  }
  $datecomp = $row->droitdepot;
  $datedepot ="";
  $datelivre = "";
  $resul = "";
  $restant=$row->weight-$total_poids;

  switch(true){

                case ($row->datenotification !="0000-00-00" && $row->datelivre =="NULL" or $row->datenotification !="" && $row->datelivre ==""):
                $datedepot = diff_date($row->datenotification,$this->session->ladate);
                break;

                case ($row->datenotification !="0000-00-00" && $row->datelivre !="NULL" or $row->datenotification !="" && $row->datelivre !=""):
                $datedepot = diff_date($row->datenotification,$row->datelivre);
                break;



                default:
                break;
  }
  switch(true){



                case ($row->datenotification =="0000-00-00" && $row->datelivre !="NULL" or $row->datenotification =="" && $row->datelivre !=""):
                $datedepot = '0';
                break;

                case ($row->datenotification =="0000-00-00" && $row->datelivre =="NULL" or $row->datenotification =="" && $row->datelivre ==""):
                $datedepot ='0';
                break;

                default:
                break;
  }
  if($row->datelivre!="" or $row->datelivre!="NULL"){
  $dateariv= diff_date($row->Date_of_arrival,$row->datelivre);
}else{
  $dateariv= diff_date($row->Date_of_arrival,$this->session->ladate);

}
if ($datedepot > $datecomp){
  $resul = $datedepot *$row->prix_lbs*$restant;
  if ($resul<10) $resul = 10;
}
$style="<style>
table {
    border-collapse: collapse;
	    display: table; /* check so these really applies */
    width: 100%;
}
.td1{
	width:20%;
}
.td2{
	width:60%;

}
.td3{

  border-style: solid;
  border-width: 0px 0px 1px 0px;
}
.td4{
  border-style: solid;
  border-width: 1px 1px 1px 1px;
}
.td5{
  border-style: solid;
  border-width: 1px 1px 0px 1px;
}
.mes_p{
	margin:0px;
	padding:0px;
}
.mes_p1{
	margin:0px;
  padding-left: 140px;
}
.mes_p2{
  padding-left: 80px;
  margin-top:5px;
}
.mes_p3{
	margin:5px;
  padding-left: 85px;
}
.mes_p4{
	margin:0px;
  padding-left: 10px;
}
.mes_p5{
	margin:5px;
  padding-left: 95px;
}
.mes_p6{
	margin-top:0px;
  padding-left: 160px;
}
.mes_p7{
  margin-top:0px;
	margin-left:200px;
}
.span1{
  margin-top:0px;
	margin-left:20px;
  display: block;
  text-decoration-style: dotted;
}
.mes_p8{
	margin-top:0px;
}
table, th {
    border: 1px solid black;
	border-width:1px;
}
td, th{
	padding:4px;
	font-size: 11px;
	text-align:left;
}

.blank{
	border-left:0px;
	border-bottom:0px;
	border-top: 0px;
	border-right:0px;
}



.mes_p{
	margin:0px;
	padding:5px;
}
</style>";
{
  if ($row2->nobuil="") {
    $awb2="";
  } else {
    $awb2="$row2->idbuil";
  }

$partie_001 = "
<table>
	<tr>
		<td class='td1'></td>
		<td class='td2'></td>
		<td class='td1'></td>
	</tr>

  <tr>
		<td ><p class='mes_p'></p></td>
		<td ><p class='mes_p6'>Amerijet International -PAP</p></td>
		<td class=''></td>
	</tr>
  <tr>
    <td colspan='2'class='td3' ><p class='mes_p8'>Storage Fee Payment Maintenance<span class='mes_p7'>PA/</span></p>
    </td>
    <td class='td3'></td>
  </tr>

  <tr>
		<td colspan='2'><p class='mes_p'>1. Station :  </p></td>
		<td class=''>".$row->Place_of_destination_code."</td>
	</tr>
  <tr>
    <td colspan='2' ><p class='mes_p'>2. Airbill :</p></td>
    <td class=''>".$row->awb."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>3.Storage Rate: </p></td>
    <td class=''>".round($row->prix_lbs,2)."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>4. Total days:</p></td>
    <td class=''>".$dateariv."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>5. Days Due: </p></td>
    <td class=''>".$datedepot."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>6. Weight:</p></td>
    <td class=''>".$restant."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>7. Storage Due:</p></td>
    <td class=''>".round($row->apayer,2)."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>8.Discount:</p></td>
    <td class=''>".round($row->rabais,2)."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>9. Storage Paid:</p></td>
    <td class=''>".round($row->montant_hc,2)."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>10. Payment Date:</p></td>
    <td class=''>".dateVersChainetext($row->date_hc)."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>11.  Payment Received By:</p></td>
    <td class=''>".$row->received."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>12.Credit (Y/N)</p></td>
    <td class=''></td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>13. House Airbill</p></td>
    <td class=''>".$awb2."</td>
  </tr>
  <tr>
    <td colspan='2'><p class='mes_p'>14. Consignee:</p></td>
    <td class=''>".$row->consignee."</td>
  </tr>



</table>";
}
$content = "
".$style."
<page backtop=\"20mm\" backbottom=\"10mm\" backleft=\"10mm\" backright=\"10mm\">

".$partie_001."

</page>";
    $html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output();
?>
