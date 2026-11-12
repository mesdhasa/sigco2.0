<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Excel extends CI_Controller {

	public function index()
	{

		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value
	    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Date");    
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "Montant");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "Monnaie");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "Description");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, 1, "No reçu");	
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, 1, "Rubrique");    
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, 1, "Fournisseur");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, 1, "Memo");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(9, 1, "Saisie par");
	    $i=1;

	    for ($t=0; $t < 20; $t++) { 

	     $i++;
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, '13-jan-2022');    
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $i, 3500);
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $i, 'HTG');
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $i, 'Desc');
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $i, '300');	
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $i, 'CAT');
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $i, 'Four');
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'Memo');	
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(9, $i, 'Par');
	    
	    }
        $writer = new Xls($spreadsheet); // instantiate Xlsx
 
        $filename = 'doc_'.date('YmdHis'); // set filename for excel file to be exported
 		ob_end_clean();
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 

	}

	public function lireExcel()
	{
		
		$data['act'] =	'lolo';
		$this->load->view('xls/xlstest',$data);
	}
	

}
?>
