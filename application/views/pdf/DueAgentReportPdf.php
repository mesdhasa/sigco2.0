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
width: 100px;}

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
</style>
<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"10mm\" backright=\"2mm\" footer=\"page\">
<span class='span1'>MESDHASA</span><br/>
<span class='span2'>Due Agent Report</span><br/>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(3))." ".au." ".dateVersChainetext($this->uri->segment(4))."<br/><br/> </p></span>
<table>
<thead>
<tr>
<th  align='center'></th>
<th align='center'>Waybill</th>
<th align='center'>Date of departure</th>
<th align='center'>Destination</th>
<th align='center'>No Rapport</th>
<th align='center'>Status</th>
<th align='center'>Broker</th>
<th align='center'>Montant</th>
<th align='center'>Currency</th>
</tr>
</thead>
<tbody>";
$sum_tab['id']=array();
$sum_tab['air_fees_usd']=array();
$sum_tab['air_fees_htg']=array();

	$i = 0;foreach($lessegments as $rs){$i++;
if (!in_array($rs->idcompagnie,$sum_tab['id'])) {
  $sum_tab['compagnie'][$rs->idcompagnie]= $rs->compagnie;
  $sum_tab['id'][]= $rs->idcompagnie;
}
if (trim($rs->description)=='Other charges due agent' and $rs->monnaie=='USD') {
$sum_tab['air_fees_usd'][$rs->idcompagnie][]=$rs->montant_hc;
}
if (trim($rs->description)=='Other charges due agent' and $rs->monnaie=='HTG') {
$sum_tab['air_fees_htg'][$rs->idcompagnie][]=$rs->montant_hc;
}

$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td  class='width10' align='center'>".$rs->awb_number."</td>
<td class='width10' align='center'>". dateVersChainetext($rs->date)."</td>
<td class='width10' align='center'>".$rs->destination."</td>
<td   align='center'>".$rs->num."</td>
<td  align='center'>".$rs->chcg."</td>
<td class='width10'  align='center'>".$rs->name_agent."</td>
<td align='center'>".$rs->montant_hc."</td>
<td align='center'>".$rs->monnaie."</td>
</tr>";
}
$content .= "</tbody>
</table>
<br/><br/><br/>
<table>
<thead>
<tr>
<th class='color2' align='center'>Compagnie</th>
<th class='width90' align='center'>Other charges due agent (USD)</th>
<th class='width90' align='center'>Other charges due agent (HTG)</th>
</tr>
</thead>
<tbody>";
$sum_total_air_fees_usd=0;
$sum_total_air_fees_htg=0;
for ($a = 0; $a < count($sum_tab['id']); $a++) {

$sum_total_air_fees_usd+=array_sum ($sum_tab['air_fees_usd'][$sum_tab['id'][$a]]);
$sum_total_air_fees_htg+=array_sum ($sum_tab['air_fees_htg'][$sum_tab['id'][$a]]);

$content .= "<tr  class=\"color\" >
<td  class='color2'  align='center'>".$sum_tab['compagnie'][$sum_tab['id'][$a]]."</td>
<td  align='center'>".array_sum ($sum_tab['air_fees_usd'][$sum_tab['id'][$a]])."</td>
<td  align='center'>".array_sum ($sum_tab['air_fees_htg'][$sum_tab['id'][$a]])."</td>

</tr>";
}
$content .= "<tr  class=\"color\" >
<td  class='color'  align='center'>Total</td>
<td  align='center'>".$sum_total_air_fees_usd."</td>
<td  align='center'>".$sum_total_air_fees_htg."</td>
</tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
