<?php
/*DATA*/
if(isset($_SESSION['droit']['a31']) and $_SESSION['droit']['a31']=="1"  ) {
}else{
redirect('home');
}
foreach($lesdepots as $row){}
$datecomp = $row->droitdepot;
	$datedepot ="";
	$datelivre = "";
	$resul = "";
	$calcul_date = "";
	
  switch(true){

    case ($row->datenotification !="0000-00-00" && $row->datelivre =="NULL" or $row->datenotification !="" && $row->datelivre ==""):
    $datedepot = diff_date($row->datenotification,$this->session->ladate);
    break;

    case ($row->datenotification !="0000-00-00" && $row->datelivre !="NULL" or $row->datenotification !="" && $row->datelivre !=""):
    $datedepot = diff_date($row->datenotification,$row->datelivre);
    break;



    default:
    break;
}
switch(true){



    case ($row->datenotification =="0000-00-00" && $row->datelivre !="NULL" or $row->datenotification =="" && $row->datelivre !=""):
    $datedepot = '0';
    break;

    case ($row->datenotification =="0000-00-00" && $row->datelivre =="NULL" or$row->datenotification =="" && $row->datelivre ==""):
    $datedepot ='0';
    break;

    default:
    break;
}
$total_poids = 0;
	$result = $this->Parser->get_degroupage($row->awb);
	if(count($result)>0){
	foreach($result as $r){
	$total_poids += $r->poids;
	}
}
$lbs=0;
$lbs=$row->weight* 2.20462;
$restant=$lbs-$total_poids;
if ($datedepot > $datecomp){
  $calcul_date=$datedepot-$datecomp;
$resul = $calcul_date*$row->prix_lbs*$restant;
if ($resul<10) $resul = 10;

}
$date=0;
$TotalArgent=0;
$AmountDue=0;
$TotalArgent=round($resul,2)-$row->rabais;
$AmountDue=$TotalArgent-$row->montant_hc-$row->rabais;
/*---------------------------*/

$style = "<style>
.b{
font-weight: bold;
}
.colorred{
color: red;
}
.noinv{
position: absolute;
top: 22px;
left: 627px;
font-size:13px;
width: 95px;
}

.date{
position: absolute;
top: 42px;
left: 627px;
font-size:13px;
width: 95px;

}


.Client{
position: absolute;
top: 243px;
left: 33px;
font-size:13px;
width: 200px;
}
.Montanttotal{
position: absolute;
top: 325px;
left: 468px;
font-size:13px;
}
.date_arrival{
position: absolute;
top: 355px;
left: 33px;
font-size:13px;
width: 90px;
}
.Reference{
position: absolute;
top: 355px;
left: 130px;
font-size:13px;
width: 90px;
}
.rate{
position: absolute;
top: 370px;
left: 499px;
font-size:13px;
width: 30px;
}
.defaul{
position: absolute;
top: 20px;
left: 627px;
font-size:13px;
width: 95px;
border: 1px solid red;
}
.remarque{
position: absolute;
top: 420px;
left: 33px;
font-size:13px;
width: 140px;
}
.qty{
position: absolute;
top: 420px;
left: 197px;
font-size:13px;
width: 40px;
}
.Klg{
position: absolute;
top: 420px;
left: 249px;
font-size:13px;
width: 40px;
}
.lb{
position: absolute;
top: 438px;
left: 249px;
font-size:13px;
width: 40px;
}
.tday{
position: absolute;
top: 420px;
left: 335px;
font-size:13px;
width: 40px;
}
.dueday{
position: absolute;
top: 420px;
left: 382px;
font-size:13px;
width: 40px;
}
.awbl{
position: absolute;
top: 420px;
left: 433px;
font-size:13px;
width: 100px;
}
.storageamount{
position: absolute;
top: 420px;
left: 545px;
font-size:13px;
width: 65px;

}
.discount{
position: absolute;
top: 420px;
left: 623px;
font-size:13px;
width: 45px;
}
.amountdue{
position: absolute;
top: 420px;
left: 680px;
font-size:13px;
width: 45px;
}
.subtotal{
position: absolute;
top: 650px;
left: 674px;
font-size:13px;
width: 45px;
}
.amountdue2{
position: absolute;
top: 673px;
left: 670px;
font-size:13px;
width: 45px;
}
</style>";

$content = "
".$style."
<page backimg=\"".base_url()."assets/images/InvoiceStorage.png\" backtop=\"0mm\" backbottom=\"0mm\" backleft=\"0mm\" backright=\"0mm\">



<div class=\"noinv\">
".$row->nofacture."
</div>

<div class=\"date\">
".dateVersChainetext($this->session->ladate)."
</div>

<div class=\"Client\">
".$row->consignee."
</div>

<div class=\"Montanttotal b colorred\">
".$AmountDue."
</div>

<div class=\"date_arrival\">
".dateVersChainetext($row->Date_of_arrival) ."
</div>

<div class=\"Reference\">
".$row->compagnie."
</div>

<div class=\"rate\">
".round($row->prix_lbs,2)."
</div>

<div class=\"remarque\">
".$row->remarque2."
</div>

<div class=\"qty\">
".$row->qty."
</div>

<div class=\"Klg\">
".$row->weight ."
</div>

<div class=\"lb\">
".round($lbs,2)."
</div>
<div class=\"tday\">
".$datedepot."
</div>
<div class=\"dueday\">
".$calcul_date."
</div>
<div class=\"awbl\">
".$row->awb."
</div>
<div class=\"storageamount\">
".$TotalArgent."
</div>
<div class=\"discount\">
".round($row->rabais,2)."
</div>
<div class=\"amountdue\">
".$AmountDue."
</div>
<div class=\"subtotal\">
".$row->montant_hc."
</div>
<div class=\"amountdue2 b\">
".$AmountDue."
</div>
<page_footer class=\"foot\">
copy [[page_cu]]/[[page_nb]] </page_footer>
</page>";


$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
