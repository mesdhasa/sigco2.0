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
<span class='span2'>Transaction de caisse</span><br/>
<span class='span2'>N0. rapport:&nbsp;&nbsp;".$this->uri->segment(4)." </span>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(5))."<br/><br/> ". $this->uri->segment(3)."</p></span>
<table>
<thead>
<tr>
<th align='center'></th>
<th align='center'>Waybill</th>
<th align='center'>Date darriv&eacute;e</th>
<th align='center'>Mode de paiement</th>
<th align='center'>Montant</th>
<th align='center'>Encaisse</th>
<th align='center'>Description</th>
<th align='center'>Client</th>
</tr>
</thead>
<tbody>";
$a=0;
	$i = 0;foreach($rapport as $rs){$i++;
		$a+=$rs->montant_hc;

$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center'>".$rs->awb."</td>
<td align='center'>".dateVersChainetext($rs->Date_of_arrival)."</td>
<td align='center'>".$rs->mode_paiement."</td>
<td align='center'>".$rs->montant_hc1."</td>
<td align='center'>".$rs->montant_hc."</td>
<td align='center'>".$rs->description."</td>
<td align='center'>".$rs->banque."&nbsp;".$rs->banque2."&nbsp;".$rs->nom_compte."&nbsp;".$rs->nom_compte2."&nbsp;".$rs->no_chque."&nbsp;".$rs->digit."&nbsp;&nbsp;".$rs->consignee."</td>
</tr>";
}
$b=0;
foreach($rapport_ex as $rs){$i++;
  $b+=$rs->montant_hc;
  
    $content .= "<tr  class=\"color\" >
    <td  align='center'>".$i."</td>
    <td align='center'>".$rs->awb."</td>
    <td align='center'>".dateVersChainetext($rs->datecreated)."</td>
    <td align='center'>".$rs->mode_paiement."</td>
    <td align='center'>".$rs->montant_hc1."</td>
    <td align='center'>".$rs->montant_hc."</td>
    <td align='center'>".$rs->description."</td>
    <td align='center'>".$rs->banque."&nbsp;".$rs->banque2."&nbsp;".$rs->nom_compte."&nbsp;".$rs->nom_compte2."&nbsp;".$rs->no_chque."&nbsp;".$rs->digit."&nbsp;&nbsp;".$rs->consignee."</td>
    </tr>";
  

}

$c=0;
foreach($rapport_mes as $rs){$i++;
  $c+=$rs->montant_hc;

$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center'>".$rs->awb."</td>
<td align='center'>".dateVersChainetext($rs->datecreated)."</td>
<td align='center'>".$rs->mode_paiement."</td>
<td align='center'>".$rs->montant_hc1."</td>
<td align='center'>".$rs->montant_hc."</td>
<td align='center'>".$rs->description."</td>
<td align='center'>".$rs->banque."&nbsp;".$rs->banque2."&nbsp;".$rs->nom_compte."&nbsp;".$rs->nom_compte2."&nbsp;".$rs->no_chque."&nbsp;".$rs->digit."&nbsp;&nbsp;".$rs->consignee."</td>
</tr>";
}
$w=count($rapport)+count($rapport_mes)+count($rapport_ex);
for($r=0;$r<$w;$r++){
}
$resul_t=0;
$resul_t=$a+$b+$c;
$content .= "<tr  class=\"color\" >
<td  class=\"color2\" colspan='5' align='center'>Nombre de transaction :".$w." </td>
<td class=\"color2\" align='center'>".$resul_t."</td>
<td class=\"color2\" align='center' ></td>
<td class=\"color2\" align='center'></td>
</tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('L','Legal','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
