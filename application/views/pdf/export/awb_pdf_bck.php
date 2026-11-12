<?php
foreach($antrepot as $rs){}
foreach($awb_data as $data){}
 $totalagent=0; $totalagent1=0;foreach($entitlement_agent as $row4){
	 if($row4->type_entitlement=="prepaid"){
		 $totalagent+=$row4->amount;
	 }else {
		 $totalagent1+=$row4->amount;

	 }
	}
	$totalcarrier=0; $totalcarrier1=0;foreach($entitlement_carrier as $row5){
		if($row5->type_entitlement=="prepaid"){
			$totalcarrier+=$row5->amount;
		}else {
			$totalcarrier1+=$row5->amount;

		}
	 }
	if(count($antrepot2)>0){

	$r=0;  $totalpieces =0; $total =0; $total2 =0; $vo_weight=0; $lb=0; $totalvolum =0; $totalvolum2 =0;foreach($antrepot2 as $row){$r++;
		$t1=round($row->dim1,2)*round($row->dim2,2)*round($row->dim3,2);
		$t2=$t1*$row->no_pieces;
		$vo_weight=$t2/366;
		$totalpieces +=$row->no_pieces;

	$totalvolum +=$vo_weight;
  $totalvolum2=round($totalvolum,2);
	$lb=$rs->gross_weight * 2.20462;


  $total=$data->rate_Charge*$totalvolum ;
$total2=round($total,2) ;
 $pp=0; $cc=0; if($data->wt_val=="prepaid"){
  $pp=round($total,2);
  $cc='';
}else if ($data->wt_val=="collect"){
  $pp='';
  $cc=round($total,2);
}else {
  $pp='';
  $cc='';
}
}}

