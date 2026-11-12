<?php

$corps_tab = "";
$totalkgs = 0;
$totallbs = 0;
$total = 0;
	$r=0;$weight=0;foreach($lesawb as $row){$r++;
		$lbs = 2.2 * floatval($row->weight);
		
	$corps_tab .= "<tr>
									<td class='color awbfont tdtab'>".$row->awbl."</td>
									<td class='color awbfont tdtab'>".$row->qty."</td>
									<td class='color awbfont tdtab2'>".$row->package."</td>
									<td class='color awbfont tdtab3'><span>".$row->weight." KGS</span><br/><span>".$lbs." LBS</span></td>
									<td class='color awbfont tdtab4'>".$row->consignee."</td>
									<td class='color awbfont tdtab'>".$row->freight."</td>
								</tr>";
								$total+=$row->qty;
								$totalkgs+=floatval($row->weight);
								$totallbs+=$lbs;
}


	$content = "
	<style>
	table {
	border-collapse: collapse;
	font-size:11px;
	}

.table{
	border-collapse: collapse;
	display: table;
	width: 100%;

}
.table, .table th, .table td{
border: 1px solid black;
border-width: 1px;
}
	.span1{
font-size: 27px;
font-weight: bold;
	}
	.span2{
font-size: 28px;
	}
	.p1{
		text-align: center;
	}
	.p2{
		font-weight: bold;
	}
	.td4{
	  border-style: solid;
	  border-width: 0px 0px 0px 0px;
	}
	.mes_p1{
		margin:0px;
	  padding-left: 10px;
		font-weight: bold;

	}
	.mes_p2{
		margin:0px;
	  padding-left: 30px;
		font-weight: bold;

	}
	.span_left{
		padding-left: -80px;
	}
	.span_left2{
		padding-left: 180px;
	}
	.span_left3{
		padding-left: 130px;

	}
	.span_left7{
		padding-left: 170px;
	}
	.span_left8{
		padding-left: 270px;
	}
	.span_left18{
		padding-left: 285px;
	}
	.span_left4{
		padding-left: 280px;
	}
	.span_left14{
		padding-left: 250px;
	}
	.span_left5{
		padding-left: 130px;
	}
	.span_left6{
		padding-left: 90px;
	}
	.color{
		color: black;
	}
	.size1{
		font-size: 20px;
	}
	.size2{
		font-size: 15px;
	}
	.td2{
		border: 1px solid black;
	border-width:1px;
	height: 1px;
	width: 760px;
	}
	.td3{
	border: 1px solid black;
	border-width:1px;
	width: 100px;
	}
	.bol{
			font-weight: bold;
		}
.spantab1{
			margin:0px;
			font-size: 13px;
		}
		.awbfont{
			font-size: 14px;
			text-align: center;
			font-family:courier;

		}
		.tdtab{
			width: 100px;
			text-align: center;
		}
		.tdtab2{
			width: 150px;
			text-align: center;
		}
		.tdtab3{
			width: 90px;
			text-align: center;
		}
		.tdtab4{
			width: 190px;
			text-align: center;
		}
	</style>
	<page backtop=\"1mm\" backbottom=\"5mm\" backleft=\"2mm\" backright=\"2mm\" footer=\"page\">
	<p class='p1'><span class='span1'>CARGO MANIFEST</span><br/>
	<span class='span2'>MANIFIESTO DE CARGA</span><span class='span1'> MANIFEST</span></p>
<p class='p2'>
<span class=''> 86-36</span><br/>
<span class=''>APPROVED</span><br/>
<span class=''>SYSTEM F.A.L. COMMITTEE</span><br/>
<span class=''>ICAO ANNEX 9-APP.4</span><br/><br/><br/>
</p>
<table>
<td class='td1 span_left2 color size1'>
<span class='mes_p1'>".$row->compagnie."</span><br/>
<span class='span_left'></span>

</td>
</table>
<table>
<td >
<span class='mes_p1'>SOWNER OR OPERATOR</span><br/>
<span >administrador</span>
</td>
<td class='td1 span_left'>
<span class='mes_p1'></span><br/>
<span class='span_left'>_________________________________________________________________________________________________</span>
</td>
</table><br/><br/><br/>










<table>

