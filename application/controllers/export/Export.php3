<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Export extends CI_Controller {



public function index()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		='e';
$data['y']			='ajouter';
$data['lesmanifeste']= 	$this->Parser_export->get_manifeste();
$data['page'] = 'export/export';
$this->load->view('template', $data);
}


public function add_reservation()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		='e';
$data['y']			='reservation';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['page'] = 'export/reservation';
$this->load->view('template', $data);
}

public function ajouter_reservation()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$compagnie	=	$this->input->post('compagnie');
$addawbl	=	$this->input->post('awblnum');
$add_noreserv	=	$this->input->post('no_reservation');
$value=$this->Parser_export->verify_awbl($addawbl);
$value_noreserv=$this->Parser_export->verify_noreserv($add_noreserv);
if ($value){
$this->session->set_flashdata('sms_ajouter_reservation','air waybill: '.$addawbl.' existe d&eacute;j&agrave;');
redirect('creer-une-reservation');
}
if ($value_noreserv){
$this->session->set_flashdata('sms_ajouter_reservation','Ce code: '.$add_noreserv.' existe d&eacute;j&agrave;');
redirect('creer-une-reservation');
}
elseif(!empty($_POST['no_reservation'])){
$data = array(
'idcompagnie'	=> 	$compagnie,
'code_reservation' 		=> 'N/R',
'no_reservation' 		=> $_POST['no_reservation'] ,
'no_awbl' 		=> $_POST['awblnum'],
'shipper' 			=> $_POST['shipper'],
'consignee' 			=> $_POST['consignee'],
'code_origine' 			=> $_POST['code_origine'],
'code_destinataire' 			=> $_POST['code_destination'],
'description_colis' 			=> $_POST['nature_of_goods'],
'prepaid'	=> $_POST['pp'],
'collect'	=> $_POST['cc'],
'nocharge'	=> $_POST['nc'],
'nom_user' 			=> $_POST['received'],
'date' 			=> date('YmdHis'),
'remarque' 			=> $_POST['remarque'],
);


$is_true=false;
$is_true=$this->Parser_export->add_reservation($data);
if($is_true){
$data['noreservpdf']= 	$this->Parser_export->recherche_noreservpdf($_POST['no_reservation']);
foreach($data['noreservpdf'] as $rs){}
$link = anchor('reservation.pdf/'.$rs->id_reservation.'','PDF Reservation','target="_blank"');
$message = 'No réservation: &nbsp' .' '.$rs->no_reservation.' '.'&nbspInserer avec success cliquez ici &nbsp'.''. $link .'';
$this->session->set_flashdata('sms', $message);
redirect('reservation');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('reservation');
}
}else {

$noreser	=	date('ymd').mt_rand(11,99);
$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));
$data = array(
'idcompagnie'	=> 	$compagnie,
'code_reservation' 		=> 'N/R',
'no_reservation' 		=>$noreser,
'no_awbl' 		=> $_POST['awblnum'],
'shipper' 			=> $_POST['shipper'],
'consignee' 			=> $_POST['consignee'],
'code_origine' 			=> $_POST['code_origine'],
'code_destinataire' 			=> $_POST['code_destination'],
'description_colis' 			=> $_POST['nature_of_goods'],
'prepaid'	=> $_POST['pp'],
'collect'	=> $_POST['cc'],
'nocharge'	=> $_POST['nc'],
'nom_user' 			=> $_POST['received'],
'date' 			=> $date->format('Y-m-d H:i:s'),
'remarque' 			=> $_POST['remarque'],
);

