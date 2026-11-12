<?php

						$date1			= $this->uri->segment(5).'-'.$this->uri->segment(4).'-'.$this->uri->segment(3);
						$date2		= $this->uri->segment(8).'-'.$this->uri->segment(7).'-'.$this->uri->segment(6);
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


.larg1{
width: 250px;
}
.larg2{
width: 175px;
}
.larg3{
width: 155px;
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
</style>
<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"2mm\" backright=\"2mm\" footer=\"page\">
<span class='span1'>MESDHASA</span><br/>
<span class='span2'>POD Report</span><br/>
<span class='span2'>Data:&nbsp;&nbsp;".dateVersChainetext($date1)."&nbsp;".au."&nbsp;".dateVersChainetext($date2)." </span><BR/><BR/>
<table>
<thead>
<tr>
<th align='center'></th>
<th align='center'>Arrival Date</th>
<th align='center'>Compagnie</th>
<th align='center'>AWB No.</th>
<th align='center'>Qty</th>
<th class='larg1' align='center'>Package</th>
<th class='larg2' align='center'>Consignee</th>
<th align='center'>Weight (KGS)</th>
<th align='center'>Delivered </th>
<th align='center'>Delivered by</th>
<th class='larg3' align='center'>Received by</th>
</tr>
</thead>
<tbody>";
$a=0;
$b=0;
$c=0.00;
$a=count($leslivraisons)+count($degroup);

$i=0;foreach($leslivraisons as $row){$i++;
$b+=$row->qtytotal;
$c+=$row->weight;
$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center'>".dateverschainetext($row->Date_of_arrival)."</td>
<td align='center'>".$row->compagnie."</td>
<td align='center'>".$row->awbl."</td>
<td align='center'>".$row->qtytotal."</td>
<td class='larg1' align='center'>".$row->package."</td>
<td class='larg2'align='center'>".$row->consignee."</td>
<td align='center'>".$row->weight."</td>
<td align='center'>".dateverschainetext($row->datelivre)."</td>
<td align='center'>".$row->livrepar."</td>
<td class='larg3'align='center'>". $row->recupar."/". $row->nif."</td>
</tr>";
}
foreach($degroup as $row2){$i++;
if ($row2->iddeg!='') {
  $d+="1";
  $e+=$row2->poids;
$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center'>".dateverschainetext($row2->Date_of_arrival)."</td>
<td align='center'>".$row2->compagnie."</td>
<td align='center'>".$row2->awbl."./.". $row2->nobuil."</td>
<td align='center'>1</td>
<td class='larg1' align='center'>".$row2->package."</td>
<td class='larg2' align='center'>".$row2->consignee."</td>
<td align='center'>".$row2->poids."</td>
<td align='center'>".dateverschainetext($row2->livrer_le)."</td>
<td align='center'>".$row2->livrepar2."</td>
<td class='larg3' align='center'>". $row2->recupar2."/". $row2->nif2."</td>
</tr>";
}}
$f=$b+$d;
$g=$c+$e;
$content .= "<tr  class=\"color\" >
<td  class=\"color2\" colspan='1' align='center' >Total:".$a." </td>
<td  align='center'></td>
<td align='center' ></td>
<td  align='center'></td>
<td class=\"color2\" align='center'>".$f."</td>
<td  align='center'></td>
<td align='center'></td>
<td class=\"color2\" align='center'>".$g."</td>
<td align='center'></td>
<td  align='center'></td>
<td align='center'></td>
</tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('L','Legal','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
