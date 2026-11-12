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
.color3{
  background-color:#d1d468;
  }
  .color4{
    background-color:#cdedb5;
    }
    .color5{
      background-color:#f7e5e5;
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
width: 50px;}

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
.b{font-weight: bold;}
</style>
<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"10mm\" backright=\"2mm\" footer=\"page\">
<span class='span1'>MESDHASA</span><br/>
<span class='span2'>Details caisse </span><br/>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(3))." ".au." ".dateVersChainetext($this->uri->segment(4))."<br/><br/> </p></span>
<table>
<thead>
<tr>
<th  align='center'></th>
<th align='center'>Waybill</th>
<th align='center'>Date of Arrival /<br> Date of Departure</th>
<th align='center'>Flight No</th>
<th align='center'>Compagnie</th>
<th align='center'>Encaisse</th>
<th align='center'>Currency</th>
<th align='center'>Description</th>
</tr>
</thead>
<tbody>";
$sum_tab['id']=array();
$sum_tab['air_fees_usd']=array();
$sum_tab['air_fees_htg']=array();
$sum_tab['info_fees_usd']=array();
$sum_tab['info_fees_htg']=array();
$sum_tab['freight_usd']=array();
$sum_tab['freight_htg']=array();
$sum_tab['storage_fees_usd']=array();
$sum_tab['storage_fees_htg']=array();
$sum_tab['due_agent_fees_usd']=array();
$sum_tab['due_agent_fees_htg']=array();
$sum_tab['freight2_usd']=array();
$sum_tab['freight2_htg']=array();
$a=0;
	$i = 0;
  $color = ""; foreach($lessegments as $rs){$i++;
if (!in_array($rs->idcompagnie,$sum_tab['id'])) {
  $sum_tab['compagnie'][$rs->idcompagnie]= $rs->compagnie;
  $sum_tab['id'][]= $rs->idcompagnie;
}
if (trim($rs->description)=='Airport Fees' and $rs->monnaie=='USD') {
$sum_tab['air_fees_usd'][$rs->idcompagnie][]= floatval($rs->montant_hc);
}
if (trim($rs->description)=='Airport Fees' and $rs->monnaie=='HTG') {
$sum_tab['air_fees_htg'][$rs->idcompagnie][]=$rs->montant_hc;
}
if (trim($rs->description)=='Redevance informatiques' and $rs->monnaie=='USD') {
$sum_tab['info_fees_usd'][$rs->idcompagnie][]=$rs->montant_hc;
}
if (trim($rs->description)=='Redevance informatiques' and $rs->monnaie=='HTG') {
$sum_tab['info_fees_htg'][$rs->idcompagnie][]=$rs->montant_hc;
}
if (trim($rs->description)=='Freight' and $rs->monnaie=='USD') {
$sum_tab['freight_usd'][$rs->idcompagnie][]=$rs->montant_hc;
}
if (trim($rs->description)=='Freight' and $rs->monnaie=='HTG') {
$sum_tab['freight_htg'][$rs->idcompagnie][]=$rs->montant_hc;
}
if ($rs->description=='Storage Fees ' and $rs->monnaie=='USD') {
$sum_tab['storage_fees_usd'][$rs->idcompagnie][]=$rs->montant_hc;
}
if ($rs->description=='Storage Fees' and $rs->monnaie=='HTG') {
$sum_tab['storage_fees_htg'][$rs->idcompagnie][]=$rs->montant_hc;
}
    if ($rs->monnaie == "USD"){
      $content .= "<tr  class='color4'  >
      <td  align='center'>".$i."</td>
      <td align='center'>".$rs->awb."</td>
      <td align='center'>". dateVersChainetext($rs->Date_of_arrival)."</td>
      <td align='center'>".$rs->Voyage_number."</td>
      <td align='center'>".$rs->compagnie."</td>
      <td align='center'>".$rs->montant_hc."</td>
      <td align='center'>".$rs->monnaie."</td>
      <td align='center'>".$rs->description."</td>
      </tr>";
    }else{
      $content .= "<tr  class='color5' >
      <td  align='center'>".$i."</td>
      <td align='center'>".$rs->awb."</td>
      <td align='center'>". dateVersChainetext($rs->Date_of_arrival)."</td>
      <td align='center'>".$rs->Voyage_number."</td>
      <td align='center'>".$rs->compagnie."</td>
      <td align='center'>".$rs->montant_hc."</td>
      <td align='center'>".$rs->monnaie."</td>
      <td align='center'>".$rs->description."</td>
      </tr>";
    }

}

