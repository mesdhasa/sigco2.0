<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/ctools.php";
class Facture extends CI_Controller {

public function __construct(){
parent::__construct();
$this->load->library('page');
}

public function index()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$val = "";
if(isset($_POST['noawbl'])){
$this->session->set_userdata('sesnumber', $_POST['noawbl']);
}
if($this->session->userdata('sesnumber') != ""){
$val = $this->session->userdata('sesnumber');
}

$data['act']		='f';
$data['y']			='rech';
$data['lessegments']= 	$this->Parser->get_awblFacture($val);
$this->session->client = "";
$data['data']= 	0;
// $data['data']=$this->page->loadpage('getData2','Parser','facture/index',0,'getDataCount');
// 	 echo "<pre>";
// print_r($data['data']);
// echo "</pre>";
$this->load->view('facturation',$data);
}



public function recherche()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$val = "";
if(isset($_POST['noawbl'])){
$this->session->set_userdata('sesnumber', $_POST['noawbl']);
}
if($this->session->userdata('sesnumber') != ""){
$val = $this->session->userdata('sesnumber');
}

$data['act']		='f';
$data['y']			='rech';
$data['lessegments']= 	$this->Parser->get_awblFacture($val);
$this->session->client = "";
$getDataCountBy=$this->Parser->getDataCountBy($this->input->post('noawbl'));
$data['data']=$this->page->search('noawbl',null,'facture','Parser',1,'getData',$getDataCountBy);
$this->load->view('facturation',$data);
}
public function degrouper()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');

$awbl2		=	$this->input->post('no_bill');
$value=$this->Parser->verify_awbl2($awbl2);
if($value){
$this->session->set_flashdata('sms','AWBL: '.$awbl2.' existe d&eacute;j&agrave;');
redirect('facture/facturerbill/f/rech/'.$_POST['awbl_1'].'/'.$segmentid);
}else{
// if (isset($_POST['weight'] > $_POST['d_depot_comp']))
if(isset($_POST['no_bill'])){
$resul = 0;
if ($_POST['d_depot'] > $_POST['d_depot_comp']){
$resul = $_POST['d_depot'] *$_POST['prix_lbs']* $_POST['poids'];
if ($resul<10) $resul = 10;
}
$data = array(
'idbuil' 	=> $_POST['awbl_1'],
'nobuil' 	=> $_POST['no_bill'],
'poids' 	=> $_POST['poids'],
'description' 	=> "Storage Fees ",
'monnaie_apayer' 	=> "USD",
'awbl_type'    => "import",
'datecreated' 	=> $this->session->ladate,
'norapport' 	=> $this->session->numrapport,
'montant' 	=> $resul
);
$this->Parser->set_degroupage($data);

// $nofacture = $this->Parser->give_num_fac();
// $idtx=date('YmdHis').mt_rand(11111,99999);
// 				$data2 = array(
// 				'idtx' 			=> $idtx,
// 				'codetx' 		=> 'FAC',
// 				'description' 	=>"Storage Fees ",
// 				'apayer' 		=> $resul,
// 				'monnaie_apayer'=> 'USD',
// 				'awbl_type'    => "import",
// 				'awbl' 			=> $_POST['no_bill'],
// 				'nofacture' 	=> $nofacture,
// 				'norapport'		=>$this->session->numrapport
// 				);
// $this->Parser->set_paiement_awbl($data2);
}
// $data3 = array(
// 		'norapport'		=>$this->session->numrapport,
// 		'idtx' 			=> $idtx,
// 		'date_hc' => date('Y-m-d-H-i-s'),
// 		'awb' =>$_POST['no_bill'],
// 		'nofacture' =>$nofacture,
// 		'date_create' =>date('Y-m-d-H-i-s'),
// 		'mode_paiement' =>"CASH",
// 		'montant_hc' =>$resul,
// 		'received' 			=> $_SESSION['account']['prenom']." ".$_SESSION['account']['nom'],
// 		'monnaie' =>'USD',
// 		'awbl_type'    => "import",
// 		'description' => 'Storage Fees ',
// 		'id_client' =>'0',
//
// );
// $this->Parser->set_paiement_awbl_degroup($data3);

// $data4 = array(
//
// 		'awbl' =>$_POST['no_bill'],
// 		'package' =>$_POST['pack'],
// 		'weight' =>$_POST['poids'],
// 		'consignee' =>$_POST['con'],
// 		'datecreated' =>$this->session->ladate,
// 		'datenotification' =>chaineversdate($_POST['not']),
// 		'segmentid' 			=> $_POST['segmentid'],
// 		'typeawbl' =>'import',
// 		'status'    => "0"
// );
// $this->Parser->set_buil_awbl_degroup($data4);


redirect('facture/facturerbill/f/rech/'.$_POST['awbl_1'].'/'.$segmentid);

}

}
public function update_degrouper()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(5);
$buil= $this->uri->segment(7);
$data = array(
'awbl_type'    => "import",
'montant' => $this->uri->segment(6)
);
// $data2 = array(
// 'awbl_type'    => "import",
// 'montant' => $this->uri->segment(6),
// 'apayer' => $this->uri->segment(6)
// );
$data3 = array(
'montant_hc' => $this->uri->segment(6),
'date_hc' => $this->session->ladate
);
$this->Parser->set_a_degroupage($id,$data);
// $this->Parser->set_a_degroupage2($buil,$data2);
// $this->Parser->set_a_degroupage3($buil,$data3);
redirect('facture/facturerbill/f/rech/'.$this->uri->segment(8).'/'.$this->uri->segment(9));
}
public function del_degrouper()
{
// echo "string ".$this->uri->segment(5).'/'.$this->uri->segment(7);
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->Parser->del_degroupage($this->uri->segment(6));
$this->Parser->del_degroupage1($this->uri->segment(8));
$this->Parser->del_degroupage2($this->uri->segment(8));
$this->Parser->del_degroupage3($this->uri->segment(8));
redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5).'/'.$this->uri->segment(7));
}

