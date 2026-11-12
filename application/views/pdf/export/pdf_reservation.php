<?php

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
	padding:5px;
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
	font-size: 12px;
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
foreach($lareservation as $rs){
$partie_001 = "
<table>
	<tr>
		<td class='td1'></td>
		<td class='td2'></td>
		<td class='td1'></td>
	</tr>

  <tr>
		<td ><p class='mes_p'>AW-16-01</p></td>
		<td ><p class='mes_p6'>Amerijet International -PAP</p></td>
		<td class=''></td>
	</tr>
  <tr>
    <td colspan='2'class='td3' ><p class='mes_p8'>Reservation Inquiry Screen<span class='mes_p7'>PA/</span></p>
    </td>
    <td class='td3'></td>
  </tr>
	<tr>
		<td colspan='2'class='td4'>
		<p class='mes_p'>*1. Reservation No:<span class='span1'>".$rs->no_reservation."</span></p>
		<p class='mes_p'>2. Airbil No:<span class='span1'>".$rs->no_awbl."</span></p>
		</td>

		<td rowspan='2'class='td4'>
    <p class='mes_p'>Station</p>
    <p class='mes_p'>Operation</p>
    <p class='mes_p'>Date:<span class='span1'>".dateVersChainetext($rs->date)."</span></p>
    <p class='mes_p'>Time</p>
    <p class='mes_p'>Quote#</p>
</td>
	</tr>
	<tr>
		<td class='td4'>
    <p class='mes_p'>3. +Suvey</p>
    </td>

		<td rowspan='2'class='td4'>
    <p class='mes_p1'>Scheduled Routing</p>
    <p class='mes_p2'>7. ____-_____-____ FLT ____ _____ ____</p>
    <p class='mes_p3'>____-_____-____ FLT ____ _____ ____</p>
    <p class='mes_p3'>____-_____-____ FLT ____ _____ ____</p>
    <p class='mes_p3'>____-_____-____ FLT ____ _____ ____</p>
    </td>
	</tr>
	<tr>
		<td class='td4'>
    <p class='mes_p'>4. Origin:<span class='span1'>".$rs->code_origine."</span></p>
    <p class='mes_p'>5. Dest:<span class='span1'>".$rs->code_destinataire."</span></p>
    </td>
		<td class='td4'></td>
	</tr>
	<tr>
		<td class='td4'>
    <p class='mes_p'>6. U/M ___</p>
    <p class='mes_p4'>. Dim Unit ___</p>
    </td>
		<td rowspan='2' class='td4'>
    <p class='mes_p1'>Pieces Act wt vol wt</p>
    <p class='mes_p2'>8.+Loose  ____ ____ ____</p>
    <p class='mes_p2'>9.+Pallet ____ ____ ____</p>
    <p class='mes_p5'>Total ____ ____ ____</p>
    </td>
		<td class='td4'>15.Charges Code ___</td>
	</tr>
	<tr>
		<td class='td4'>Charge</td>
		<td class='td4'>16. +Insurance ___</td>
	</tr>
	<tr>
		<td colspan='2' class='td5'>
    <p class='mes_p'>10.Pripority ___</p>
    </td>
		<td class='td4'>
    <p class='mes_p'>17. +Promotion code</p>
    </td>
	</tr>
	<tr>
		<td colspan='2' class='td4'>
    <p class='mes_p'>11.Comm Class ___</p>
    <p class='mes_p'>12. +Tendered By _____ __________</p>
    <p class='mes_p'>13. +Consignee:<span class='span1'>".$rs->consignee."</span></p>
    <p class='mes_p'>14. +Remarks:<span class='span1'>".$rs->remarque."</span></p>
    </td>
		<td class='td4'>
       <p class='mes_p'>18. +Spot rate</p>
</td>
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
