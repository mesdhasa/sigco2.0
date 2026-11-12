<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Entreprise extends CI_Controller {

public function index()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);
}
public function conf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['lestaux']= 	$this->Parser->get_taux();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration',$data);
}
public function edit_entreprise()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	'ent';
$data['y']			=	'configuration';
$data['lentreprise']	= 	$this->Parser->get_lentreprise($id);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['lestaux']= 	$this->Parser->get_taux();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration_entre',$data);
}
public function edit_frais()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	'ent';
$data['y']			=	'configuration';
$data['lefrais']	= 	$this->Parser->get_lefrais($id);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lestaux']= 	$this->Parser->get_taux();
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration_frais',$data);
}
public function edit_charges_codes()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lecharges_codes']= 	$this->Parser->get_charges_codes_id($id);
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['lestaux']= 	$this->Parser->get_taux();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration_charges_codes',$data);
}
public function edit_commodity()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['lecommodity']= 	$this->Parser->get_commodity_id($id);
$data['lestaux']= 	$this->Parser->get_taux();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration_commodity',$data);
}
public function edit_taux()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	'ent';
$data['y']			=	'configuration';
$data['taux']	= 	$this->Parser->get_taux2($id);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lestaux']= 	$this->Parser->get_taux();
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration_taux',$data);
}
public function edit_currency()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	'ent';
$data['y']			=	'configuration';
$data['currency1']= 	$this->Parser->get_lecurrency($id);
$data['lescompagnie']= 	$this->Parser->get_allcompagnie();
$data['lesfrais']= 	$this->Parser->get_allfrais();
$data['lestaux']= 	$this->Parser->get_taux();
$data['lescharges_codes']= 	$this->Parser->get_charges_codes();
$data['lescommodity']= 	$this->Parser->get_commodity();
$data['currency']= 	$this->Parser->get_currency();
$this->load->view('configuration_currency',$data);
}
public function ajouter_comp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);

if(isset($_POST['compagnie'])){
$data = array(
'	compagnie' 	=> $_POST['compagnie'],
'	droitdepot'  	=> $_POST['droitdepot'],
'	prix_lbs' 		=> $_POST['prix_lbs'],
'	sps' 		=> $_POST['sps']
);
$is_true=false;
$is_true=$this->Parser->add_compagnie($data);
if($is_true){
$this->session->set_flashdata('sms','Inserer avec success.');
redirect('entreprise/conf/ent/configuration');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('entreprise/conf/ent/configuration');
}
}
}
public function ajouter_currency()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);

if(isset($_POST['name_currency'])){
$data = array(
'	name' 	=> $_POST['name_currency'],
'	code'  	=> $_POST['code_currency'],
);
$is_true=false;
$is_true=$this->Parser->add_currency($data);
if($is_true){
$this->session->set_flashdata('sms','Inserer avec success.');
redirect('entreprise/conf/ent/configuration');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('entreprise/conf/ent/configuration');
}
}
}
public function ajouter_charges_codes()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);

if(isset($_POST['code'])){
$data = array(
'charges_codes' 	=> strtoupper($_POST['code']),
'description'  	=> strtoupper($_POST['description_code']),
'statut'  	=>"1",
);
$is_true=false;
$is_true=$this->Parser->add_charges_codes($data);
if($is_true){
$this->session->set_flashdata('sms','Inserer avec success.');
redirect('entreprise/conf/ent/configuration');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('entreprise/conf/ent/configuration');
}
}
}
public function ajouter_commodity()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);

if(isset($_POST['code'])){
$data = array(
'commodity' 	=> strtoupper($_POST['code']),
'description'  	=> strtoupper($_POST['description']),
'statut'  	=>"1",
);
$is_true=false;
$is_true=$this->Parser->add_commodity($data);
if($is_true){
$this->session->set_flashdata('sms','Inserer avec success.');
redirect('entreprise/conf/ent/configuration');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('entreprise/conf/ent/configuration');
}
}
}
public function update_comp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];

$data = array(
'	compagnie' 	=> $_POST['compagnie'],
'	droitdepot'  	=> $_POST['droitdepot'],
'	prix_lbs' 		=> $_POST['prix_lbs'],
'	sps' 		=> $_POST['sps'],
'	statut' 		=> $_POST['statut']
);

$this->Parser->set_a_lentreprise($id,$data);
redirect('entreprise/conf/ent/configuration');
}
public function update_taux()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];

$data = array(
'	taux' 		=> $_POST['taux'],
'	statut' 		=> '1'
);

$this->Parser->set_a_currency($id,$data);
redirect('entreprise/conf/ent/configuration');
}
public function update_frais()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];