public function facturerbill()
{

if($_SESSION['account']['code'] == ""){
redirect('login');
}
$val = $this->uri->segment(5);
$val2 = $this->uri->segment(6);
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);
$data['lessegments']	= 	$this->Parser->get_Un_awbl($val,$val2);
$lespaiements			= 	$this->Parser->get_paiement_awbl($val);
$data['lespaiements']	= 	$lespaiements;
$data['frais']			= 	$this->Parser->get_frais();
$data['client']			= 	$this->Parser->get_client_client();
$data['clientcode'] = 	$this->Parser->get_allclient();
$data['lesnorapport']		= 	$this->Parser->get_noRapport_pmt($val);

foreach($lespaiements as $pmt){
if($pmt->nofacture != ""){
$data['nofacture']		= 	$pmt->nofacture;
}
}


if(!isset($this->session->client) or $this->session->client==""){
$this->session->client = $pmt->codeclient;
}

$this->load->view('factbill',$data);
}
public function ajouterMontant(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);

if(isset($_POST['montant'])){
$data = array(
'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
'codetx' 		=> 'FAC',
'description' 	=> $_POST['description'],
'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
'monnaie_apayer'=> 'USD',
'awbl' 			=> $this->uri->segment(5),
'awbl_type'    => "import",
'norapport'		=>$this->session->numrapport
);

$this->Parser->set_paiement_awbl($data);
}

redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}
public function ajouterMontant2(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);

if(isset($_POST['montant'])){
$data = array(
'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
'codetx' 		=> 'FAC',
'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
'monnaie_apayer'=> 'USD',
'description' 	=> 'CCA#'.$_POST['description'],
'awbl_type'    => "import",
'awbl' 			=> $this->uri->segment(5),
'norapport'		=>$this->session->numrapport
);

$this->Parser->set_paiement_awbl($data);
}

redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}

public function getclient()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');

if(isset($_POST['client'])){
$this->session->client = $_POST['client'];
}
redirect('facture/facturerbill/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}

public function deleteFacture()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(5);
$this->Parser->deletePaiement($id);
redirect('facture/facturerbill/f/rech/'.$this->uri->segment(6).'/'.$this->uri->segment(7));

}

public function validerfacture()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
// echo $this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8);
$nofacture = $this->uri->segment(8);
if(strlen($nofacture)<15){}else{
$nofacture = $this->Parser->give_num_fac();
}

$data = array(
'nofacture' 	=> $nofacture,
'date' 			=> $this->session->ladate,
'status' 		=> '1',
'codeclient' 	=> $this->uri->segment(5)
);

$this->Parser->valider_facture($this->uri->segment(6),$data);
redirect('facture/facturerbill/f/rech/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8));
//http://127.0.0.1/www/mesdhasa2.0/facture/facturerbill/f/rech/125-43382242/1/18-04261
}

public function update_buill()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid=$this->input->post('segmentid');

$id = $_POST['awbl'];

$numlivraison = "--";
if(isset($_POST['nolivraison'])){
if($_POST['numlivre']=="--"){
$numlivraison = $this->Parser->give_num_livraison();
}else{
$numlivraison = $_POST['numlivre'];
}

}
$data=array(
'qty'			=>$_POST['qty'],
'qtytotal'		=>$_POST['qtytotal'],
'package'		=>$_POST['package'],
'weight'		=>$_POST['weight'],
'consignee'		=>$_POST['consignee'],
'freight'		=>$_POST['freight'],
'other_freight'		=>$_POST['other_freight'],
'weight_charge'		=>$_POST['weight_charge'],
'currency'		=>$_POST['currency'],
'notify_code'	=>$_POST['notify_code'],
'notify_name'	=>$_POST['notify_name'],
'notify_adress'	=>$_POST['notify_adress'],
'datenotification'	=>chaineversdate($_POST['datenotification']),
'remarque'		=>$_POST['remarque'],
'remarque2'		=>$_POST['remarque2'],
'dateremis'		=>chaineversdate($_POST['dateremis']),
'remis_a'		=>$_POST['remis_a'],
'typeawbl'    => "import",
'nolivraison'	=>$numlivraison
);


$data2=array(
'codeclient'	=> $this->session->client
);
$this->Parser->update_buill($id,$data,$segmentid);
$this->Parser->update_num_client($id,$data2);
redirect('facture/facturerbill/f/rech/'.$id.'/'.$segmentid);

}

public function facturepdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$id						= $this->uri->segment(3);
$data['information']	= $this->Parser->get_facture($id);
$this->load->view('pdf/pdffacture',$data);
}
public function facturehtml()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id						= $this->uri->segment(3);
$data['information']	= $this->Parser->get_facture($id);
$data['lessegments']= 	$this->Parser->get_paiement_awbl_or_fac($id);
$data['lespaiments_efec']= 	$this->Parser->get_paiement_effectue($id);
$this->load->view('facturehtml',$data);
}