$is_true=false;
$is_true=$this->Parser_export->add_reservation($data);
if($is_true){
$data['noreservpdf']= 	$this->Parser_export->recherche_noreservpdf($noreser);
foreach($data['noreservpdf'] as $rs){}
$link = anchor('reservation.pdf/'.$rs->id_reservation.'','PDF Reservation');
$message = 'No réservation: &nbsp' .' '.$rs->no_reservation.' '.'&nbspInserer avec success cliquez ici &nbsp'.''. $link .'';
$this->session->set_flashdata('sms', $message);
redirect('reservation');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('reservation');
}

}
}
public function ajouter_warehouse()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
;
// $value=$this->Parser_export->verify_awbl_table($addawbl);
// $value2=$this->Parser_export->verify_awbl($addawbl);
// if ($value){
// 	$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave;');
// 	redirect('warehouse');
// }
// elseif($value2){
// 	$resul 	= $this->Parser_export->get_noawbl($addawbl);
// 	$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));
// 	foreach($resul as $rs){}
// 		$data = array(
// 			'code_warehouse' 		=> 'W/R',
// 			'no_warehouse' 		=> $rs->no_reservation ,
// 			'no_awbl' 	=> $_POST['awblnum'],
// 			'carrier '	=> $_POST['compagnie'],
// 			'shipper' 	=> $_POST['shipper'],
// 			'consignee '	=> $_POST['consignee'],
// 			'destination'	=> $_POST['code_destination'],
// 			'control_no '	=> $_POST['control_no'],
// 			'no_of_pieces'	=> $_POST['no_of_pieces'],
// 		'actual_weight'	=> $_POST['actual_weight'],
// 			'volume_weight'	=> $_POST['volume_weight'],
// 			'no_excep_noted'	=> $_POST['no_exception_noted'],
// 		'excep_noted'	=> $_POST['exception_noted'],
// 			// 'custumer_signature'	=> $_POST[''],
// 			'receiving'	=> $_POST['receiving'],
// 			' cooler' 	=> $_POST['cooler'],
// 			'office '	=> $_POST['office'],
// 		'contaider'	=> $_POST['container'],
// 			'commodity'	=> $_POST['commodity'],
// 			'entered_by'	=>$_POST['entered_by'],
// 			'received '	=> $_POST['received'],
// 			'ladate' 	=> $date->format('Y-m-d H:i:s'),
// 			// 'total_weight '	=> $_POST[''],
// 			'remarque '	=> $_POST['remarque']
// 		);
// 		for ($i=0; $i<count($_POST['qt']) ; $i++) {
// 				if(isset($_POST['qt'][$i]) != NULL && isset($_POST['dim1'][$i])!= NULL  && isset($_POST['dim2'][$i])!= NULL  && isset($_POST['dim3'][$i])!= NULL  ){
// 				$data2[]=array(
// 									'id_warehouse'	=> $_POST['awblnum'],
// 									'no_pieces'	=> $_POST['qt'][$i],
// 									'dim1'	=> $_POST['dim1'][$i],
// 									'dim2'	=> $_POST['dim2'][$i],
// 									'dim3'	=> $_POST['dim3'][$i],
// 										);
// 									}}
//
// 		$data3= array(
// 			'shipper' => $_POST['shipper'],
// 			'consignee' => $_POST['consignee'],
// 			'code_destinataire' =>  $_POST['code_destination']
// 		);
// 		$is_true=false;
// 		$is_true=$this->Parser_export->add_warehouse($data);
// 		$is_true=$this->Parser_export->add_warehouse_colis($data2);
// 		$is_true=$this->Parser_export->update_reserv_warehouse($data3,$rs->no_reservation );
//
// 		if($is_true){
// 			$this->session->set_flashdata('sms',' No Wharehouse &nbsp'.$rs->no_reservation.'&nbspInserer avec success cliquez ici &nbsp');
// 				redirect('warehouse');
// 		}else{
// 			$this->session->set_flashdata('sms',' No Wharehouse &nbsp'.$rs->no_reservation.'&nbspInserer avec success cliquez ici &nbsp');
// 				redirect('warehouse');
// 		}
// }
$nowhare	=	$this->Parser_export->give_num_no_warehouse();
$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));
$data = array(
'code_warehouse' 		=> 'W/R',
'no_warehouse' 		=> $nowhare,
// 'no_awbl' 	=> $this->input->post('awblnum'),
'nom_ch '	=> strtoupper($_POST['nom']),
// 'idcompagnie'	=> $_POST['compagnie'],
'prenom_ch' 	=> strtoupper($_POST['prenom']),
'cin_ch'	=> strtoupper($_POST['cin']),
'tel_ch'	=> strtoupper($_POST['tel']),
'gross_weight '	=> $_POST['gross_weight'],
// 'no_of_pieces'	=> $_POST['no_of_pieces'],
// 'actual_weight'	=> $_POST['actual_weight'],
// 'volume_weight'	=> $_POST['volume_weight'],
'nom_p'	=> strtoupper($_POST['nomp']),
'email_p'	=> $_POST['email'],
// 'custumer_signature'	=> $_POST[''],
'tel_p'	=> strtoupper($_POST['tel']),
'remarque' 	=> strtoupper($_POST['remarque']),
'ladate'	=> $date->format('Y-m-d H:i:s'),
'nature_and_quantity'	=> strtoupper($_POST['nature_of_goods']),
'status'	=>'1'

);
$data_awb = array(
'awb_number' => $this->input->post('awblnum'),
'status'	=>'1'
);
$insert = array();
$insert['awbl'] 		     =  $this->input->post('awblnum');
$insert['segmentid'] 		 = 	$_POST['compagnie'];
$insert['typeawbl'] 		 = 	'export';

for ($i=0; $i<count($_POST['qt']) ; $i++) {
if(!empty($_POST['qt'][$i]) && !empty($_POST['dim1'][$i]) && !empty($_POST['dim2'][$i]) && !empty($_POST['dim3'][$i])){
// $total_pieces=0;
// $total_pieces += $_POST['qt'][$i];
// $t1=round($_POST['dim1'],2)[$i]*round($_POST['dim2'],2)[$i]*round($_POST['dim3'],2)[$i];
// $t2=$t1*$total_pieces;
// $t3=$t2/366;
$data2[]=array(
// 'id_warehouse'	=> $_POST['awblnum'],
'id_warehouse'	=> $nowhare,
'no_pieces'	=> $_POST['qt'][$i],
'dim1'	=> round($_POST['dim1'][$i],2),
'dim2'	=> round($_POST['dim2'][$i],2),
'dim3'	=> round($_POST['dim3'][$i],2),

);

}else{

}
}

// echo "<pre>";
// print_r($data2);
// echo "</pre>";
// $is_true=false;
$is_true=false;
// $is_true=$this->Parser->set_addawbl_exp($insert);
$is_true=$this->Parser_export->add_warehouse($data);
// $is_true=$this->Parser_export->add_awbl($data_awb);
if (empty($data2)) {
// code...
}else {
$is_true=$this->Parser_export->set_warehouse_colis($data2);
}

if($is_true){
// $this->session->set_flashdata('sms',' No Wharehouse &nbsp'.$nowhare.'&nbspInserer avec success,cliquez ici&nbsp');
redirect("modifier_warehouse/".$nowhare);
}else{
// $this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('warehouse');
}

}
public function modifier_ajouter_warehouse()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
if ($value){
$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave;');
redirect('warehouse');
}