$data = array(
'	description' 	=> $_POST['description'],
'	montant'  	=> $_POST['montant'],
'	status' 		=> $_POST['statut']
);

$this->Parser->set_a_lefrais($id,$data);
redirect('entreprise/conf/ent/configuration');
}
public function update_charges_codes()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$id = $_POST['id'];
if(isset($_POST['code'])){
$data = array(
'charges_codes' 	=> strtoupper($_POST['code']),
'description'  	=> strtoupper($_POST['description_code']),
'statut'  	=>$_POST['statut_charges_codes'],
);
$this->Parser->set_a_charges_codes($id,$data);
redirect('entreprise/conf/ent/configuration');
}
}
public function update_commodity()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

$id = $_POST['id'];
if(isset($_POST['code'])){
$data = array(
'commodity' 	=> strtoupper($_POST['code']),
'description'  	=> strtoupper($_POST['description']),
'statut'  	=>$_POST['statut_commodity'],
);
$this->Parser->set_a_commodity($id,$data);
redirect('entreprise/conf/ent/configuration');
}
}
public function update_currency()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $_POST['id'];

$data = array(
'	name' 	=> $_POST['name_currency'],
'	code'  	=> $_POST['code_currency'],
'	statut' 		=> $_POST['statut_currency']
);

$this->Parser->set_a_lecurrency($id,$data);
redirect('entreprise/conf/ent/configuration');
}
public function supprimerVol()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$idvol				= $this->uri->segment(3);
$data['idvol']		= $idvol;
if(count($this->Parser->get_awbl($idvol)) > 0){
$this->session->set_flashdata('sms','<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Erreur ce vol contient des AWBL.');
}else{
$this->Parser->delete_vol($idvol);
$this->session->set_flashdata('sms','Vol supprim&eacute; avec succ&egrave;s.');
}
redirect('entreprise/conf/ent/configuration');
}

public function ajouter_frais()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']		=	$this->uri->segment(3);
$data['y']			=	$this->uri->segment(4);

if(isset($_POST['description'])){
$data = array(
'	description' 	=> $_POST['description'],
'	montant'  	=> $_POST['montant'],
);
$this->Parser->add_frais($data);
}
redirect('entreprise/conf/ent/configuration');
}

public function addawbEntreprise()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id= $this->uri->segment(4);
$data['act']		=	'ent';
$data['y']			=	'configuration';
$data['lesawbcomp']	= 	$this->Parser->get_awbcomp($id);

$this->load->view('add_number_Awb',$data);
}

public function addAWB_comp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
if(isset($_POST['awbnum'])){


$value			=	$this->Parser_export->verify_awbl_table($_POST['awbnum']);
$value2			=	$this->Parser_export->verify_awbl($_POST['awbnum']);
$value3			=	$this->Parser_export->verify_awbl2($_POST['awbnum']);
if ($value or $value2 or $value3){
	$this->session->set_flashdata('sms2','Ce code: '.$_POST['awbnum'].' existe d&eacute;j&agrave;');
	redirect('entreprise/addawbEntreprise/ent/'.$_POST['idcomp']);
}else {
	// code...
$data = array(
'awb' 			=> $_POST['awbnum'],
'date_in'  		=> date('Y-m-d H:i:s'),
'date_out'  	=> Null,
'id_compagnie'  => $_POST['idcomp'],
'statut'  		=> "0"
);

$this->Parser->add_addAWB_comp($data);
redirect('entreprise/addawbEntreprise/ent/'.$_POST['idcomp']);
	}
}
	
}

public function addAWB_comp_excel()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}




$fp = fopen($_FILES['ExcelAwb']['tmp_name'], 'rb');
$awblex="";
    while ( ($line = fgets($fp)) !== false) {
$value			=	$this->Parser_export->verify_awbl_table($line);
$value2			=	$this->Parser_export->verify_awbl($line);
$value3			=	$this->Parser_export->verify_awbl2($line);
if ($value or $value2 or $value3){
	$awblex.=$line;
}else {
	// code...
$data = array(
'awb' 			=> $line,
'date_in'  		=> date('Y-m-d H:i:s'),
'date_out'  	=> Null,
'id_compagnie'  => $_POST['idcomp'],
'statut'  		=> "0"
);
$this->Parser->add_addAWB_comp($data);
    }


	}

	if($awblex==""){
		redirect('entreprise/addawbEntreprise/ent/'.$_POST['idcomp']);

	}else{
		$this->session->set_flashdata('sms2','Ce code: '.$awblex.'; existe d&eacute;j&agrave;');
		redirect('entreprise/addawbEntreprise/ent/'.$_POST['idcomp']);
	}
	exit();
}




}
?>