public function searchFacture()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
// $data['lessegments_degrou']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);
if($this->uri->segment(5)=="" ){
// $data['lessegments']= 	$this->Parser->get_paiement_awbl_or_fac($this->uri->segment(5));
// // $data['lessegments_degrou']= 	$this->Parser->get_paiement_awbl_or_fac_degroup($this->uri->segment(5));
// $data['lespaiments_efec']= 	$this->Parser->get_paiement_effectue($this->uri->segment(5));
$data['lestaux']= 	$this->Parser->get_taux();
$this->load->view('paiement',$data);
}else {
$data['lessegments']= 	$this->Parser->get_paiement_awbl_or_fac($this->uri->segment(5));
// // $data['lessegments_degrou']= 	$this->Parser->get_paiement_awbl_or_fac_degroup($this->uri->segment(5));
$data['lespaiments_efec']= 	$this->Parser->get_paiement_effectue($this->uri->segment(5));
$data['lestaux']= 	$this->Parser->get_taux();
$this->load->view('paiement',$data);
}

}
// public function degroup()
// 	{
// 		$data['act']			=	$this->uri->segment(3);
// 		$data['y']				=	$this->uri->segment(4);
// 		$data['id']				=	$this->uri->segment(5);
// 		$data['lessegments']= 	$this->Parser->get_paiement_awbl_or_fac_degroup($this->uri->segment(5));
// 		// $data['lespaiments_efec']= 	$this->Parser->get_paiement_effectue($this->uri->segment(5));
// 		$data['lestaux']= 	$this->Parser->get_taux();
// 		$this->load->view('paiement_degroup',$data);
// 	}
public function searchFac()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$key = "";
if(isset($_POST['noawbl'])){
$key = $_POST['noawbl'];
}

redirect('facture/searchFacture/p/rechp/'.$key);
}

public function payerfacture()