<td class='td1 span_left3'>
<span class='mes_p2 color size2'>".$row->Registration_number_of_transport_code."</span><br/>
<span ></span>
</td>

<td class='td1 span_left14 size2'>
<span class='mes_p1 color'>".$row->Voyage_number."</span><br/>
<span ></span>
</td>

<td class='td1 span_left5 size2'>
<span class='mes_p1 color'>".$row->Date_of_arrival."</span><br/>
<span ></span>
</td>
</table>
<table>
<td>
<span class='mes_p1'>AIRCRAFT</span><br/>
<span >Aeronave</span>
</td>
<td class='td1'>
<span class='mes_p2 color'></span><br/>
<span >__________________________________________________</span>
</td>
<td >
<span class='mes_p1'>FLIGHT No.</span><br/>
<span >Vuelo No.</span>
</td>
<td class='td1'>
<span class='mes_p1'></span><br/>
<span >___________________________</span>
</td>
<td >
<span class='mes_p1'>DATE</span><br/>
<span >Fecha</span>
</td>
<td class='td1'>
<span class='mes_p1'></span><br/>
<span >____________________</span>
</td>
</table><br/><br/>

<table>

<td class='td1 span_left6'>
<span class='mes_p2'>(REGISTRATION MARKS AND NATIONALITY)</span><br/>
<span > (Matricula, Marca y Nacionalidad)</span>
</td>

</table><br/><br/>








<table>

<td class='td1 span_left7'>
<span class='mes_p2 color size2'>".$row->Place_of_departure_code."</span><br/>
<span ></span>
</td>

<td class='td1 span_left18 size2'>
<span class='mes_p1 color'>PORT-AU-PRINCE</span><br/>
<span ></span>
</td>

</table>
<table>
<td>
<span class='mes_p1'>POINT OF LOADIN</span><br/>
<span >Punto de Carga</span>
</td>
<td class='td1'>
<span class='mes_p2 color'></span><br/>
<span >_____________________________________________</span>
</td>
<td >
<span class='mes_p1'>POINT OF UNLOADING</span><br/>
<span >Punto de Descarga</span>
</td>
<td class='td1'>
<span class='mes_p1'></span><br/>
<span >________________________________________</span>
</td>


</table><br/><br/>

<table>
<td class='td1 span_left7'>
<span class='mes_p2'>(PLACE AND COUNTRY)</span><br/>
<span > ( Lugar y Pa&iacute;s )</span>
</td>
<td class='td1 span_left8'>
<span class='mes_p2'>(PLACE AND COUNTRY)</span><br/>
<span > ( Lugar y Pa&iacute;s )</span>
</td>
</table><br/><br/>

<table>
<td class='td2'></td>
</table><br/>

<table class='table'>
		<tr>
		<td class='tdtab'><span class='spantab1 bol'>MARKS AND NUMBERS ON PACKAGES</span><br/><span class='spantab2'>Macas y n&uacute;meros En los paquetes</span></td>
		<td class='tdtab'><span class='spantab1 bol'>NUMBERS AND TYPE OF PACKAGES</span> N&uacute;meros y tipo de paquetes</td>
		<td class='tdtab2'><span class='spantab1 bol'>NATURE OF GOODS</span> Naturaleza de Mercader&iacute;a</td>
	<td class='tdtab3'><span class='spantab1 bol'>GROSS WEIGHT</span><br/><span>Peso Bruto</span></td>
	<td class='tdtab4'><span class='spantab1 bol'>FOR USE BY OWNER OR OPERATOR ONLY</span> <br/><span>S&oacute;lo para uso del propietario O adminitrador</span></td>
		<td class='tdtab'><span class='spantab1 bol'>OR OFFICIAL USE ONLY</span> <br/><span>Para uso official solamente</span></td>
		</tr>

		".$corps_tab."
		<tr >
		<td  class='awbfont bol'colspan='1' align='center'>Total</td>
		<td  class='awbfont p2' align='center'>".$total."</td>
		<td  align='center' ></td>
		<td   class='awbfont p2'align='center'><span>".$totalkgs." KGS</span><br/><span>".$totallbs." LBS</span></td>
		<td  align='center'></td>
		<td  align='center'></td>
		</tr>
</table>

";



$content .= "
</page>";

$html2pdf = new HTML2PDF('P','Legal','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