else{
$id=$_POST['warehouse'];
$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));
$data = array(
'nom_ch '	=> strtoupper($_POST['nom']),
'prenom_ch' 	=> strtoupper($_POST['prenom']),
'cin_ch'	=> $_POST['cin'],
'tel_ch'	=> strtoupper($_POST['tel']),
'gross_weight '	=> $_POST['gross_weight'],
'nom_p'	=> strtoupper($_POST['nomp']),
'email_p'	=> $_POST['email'],
'tel_p'	=> strtoupper($_POST['tel']),
'remarque' 	=> strtoupper($_POST['remarque']),
'nature_and_quantity'	=> strtoupper($_POST['nature_of_goods']),
'ladate'	=> $date->format('Y-m-d H:i:s')
);


$is_true=false;
$is_true=$this->Parser_export->update_warehouse($id,$data);
if($is_true){
redirect("modifier_warehouse/".$_POST['warehouse']);
}else{
redirect("modifier_warehouse/".$_POST['warehouse']);
}
}
}

public function edit_warehouse()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];
$data = array(
'no_awbl' 		=> $_POST['awblnum'],
'shipper' 			=> strtoupper($_POST['shipper']),
'carrier' 		=> strtoupper($_POST['carrier']),
'qty' 			=> $_POST['Qty'],
'qtytotal' 			=> $_POST['Of'],
'description_colis' 			=> strtoupper($_POST['nature_of_goods']),
'remarque' 			=> strtoupper($_POST['remarque']),
);

$this->Parser_export->set_warehouse($id,$data);
redirect('warehouse');
}
public function modifier_reservation()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id 	= $this->uri->segment(2);
$data['act']		='e';
$data['y']			='reservation';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['lareservation'] 	= $this->Parser_export->get_lareservation($id);
$data['page'] = 'export/mod_reservation';
$this->load->view('template', $data);
}
public function ajouter_un_manifeste()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		='e';
$data['y']			='ajouter';
$data['page'] = 'export/manifeste';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$this->load->view('template', $data);
}
public function add_manifeste()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$compagnie	=	$this->input->post('compagnie');

if(empty($_POST['compagnie'])){
$this->session->set_flashdata('sms_add_manifeste2','erreur insertion,choisissez une compagnie ');
redirect('creer-un-manifeste');
}else {
$data = array(

'idcompagnie'	=> 	$compagnie,
'air_craft' 		=> $_POST['air_craft'],
'flight' 		=> $_POST['flight'],
'date' 			=> chaineversdate($_POST['dateflt']),
'country_loading' 			=> "HTPAP",
'country_unloading' 			=> strtoupper($_POST['country_unloading']),
'type_manifeste' 			=>'Export',
);

$is_true=false;
$is_true=$this->Parser_export->add_manifeste($data);
if($is_true){
$this->session->set_flashdata('sms_add_manifeste','Inserer avec success.');
redirect('manifeste');
}else{
$this->session->set_flashdata('sms_add_manifeste','Veuillez contacter.......');
redirect('manifeste');
}

}
}
public function edit_manifeste()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];
$compagnie	=	$this->input->post('compagnie');
$data = array(
'idcompagnie'	=> 	$compagnie,
'air_craft' 		=> $_POST['air_craft'],
'flight' 		=> $_POST['flight'],
'date' 			=> chaineversdate($_POST['dateflt']),
'country_loading' 			=> "HTPAP",
'country_unloading' 			=> strtoupper($_POST['country_unloading']),

);

$this->Parser_export->set_a_manifeste($id,$data);
$this->session->set_flashdata('sms_add_manifeste','Modifier avec success.');
redirect('manifeste');
}
public function edit_reservation()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];
$compagnie	=	$this->input->post('compagnie');

if(!empty($_POST['no_reservation'])){
$data = array(
'idcompagnie'	=> 	$compagnie,
'no_reservation' 		=> $_POST['no_reservation'] ,
'no_awbl' 		=> $_POST['awblnum'],
'shipper' 			=> $_POST['shipper'],
'consignee' 			=> $_POST['consignee'],
'code_origine' 			=> $_POST['code_origine'],
'code_destinataire' 			=> $_POST['code_destination'],
'description_colis' 			=> $_POST['nature_of_goods'],
'nom_user' 			=> $_POST['received'],
'date' 			=> date('Y-m-d-H-i-s'),
'remarque' 			=> $_POST['remarque'],
);


	$is_true=false;
	$is_true=$this->Parser_export->set_a_reservation($id,$data);
	if($is_true){
		$this->session->set_flashdata('sms_modifier',' No réservation &nbsp'.$_POST['no_reservation'].'&nbspModifier avec success cliquez ici &nbsp');
			redirect('reservation');
	}else{
		$this->session->set_flashdata('sms_modifier',' No réservation &nbsp'.$_POST['no_reservation'].'&nbspModifier avec success cliquez ici &nbsp');
			redirect('reservation');
	}
}else {
$noreser	=	$_POST['code_reser'];
$data = array(
'idcompagnie'	=> 	$compagnie,
'no_awbl' 		=> $_POST['awblnum'],
'shipper' 			=> $_POST['shipper'],
'consignee' 			=> $_POST['consignee'],
'code_origine' 			=> $_POST['code_origine'],
'code_destinataire' 			=> $_POST['code_destination'],
'description_colis' 			=> $_POST['nature_of_goods'],
'nom_user' 			=> $_POST['received'],
'date' 			=> date('YmdHis'),
'remarque' 			=> $_POST['remarque'],
);

$is_true=false;
$is_true=$this->Parser_export->set_a_reservation($id,$data);
if($is_true){
$this->session->set_flashdata('sms_modifier',' No réservation &nbsp'.$noreser.'&nbspInserer avec success,cliquez ici&nbsp');
redirect('reservation');
}else{
$this->session->set_flashdata('sms_modifier',' No réservation &nbsp'.$noreser.'&nbspModier avec success,cliquez ici&nbsp');
redirect('reservation');
}
}
}
public function ajax_prepaidcollect()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
if(isset($_POST['id'])){
$this->Parser_export->set_prepaidcollect($_POST['id'],$_POST['pp'],$_POST['cl'],$_POST['nc']);
}
}
public function supprimer_manifeste($id)
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$reponse = $this->Parser_export->delete_manifeste($id);

