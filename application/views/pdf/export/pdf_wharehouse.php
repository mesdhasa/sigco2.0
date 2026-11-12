<?php
foreach($antrepot as $rs){}
$style="<style>


.blank{
	border-left:0px;
	border-bottom:0px;
	border-top: 0px;
	border-right:0px;
}

.p1{
	width:50%;
}
.p2{
	width:50%;
}


legend
{
font-size:13px;
font-weight:bold;
margin-bottom: 0px;
width: auto;
border: 1px solid #ddd;
border-radius: 1px;
padding: 5px 5px 5px 10px;
background-color: #ffffff;
}
fieldset {
display: block;
width: 350px;
margin-inline-start: 2px;
margin-inline-end: 2px;
padding-block-start: 0.35em;
padding-inline-start: 0.75em;
padding-inline-end: 0.75em;
padding-block-end: 0.625em;
min-inline-size: min-content;
border-width: 1px;
border-style: groove;
border-color: threedface;
border-image: initial;
}
.mes_p{
	margin:0px;
	padding:5px;
}
.span1{
font-size: 25px;
font-weight: bold;
font-style: italic;
}
.span2{
font-size: 15px;
font-weight: bold;
font-style: italic;
text-align: center;
}
.span3{
font-size: 15px;
font-style: italic;
text-align: center;
}
.table1 {
border-collapse: collapse;
font-size:13px;
border: 1px solid black;
padding:3px;
margin-left:50px;
}

.th1, .td1 {
border: 1px solid black;
padding:3px;
}
</style>";
if(count($antrepot2)>0){

$r=0;  $totalpieces =0; $vo_weight=0;  $totalvolum =0;foreach($antrepot2 as $row){$r++;
  $t1=round($row->dim1,2)*round($row->dim2,2)*round($row->dim3,2);
  $t2=$t1*$row->no_pieces;
  $vo_weight=$t2/366;
  $totalpieces +=$row->no_pieces;
$totalvolum +=$vo_weight;
$v=round($totalvolum,2);
$pcs=$row->no_pieces;
$dim1=$row->dim1;
$dim2=$row->dim2;
$dim3=$row->dim3;
$w=round($vo_weight,2);
$table2 .="	<tr>
<td  align='center' class='td1'>$r</td>
<td  align='center' class='td1'>$pcs</td>
<td  align='center' class='td1'>$dim1</td>
<td  align='center' class='td1'>$dim2</td>
<td  align='center' class='td1'>$dim3</td>
<td  align='center' class='td1'>$w</td>
</tr>";
}
$table3="<tr>
<td colspan='5' align='right'><strong>Total PCS</strong></td>
<td align='right'><strong>$totalpieces</strong></td>
</tr>
<tr>
<td colspan='5' align='right'><strong>Total Volumetric weight</strong></td>
<td align='right'><strong>$v</strong></td>
</tr>	";
}
$partie_001 = "
<span class='span1'>MESDHASA</span><br/>
<span class='span2'>Warehouse Receipt</span><br/>
<span class='span2'>W/R # : </span><span class='span3'>".$this->uri->segment(4)."</span><br/>
<span class='span2'>Date: ".dateVersChainetext($rs->ladate)."</span><br/><br/>
<table>
	<tr>
		<td class='p1'><fieldset >
    <legend>Chauffeur</legend>
    <p class='mes_p'>Nom : $rs->nom_ch</p>
    <p class='mes_p'>Prenom : $rs->prenom_ch</p>
    <p class='mes_p'>Tel : $rs->tel_ch</p>
    <p class='mes_p'>CIN/ NIF : $rs->cin_ch</p>
    </fieldset>
    </td>
		<td class='p2'>
    <fieldset >
    <legend>Proprietaire</legend>
    <p class='mes_p'>Nom : $rs->nom_p</p>
    <p class='mes_p'>E-mail : $rs->email_p</p>
    <p class='mes_p'>Tel : $rs->tel_p</p>
    <p class='mes_p'>Remarque : $rs->remarque</p>
    </fieldset>
    </td>
	</tr>
</table><br/><br/>
<table class='table1'>
<thead>
<tr>
<th align='center' class='th1'></th>
<th align='center' class='th1'>Nbr/PCS</th>
<th align='center' class='th1'>Lenght/Inches</th>
<th align='center' class='th1'>Width/Inches</th>
<th align='center' class='th1'>Height/Inches</th>
<th align='center' class='th1'>Volumetric Weight (Kg)</th>
</tr>
</thead>

<tbody>

	" .$table2. "
	" .$table3. "
<tr>
<td colspan='5' align='right'><strong>Nature Of Goods</strong></td>
<td align='right'><strong>$rs->nature_and_quantity</strong></td>
</tr>
<tr>
<td colspan='5' align='right'><strong>Gross Weight</strong></td>
<td align='right'><strong>$rs->gross_weight</strong></td>
</tr>
</tbody>
</table>";

$content = "
".$style."
<page backtop=\"20mm\" backbottom=\"10mm\" backleft=\"10mm\" backright=\"10mm\">

".$partie_001."

</page>";
    $html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output();
?>