$style="<style>




	position: absolute;
	white-space: pre;
	overflow: visible;
}
.b99{border: 1px solid black;border-width:1px;}
.s1_1{text-transform: uppercase;font-size: auto;font-size: 20px;}
.s1_11{text-transform: uppercase;font-size: auto;font-size: 30px;}
.s1_2{text-transform: uppercase;font-size: auto;font-size: 14px;}
#t2_1{margin-left:370px; }
#t3_1{margin-left:179px;width:165px;padding-top:3px;margin-top:13px;}
#t4_1{padding-top:5px;width:340px; }
#t5_1{margin-left:179px;width:165px;padding-top:10px;margin-top:30px;}
#t6_1{padding-top:3px;width:340px; }
#comp1{padding-top:0px;width:780px; height:50px;margin-top:30px;padding-top:0px; position: relative;  z-index: 100;}
#t7_1{padding-top:0px;width:340px;margin-top:10px; position: absolute; z-index:-100 ;}
#t8_1{padding-top:0px;width:365px;margin-top:10px;margin-left:370px;position: absolute;}
#comp2{padding-top:0px;width:780px; height:20px;margin-top:13px;padding-top:0px; position: relative;  z-index: 100;}
#t9_1{padding-top:0px;width:160px;margin-top:10px; position: absolute; z-index:-100 ;}
#t10_1{padding-top:10px;width:160px;margin-top:0px;margin-left:179px;position: absolute;}
#comp3{padding-top:0px;width:780px; height:20px;margin-top:15px;padding-top:0px; position: relative;  z-index: 100;}
#t11_1{padding-top:0px;width:340px;margin-top:10px; position: absolute; z-index:-100 ;}
#t12_1{padding-top:0px;width:110px;margin-top:0px;margin-left:350px;position: absolute;}
#t13_1{padding-top:0px;width:100px;margin-top:0px;margin-left:483px;position: absolute;}
#t14_1{padding-top:0px;width:100px;margin-top:0px;margin-left:593px;position: absolute;}
#comp4{padding-top:0px;width:780px; height:20px;margin-top:29px;padding-top:0px; position: relative;  z-index: 100;}
#t15_1{padding-top:0px;width:38px;margin-top:0px; position: absolute; z-index:-100 ;}
#t16_1{padding-top:0px;width:167px;margin-top:0px;margin-left:42px;position: absolute;}
#t17_1{padding-top:0px;width:33px;margin-top:0px;margin-left:220px;position: absolute;}
#t18_1{padding-top:0px;width:30px;margin-top:0px;margin-left:260px;position: absolute;}
#t19_1{padding-top:0px;width:30px;margin-top:0px;margin-left:295px;position: absolute;}
#t20_1{padding-top:0px;width:30px;margin-top:0px;margin-left:335px;position: absolute;}
#t21_1{padding-top:0px;width:32px;margin-top:0px;margin-left:370px;position: absolute;}
#t22_1{padding-top:0px;width:17px;margin-top:0px;margin-left:408px;position: absolute;}
#t23_1{padding-top:0px;width:8px;margin-top:0px;margin-left:433px;position: absolute;}
#t24_1{padding-top:0px;width:8px;margin-top:0px;margin-left:454px;position: absolute;}
#t25_1{padding-top:0px;width:8px;margin-top:0px;margin-left:475px;position: absolute;}
#t26_1{padding-top:0px;width:8px;margin-top:0px;margin-left:495px;position: absolute;}
#t27_1{padding-top:0px;width:110px;margin-top:0px;margin-left:526px;position: absolute;}
#t28_1{padding-top:0px;width:112px;margin-top:0px;margin-left:650px;position: absolute;}
#comp5{padding-top:0px;width:780px; height:18px;margin-top:8px;padding-top:0px; position: relative;  z-index: 100;}
#t29_1{padding-top:0px;width:167px;margin-top:0px;margin-left:0px;position: absolute;}
#t30_1{padding-top:0px;width:78px;margin-top:0px;margin-left:181px;position: absolute;}
#t31_1{padding-top:0px;width:77px;margin-top:0px;margin-left:268px;position: absolute;}
#t32_1{padding-top:0px;width:100px;margin-top:0px;margin-left:365px;position: absolute;}
#comp6{padding-top:0px;width:780px; height:18px;margin-top:18px;padding-top:0px; position: relative;  z-index: 100;}
#t33_1{padding-top:0px; width:400px;margin-top:0px; margin-left:0px;position: absolute; resize: both; overflow: auto;}
#t34_1{padding-top:0px;width:100px;margin-top:30px;margin-left:650px;position: absolute;}
#comp7{padding-top:0px;width:780px; height:58px;margin-top:75px;padding-top:0px; position: relative;  z-index: 100;}
#t35_1{padding-top:0px;width:35px;margin-top:0px;margin-left:0px;position: absolute;}
#t36_1{padding-top:0px;width:58px;margin-top:0px;margin-left:42px;position: absolute;}
#t37_1{padding-top:0px;width:8px;margin-top:0px;margin-left:105px;position: absolute;}
#t38_1{padding-top:0px;width:8px;margin-top:0px;margin-left:124px;position: absolute;}
#t39_1{padding-top:0px;width:60px;margin-top:0px;margin-left:136px;position: absolute;}
#t40_1{padding-top:0px;width:60px;margin-top:0px;margin-left:213px;position: absolute;}
#t41_1{padding-top:0px;width:60px;margin-top:0px;margin-left:290px;position: absolute;}
#t42_1{padding-top:0px;width:105px;margin-top:0px;margin-left:378px;position: absolute;}
#t43_1{padding-top:0px;width:213px;margin-top:0px;margin-left:504px;position: absolute;}
#t44_1{padding-top:0px;width:213px;margin-top:30px;margin-left:504px;position: absolute;}
#comp8{padding-top:0px;width:780px; height:58px;margin-top:150px;padding-top:0px; position: relative;  z-index: 100;}
#comp9{padding-top:0px;width:780px; height:58px;margin-top:-20px;padding-top:0px; position: relative;  z-index: 100;}

table {
    border-collapse: collapse;
	    display: table; /* check so these really applies */
    width: 100%;
}
.td1{width:4%;}
.td2{width:8%;padding-left:8px;}
.td3{width:2%;padding-left:13px;}
.td4{width:2%;padding-left:12px;}
.td5{width:10%;padding-left:2px;}
.td6{width:10%;padding-left:6px;}
.td7{width:11%;padding-left:8px;}
.td8{width:16%;padding-left:14px;}
.td9{width:28%;padding-left:40px;}
.td10{width:28%;padding-left:547px;}
.td11{width:16%;padding-left:30px;}
.td12{width:10%;padding-left:12px;}




</style>";
  if(count($antrepot2)>0){
  $dimm1=0; $dimm2=0; $dimm3=0; foreach($antrepot2 as $row){$r++;
  $dimm1=round($row->dim1,2);
  $dimm2=round($row->dim2,2);
  $dimm3=round($row->dim3,2);
$table2="	<tr>
		<td colspan='10' class='td10 b s1_2'>45X45X45</td>
	</tr>";
}}
$table1= "    <table>
    	<tr>
    		<td class='td1 b s1_2'>$totalpieces</td>
    		<td class='td2 b s1_2'>$rs->gross_weight</td>
        <td class='td3 b s1_2'>k</td>
        <td class='td4 b s1_2'>$data->rate_class</td>
        <td class='td5 b s1_2'>$data->commdity_item_no</td>
        <td class='td6 b s1_2'>$totalvolum2</td>
        <td class='td7 b s1_2'>$data->rate_Charge</td>
        <td class='td8 b s1_2'>$total2</td>
        <td class='td9 b s1_2'>$rs->nature_and_quantity</td>
    	</tr>
	" .$table2. "
		</table>";

