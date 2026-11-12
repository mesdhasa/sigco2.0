<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class Rapports extends CI_Controller {

public function index()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']	=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);
}
public function depot()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lesdepots']= 	array();
$data['act']		=	'rapports';
$data['y']			=	'storage';
$this->load->view('droit_depot1',$data);
}

public function larecherche()
{
	if($_SESSION['account']['code'] == ""){
		redirect('login');
		}
		$data['act']		=	'rapports';
		$data['y']			=	'storage';
		// $data['lesdepots']			=$this->Parser->get_lesdroitt_depot();
		if(!empty($_POST['awbl']) && empty($_POST['date1']) && empty($_POST['date2']) ){
		if( isset($_POST['awbl'])){
		$data['lesdepots']= 	$this->Parser->get_droitt_depot($_POST['awbl']);
		$this->session->no = $_POST['awbl'];
		}}else{
		if(empty($_POST['awbl']) && !empty($_POST['date1']) && !empty($_POST['date2']) ){
		if( isset($_POST['date1']) && isset($_POST['date2'])){
		$data['lesdepots']= 	$this->Parser->recherche_depot_date(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
		$this->session->no = chaineVersDate($_POST['date1']);
		$this->session->no = chaineVersDate($_POST['date2']);
		}
		}
		
		}
		$this->load->view('storage_report',$data);
}
public function droit_depot_awb_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$id				= $this->uri->segment(3);
$data['id']		= $id;
$data['lesdepots']= 	$this->Parser->get_droitt_depot($id);
$data['awb']= 	$this->Parser->awb_degroup($id);
$this->session->no = $id;
// echo '<pre>',print_r($data['lesdepots']),'</pre>';

$this->load->view('pdf/storage_fees_due_awb_pdf',$data);
}

public function droit_depot_pdf_total()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$date1			= $this->uri->segment(5).'-'.$this->uri->segment(4).'-'.$this->uri->segment(3);
$date2		= $this->uri->segment(8).'-'.$this->uri->segment(7).'-'.$this->uri->segment(6);
$data['lesdepots']= 	$this->Parser->recherche_depot_date($date1,$date2);


$this->load->view('pdf/storage_fees_due',$data);
}

public function revenue_report_pdf_total()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1			= $this->uri->segment(5).'-'.$this->uri->segment(4).'-'.$this->uri->segment(3);
$date2		= $this->uri->segment(8).'-'.$this->uri->segment(7).'-'.$this->uri->segment(6);
$data['lesrevenue']= 	$this->Parser->get_factures_payer($date1,$date2);
// echo '<pre>',print_r($data['lesrevenue']),'</pre>';
$this->load->view('pdf/revenue_report',$data);
}
public function revenue_report()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lesrevenue']= 	array();
$data['act']		=	'rapports';
$data['y']			=	'revenue';
$this->load->view('renenue_report',$data);
}

public function rec_revenue_report()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lesrevenue']= 	array();
$data['act']		=	'rapports';
$data['y']			=	'revenue';
if(!empty($_POST['awbl']) && empty($_POST['date1']) && empty($_POST['date2']) ){
if( isset($_POST['awbl'])){
$data['lesrevenue']= 	$this->Parser->get_factures_payer($_POST['awbl']);
$this->session->no = $_POST['awbl'];
}}else{
if(empty($_POST['awbl']) && !empty($_POST['date1']) && !empty($_POST['date2']) ){
if( isset($_POST['date1']) && isset($_POST['date2'])){
$data['lesrevenue']= 	$this->Parser->get_factures_payer(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
$this->session->no = chaineVersDate($_POST['date1']);
$this->session->no = chaineVersDate($_POST['date2']);
}
}

}
$this->load->view('renenue_report',$data);
}
public function weekly_search ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$_POST['type']= "";

$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('weekly_report',$data);
}
public function weekly_search2 ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
if($_POST['type']=="import"){
if(!empty($_POST['date1']) && !empty($_POST['date2'])){
	$data['lessegments']= 	$this->Parser->recherche_weekly1(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$_POST['type']);
}
}else {
	if(!empty($_POST['date1']) && !empty($_POST['date2'])){
		$data['lessegments']= 	$this->Parser->recherche_weekly2(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$_POST['type']);
	}
}