{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
if(isset($_POST['montantenc'])){
if($_POST['monnaie']=='HTG'){
$htg=$_POST['montant']/$_POST['htaux'];
$data = array(
'idtx' 			=> date('YmdHis'),
'codetx' 		=> 'PMT',
'description' 	=> 'Paiement',
'payer' 		=> round($htg,2),
'taux' 			=> $_POST['htaux'],
'encaisse' 		=> round($_POST['montant'],2),
'monnaie' 		=> $_POST['monnaie'],
'monnaie_apayer'=> $_POST['monnaie_apayer'],
'nofacture' 	=> $_POST['nofacture'],
'nopaiement' 	=> $this->Parser->give_num_pmt(),
'typepmt' 		=> $_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'awbl' 			=> $_POST['awbl'],
'awbl_type'    => $_POST['type_awbl'],
'date' 			=> $this->session->ladate,
'codeclient' 	=> $_POST['codeclient'],
'memo' 			=> $_POST['memo'],
'norapport'		=>$this->session->numrapport,
'status' 		=> '1'

);
}else {
$htg=$_POST['montant'];
$data = array(
'idtx' 			=> date('YmdHis'),
'codetx' 		=> 'PMT',
'description' 	=> 'Paiement',
'payer' 		=> round($htg,2),
'taux' 			=> $_POST['htaux'],
'encaisse' 		=> round($_POST['montant'],2),
'monnaie' 		=> $_POST['monnaie'],
'monnaie_apayer'=> $_POST['monnaie_apayer'],
'nofacture' 	=> $_POST['nofacture'],
'nopaiement' 	=> $this->Parser->give_num_pmt(),
'typepmt' 		=> $_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'awbl' 			=> $_POST['awbl'],
'awbl_type'    => $_POST['type_awbl'],
'date' 			=> $this->session->ladate,
'codeclient' 	=> $_POST['codeclient'],
'memo' 			=> $_POST['memo'],
'norapport'		=>$this->session->numrapport,
'status' 		=> '1'

);

}

}
$this->Parser->set_paiement_awbl($data);

if($_POST['type']=='CASH' or $_POST['type']=='CHEQUE' or $_POST['type']=='CARTE DE CREDIT' or $_POST['type']=='VIREMENT'){
$prix_ex =explode(",", $_POST['all_prix']);
$description_ex = explode(",", $_POST['all_description']);
$mp=0;
if(isset($_POST['montant'])){
$mp=round($_POST['montant'],2);
}
for($i = 0; $i < count($prix_ex), $i < count($description_ex); $i++){
if(isset($prix_ex[$i]) && !empty($prix_ex[$i]) && isset($description_ex[$i])){
// tet

if($_POST['monnaie']=='HTG'){
$htg2=$prix_ex[$i]*$_POST['htaux'];
if(($mp-$htg2)>=0){
$mp=$mp-$htg2;
$facture=$this->uri->segment(5);
$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'montant_hc' =>round($htg2,2),
'montant_hc1' =>round($htg2,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'awbl_type'    => $_POST['type_awbl'],
'description' => $description_ex[$i],
'memo' 			=> $_POST['memo'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);
}else{
$facture=$this->uri->segment(5);
$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'montant_hc' =>$mp,
'montant_hc1' =>round($htg2,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'awbl_type'    => $_POST['type_awbl'],
'description' => $description_ex[$i],
'memo' 			=> $_POST['memo'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);
}


}else {
$htg2=$prix_ex[$i];
$facture=$this->uri->segment(5);
if(($mp-$htg2)>=0){
$mp=$mp-$htg2;
$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'montant_hc' =>round($htg2,2),
'montant_hc1' =>round($htg2,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'description' => $description_ex[$i],
'memo' 			=> $_POST['memo'],
'awbl_type'    => $_POST['type_awbl'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);
}else {
$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'montant_hc' =>$mp,
'montant_hc1' =>round($htg2,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'description' => $description_ex[$i],
'memo' 			=> $_POST['memo'],
'awbl_type'    => $_POST['type_awbl'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);
}

}
// pied

}
}

}
if($_POST['type']=='EXTERNE' ){
$prix_ex =explode(",", $_POST['all_prix']);
$description_ex = explode(",", $_POST['all_description']);
for($i = 0; $i < count($prix_ex), $i < count($description_ex); $i++){
if(isset($prix_ex[$i]) && !empty($prix_ex[$i]) && isset($description_ex[$i])){
if($_POST['monnaie']=='HTG'){
$htg2=$prix_ex[$i]*$_POST['htaux'];
$facture=$this->uri->segment(5);
$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'montant_hc' =>'0',
'montant_hc1' =>round($htg2,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'awbl_type'    => $_POST['type_awbl'],
'description' => $description_ex[$i],
'memo' 			=> $_POST['memo'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);

}else {
$htg2=$prix_ex[$i];
$facture=$this->uri->segment(5);

$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'banque' 		=> $_POST['banque1'],
'banque2' 		=> $_POST['banque2'],
'nom_compte' 		=> $_POST['nom_compte1'],
'nom_compte2' 		=> $_POST['nom_compte2'],
'no_chque' 		=> $_POST['cheque'],
'digit' 		=> $_POST['digit'],
'montant_hc' =>'0',
'montant_hc1' =>round($htg2,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'description' => $description_ex[$i],
'memo' 			=> $_POST['memo'],
'awbl_type'    => $_POST['type_awbl'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);
}
}
// rr
}

}
$this->Parser->set_paiement_awbl2($data2);



// echo "<pre>";
// print_r($data2);
// echo "</pre>";
redirect('facture/searchFacture/p/rechp/'.$this->uri->segment(5));
}
public function Rembourser_facture()

{
if($_SESSION['account']['code'] == ""){
redirect('login');
}

if(isset($_POST['amount'])){
if($_POST['monnaie']=='HTG'){
$htg=$_POST['amount']/$_POST['htaux'];
$htg2=$htg*'-1';
$data = array(
'idtx' 			=> date('YmdHis'),
'codetx' 		=> 'PMT',
'description' 	=> 'REMBOURSSEMENT',
'payer' 		=> round($htg2,2),
'taux' 			=> $_POST['htaux'],
'encaisse' 		=> round($_POST['amount'],2),
'monnaie' 		=> $_POST['monnaie'],
'nofacture' 	=> $_POST['nofacture'],
'nopaiement' 	=> $this->Parser->give_num_pmt(),
'typepmt' 		=> $_POST['type'],
'awbl' 			=> $_POST['awbl'],
'awbl_type'    => $_POST['type_awbl'],
'date' 			=> $this->session->ladate,
'codeclient' 	=> $_POST['codeclient'],
'memo' 			=> $_POST['memo'],
'user_remboursement' 			=> $_POST['received'],
'norapport'		=>$this->session->numrapport,
'status' 		=> '1'

);
}else {
$htg=$_POST['amount']*'-1';
$data = array(
'idtx' 			=> date('YmdHis'),
'codetx' 		=> 'PMT',
'description' 	=> 'REMBOURSSEMENT',
'payer' 		=> round($htg,2),
'taux' 			=> $_POST['htaux'],
'encaisse' 		=> round($_POST['amount'],2),
'monnaie' 		=> $_POST['monnaie'],
'nofacture' 	=> $_POST['nofacture'],
'nopaiement' 	=> $this->Parser->give_num_pmt(),
'typepmt' 		=> $_POST['type'],
'awbl' 			=> $_POST['awbl'],
'awbl_type'    => $_POST['type_awbl'],
'date' 			=> $this->session->ladate,
'codeclient' 	=> $_POST['codeclient'],
'memo' 			=> $_POST['memo'],
'user_remboursement' 			=> $_POST['received'],
'norapport'		=>$this->session->numrapport,
'status' 		=> '1'
);

}
if($_POST['monnaie']=='HTG'){
$htg2=$_POST['amount']*$_POST['htaux'];
$htg3=$htg2*'-1';
$facture=$_POST['lien_p'];
$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'montant_hc' =>round($htg3,2),
'montant_hc1' =>round($htg3,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'awbl_type'    => $_POST['type_awbl'],
'description' => 'REMBOURSSEMENT',
'memo' 			=> $_POST['memo'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);

}else {

$htg3=$_POST['amount']*'-1';
$facture=$_POST['lien_p'];

$data2[] = array(
'norapport'		=>$this->session->numrapport,
'date_hc' => $this->session->ladate,
'awb' =>$_POST['awbl'],
'nofacture' =>$facture,
'date_create' =>$this->session->ladate,
'mode_paiement' =>$_POST['type'],
'montant_hc' =>round($htg3,2),
'montant_hc1' =>round($htg3,2),
'received' 			=> $_POST['received'],
'monnaie' =>$_POST['monnaie'],
'taux' 			=> $_POST['htaux'],
'awbl_type'    => $_POST['type_awbl'],
'description' => 'REMBOURSSEMENT',
'memo' 			=> $_POST['memo'],
'id_client' =>$_POST['codeclient'],
'nopaiement' 	=>$data ['nopaiement'],
'idtx' =>$data ['idtx']

);
}
}
$this->Parser->set_paiement_awbl($data);
$this->Parser->set_paiement_awbl2($data2);

redirect('facture/searchFacture/p/rechp/'.$_POST['lien_p']);

}
public function deleteFacture_payer()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(3);
$this->Parser->deleteFacture_detail1($id);
$this->Parser->deleteFacture_detail2($id);
redirect('facture/searchFacture/p/rechp/'.$this->uri->segment(4));

}
public function caissepdf_usd()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$currency				= $this->uri->segment(3);
$norapport				= $this->uri->segment(4);
$data['rapport']	= $this->Parser->get_caisse_transation($norapport,$currency);
$data['rapport_ex']	= $this->Parser->get_caisse_transation_ex($norapport,$currency);
$data['rapport_mes']	= $this->Parser->get_caisse_transation_mes($norapport,$currency);

// echo "<pre>";
// print_r($data);
// echo "</pre>";
$this->load->view('pdf/transaction_caisse',$data);
}
public function caissepdf_htg()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');

$currency				= $this->uri->segment(3);
$norapport				= $this->uri->segment(4);
$data['norapport']		= $norapport;
$data['currency']		= $currency;
$data['rapport']	= $this->Parser->get_caisse_transation($norapport,$currency);
$data['rapport_ex']	= $this->Parser->get_caisse_transation_ex($norapport,$currency);
$data['rapport_mes']	= $this->Parser->get_caisse_transation_mes($norapport,$currency);

$this->load->view('pdf/transaction_caisse',$data);
}
public function description_pmt()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data = array(
'idtx' 			=>$_POST['description']
);

// 			   echo "<pre>";
// print_r($data);
//    echo "<pre>";

}
public function imprimerecu()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$data['id']				=	$this->uri->segment(3);
$data['lespaiement_histo']= 	$this->Parser->get_paiement_awbl_or_fac($this->uri->segment(4));
$data['lessegments']= 	$this->Parser->get_paiement_recu($this->uri->segment(3));
$data['infohisto']= 	$this->Parser->get_paiement_recu_histo2($this->uri->segment(3));
$this->load->view('recuhtml',$data);
}

public function rapport()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['lesfactures']	= 	$this->Parser->get_factures();
$this->load->view('rapportFacture',$data);
}
public function rap_caisse()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['lesfactures_caisse']	= 	$this->Parser->get_factures_caisse($this->session->numrapport);
$data['norapport']	= 	$this->Parser->get_norapport2();
$this->load->view('rapport_caisse',$data);
}