$this->session->set_flashdata('sms_add_manifeste','Votre manifeste est supprimé avec succès.');

redirect('manifeste');
}
public function delete_warehouse_colis()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$reponse = $this->Parser_export->delete_warehouse_colis($this->uri->segment(4));

redirect("modifier_warehouse/".$this->uri->segment(5));
}
public function supprimer_reservation($id)
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$reponse = $this->Parser_export->delete_reservation($id);

$this->session->set_flashdata('sms_add_manifeste','Votre manifeste est supprimé avec succès.');

redirect('reservation');
}
public function supprimer_warehouse($id)
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$reponse = $this->Parser_export->delete_warehouse(($this->uri->segment(4)));
$reponse = $this->Parser_export->delete_warehouse_colis2(($this->uri->segment(5)));
$this->session->set_flashdata('sms_add_manifeste','Votre manifeste est supprimé avec succès.');
redirect('warehouse');
}
public function modifier_un_manifeste()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id 	= $this->uri->segment(2);
$data['act']		='e';
$data['y']			='recherche';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['lemanifeste'] 	= $this->Parser_export->get_lemanifeste($id);
$data['page'] = 'export/manifeste_edit';
$this->load->view('template', $data);
}
public function liste_awb()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		='e';
$data['y']			='ajouter';
$id 	= $this->uri->segment(3);
$lemanifeste 	= $this->Parser_export->get_lemanifeste($id);
foreach($lemanifeste as $rs){}
if ($rs->vol_fermer=="0") {
$data['lesawb']= 	$this->Parser_export->get_all_awb();
$this->load->view('export/liste_awb', $data);
}else{
redirect('manifeste');

}

}
public function add_awb_manifest()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

if(isset($_POST['lesid'])){
foreach($_POST['lesid'] as $row){
$vol_valide2 = "";

if(isset($_POST["vol_valide".$row])){
$vol_valide2 = $_POST['vol_valide'.$row];
}
$databill[]=array(
'id_awbl'		=>$row,
'id_manifeste'	=>$vol_valide2
);
}
$id = $_POST['idmanifeste'];
$idvol = $_POST['comp'];
$data=array(
'status'		=>'1',
);
// 	 echo "<pre>";
// print_r($idvol.'/'.$id);
//    echo "</pre>";
$this->Parser_export->set_les_awbl($databill);
$this->Parser_export->update_manifest_awbl($id,$data);
}
redirect("lister_awb_vol/".$idvol.'/'.$id);
}
public function fermer_vol()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(5);
$idvol = $this->uri->segment(4);
$data = array(
'vol_fermer'	=> 	"1",
);
$this->Parser_export->set_a_manifeste($id,$data);
redirect("lister_awb_vol/".$idvol.'/'.$id);
}
public function ouvrir_vol()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(5);
$idvol = $this->uri->segment(4);
$data = array(
'vol_fermer'	=> 	"0",
);
$this->Parser_export->set_a_manifeste($id,$data);
redirect("lister_awb_vol/".$idvol.'/'.$id);
}
public function remove_awb_manifest()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

if(isset($_POST['lesid'])){
foreach($_POST['lesid'] as $row){
$vol_valide2 = '0';

if(isset($_POST["vol_valide".$row]) ){
$vol_valide2 = $_POST['vol_valide'.$row];
}

$databill[]=array(
'id_awbl'		=>$row,
'id_manifeste'	=>$vol_valide2
);
}
$id = $_POST['idmanifeste'];
$idvol = $_POST['comp'];
// 	 echo "<pre>";
// print_r($databill);
//    echo "</pre>";
$this->Parser_export->set_les_awbl($databill);
}
redirect("lister_awb_vol/".$idvol.'/'.$id);
}
public function liste_awb_vol()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		='e';
$data['y']			='recherche';
$id 	= $this->uri->segment(3);
$data['lemanifeste'] 	= $this->Parser_export->get_lemanifeste($id);
$data['lesawb']= 	$this->Parser_export->get_all_awb_vol($id);

//  echo "<pre>";
// 	print_r($data['lesawb']);
// 	   echo "</pre>";
$this->load->view('export/liste_awb_vol', $data);
}
public function manifest_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$id 	= $this->uri->segment(5);
$data['lemanifeste'] 	= $this->Parser_export->get_lemanifeste2($id);
$data['lesawb']= 	$this->Parser_export->get_all_awb_vol($id);
// print_r($data['lareservation']);
$this->load->view('pdf/pdfmanifest.php' ,$data);
}

