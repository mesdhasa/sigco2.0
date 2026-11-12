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
width: 100%;
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
   width: 500px;}

.width90{
width: 90px;}

}
.width10{
width: 160px;}

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
<span class='span2'>Freight Paid </span><br/>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(3))." ".au." ".dateVersChainetext($this->uri->segment(4))."<br/><br/> </p></span>
<table>
<thead>
<tr>
<th  align='center'></th>
<th align='center' class='width10'>Waybill</th>
<th align='center' class='width10'>No Rapport</th>
<th align='center' class='width10'>Description</th>
<th align='center'>Montant</th>
<th align='center'>Currency</th>
<th align='center'>Statut</th>

</tr>
</thead>
<tbody>";
$statut=" ";
	$i = 0;foreach($lessegments as $rs){$i++;
       if($rs->prepaid=="1"){
        $statut=PP; 
       }
       if($rs->collect=="1"){
        $statut=CC; 
       }
       if($rs->nocharge=="1"){
        $statut=NC; 
       }
    $a+=$rs->totalF;
$content .= "<tr  class=\"color\" >
<td  align='center' >".$i."</td>
<td align='center' class='width10'>".$rs->awb."</td>
<td align='center' class='width10'>".$rs->num."</td>
<td align='center' class='width10'>".Freight."</td>
<td align='center'>".$rs->totalF."</td>
<td align='center'>".$rs->monnaie."</td>

<td align='center'>".$statut."</td>
</tr>";
}
$w=count($lessegments);
for($r=0;$r<$w;$r++){
}
$resul_t=0;
$resul_t=$a;
$content .= "<tr  class=\"color\" >
<td  class=\"color2\" colspan='4' align='center'>Nombre de transaction :".$w." </td>
<td class=\"color2\" align='center'>".$resul_t."</td>
<td class=\"color2\" align='center' ></td>
<td class=\"color2\" align='center' ></td>

</tr>";

$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
