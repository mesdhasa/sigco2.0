<?php
mb_internal_encoding('UTF-8');
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


$helper = new Sample();
if ($helper->isCli()) {
    $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

    return;
}

// Create new Spreadsheet object
$objPHPExcel = new Spreadsheet();

$objPHPExcel->getProperties();
$sheet = $objPHPExcel->getActiveSheet();
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Date");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "Flt #");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "AWB #");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "Q.Colis");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, "Commodity");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, "Consignee");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, "Wt/LBS");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, "Wt/KGS");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, "Wt/Ch");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, 1, "D/A & D/C");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, 1, "PP");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, 1, "CC");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, 1, "TTL CC");
$i = 1;
$pp = "";
$cl = "";
$nc = "";
$totalkgs = 0;
$totallbs = 0;
foreach($lesawb as $row){
    $i++;
 
    $lbs = 2.2 * floatval($row->weight);
    $totalkgs=floatval($row->weight);
	$totallbs=$lbs;
    if($row->prepaid=="1"){
        $pp = "PP";
        $cl="";
    }elseif($row->collect=="1"){
        $pp = "";
        $cl = "CC";
    }
  

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i,   $row->Date_of_arrival);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i,   $row->Voyage_number);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i,   $row->awbl);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i,   $row->qty);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i,   $row->package);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i,   $row->consignee);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i,   $totallbs);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i,   $totalkgs);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i,   $row->weight_charge);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i,  "");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i,  $pp);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i,  $cl);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i,  $row->freight);
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$filename = "Manifest_vol_IMPORT" . date("Y-m-d-H:i:s") . "_" . mt_rand() . ".xls";
ob_end_flush(); // IMPORTANT SINON CELA NE MARCHE PAS
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
ob_end_clean();// IMPORTANT SINON CELA NE MARCHE PAS
$writer->save('php://output');
exit;