public function ExpManifestxls()
{
	if($_SESSION['account']['code'] == ""){
		redirect('login');
	}
	
	$id 	= $this->uri->segment(5);
	$data['lemanifeste'] 	= $this->Parser_export->get_lemanifeste2($id);
	$data['lesawb']= 	$this->Parser_export->get_all_awb_vol($id);
	// echo "<pre>";
	//  print_r($data['lemanifeste']);
	// print_r($data['lesawb']);
	// echo "</pre>";

	$this->load->view('xls/exp_xlsmanifest',$data);
}



public function rech_manifeste()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lesmanifeste']= 	array();
$data['act']		='e';
$data['y']			='recherche';
if(!empty($_POST['custum']) && empty($_POST['date1']) && empty($_POST['date2']) ){
$data['lesmanifeste']= 	$this->Parser_export->recherche_vol($_POST['custum']);
$this->session->no = $_POST['custum'];
}else{
if(empty($_POST['custum']) && !empty($_POST['date1']) && !empty($_POST['date2']) ){
$data['lesmanifeste']= 	$this->Parser_export->recherche_vol_date(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
$this->session->no = chaineVersDate($_POST['date1']);
$this->session->no = chaineVersDate($_POST['date2']);
}
}
// print_r($data['lesmanifeste']);
$data['page'] = 'export/recherche_manifeste';
$this->load->view('template', $data);
}
public function  recherche_reservation()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lesreservation']= 	array();

$data['act']		='e';
$data['y']			='reservation';
if(!empty($_POST['custum'])){
$data['lesreservation']= 	$this->Parser_export->recherche_reserv($_POST['custum']);
$this->session->no = $_POST['custum'];
}else{

}
// print_r($data['lesreservation']);

$data['page'] = 'export/rech_reservation';
$this->load->view('template', $data);
}
public function antrepot()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['leswarehouse']= 	array();
$data['act']		='e';
$data['y']			='warehouse';
$data['compagnie']	= 	$this->Parser->get_compagnie();
if(!empty($_POST['custum'])){
$data['leswarehouse']= 	$this->Parser_export->recherche_warehouse($_POST['custum']);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($_POST['custum']);
// 							echo "<pre>";
// print_r($data['leswarehouse']['id_warehouse']);
// echo "</pre>";

$this->session->no = $_POST['custum'];
}else{

}
// print_r($data['lesreservation']);
$data['page'] = 'export/rech_warehouse';
$this->load->view('template', $data);
}

public function add_wr()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['awb']= 	array();
$data['act']		='e';
$data['y']			='warehouse';

$addawbl		=	$this->input->post('awblnum');
$compagnie		=	$this->input->post('compagnie');
$value			=	$this->Parser_export->verify_awbl_table($addawbl);
$value2			=	$this->Parser_export->verify_awbl($addawbl);


if ($value){
$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave1;');
redirect('Airway_Bill');
}elseif ($value2) {
$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave2;');
redirect('Airway_Bill');
}else {
// code...

$no_warehouse	=	$this->input->post('no_warehouse');

$res			=	$this->Parser_export->verify_warehouse($no_warehouse);
$res2			=	$this->Parser_export->verify_warehouse2($no_warehouse);

if ($res){

$this->Parser_export->creation_bill_export($addawbl,$no_warehouse,$compagnie);

redirect('modifier_Airway_Bill/'.$addawbl);

}else{

foreach($res2 as $row){
}
// print_r($row->no_awbl);
$this->session->set_flashdata('sms2','Ce code W/R #: '.$no_warehouse.'&nbsp;&nbsp;&nbsp;'.'AWB #:'.$row->no_awbl.'&nbsp;&nbsp;'.'erreur');
redirect('Airway_Bill');
}

}

}
public function add_wr2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['awb']= 	array();
$data['act']		='e';
$data['y']			='warehouse';

$compagnie		=	$this->input->post('compagnie');
$addawbl		=	$this->Parser_export->get_awb_bycom($compagnie);
foreach($addawbl as $row){}
$awb_bycomp=$row->awb;
if (empty($addawbl)){
$this->session->set_flashdata('sms2','Pas d\'AWB pour cette compagnie');
redirect('Airway_Bill2/'.$this->input->post('no_warehouse'));
}else{
$value			=	$this->Parser_export->verify_awbl_table($row->awb);
$value2			=	$this->Parser_export->verify_awbl($row->awb);
if ($value){
$this->session->set_flashdata('sms2','Ce code: '.$row->awb.' existe d&eacute;j&agrave1;');
redirect('Airway_Bill2/'.$this->input->post('no_warehouse'));
}elseif ($value2) {
$this->session->set_flashdata('sms2','Ce code: '.$row->awb.' existe d&eacute;j&agrave2;');
redirect('Airway_Bill2/'.$this->input->post('no_warehouse'));
}else {
// code...

$no_warehouse	=	$this->input->post('no_warehouse');

$res			=	$this->Parser_export->verify_warehouse($no_warehouse);
$res2			=	$this->Parser_export->verify_warehouse2($no_warehouse);

if ($res){

$this->Parser_export->creation_bill_export2($awb_bycomp,$no_warehouse,$compagnie);

redirect('modifier_Airway_Bill/'.$row->awb);

}else{

foreach($res2 as $row){
}
// print_r($row->no_awbl);
// $this->session->set_flashdata('sms2','Ce code W/R #: '.$no_warehouse.'&nbsp;&nbsp;&nbsp;'.'AWB #:'.$row->no_awbl.'&nbsp;&nbsp;'.'erreur');
// redirect('Airway_Bill2/'.$this->input->post('no_warehouse'));
}
}

}

}
public function add_antrepot()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		='e';
$data['y']			='warehouse';
// $data['page'] = 'export/antrepot';
$this->load->view('export/antrepot', $data);
}
// public function verifierphp()
// {
// if($_SESSION['account']['code'] == ""){
// redirect('login');
// }
// $data['act']		='e';
// $data['y']			='warehouse';
// $this->load->view('export/phpinfo', $data);
// export/export/verifierphp/e/warehouse
// }
public function ajouter_pcs()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
// $total_pieces=0;
// $total_pieces += $_POST['qt'];
// $t1=round($_POST['dim1'],2) *round($_POST['dim2'],2)*round($_POST['dim3'],2);
// $t2=$t1*$total_pieces;
// $t3=$t2/366;
//  	$total_pieces=0;
$id = $_POST['warehouse'];
$data=array(
'id_warehouse'	=> $id,
'no_pieces'	=> $_POST['qt'],
'dim1'	=> round($_POST['dim1'],2),
'dim2'	=> round($_POST['dim2'],2),
'dim3'	=> round($_POST['dim3'],2),
);
// 							echo "<pre>";
// print_r($data);
// echo "</pre>";

