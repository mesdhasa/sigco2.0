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
</style>
<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"10mm\" backright=\"2mm\" footer=\"page\">
<span class='span1'>MESDHASA</span><br/>
<span class='span2'>Informatics fees  </span><br/>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(3))." ".au." ".dateVersChainetext($this->uri->segment(4))."<br/><br/> </p></span>
<table>
<thead>
<tr>
<th  align='center'></th>
<th align='center'>Waybill</th>
<th align='center'>Date of Arrival</th>
<th align='center'>Flight No</th>
<th align='center'>Compagnie</th>
<th align='center'>Encaisse</th>
<th align='center'>Currency</th>
<th align='center'>No Rapport</th>
<th align='center'>Description</th>
</tr>
</thead>
<tbody>";
$i = 0;foreach($lessegments as $rs){$i++;
if (!in_array($rs->idcompagnie,$sum_tab['id'])) {
$sum_tab['compagnie'][$rs->idcompagnie]= $rs->compagnie;
$sum_tab['id'][]= $rs->idcompagnie;
}
$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center'>".$rs->awb."</td>
<td align='center'>". dateVersChainetext($rs->Date_of_arrival)."</td>
<td align='center'>".$rs->Voyage_number."</td>
<td align='center'>".$rs->compagnie."</td>
<td align='center'>".$rs->montant_hc."</td>
<td align='center'>".$rs->monnaie."</td>
<td align='center'>".$rs->num."</td>
<td align='center'>".$rs->description."</td>
</tr>";
}
$content .= "</tbody>
</table>
<br/><br/><br/>
<table>
<thead>
<tr>
<th class='color2' align='center'>Compagnie</th>
<th class='width90' align='center'>Total AWBs</th>
<th class='width90' align='center'>X 250 Gdes</th>
</tr>
</thead>
<tbody>";
for ($a = 0; $a < count($sum_tab['id']); $a++) {

$b=$i*250;

$content .= "<tr  class=\"color\" >
<td  class='color2'  align='center'>".$sum_tab['compagnie'][$sum_tab['id'][$a]]."</td>
<td  align='center'>".$i."</td>
<td  align='center'>".$b."</td>

</tr>";
}

$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
