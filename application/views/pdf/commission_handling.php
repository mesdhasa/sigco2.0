<?php

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
font-weight: bold;
}
.color1{
background-color:rgb(240, 176, 176);
font-weight: bold;
}
.span1{
font-size: 25px;
font-weight: bold;
font-style: italic;
}
.width9{
   width: 100px;}

.width90{
width: 90px;}

}
.width10{
width: 140px;}

}
.span2{
font-size: 15px;
font-weight: bold;
font-style: italic;
text-align: center;

}
.span3{
text-align: right;
width:230px;
margin-top: -20px;
}
.span4{
  font-size: 20px;
  font-weight: bold;
  color:red;
}
.span5{
  font-size: 18px;
  font-weight: bold;
  color:red;
}
.color3{
  font-weight: bold;
}
.span8{
  font-size: 15px;
  font-weight: bold;
  color:red;
}
.span6{
  font-size: 15px;
  font-weight: bold;
text-decoration: underline blue;
}
.span7{
  font-size: 15px;
  font-weight: bold;
}
.p3{
font-size: 15px;
font-weight: bold;
font-style: italic;
}
.size_txt{
font-size: 15px;

}
</style>
<page backtop=\"10mm\" backbottom=\"5mm\" backleft=\"10mm\" backright=\"2mm\" footer=\"page\">
<span class='span1'>AMERIJET - PAP STATION</span><p class='span3'><img  class='span3' src=\"http://sigco.mesdhasa.com/sigco/assets/images/logo.png\"/></p><br/><br/>
<span class='span4'>Ground Handling Fees Report Cover Page</span><br/><br/>
<span class='span5'>Period:".dateVersChainetext($date1)." ".au." ".dateVersChainetext($date2)."</span><br/><br/>
<span class='span6'>To: posinvoice@amerijet.com</span><br/><br/>
<span class='span7'>From: YASMINE M. PAUL /PAP</span><br/><br/>
<span class='span8'>Ref:  PAP WEEKLY EXPENSE REPORT</span><br/><br/>
<hr>
<table>
<thead>
<tr>
<th  align='center'></th>
<th align='center' class='width10'>Date</th>
<th align='center' class='width10'>Flight #</th>
 <th align='center' class='width10'>Company</th>
 <th align='center' class='width10'>Aircraft</th>
<th align='center'>Amount (".$per.")</th>
</tr>
</thead>
<tbody>";

$i = 0;foreach($lessegments as $rs){ if (in_array ( $rs->id,$id)) {
  $i++;
  $b=trim($per);
  $c+=$b;

$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center' >". dateVersChainetext($rs->Date_of_arrival)."</td>
<td align='center'>".$rs->Voyage_number."</td>
<td align='center'>".$rs->compagnie."</td>
<td align='center'>".$rs->Registration_number_of_transport_code."</td>
<td align='center'>$".$b."</td>

</tr>";
}
}
$content .= "<tr  class=\"color\" >
<td  class='color2' colspan='5' align='right'>TOTAL</td>
<td class=\"color2\" colspan='1' align='left'>$".$c."</td>
</tr>";
$content .= "<tr >
<td  class=\"color3\" colspan='4' align='right'>G/L #</td>
<td class=\"color1\" colspan='2' align='left'>".$gl."</td>
</tr>";
$content .= "<tr   >
<td  class=\"color3\" colspan='4' align='right'>VOUCHER #:</td>
<td class=\"color1\" colspan='2' align='left'>".$voucher."</td>
</tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