$partie_001 = "
<div id='t1_1' class='b s1_1'>410PAP64215675 <div id='t2_1' class='t s1_11'>$data->awb_number</div></div>
<div id='t3_1' class='b s1_2'>$data->account_number_shipper</div>
<div id='t4_1' class='b s1_2'>$data->name_shipper $data->ville_shipper $data->address_shipper $data->email_shipper  $data->tel_shipper</div>
<div id='t5_1' class='b s1_2'>$data->account_number_consignee</div>
<div id='t6_1' class='b s1_2'>$data->name_consignee $data->ville_consignee $data->address_consignee $data->email_consignee  $data->tel_consignee</div>
<div id='comp1' class=' s1_2'>
  <div id='t7_1' class='b s1_2'>$data->name_agent $data->adress_agent $data->ville_agent</div>
<div id='t8_1' class='b s1_2'>$data->accounting_information</div>
</div>
<div id='comp2' class=' s1_2'>
  <div id='t9_1' class='b s1_2'>$data->iata_code_agent</div>
<div id='t10_1' class='b s1_2'>$data->account_number_agent</div>
</div>
<div id='comp3' class=' s1_2'>
  <div id='t11_1' class='b s1_2'>PORT-AU-PRINCE HAITI INTE</div>
  <div id='t12_1' class='b s1_2'></div>
  <div id='t13_1' class='b s1_2'> </div>
<div id='t14_1' class='b s1_2'> </div>
</div>
<div id='comp4' class='b s1_2'>
  <div id='t15_1' class='b s1_2'>$data->route_to1</div>
  <div id='t16_1' class='b s1_2'>$data->route_first_carrier</div>
  <div id='t17_1' class='b s1_2'>$data->route_to2</div>
  <div id='t18_1' class='b s1_2'>$data->route_by1</div>
  <div id='t19_1' class='b s1_2'>$data->route_to3</div>
  <div id='t20_1' class='b s1_2'>$data->route_by2</div>
  <div id='t21_1' class='b s1_2'>$data->currency</div>
  <div id='t22_1' class='b s1_2'>$data->chcg</div>
  <div id='t23_1' class='b s1_2'>X</div>
  <div id='t24_1' class='b s1_2'>X</div>
  <div id='t25_1' class='b s1_2'>X</div>
  <div id='t26_1' class='b s1_2'>X</div>
  <div id='t27_1' class='b s1_2'>$data->value_for_carriage</div>
  <div id='t28_1' class='b s1_2'>$data->value_for_customs</div>
</div>
<div id='comp5' class='b s1_2'>
  <div id='t29_1' class='b s1_2'>$data->destination</div>
  <div id='t30_1' class='b s1_2'>$data->flight $data->date_flight</div>
  <div id='t31_1' class='b s1_2'></div>
  <div id='t32_1' class='b s1_2'></div>
</div>
<div id='comp6' class='b s1_2'>
  <div id='t33_1' class='b s1_2'>$data->flight $data->requirements</div>
  <div id='t34_1' class='b s1_2'>$data->flight $data->sci</div>
</div>
<div id='comp7' class='b s1_1'>
" .$table1. "
  </div>
  <div id='comp8' class='b s1_1'>
  <table>
      	<tr>
      		<td class='td1 b s1_2'>$totalpieces</td>
      		<td class='td2 b s1_2'>$rs->gross_weight</td>
          <td class='td3 b s1_2'></td>
          <td class='td4 b s1_2'></td>
          <td class='td5 b s1_2'></td>
          <td class='td6 b s1_2'></td>
          <td class='td7 b s1_2'></td>
          <td class='td11 b s1_2'>$total2</td>
          <td class='td9 b s1_2'></td>
      	</tr>
  		</table>
    </div>
    <div id='comp9' class='b s1_1'>
    <table>
    <tr>
      <td class='td1 b s1_2'>$pp</td>
      <td class='td2 b s1_2'></td>
      <td class='td3 b s1_2'></td>
      <td class='td4 b s1_2'></td>
      <td class='td12 b s1_2'>$cc</td>
      <td class='td6 b s1_2'></td>
      <td class='td7 b s1_2'></td>
      <td class='td11 b s1_2'></td>
      <td class='td9 b s1_2'></td>
    </tr>
    		</table>
      </div>



";

$content = "
".$style."
<page backtop=\"-2mm\" backbottom=\"0mm\" backleft=\"4mm\" backright=\"20mm\">

".$partie_001."

</page>";
    $html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output();
?>