$color = ""; foreach($lessegments2 as $rs){$i++;
  if (!in_array($rs->idcompagnie,$sum_tab['id'])) {
    $sum_tab['compagnie'][$rs->idcompagnie]= $rs->compagnie;
    $sum_tab['id'][]= $rs->idcompagnie;
  }
  
  if (trim($rs->description)=='Other charges due agent' and $rs->monnaie=='USD') {
  $sum_tab['due_agent_fees_usd'][$rs->idcompagnie][]=$rs->montant_hc;
  }
  if (trim($rs->description)=='Other charges due agent' and $rs->monnaie=='HTG') {
  $sum_tab['due_agent_fees_htg'][$rs->idcompagnie][]=$rs->montant_hc;
  }
  if ((trim($rs->description)=='Weight charge' or trim($rs->description)=='Other charges due carrier') and $rs->monnaie=='USD') {
    $sum_tab['freight2_usd'][$rs->idcompagnie][]=$rs->montant_hc;
    }
    if ((trim($rs->description)=='Weight charge' or trim($rs->description)=='Other charges due carrier') and $rs->monnaie=='HTG') {
      $sum_tab['freight2_htg'][$rs->idcompagnie][]=$rs->montant_hc;
      }
      if ($rs->monnaie == "USD"){
        $content .= "<tr  class='color4'  >
        <td  align='center'>".$i."</td>
        <td align='center'>".$rs->awb."</td>
        <td align='center'>". dateVersChainetext($rs->Date_of_arrival)."</td>
        <td align='center'>".$rs->Voyage_number."</td>
        <td align='center'>".$rs->compagnie."</td>
        <td align='center'>".$rs->montant_hc."</td>
        <td align='center'>".$rs->monnaie."</td>
        <td align='center'>".$rs->description."</td>
        </tr>";
      }else{
        $content .= "<tr  class='color5' >
        <td  align='center'>".$i."</td>
        <td align='center'>".$rs->awb."</td>
        <td align='center'>". dateVersChainetext($rs->Date_of_arrival)."</td>
        <td align='center'>".$rs->Voyage_number."</td>
        <td align='center'>".$rs->compagnie."</td>
        <td align='center'>".$rs->montant_hc."</td>
        <td align='center'>".$rs->monnaie."</td>
        <td align='center'>".$rs->description."</td>
        </tr>";
      }
  
  }
  
$content .= "</tbody>
</table>
<br/><br/><br/>
<table>
<thead>
<tr>
<th class='color2' align='center'>Compagnie</th>
<th class='width90 color4' align='center'>Import Fees (USD)</th>
<th class='width90 color5' align='center'>Import Fees (HTG)</th>
<th class='width9 color4' align='center'>Informatics fees (USD)</th>
<th class='width9 color5' align='center'>Informatics fees (HTG)</th>
<th class='width9 color4' align='center'>Total Freight paid (USD)</th>
<th class='width9 color5' align='center'>Total Freight paid (HTG)</th>
<th class='width9 color4' align='center'>Total Storage fees (USD)</th>
<th class='width9 color5' align='center'>Total Storage fees (HTG)</th>
<th class='width9 color4' align='center'>Due Agent fees (USD)</th>
<th class='width9 color5' align='center'>Due Agent fees (HTG)</th>
</tr>
</thead>
<tbody>";
$sum_total_air_fees_usd=0;
$sum_total_air_fees_htg=0;
$sum_total_info_fees_usd=0;
$sum_total_info_fees_htg=0;
$sum_total_freight_usd=0;
$sum_total_freight_htg=0;
$sum_total_storage_fees_usd=0;
$sum_total_storage_fees_htg=0;
$sum_total_due_agent_fees_usd=0;
$sum_total_due_agent_fees_htg=0;