public function details_de_caisse()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['lessegments2']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$this->load->view('details_de_caisse',$data);
}

public function recherche_details_de_caisse()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$data['lessegments2']= 	array();
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($_POST['date1']) && !empty($_POST['date2']) ){
$data['lessegments']= 	$this->Parser->recherche_details_de_caisse(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
$data['lessegments2']= 	$this->Parser->recherche_details_de_caisse2(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
$this->session->no = chaineVersDate($_POST['date1']);
$this->session->no = chaineVersDate($_POST['date2']);
}

$this->load->view('details_de_caisse',$data);
}

public function details_de_caisse_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$data['compagnie']	= 	$this->Parser->get_compagnie();
$data['lessegments']= 	$this->Parser->recherche_details_de_caisse($date1,$date2);
$data['lessegments2']= 	$this->Parser->recherche_details_de_caisse2($date1,$date2);
$this->load->view('pdf/details_de_caisse_pdf',$data);
}
public function informatics_fees()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('informatics_fees',$data);
}
public function recherche_informatics_fees()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($_POST['date1']) && !empty($_POST['date2'])){
$data['lessegments']= 	$this->Parser->recherche_informatics_fees(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
}

$this->load->view('informatics_fees',$data);
}
public function informatics_fees_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$custum =	$this->uri->segment(5);
$data['lessegments']= 	$this->Parser->recherche_informatics_fees($date1,$date2,$custum);
$this->load->view('pdf/informatics_fees_pdf',$data);
}
public function import_fees()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('import_fees',$data);
}
public function recherche_import_fees()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($_POST['date1']) && !empty($_POST['date2']) ){
$data['lessegments']= 	$this->Parser->recherche_import_fees(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
$this->session->no = chaineVersDate($_POST['date1']);
$this->session->no = chaineVersDate($_POST['date2']);
}

$this->load->view('import_fees',$data);
}
public function import_fees_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$currency	= $this->uri->segment(3);
$date1 =	$this->uri->segment(4);
$date2 =	$this->uri->segment(5);
$data['compagnie']	= 	$this->Parser->get_compagnie();
$data['lessegments']= 	$this->Parser->recherche_import_fees2($date1,$date2,$currency);

$this->load->view('pdf/import_fees_pdf',$data);
}
public function Freight()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('freight',$data);
}
public function recherche_freight()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($_POST['date1']) && !empty($_POST['date2']) ){
$data['lessegments']= 	$this->Parser->recherche_freight(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']));
$this->session->no = chaineVersDate($_POST['date1']);
$this->session->no = chaineVersDate($_POST['date2']);
}

$this->load->view('freight',$data);
}
public function freight_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$date1 =	$this->uri->segment(3);
$date2 =	$this->uri->segment(4);
$data['lessegments']= 	$this->Parser->recherche_freight($date1,$date2);