// $this->Parser_export->set_warehouse($data);
$this->Parser_export->add_warehouse_colis($data);
redirect("modifier_warehouse/".$id);
}
public function modifier_antrepot()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id 	= $this->uri->segment(2);
$data['act']		='e';
$data['y']			='warehouse';
$data['antrepot'] 	= $this->Parser_export->get_antrepot($id);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($id);
// $data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['page'] = 'export/modifier_antrepot';
$this->load->view('template', $data);
}
public function warehousepdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$id 	= $this->uri->segment(4);
$data['antrepot'] 	= $this->Parser_export->get_antrepot($id);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($id);
// print_r($data['lareservation']);
$this->load->view('pdf/export/pdf_wharehouse.php' ,$data);
}
public function Airway_Bill()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['leswarehouse']= 	array();
$data['nowh']= 	$this->uri->segment(2);
$data['act']		='e';
$data['y']			='airway';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
if(!empty($_POST['custum'])){
//$data['leswarehouse']= 	$this->Parser_export->recherche_warehouse($_POST['custum']);
$data['leswarehouse']= 	$this->Parser_export->recherche_awbl_export($_POST['custum']);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($_POST['custum']);
$this->session->no = $_POST['custum'];
}else{

}
// print_r($data['lesreservation']);
$data['page'] = 'export/rech_awb';
$this->load->view('template', $data);
}

public function Airway_Bill2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['leswarehouse']= 	array();
$data['nowh']= 	$this->uri->segment(2);
$data['act']		='e';
$data['y']			='airway';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
if(!empty($_POST['custum'])){
//$data['leswarehouse']= 	$this->Parser_export->recherche_warehouse($_POST['custum']);
$data['leswarehouse']= 	$this->Parser_export->recherche_awbl_export($_POST['custum']);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($_POST['custum']);
$this->session->no = $_POST['custum'];
}else{

}
// print_r($data['lesreservation']);
$data['page'] = 'export/rech_awb2';
$this->load->view('template', $data);
}
public function modifier_awb()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id 	= $this->uri->segment(2);
$data['act']		='e';
$data['y']			='airway';

$res	= $this->Parser_export->init_antrepot($id);
foreach($res as $rr){}

$data['antrepot'] 	= $this->Parser_export->get_antrepot($rr->no_warehouse);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($rr->no_warehouse);
$data['awb_data'] 	= $this->Parser_export->get_awb_data($id);
$data['rateclass']	= 	$this->Parser_export->get_rate_class();
$data['lescommodity']= 	$this->Parser_export->get_commodity();
$data['lescharges_codes']= 	$this->Parser_export->get_charges_codes();
$data['entitlement']	= 	$this->Parser_export->get_entitlement();
$data['entitlement_agent']	= 	$this->Parser_export->entitlement_agent($id);
$data['entitlement_carrier']	= 	$this->Parser_export->entitlement_carrier($id);
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['entitlement2'] 	= $this->Parser_export->get_entitlement2($id);
$data['other_charges']	= 	$this->Parser_export->get_description_awb();
$data['clientcode'] = 	$this->Parser_export->get_allclient2();
$data['page'] = 'export/addawbl_export';
$this->load->view('template', $data);
}

