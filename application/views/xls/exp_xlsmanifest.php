<?php
mb_internal_encoding('UTF-8');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;




// Create new Spreadsheet object
$objPHPExcel = new Spreadsheet();

$objPHPExcel->getProperties();
$sheet = $objPHPExcel->getActiveSheet();
$objPHPExcel->getActiveSheet()->setCellValue([1, 1], "Date");
$objPHPExcel->getActiveSheet()->setCellValue([2, 1], "Flt #");
$objPHPExcel->getActiveSheet()->setCellValue([3, 1], "AWB #");
$objPHPExcel->getActiveSheet()->setCellValue([4, 1], "Q.Colis");
$objPHPExcel->getActiveSheet()->setCellValue([5, 1], "Dest.");
$objPHPExcel->getActiveSheet()->setCellValue([6, 1], "Orig.");
$objPHPExcel->getActiveSheet()->setCellValue([7, 1], "Description");
$objPHPExcel->getActiveSheet()->setCellValue([8, 1], "Shipper");
$objPHPExcel->getActiveSheet()->setCellValue([9, 1], "Broker");
$objPHPExcel->getActiveSheet()->setCellValue([10, 1], "Consignee");
$objPHPExcel->getActiveSheet()->setCellValue([11, 1], "Wt/LBS");
$objPHPExcel->getActiveSheet()->setCellValue([12, 1], "Wt/KGS");
$objPHPExcel->getActiveSheet()->setCellValue([13, 1], "Total Wt/Ch");
$objPHPExcel->getActiveSheet()->setCellValue([14, 1], "PP");
$objPHPExcel->getActiveSheet()->setCellValue([15, 1], "CC");
$objPHPExcel->getActiveSheet()->setCellValue([16, 1], "PP Due-A");
$objPHPExcel->getActiveSheet()->setCellValue([17, 1], "CC Due-A");
$objPHPExcel->getActiveSheet()->setCellValue([18, 1], "Due Carrier");
$objPHPExcel->getActiveSheet()->setCellValue([19, 1], "Montant PP");
$objPHPExcel->getActiveSheet()->setCellValue([20, 1], "TTL PP");

foreach($lemanifeste as $manifeste){}

$i = 1;
foreach($awb_data  as $data){
  // print_r($entitlement_agent2[$data->awb_number]);
  // print_r($entitlement_carrier2[$data->awb_number]);
  // die();
foreach($entitlement_agent2[$data->awb_number]  as $data2){}
foreach($entitlement_carrier2[$data->awb_number]  as $data3){}
  $i++;
  


//  if(count($antrepot2)>0){


  $r=0;  $totalpieces =0; $total =0; $vo_weight=0; $lbs=0; $totalvolum =0;
    $t1=round($data->dim1)*round($data->dim2)*round($data->dim3);
    $t2=$t1*$data->no_pieces;
    $vo_weight=$t2/366;
    $totalpieces += (float) $data->no_pieces;

  $totalvolum +=$vo_weight;
  $lbs=$data->gross_weight * 2.20462;




if ($data->gross_weight > round($totalvolum)){
$total=$data->rate_Charge*$data->gross_weight ;
} else{
 $total=$data->rate_Charge*$totalvolum ;
}

 

if($data->wt_val=="prepaid"){
  $pp = "PP";
  $cl="";
  $PPDueA=$data2->TotalDueAgent;
  $CCDA="";
  $DueCarrier=$data3->TotalDueCarrier;
  $montantpp=round($total,2)+$PPDueA+$DueCarrier;
  
}elseif($data->wt_val=="collect"){
  $pp = "";
  $cl = "CC";
  $PPDueA="";
  $CCDA=$data2->TotalDueAgent;
  $DueCarrier=$data3->TotalDueCarrier;
  $montantpp="";


}


 
$objPHPExcel->getActiveSheet()->setCellValue([1, $i], $manifeste->date);
$objPHPExcel->getActiveSheet()->setCellValue([2, $i], $manifeste->flight);
$objPHPExcel->getActiveSheet()->setCellValue([3, $i], $data->awb_number);
$objPHPExcel->getActiveSheet()->setCellValue([4, $i], $data->qty);
$objPHPExcel->getActiveSheet()->setCellValue([5, $i], $manifeste->country_unloading);
$objPHPExcel->getActiveSheet()->setCellValue([6, $i], "PAP");

$objPHPExcel->getActiveSheet()->setCellValue([7, $i], $data->nature_and_quantity);
$objPHPExcel->getActiveSheet()->setCellValue([8, $i], $data->name_shipper);
$objPHPExcel->getActiveSheet()->setCellValue([9, $i], $data->name_agent);
$objPHPExcel->getActiveSheet()->setCellValue([10, $i], $data->name_consignee);
$objPHPExcel->getActiveSheet()->setCellValue([11, $i], round($lbs,2));
$objPHPExcel->getActiveSheet()->setCellValue([12, $i], $data->gross_weight);
$objPHPExcel->getActiveSheet()->setCellValue([13, $i], round($total,2));
$objPHPExcel->getActiveSheet()->setCellValue([14, $i], $pp);
$objPHPExcel->getActiveSheet()->setCellValue([15, $i], $cl);
$objPHPExcel->getActiveSheet()->setCellValue([16, $i], $PPDueA);
$objPHPExcel->getActiveSheet()->setCellValue([17, $i], $CCDA);
$objPHPExcel->getActiveSheet()->setCellValue([18, $i], $DueCarrier);
$objPHPExcel->getActiveSheet()->setCellValue([19, $i], $montantpp);
$objPHPExcel->getActiveSheet()->setCellValue([20, $i], "");

}



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$filename = "Manifest_vol_Export" . date("Y-m-d-H:i:s") . "_" . mt_rand() . ".xls";
// Rien ne doit preceder le fichier Excel
while (ob_get_level() > 0) { ob_end_clean(); }
// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$writer = IOFactory::createWriter($objPHPExcel, 'Xls');
while (ob_get_level() > 0) { ob_end_clean(); }
$writer->save('php://output');
exit;