for ($a = 0; $a < count($sum_tab['id']); $a++) {

$sum_total_air_fees_usd+=array_sum ($sum_tab['air_fees_usd'][$sum_tab['id'][$a]]);
$sum_total_air_fees_htg+=array_sum ($sum_tab['air_fees_htg'][$sum_tab['id'][$a]]);
$sum_total_info_fees_usd+=array_sum ($sum_tab['info_fees_usd'][$sum_tab['id'][$a]]);
$sum_total_info_fees_htg+=array_sum ($sum_tab['info_fees_htg'][$sum_tab['id'][$a]]);
$sumfreight_usd=(array_sum ($sum_tab['freight_usd'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['freight2_usd'][$sum_tab['id'][$a]]));
$sumfreight_htg=(array_sum ($sum_tab['freight_htg'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['freight2_htg'][$sum_tab['id'][$a]]));

$sum_total_freight_usd+=$sumfreight_usd;
$sum_total_freight_htg+=$sumfreight_htg;
$sum_total_storage_fees_usd+=array_sum ($sum_tab['storage_fees_usd'][$sum_tab['id'][$a]]);
$sum_total_storage_fees_htg+=array_sum ($sum_tab['storage_fees_htg'][$sum_tab['id'][$a]]);
$sum_total_due_agent_fees_usd+=array_sum ($sum_tab['due_agent_fees_usd'][$sum_tab['id'][$a]]);
$sum_total_due_agent_fees_htg+=array_sum ($sum_tab['due_agent_fees_htg'][$sum_tab['id'][$a]]);
$content .= "<tr  class=\"color\" >
<td  class='color2'  align='center'>".$sum_tab['compagnie'][$sum_tab['id'][$a]]."</td>
<td  class='color4' align='center'>".array_sum ($sum_tab['air_fees_usd'][$sum_tab['id'][$a]])."</td>
<td  class='color5' align='center'>".array_sum ($sum_tab['air_fees_htg'][$sum_tab['id'][$a]])."</td>
<td  class='color4' align='center'>".array_sum ($sum_tab['info_fees_usd'][$sum_tab['id'][$a]])."</td>
<td  class='color5'  align='center'>".array_sum ($sum_tab['info_fees_htg'][$sum_tab['id'][$a]])."</td>
<td  class='color4' align='center'>".$sumfreight_usd."</td>
<td  class='color5'  align='center'>".$sumfreight_htg."</td>
<td  class='color4' align='center'>".array_sum ($sum_tab['storage_fees_usd'][$sum_tab['id'][$a]])."</td>
<td  class='color5'  align='center'>".array_sum ($sum_tab['storage_fees_htg'][$sum_tab['id'][$a]])."</td>
<td  class='color4' align='center'>".array_sum ($sum_tab['due_agent_fees_usd'][$sum_tab['id'][$a]])."</td>
<td  class='color5'  align='center'>".array_sum ($sum_tab['due_agent_fees_htg'][$sum_tab['id'][$a]])."</td>
</tr>";
}
$content .= "<tr  class=\"color\" >
<td  class='color b size_txt'  align='center'>Total</td>
<td  class='color4' align='center'>".$sum_total_air_fees_usd."</td>
<td  class='color5'  align='center'>".$sum_total_air_fees_htg."</td>
<td  class='color4' align='center'>".$sum_total_info_fees_usd."</td>
<td  class='color5'  align='center'>".$sum_total_info_fees_htg."</td>
<td  class='color4' align='center'>".$sum_total_freight_usd."</td>
<td  class='color5'  align='center'>".$sum_total_freight_htg."</td>
<td  class='color4' align='center'>".$sum_total_storage_fees_usd."</td>
<td  class='color5'  align='center'>".$sum_total_storage_fees_htg."</td>
<td  class='color4' align='center'>".$sum_total_due_agent_fees_usd."</td>
<td  class='color5'  align='center'>".$sum_total_due_agent_fees_htg."</td>
</tr>";
$content .= "</tbody>
</table>
<br/><br/><br/>
<table>
<thead>
<tr class='color3'>
<th align='center'>Compagnie</th>
<th class='width90' align='center'>Total (USD)</th>
<th class='width90' align='center'>Total (HTG)</th>
</tr>
</thead>
<tbody>";

$sum_total_usd=$sum_total_air_fees_usd+$sum_total_info_fees_usd+$sum_total_freight_usd+$sum_total_storage_fees_usd+$sum_total_due_agent_fees_usd;
$sum_total_htg=$sum_total_air_fees_htg+$sum_total_info_fees_htg+$sum_total_freight_htg+$sum_total_storage_fees_htg+$sum_total_due_agent_fees_htg;



for ($a = 0; $a < count($sum_tab['id']); $a++) {
$sum_usd=(array_sum ($sum_tab['air_fees_usd'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['info_fees_usd'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['freight_usd'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['freight2_usd'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['storage_fees_usd'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['due_agent_fees_usd'][$sum_tab['id'][$a]]));
$sumf_htg=(array_sum ($sum_tab['air_fees_htg'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['info_fees_htg'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['freight_htg'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['freight2_htg'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['storage_fees_htg'][$sum_tab['id'][$a]]))+(array_sum ($sum_tab['due_agent_fees_htg'][$sum_tab['id'][$a]]));

$content .= "<tr  class=\"color\" >
<td   align='center'>".$sum_tab['compagnie'][$sum_tab['id'][$a]]."</td>
<td class='color4'  align='center'>".$sum_usd."</td>
<td  class='color5'  align='center'>".$sumf_htg."</td>
</tr>";
}
$content .= "<tr  class=\"color\" >
<td  class='color b size_txt'  align='center'>Total</td>
<td  class='color4' align='center'>".$sum_total_usd."</td>
<td  class='color5' align='center'>".$sum_total_htg."</td>
</tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('L','Legal','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