$this->load->view('pdf/freight_pdf',$data);
}
public function due_agent()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['compagnie']	= 	$this->Parser->get_compagnie();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('due_agent',$data);
}
public function recherche_due_agent()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$data['compagnie']	= 	$this->Parser->get_compagnie();
$compagnie	=	$this->input->post('compagnie');
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($_POST['date1']) && !empty($_POST['date2']) && !empty($compagnie) ){
	$data['lessegments']= 	$this->Parser->recherche_due_agent(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$compagnie);
}

$this->load->view('due_agent',$data);
}
public function due_agent_pdf()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$this->load->library('Pdf');
$currency	= $this->uri->segment(3);
$date1 =	$this->uri->segment(4);
$date2 =	$this->uri->segment(5);
$comp =	$this->uri->segment(6);
$data['compagnie']	= 	$this->Parser->get_compagnie();
$data['lessegments']= 	$this->Parser->recherche_due_agent2($date1,$date2,$currency,$comp);

$this->load->view('pdf/due_agent_pdf',$data);
}
public function statistics_weight()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$_POST['date1']= "";
$_POST['date2']= "";
$data['lessegments']= 	array();
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);

$this->load->view('statistics_weight',$data);
}
// public function statistics_weight()
// {
// if($_SESSION['account']['code'] == ""){
// redirect('login');
// }
// $_POST['date1']= "";
// $_POST['date2']= "";
// $data['lessegments']= 	array();
// $data['compagnie']	= 	$this->Parser->get_compagnie();
// $data['act']			=	$this->uri->segment(3);
// $data['y']				=	$this->uri->segment(4);
//
// $this->load->view('statistics_weight',$data);
// }
public function recherche_statistics_weight()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['lessegments']= 	array();
$type	=	$this->input->post('type');
$data['act']	=	$this->uri->segment(3);
$data['y']		=	$this->uri->segment(4);
if(!empty($type=='import')){
  if(!empty($_POST['date1']) && !empty($_POST['date2']) && !empty($type) ){
  	$data['lessegments']= 	$this->Parser->recherche_statistics_weight(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$type);
  }

}else {
  if(!empty($_POST['date1']) && !empty($_POST['date2']) && !empty($type) ){
  	$data['lessegments']= 	$this->Parser->recherche_statistics_weight_export(chaineVersDate($_POST['date1']),chaineVersDate($_POST['date2']),$type);
   }

}

// print_r($data['lessegments']);
$this->load->view('statistics_weight',$data);
}
public function rap_caisse2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['lesfactures_caisse']	= 	$this->Parser->get_factures_caisse($this->session->numrapport);
$data['norapport']	= 	$this->Parser->get_norapport2();
$this->load->view('rapport_caisse2',$data);
}
public function recherche_no()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$norapport	= chaineversdate($this->input->post('daterapport'));
$data['norapport']	= $this->Parser->get_norapport3($norapport);
if(count($data['norapport'])==0){
$this->session->set_flashdata('sms','No Report Number For This DAY');
redirect('facture/rap_caisse/f/rap_caisse');

}else{
foreach($data['norapport'] as $row){
redirect('facture/recherche_no2/'.$row->num."/".$norapport);

}
}
}
public function recherche_no2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$norapport	=$this->uri->segment(3);
$date =$this->uri->segment(4);
$data['act']			=	'f';
$data['y']				=	'rap_caisse';
$data['lesfactures_caisse']	= 	$this->Parser->get_factures_caisse($norapport);
$data['norapport']	= 	$this->Parser->get_norapport2();
$this->load->view('rech_norapport',$data);
}
public function todo(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
echo $_POST['action']." Programmeur";
}
public function rabais_off()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
foreach ($_POST['idtx'] as $row ) {
$data = array(
'rabais' 	=>	$_POST['rabais_item'.$row]
);
$this->Parser->set_a_rabais($row,$data);

}
redirect('facture/facturerbill/f/rech/'.$_POST['awbl_1'].'/'.$_POST['segmentid']);

}
public function lescca ($awbl)
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$element='';

$resdata =	$this->Parser->lescca($awbl);
if (count($resdata)>0){
foreach ($resdata as $row){
$element .=$row->description."<br/>";
}
}

}

public function add_awb_export()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$awbl	=$this->input->post('awblnum');
$value=$this->Parser->verify_awbl($awbl);
if($value){
$this->session->set_flashdata('sms2','Ce code: '.$addawbl.' existe d&eacute;j&agrave;');
redirect('facture');;
}else{
redirect('facture/add_awb_export2/'.$awbl);
}
}
public function add_awb_export2()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$awbl	=$this->uri->segment(3);
$data['act']			=	'f';
$data['y']				=	'rech';
$this->load->view('add_awb_mesdhasa',$data);
}
public function add_awb_ex()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$insert = array();
$insert['id'] 		     = 	NULL;
$insert['awbl'] 		     = 	$_POST['awblnum'];
$insert['consignee'] 		 = 	$_POST['consignee'];
$insert['notify_adress'] 	 = 	$_POST['notify_adress'];
$insert['qty'] 		         = 	$_POST['qty'];
$insert['qtytotal'] 		 = 	$_POST['qtytotal'];
$insert['package'] 		     = 	$_POST['package'];
$insert['weight'] 		     = 	$_POST['weight'];
$insert['freight'] 		     = 	$_POST['freight'];
$insert['currency'] 		 = 	$_POST['currency'];
$insert['remarque'] 		 = 	$_POST['remarque'];
$insert['currency'] 		 = 	'USD';
$insert['nolivraison'] 		 = 	'OK-MESDHASA2';
$insert['segmentid'] 		 = 	'6';
$insert['typeawbl'] 		 = 	'MESDHASA2';