public function addawbl_export ()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id_awbl'];
$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));
$data = array(
'account_number_shipper'	=>strtoupper($_POST['account_number_shipper']),
'name_shipper'	=> strtoupper($_POST['name_shipper']),
'ville_shipper'	=> strtoupper($_POST['ville_shipper']),
'address_shipper'	=> strtoupper($_POST['address_shipper']),
'email_shipper'	=>strtoupper($_POST['email_shipper']),
'tel_shipper'	=> strtoupper($_POST['tel_shipper']),
'account_number_consignee'	=> strtoupper($_POST['account_number_consignee']),
'name_consignee'	=> strtoupper($_POST['name_consignee']),
'ville_consignee'	=> strtoupper($_POST['ville_consignee']),
'address_consignee'	=> strtoupper($_POST['address_consignee']),
'email_consignee'	=> strtoupper($_POST['email_consignee']),
'tel_consignee'	=> strtoupper($_POST['tel_consignee']),
'account_number_agent'	=> strtoupper($_POST['account_number_agent']),
'name_agent'	=> strtoupper($_POST['name_agent']),
'adress_agent'	=>strtoupper($_POST['adress_agent']),
'ville_agent'	=> strtoupper($_POST['ville_agent']),
'iata_code_agent'	=>strtoupper($_POST['iata_code_agent']),
// 'departure'	=>strtoupper($_POST['departure']),
'route_to1'	=>strtoupper( $_POST['route_to1']),
'route_first_carrier'	=>strtoupper($_POST['route_first_carrier']),
'route_to2'	=>strtoupper($_POST['route_to2']),
'route_by1'	=> strtoupper($_POST['route_by1']),
'route_to3'	=> strtoupper($_POST['route_to3']),
'route_by2'	=> strtoupper($_POST['route_by2']),
'destination'	=> strtoupper($_POST['destination']),
'flight'	=>strtoupper($_POST['flight']),
'date_flight'	=>strtoupper($_POST['date_flight']),
'awb_number'	=> strtoupper($_POST['awb_number']),
// 'airport_of_departure'	=> strtoupper($_POST['airport_of_departure']),
'accounting_information'	=>strtoupper($_POST['accounting_information']),
'reference_number'	=>strtoupper($_POST['reference_number']),
'information1'	=>strtoupper($_POST['information1']),
'information2'	=>strtoupper($_POST['information2']),
'currency'	=>strtoupper('USD'),
'chcg'	=> strtoupper($_POST['chcg']),
'value_for_carriage'	=>strtoupper($_POST['value_for_carriage']),
'wt_val'	=> $_POST['wt_val_pp_col'],
'value_for_customs'	=> strtoupper($_POST['value_for_customs']),
// 'other'	=> $_POST['other_pp_col'],
'amount_of_insurance'	=> strtoupper($_POST['amount_of_insurance']),
'requirements'	=> strtoupper($_POST['requirements']),
'sci'	=> strtoupper($_POST['sci']),
'rate_class'	=> strtoupper($_POST['rate_class']),
'commdity_item_no'	=> strtoupper($_POST['commdity']),
'rate_Charge'	=> strtoupper($_POST['rate_Charge']),
'valuation_charge_pp'	=> strtoupper($_POST['valuation_charge_pp']),
'tax_pp'	=> strtoupper($_POST['tax_pp']),
'qty'	=> strtoupper($_POST['qty_awbl2']),
'total_freight'	=> strtoupper($_POST['freight_awbl2']),
'total_weight_charge'	=> strtoupper($_POST['weight_charge_awbl2']),
'datecreated'	=> $date->format('Y-m-d H:i:s')

);


$prepaid = 0;
$collect = 0;
$nocharge =0;
$res = $this->Parser_export->get_awb_data($_POST['awb_number']);
$res_agent	= 	$this->Parser_export->entitlement_agent($_POST['awb_number']);
$res_carrier	= 	$this->Parser_export->entitlement_carrier($_POST['awb_number']);

$Other_charges_due_agent	= $this->Parser_export->Other_charges_due_agent($_POST['awb_number']);
$Other_charges_due_carrier	= $this->Parser_export->Other_charges_due_carrier($_POST['awb_number']);
$Weight_charge= $this->Parser_export->Weight_charge($_POST['awb_number']);
// foreach($res as $rr){}
//
// $data['antrepot'] 	= $this->Parser_export->get_antrepot($rr->no_warehouse);

if(count($Other_charges_due_agent)>0){
if(count($res_agent)>0){
foreach($Other_charges_due_agent as $rws22){}
foreach($res_agent as $rws2){}
if($rws2->type_entitlement=="prepaid"){
$datapmt[0]=array(
'idtx'				=>$rws22->idtx,
'date'				=>date('y-m-d'),
'apayer'			=>$_POST['other_charges_due_carrier_cc'],
'norapport'			=>$this->session->numrapport
);
}
}
}
if(count($Other_charges_due_carrier)>0){
if(count($res_carrier)>0){
foreach($Other_charges_due_carrier as $rws33){}
$datapmt[1]=array(
'idtx'				=>$rws33->idtx,
'date'				=>date('y-m-d'),
'apayer'			=>$_POST['other_charges_due_carrier_cc1'],
'norapport'			=>$this->session->numrapport,
);
}
}
if(count($Weight_charge)>0){
foreach($Weight_charge as $rws44){}
foreach($res as $rws){
if($rws->wt_val=="prepaid"){
$prepaid = 1;
$datapmt[2]=array(
'idtx'				=>$rws44->idtx,
'date'				=>date('y-m-d'),
'apayer'			=>$_POST['weight_charge_pp'],
'norapport'			=>$this->session->numrapport,
);

}
if($rws->wt_val=="collect"){
$collect = 1;
}
}
}
$insert = array();
$insert['consignee'] 		 = 	strtoupper($_POST['name_consignee']);
$insert['notify_adress'] 	 =  strtoupper($_POST['requirements']);
$insert['qty'] 		         = 	$_POST['qty_awbl2'];
$insert['qtytotal'] 		 = 	$_POST['qty_awbl2'];
$insert['package'] 		     = 	 strtoupper($_POST['package_awbl2']);
$insert['weight'] 		     = 	$_POST['weight_awbl2'];
$insert['weight_charge'] 		     = 	$_POST['weight_charge_awbl2'];
$insert['freight'] 		     = 	$_POST['weight_charge_pp'];
$insert['prepaid'] 		 	 = 	$prepaid;
$insert['collect'] 		     = 	$collect;
$insert['nocharge'] 		     = 	$nocharge ;
$insert['currency'] 		 = 	'USD';
$insert['nolivraison'] 		 = 	'OK-export';
$insert['typeawbl'] 		 = 	'export';
// 	 echo "<pre>";
// print_r($datapmt);
//    echo "</pre>";


