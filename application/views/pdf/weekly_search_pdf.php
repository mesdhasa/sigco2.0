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
.width101{
width: 120px;}

}
.width102{
width: 300px;}

}
.padding1{
  padding-left: 43px;
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
<span class='span2'>WEEKLY REPORTS (Inbound) </span><br/>
<span  class='span2'><p>".dateVersChainetext($this->uri->segment(3))." ".au." ".dateVersChainetext($this->uri->segment(4))."<br/><br/> </p></span>
<table>
<thead>
<tr>
<th  align='center'></th>
<th align='center' class='width10'>Date</th>
<th align='center' class='width10'>AWB #</th>
<th align='center'class='width101'>TTL CC</th>
<th align='center' class='width102'>REMARKS</th>
</tr>
</thead>
<tbody>";
$i = 0;foreach($lessegments as $rs){$i++;
$c+=$rs->freight;
$content .= "<tr  class=\"color\" >
<td  align='center'>".$i."</td>
<td align='center'>". dateVersChainetext($rs->date_hc)."</td>
<td align='center'>".$rs->awbl."</td>
<td align='center'>$".$rs->freight."</td>
<td align='center'>".$rs->remarque2."</td>


</tr>";
}
$content .= "<tr  class=\"color\" >
<td  class='color2' colspan='3' align='center'>TOTAL</td>
<td class=\"color2 padding1\" colspan='2' align='left'>$".$c."</td>
</tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