$is_true=false;
$is_true=$this->Parser->set_addawbl_mesdhasa($insert);
if($is_true){
$this->session->set_flashdata('sms','Inserer avec success.');
redirect('facture');
}else{
$this->session->set_flashdata('sms','Veuillez contacter.......');
redirect('facture');
}
}
public function facturerbill_ex()
{

if($_SESSION['account']['code'] == ""){
redirect('login');
}
$val = $this->uri->segment(5);
$val2 = $this->uri->segment(6);
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);
$data['lessegments']	= 	$this->Parser->get_Un_awbl_exp($val,$val2);
$lespaiements			= 	$this->Parser->get_paiement_awbl_exp($val);
$data['lespaiements']	= 	$lespaiements;
$data['frais']			= 	$this->Parser->get_frais();
$data['client']			= 	$this->Parser->get_client_client();
$data['clientcode'] = 	$this->Parser->get_allclient();
$data['lesnorapport']		= 	$this->Parser->get_noRapport_pmt_exp($val);


foreach($lespaiements as $pmt){
if($pmt->nofacture != ""){
$data['nofacture']		= 	$pmt->nofacture;
}
}


if(!isset($this->session->client) or $this->session->client==""){
$this->session->client = $pmt->codeclient;
}

$this->load->view('factbill_ex',$data);
}
public function facturerbill_mesdhasa()
{

if($_SESSION['account']['code'] == ""){
redirect('login');
}
$val = $this->uri->segment(5);
$val2 = $this->uri->segment(6);
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);
$data['lessegments']	= 	$this->Parser->get_Un_awbl_exp($val,$val2);
$lespaiements			= 	$this->Parser->get_paiement_awbl_exp($val);
$data['lespaiements']	= 	$lespaiements;
$data['frais']			= 	$this->Parser->get_frais();
$data['client']			= 	$this->Parser->get_client_client();
$data['clientcode'] = 	$this->Parser->get_allclient();
$data['lesnorapport']		= 	$this->Parser->get_noRapport_pmt_mesdhasa($val);

foreach($lespaiements as $pmt){
if($pmt->nofacture != ""){
$data['nofacture']		= 	$pmt->nofacture;
}
}


if(!isset($this->session->client) or $this->session->client==""){
$this->session->client = $pmt->codeclient;
}

$this->load->view('factbill_mesdhasa',$data);
}
public function update_buill_exp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid=$this->input->post('segmentid');

$id = $_POST['awbl'];

$numlivraison = "--";
if(isset($_POST['nolivraison'])){
if($_POST['numlivre']=="--"){
$numlivraison = $this->Parser->give_num_livraison();
}else{
$numlivraison = $_POST['numlivre'];
}

}
$data=array(
'qty'			=>$_POST['qty'],
'qtytotal'		=>$_POST['qtytotal'],
'package'		=>$_POST['package'],
'weight'		=>$_POST['weight'],
'consignee'		=>$_POST['consignee'],
'freight'		=>$_POST['freight'],
'	nolivraison'		=>"OK-export",
'weight_charge'		=>$_POST['weight_charge'],
'currency'		=>"USD",
// 'notify_code'	=>$_POST['notify_code'],
// 'notify_name'	=>$_POST['notify_name'],
'notify_adress'	=>$_POST['notify_adress'],
// 'datenotification'	=>chaineversdate($_POST['datenotification']),
'remarque'		=>$_POST['remarque'],
// 'dateremis'		=>chaineversdate($_POST['dateremis']),
// 'remis_a'		=>$_POST['remis_a'],
'typeawbl'    => "export",
);


$data2=array(
'codeclient'	=> $this->session->client
);
$this->Parser->update_buill($id,$data,$segmentid);
$this->Parser->update_num_client($id,$data2);
redirect('facture/facturerbill_ex/f/rech/'.$id.'/'.$segmentid);

}
public function update_buill_mesdhasa()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid=$this->input->post('segmentid');

$id = $_POST['awbl'];

$numlivraison = "--";
if(isset($_POST['nolivraison'])){
if($_POST['numlivre']=="--"){
$numlivraison = $this->Parser->give_num_livraison();
}else{
$numlivraison = $_POST['numlivre'];
}

}
$data=array(
'qty'			=>$_POST['qty'],
'qtytotal'		=>$_POST['qtytotal'],
'package'		=>$_POST['package'],
'weight'		=>$_POST['weight'],
'consignee'		=>$_POST['consignee'],
'freight'		=>$_POST['freight'],
'	nolivraison'		=>"OK-export",
'weight_charge'		=>$_POST['weight_charge'],
'currency'		=>"USD",
// 'notify_code'	=>$_POST['notify_code'],
// 'notify_name'	=>$_POST['notify_name'],
'notify_adress'	=>$_POST['notify_adress'],
// 'datenotification'	=>chaineversdate($_POST['datenotification']),
'remarque'		=>$_POST['remarque'],
// 'dateremis'		=>chaineversdate($_POST['dateremis']),
// 'remis_a'		=>$_POST['remis_a'],
);