$this->load->view('weekly_report',$data);
}
public function weekly_search_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$type='import';
$data['lessegments']= 	$this->Parser->recherche_weekly1($date1,$date2,$type);
$this->load->view('pdf/weekly_search_pdf',$data);
}

public function weekly_search_pdf2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$type='export';
$data['lessegments']= 	$this->Parser->recherche_weekly2($date1,$date2,$type);
$this->load->view('pdf/weekly_search_pdf2',$data);
}
public function commission_weight_search ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$_POST['type']= "";
$_POST['custum']= "";

$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('commission_weight',$data);
}
public function commission_weight_search2 ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
if($_POST['type']=="import"){
if(!empty($_POST['date1']) && !empty($_POST['date2'])){
	$data['lessegments']= 	$this->Parser->recherche_commission_weight1(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$_POST['type']);
}
}else {
	if(!empty($_POST['date1']) && !empty($_POST['date2'])){
		$data['lessegments']= 	$this->Parser->recherche_commission_weight2(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
	}
}
// echo '<pre>',print_r($data['lessegments']),'</pre>';

$this->load->view('commission_weight',$data);
}
public function commission_weight_search_pdf1()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$per =	$this->uri->segment(5);
$type='import';
$data['lessegments']= 	$this->Parser->recherche_commission_weight1($date1,$date2,$type);
$this->load->view('pdf/commission_weight',$data);
}

public function commission_weight_search_excel()
	{
		$date1 =	$this->uri->segment(3);
		$date2 =	$this->uri->segment(4);
		$per =	$this->uri->segment(5);
		$type='import';
		$data['lessegments']= 	$this->Parser->recherche_commission_weight1($date1,$date2,$type);

		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
		$range1=A1;
		$range2=O1;
        // manually set table data value
		$spreadsheet->getActiveSheet()
            ->getStyle("$range1:$range2")
            ->getFont()
            ->setSize(24);
			$spreadsheet->getActiveSheet()
            ->getStyle("2")
            ->getFont()
            ->setSize(16);
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$spreadsheet->getActiveSheet()->mergeCells("$range1:$range2");
		$spreadsheet->getActiveSheet()->getStyle("$range1:$range1")->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->getStyle(2)->getAlignment()->setHorizontal('center');
	    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "COMMISSION ON WEIGHT CHARGES (Inbound)" .dateVersChainetext($date1) .",au,". dateVersChainetext($date2)); 
	    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 2, "Date");    
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, 2, "AWB #");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, 2, "Orig");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, 2, "Wt/Ch");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, 2, "$per %");	
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, 2, "REMARKS");    
	    $i=2;

	    foreach($data['lessegments'] as $rs){$i++;
			$b=($rs->weight_charge*trim($per)/100);
			$c+=$b;
	$spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal('center');
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, dateVersChainetext($rs->Date_of_arrival));    
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $rs->awbl);
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $rs->Place_of_departure_code);
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $rs->weight_charge);
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $i, round($b,2));	
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $rs->remarque2);
	    
	    }
		$z=$i+1;
		$spreadsheet->getActiveSheet()
            ->getStyle("$z")
            ->getFont()
            ->setSize(16);
		$range3="A".$z;
		$range4="C".$z;;
		$spreadsheet->getActiveSheet()->getStyle("$range3:$range4")->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->mergeCells("$range3:$range4");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $z, "Total"); 
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $z, 	round($c,2)); 


        $writer = new Xls($spreadsheet); // instantiate Xlsx
 
        $filename = 'COMMISSION ON WEIGHT CHARGES (Inbound),'.dateVersChainetext($date1).'_au_'.dateVersChainetext($date2); // set filename for excel file to be exported
 		ob_end_clean();
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 

	}



public function commission_weight_search_pdf2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$per =	$this->uri->segment(5);
$data['lessegments']= 	$this->Parser->recherche_commission_weight2($date1,$date2);
$this->load->view('pdf/commission_weight2',$data);
}