$this->Parser_export->update_awbl($id,$data);
$this->Parser_export->update_awbl2($_POST['awb_number'],$insert);
// $this->Parser_export->update_Other_charges_due_agent($_POST['awb_number'],$datapmt1,$rws22->idtx);
// // $this->Parser_export->update_Other_charges_due_carrier($_POST['awb_number'],$datapmt2,$rws33->idtx);
// $this->Parser_export->update_Weight_charge($_POST['awb_number'],$datapmt3,$rws44->idtx);

if(count($datapmt)>0){
$this->Parser_export->update_batch_tbl_facture($datapmt);
}
redirect("modifier_Airway_Bill/".$_POST['awb_number']);
}
public function void_awb()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id_awbl'];
$date = new DateTime(null, new DateTimeZone('America/Port-au-Prince'));
$data = array(
'void'	=> '1',
'pers_void'	=> $_POST['entered_by'],
'date_void'	=> $date->format('Y-m-d H:i:s')

);

// $insert = array();
// $insert['date_void']	= $date->format('Y-m-d H:i:s');
// $insert['pers_void']	= $_POST['entered_by'];
// $insert['void'] 		 = 	'1';
// 							echo "<pre>";
// print_r($data);
// echo "</pre>";
//
$this->Parser_export->update_awbl($id,$data);
$this->Parser_export->update_awbl2($_POST['awb_number'],$data);
}
public function add_other_charges()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$id = $_POST['awblnum'];
$data=array(
'id_other'	=> $id,
'description'	=> $_POST['description'],
'amount'	=> round($_POST['amount'],2),
'entitlement'	=> $_POST['entitlement'],
'type_entitlement'	=> $_POST['type_entitlement'],
);
// 							echo "<pre>";
// print_r($data);
// echo "</pre>";

// $this->Parser_export->set_warehouse($data);
$this->Parser_export->add_other_charges($data);
redirect("modifier_Airway_Bill/".$id);
}
public function delete_other_charges()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$reponse = $this->Parser_export->delete_other_charges($this->uri->segment(4));

redirect("modifier_Airway_Bill/".$this->uri->segment(5));
}
// public function awb_pdf2()
// 	{
// 		if($_SESSION['account']['code'] == ""){
// 			redirect('login');
// 		}
//
// 		$this->load->view('export/awb.html', $data);
// 	}
public function reservationpdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$id 	= $this->uri->segment(2);
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['lareservation'] 	= $this->Parser_export->get_lareservation($id);
// print_r($data['lareservation']);
$this->load->view('pdf/export/pdf_reservation.php' ,$data);
}

public function awb_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$id 	= $this->uri->segment(4);

$res	= $this->Parser_export->init_antrepot($id);
foreach($res as $rr){}

$data['antrepot'] 	= $this->Parser_export->get_antrepot_pdf($rr->no_warehouse);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($rr->no_warehouse);
$data['awb_data'] 	= $this->Parser_export->get_awb_data($id);
$data['entitlement_agent']	= 	$this->Parser_export->entitlement_agent($id);
$data['entitlement_carrier']	= 	$this->Parser_export->entitlement_carrier($id);
$data['entitlement2'] 	= $this->Parser_export->get_entitlement2($id);
$this->load->view('pdf/export/awb_pdf',$data);
}

public function tag4x6()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$id 	= $this->uri->segment(4);

$data['tag_data'] 	= $this->Parser_export->get_all_info_tag($id);

// 							echo "<pre>";
// print_r($data['tag_data']);
// echo "</pre>";

$this->load->view('pdf/export/tag4x6_pdf',$data);
}
public function tag4x4()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$id 	= $this->uri->segment(4);

$res	= $this->Parser_export->init_antrepot($id);
foreach($res as $rr){}

$data['antrepot'] 	= $this->Parser_export->get_antrepot_pdf($rr->no_warehouse);
$data['antrepot2'] 	= $this->Parser_export->get_antrepot_pcs($rr->no_warehouse);
$data['awb_data'] 	= $this->Parser_export->get_awb_data($id);
$data['entitlement_agent']	= 	$this->Parser_export->entitlement_agent($id);
$data['entitlement_carrier']	= 	$this->Parser_export->entitlement_carrier($id);
$data['entitlement2'] 	= $this->Parser_export->get_entitlement2($id);
$this->load->view('pdf/export/awb_pdf',$data);
}
public function edit_awbl_export()
{
$data['act']		='e';
$data['y']			='airmay';
$data['compagnie']	= 	$this->Parser_export->get_compagnie();
$data['clientcode'] = 	$this->Parser->get_allclient();
$data['page'] = 'export/edit_awbl_exp';
$this->load->view('template', $data);
}


public function deleteAwb($id)
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data=array(
	'statut'		=>'0',
	'date_out' =>NULL,
	);
	$data2=array(
		'no_awbl'		=>NULL,
		);
$reponse = $this->Parser_export->delete_awb_tblAWBL($id);
$reponse = $this->Parser_export->delete_awb_tblBuil($id);
$reponse = $this->Parser_export->delete_awb_tblfacture($id);
$reponse = $this->Parser_export->update_awb_by_compagnie($id,$data);
$reponse = $this->Parser_export->update_awb_warehouse($id,$data2);

$this->session->set_flashdata('sms2','Votre AWB est supprimé avec succès.');

redirect('Airway_Bill');
}


}


?>