$data2=array(
'codeclient'	=> $this->session->client
);
$this->Parser->update_buill($id,$data,$segmentid);
$this->Parser->update_num_client($id,$data2);
redirect('facture/facturerbill_mesdhasa/f/rech/'.$id.'/'.$segmentid);

}
public function getclient_exp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');

if(isset($_POST['client'])){
$this->session->client = $_POST['client'];
}
redirect('facture/facturerbill_ex/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}
public function ajouterMontant_exp(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);

if(isset($_POST['montant'])){
$data = array(
'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
'codetx' 		=> 'FAC',
'description' 	=> $_POST['description'],
'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
'monnaie_apayer'=> 'USD',
'awbl' 			=> $this->uri->segment(5),
'awbl_type'    => "export",
'norapport'		=>$this->session->numrapport
);
$this->Parser->set_paiement_awbl($data);
}

redirect('facture/facturerbill_ex/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}
public function ajouterMontant_mesdhasa(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);

if(isset($_POST['montant'])){
$data = array(
'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
'codetx' 		=> 'FAC',
'description' 	=> $_POST['description'],
'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
'monnaie_apayer'=> 'USD',
'awbl' 			=> $this->uri->segment(5),
'norapport'		=>$this->session->numrapport,
'awbl_type'    => "MESDHASA2",

);
$this->Parser->set_paiement_awbl($data);
}

redirect('facture/facturerbill_mesdhasa/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}
public function rabais_off_mesdhasa()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
foreach ($_POST['idtx'] as $row ) {
$data = array(
'rabais' 	=>	$_POST['rabais_item'.$row]
);
$this->Parser->set_a_rabais($row,$data);

}
redirect('facture/facturerbill_mesdhasa/f/rech/'.$_POST['awbl_1'].'/'.$_POST['segmentid']);

}
public function deleteFacture_exp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(5);
$this->Parser->deletePaiement($id);
redirect('facture/facturerbill_ex/f/rech/'.$this->uri->segment(6).'/'.$this->uri->segment(7));

}
public function deleteFacture_mesdhasa()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$id = $this->uri->segment(5);
$this->Parser->deletePaiement($id);
redirect('facture/facturerbill_mesdhasa/f/rech/'.$this->uri->segment(6).'/'.$this->uri->segment(7));

}
public function ajouterMontant2_exp(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);

if(isset($_POST['montant'])){
$data = array(
'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
'codetx' 		=> 'FAC',
'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
'monnaie_apayer'=> 'USD',
'description' 	=> 'CCA#'.$_POST['description'],
'awbl_type'    => "export",
'awbl' 			=> $this->uri->segment(5),
'norapport'		=>$this->session->numrapport
);

$this->Parser->set_paiement_awbl($data);
}

redirect('facture/facturerbill_ex/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}
public function ajouterMontant2_mesdhasa(){
if($_SESSION['account']['code'] == ""){
redirect('login');
}
$segmentid =$this->input->post('segmentid');
$data['act']			=	$this->uri->segment(3);
$data['y']				=	$this->uri->segment(4);
$data['id']				=	$this->uri->segment(5);

if(isset($_POST['montant'])){
$data = array(
'idtx' 			=> date('YmdHis').mt_rand(11111,99999),
'codetx' 		=> 'FAC',
'apayer' 		=> ($_POST['signe']."1")*$_POST['montant'],
'monnaie_apayer'=> 'USD',
'description' 	=> 'CCA#'.$_POST['description'],
'awbl' 			=> $this->uri->segment(5),
'norapport'		=>$this->session->numrapport
);

$this->Parser->set_paiement_awbl($data);
}

redirect('facture/facturerbill_mesdhasa/f/rech/'.$this->uri->segment(5).'/'.$segmentid);
}
public function validerfacture_exp()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
// echo $this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8);
$nofacture = $this->uri->segment(8);
if(strlen($nofacture)<15){}else{
$nofacture = $this->Parser->give_num_fac();
}

$data = array(
'nofacture' 	=> $nofacture,
'date' 			=> $this->session->ladate,
'status' 		=> '1',
'codeclient' 	=> $this->uri->segment(5)
);

$this->Parser->valider_facture($this->uri->segment(6),$data);
redirect('facture/facturerbill_ex/f/rech/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8));
//http://127.0.0.1/www/mesdhasa2.0/facture/facturerbill/f/rech/125-43382242/1/18-04261
}
public function validerfacture_mesdhasa()
{
if($_SESSION['account']['code'] == ""){
redirect('login');
}
// echo $this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8);
$nofacture = $this->uri->segment(8);
if(strlen($nofacture)<15){}else{
$nofacture = $this->Parser->give_num_fac();
}

$data = array(
'nofacture' 	=> $nofacture,
'date' 			=> $this->session->ladate,
'status' 		=> '1',
'codeclient' 	=> $this->uri->segment(5)
);

$this->Parser->valider_facture($this->uri->segment(6),$data);
redirect('facture/facturerbill_mesdhasa/f/rech/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8));
//http://127.0.0.1/www/mesdhasa2.0/facture/facturerbill/f/rech/125-43382242/1/18-04261
}
}
?>