public function commission_weight_search_excel2()
	{
		$date1 =	$this->uri->segment(3);
		$date2 =	$this->uri->segment(4);
		$per =	$this->uri->segment(5);
		$type='import';
		$data['lessegments']= 	$this->Parser->recherche_commission_weight2($date1,$date2,$type);

		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
		$range1=A1;
		$range2=O1;
        // manually set table data value
		$spreadsheet->getActiveSheet()
            ->getStyle("$range1:$range2")
            ->getFont()
            ->setSize(24);
			$spreadsheet->getActiveSheet()
            ->getStyle("2")
            ->getFont()
            ->setSize(16);
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$spreadsheet->getActiveSheet()->mergeCells("$range1:$range2");
		$spreadsheet->getActiveSheet()->getStyle("$range1:$range1")->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->getStyle(2)->getAlignment()->setHorizontal('center');
	    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "COMMISSION ON WEIGHT CHARGES (Outbound)" .dateVersChainetext($date1) .",au,". dateVersChainetext($date2)); 
	    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 2, "Date");    
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, 2, "AWB #");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, 2, "Dest");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, 2, "Wt/Ch");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, 2, "$per %");	
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, 2, "REMARKS");    
	    $i=2;

	    foreach($data['lessegments'] as $rs){$i++;
			if($rs->void=="1"){
			}else{
			  if ($rs->gross_weight > round($rs->totalvolum)){
				$weight=$rs->rate_Charge*$rs->gross_weight;
			   } 
			   if ($rs->gross_weight < round($rs->totalvolum)){
				$weight=$rs->rate_Charge*$rs->totalvolum;
				 } 
				 $b=($weight*trim($this->uri->segment(5))/100);
				 $c+=$b;
	$spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal('center');
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $i, dateVersChainetext($rs->date));    
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $rs->awb_number);
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $rs->route_to1);
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $i, round($weight,2));
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $i, round($b,2));	
	$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $rs->remarque2);
				}
	    }
		$z=$i+1;
		$spreadsheet->getActiveSheet()
            ->getStyle("$z")
            ->getFont()
            ->setSize(16);
		$range3="A".$z;
		$range4="C".$z;;
		$spreadsheet->getActiveSheet()->getStyle("$range3:$range4")->getAlignment()->setHorizontal('center');
		$spreadsheet->getActiveSheet()->mergeCells("$range3:$range4");
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $z, "Total"); 
		$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $z, 	round($c,2)); 


        $writer = new Xls($spreadsheet); // instantiate Xlsx
 
        $filename = 'COMMISSION ON WEIGHT CHARGES (Outbound),'.dateVersChainetext($date1).'_au_'.dateVersChainetext($date2); // set filename for excel file to be exported
 		ob_end_clean();
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 

	}




public function commission_fees_search ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$_POST['type']= "";
$_POST['custum']= "";
$_POST['custum2']= "";
$_POST['custum3']= "";

$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('commission_fees',$data);
}
public function commission_fees_search2 ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
if($_POST['type']=="import"){
if(!empty($_POST['date1']) && !empty($_POST['date2'])){
	$data['lessegments']= 	$this->Parser->recherche_commission_fees1(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$_POST['type']);
}
}
$this->load->view('commission_fees',$data);
}
public function savecheck()
{
	if($_SESSION['account']['code'] == ""){
	redirect('login');
	}
	$this->load->library('Pdf');

	$data['date1'] =$_POST['date1'];
	$data['date2'] =$_POST['date2'];
	$data['per'] =$_POST['amount'];
	$data['voucher']=$_POST['voucher'];
	$data['gl']=$_POST['gl'];
	$data['id']=$_POST['choice'];
	$type='import';
	$data['lessegments']= 	$this->Parser->recherche_commission_fees1($data['date1'],$data['date2'],$type);
	$this->load->view('pdf/commission_handling',$data);
}
public function commission_handling_pdf1()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$data['date1'] =$_POST['date1'];
$data['date2'] =$_POST['date2'];
$data['per'] =$_POST['amount'];
$data['voucher']=$_POST['voucher'];
$data['gl']=$_POST['gl'];
$data['id']=$_POST['choice'];
$type='import';
$data['lessegments']= 	$this->Parser->recherche_commission_fees1($data['date1'],$data['date2'],$type);
$this->load->view('pdf/commission_handling',$data);
}

public function DueAgent()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('due_agent_report',$data);
}
public function RecherDueAgent()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($_POST['date1']) && !empty($_POST['date2'])){
	$data['lessegments']= 	$this->Parser->RecherDueAgent(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
}
$this->load->view('due_agent_report',$data);
}

public function RecherDueAgentPdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$data['compagnie']	= 	$this->Parser->get_compagnie();
$data['lessegments']= 	$this->Parser->RecherDueAgent($date1,$date2);

$this->load->view('pdf/DueAgentReportPdf',$data);
}


}
?>
