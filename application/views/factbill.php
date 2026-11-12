<?php
if(isset($_SESSION['droit']['a15']) and $_SESSION['droit']['a15']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
$fre = "Freight";
$fre2 = "Other Freight";
$drt = "Storage Fees ";
$drt2 = "Storage Fees degroupage ";
foreach($lessegments as $row){}
$total_poids = 0;
$res = $this->Parser->get_degroupage($row->awbl);
if(count($res)>0){
foreach($res as $r){
$total_poids += $r->poids;
}
}
$sps="";
$totalsps=$row->sps;
$poidsps=$row->weight;
$datecomp = $row->droitdepot;
$datedepot ="";
$datelivre = "";
$resul = "";
$restant=$row->weight* 2.20462-$total_poids;
$calcul_date="";

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

              case ($row->datenotification =="0000-00-00" && $row->datelivre =="NULL" or $row->datenotification =="" && $row->datelivre ==""):
              $datedepot ='0';
              break;

              default:
              break;
}


?>


<div class="page-header">
<form id="frmclient" name="frmclient" action="<?php echo base_url().'facture/getclient/f/rech/'.$row->awbl?>" method="POST">
<input type="hidden" class="form-control" id="segmentid"  name=" segmentid" value="<?php echo $row->segmentid?>" />
<h1>
<small>
<i class="ace-icon fa fa-angle-double-right"></i>
Bill an AWB
</small>
<?php if(strlen($nofacture)<15){?>

<small style="color:#000000; font-size:22px;">
# invoice: <strong><?php echo $nofacture;?></strong>
</small>

<?php }?>

<small style="color:#000000; font-size:17px;">
<strong>Customer:</strong> <select name="client" id="client" onchange="javascript:document.getElementById('frmclient').submit();">
<?php foreach($client as $cl){?>
<option value="<?php echo $cl->codeclient?>" <?php if(isset($this->session->client) and $this->session->client==$cl->codeclient) echo " selected"?>><?php echo $cl->societe?></option>
<?php }?>
</select>

</small>

</h1>
</form>
<div class="col-lg-5 col-lg-offset-7">
<p style="text-align:right; margin-top:-30px;">
<strong style="font-size:20px; text-align:right;"> <?php echo $row->compagnie?>  <?php echo dateVersChainetext($row->Date_of_arrival);?>  <?php echo $row->typeawbl?></strong>

</p>
</div>

</div>

<div class="page-content">

<div class="row">
<div class="col-lg-7 col-md-6 col-xs-12">
	<div class="alert alert-info">
  <strong>No Rapport :</strong>   <?php
	 foreach ($lesnorapport as $histo) {
	 ?>

	<?php echo $histo->norapport?>;
 <?php }?>
</div>
<strong style="font-size:20px;">[ <?php echo $row->awbl?> ]</strong>

<form class="form-horizontal" action="<?php echo base_url()?>facture/update_buill" method="POST">
<input type="hidden" value="<?php echo $row->awbl?>" name="awbl" />
<div class="form-group">
<label class="control-label col-sm-2" for="consignee"><strong>Consignee:</strong></label>
<div class="col-sm-4">
<input autocomplete="off" type="text" class="form-control" id="consignee" placeholder="Consignee" name="consignee" value="<?php echo $row->consignee?>">
</div>
<label class="control-label col-sm-3" for="codec"><strong>Customer code:</strong></label>
<div class="col-sm-3">
<select name="codec" id="codec">
<option value=""></option>
<?php foreach($clientcode as $code){?>
<option value="<?php echo $code->codeclient."|".$code->societe;?>"><?php echo $code->reference?></option>
<?php }?>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="notify_adress"><strong>Notify adress:</strong></label>
<div class="col-sm-10">
<textarea name="notify_adress" id="notify_adress" placeholder="Notify adress" class="form-control"><?php echo $row->notify_adress?></textarea>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="qty"><strong>Qty:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="qty" placeholder="Qty" name="qty" value="<?php echo $row->qty?>">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="qtytotal"><strong>Qty of:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="qtytotal" placeholder="Of" name="qtytotal" value="<?php echo $row->qtytotal?>">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="package"><strong>Nature of goods:</strong></label>
<div class="col-sm-10">
<input autocomplete="off"  type="text" class="form-control" id="package" placeholder="Package" name="package" value="<?php echo $row->package?>">
</div>
</div>
<?php if ($totalsps < $poidsps){

?>
<div class="form-group">
<label class="control-label col-sm-2" for="weight"><strong>Weight: (Kg)</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" value="<?php echo $row->weight?>">
</div>
<label class="control-label col-sm-2" for="weight"><strong>Weight: (Lb)</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" disabled value="<?php echo $row->weight *2.20462?>">
</div>
</div>
<?php }else{?>
<div class="form-group">
<label class="control-label col-sm-2" for="weight"><strong>Weight: (Kg)</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" value="<?php echo $row->weight?>">
</div>
<label class="control-label col-sm-2" for="weight"><strong>Weight: (Lb)</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" disabled  value="<?php echo $row->weight *2.20462?>">
</div>
<small style="color:#000000; font-size:22px;">SPS
</small></div>
<?php }?>
<div class="form-group">
<label class="control-label col-sm-2" for="weight_charge"><strong>Weight charge:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight_charge" placeholder="weight_charge" name="weight_charge" value="<?php echo $row->weight_charge?>">
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-2" for="freight"><strong>Freight Total:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="freight" placeholder="Freight" name="freight" value="<?php echo $row->freight?>">
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-2" for="freight"><strong>Other Freight :</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="other_freight" placeholder="Other Freight" name="other_freight" value="<?php echo $row->other_freight?>">
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="currency"><strong>Currency:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="currency" placeholder="Currency" name="currency" value="<?php echo $row->currency?>">
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>Pre-paid:</strong></label>
<div class="col-sm-10">
<input id="<?php echo $row->awbl?>a" <?php if($row->prepaid=="1") echo "checked=\"checked\"";?> onchange="Clkppcl('<?php echo $row->awbl?>','b')" class="choixcb" type="checkbox">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>Collect:</strong></label>
<div class="col-sm-10">
<input id="<?php echo $row->awbl?>b" <?php if($row->collect=="1") echo "checked=\"checked\"";?> onchange="Clkppcl('<?php echo $row->awbl?>','a')" class="choixcb" type="checkbox">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>No charge:</strong></label>
<div class="col-sm-10">
<input id="<?php echo $row->awbl;?>c" <?php if($row->nocharge=="1") echo "checked=\"checked\"";?>  onchange="Clkppcl('<?php echo $row->awbl;?>','a','b')" class="choixcb" type="checkbox">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>Allow to deliver:</strong></label>
<div class="col-sm-10">
<input type="hidden" name="numlivre" value="<?php echo $row->nolivraison;?>" />
<?php if($row->recupar == 'n'){?>
<input id="nolivraison" name="nolivraison" <?php if($row->nolivraison!="--") echo "checked=\"checked\"";?> class="choixcb" type="checkbox">
<!-- <strong>No: <?php echo $row->nolivraison;?></strong> -->
<?php }?>
<strong>No: <?php echo $row->nolivraison;?></strong>
<input type="hidden" name="numlivre" value="<?php echo $row->nolivraison;?>" />
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2 col-lg-pull-0" for="datenotification"><strong>Notification:</strong></label>
<div class="col-sm-3">
<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date Notification" name=" datenotification" value="<?php echo dateVersChaine($row->datenotification)?>"  required/>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="notify_adress"><strong>Remarque:</strong></label>
<div class="col-sm-10">
<textarea name="remarque2" id="remarque2" placeholder="Remarque:" class="form-control"><?php echo $row->remarque2?></textarea>
</div>
</div>
<fieldset>
   <legend>Document remis - Tierce personne:</legend>
   <div class="form-group">
   <label class="control-label col-sm-2 col-lg-pull-0" for="datenotification"><strong>Remis le:</strong></label>
   <div class="col-sm-3">
   <input autocomplete="off" type="text" class="form-control" id="datecustum2" placeholder="Remis le" name="dateremis" value="<?php echo dateVersChaine($row->dateremis)?>"  />
   </div>
   </div>
   <div class="form-group">
   <label class="control-label col-sm-2" for="package"><strong>Remis à:</strong></label>
   <div class="col-sm-10">
   <input autocomplete="off"  type="text" class="form-control" id="remis_a" placeholder="Remis à" name="remis_a" value="<?php echo $row->remis_a?>">
   </div>
   </div>
 </fieldset>
<div class="form-group">
<label class="control-label col-sm-2" for="notify_adress"><strong>Note:</strong></label>
<div class="col-sm-10">
<textarea name="remarque" id="remarque" placeholder="Note:" class="form-control"><?php echo $row->remarque?></textarea>
</div>
</div>
<div class="form-group">
<input type="hidden" class="form-control" id="segmentid"  name=" segmentid" value="<?php echo $row->segmentid?>" />
<button type="submit" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-save"></i>
Save
</button>
<?php if(strlen($nofacture)<15){?>
<a href="<?php echo base_url()?>facture/facturehtml/<?php echo $nofacture?>" target="_blank" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-print"></i>
Print
</a>
<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo base_url()?>rapports/droit_depot_awb_pdf/<?php 	echo $row->awbl;?>">
                            <i class="ace-icon fa fa-print"></i>
                            Invoice storage fees
                            </a>
<?php }?>
<a href="<?php echo base_url()?>facture" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-close"></i>
Close
</a>
</div>
</form>
</div>
<?php if(isset($this->session->client) and $this->session->client!=""){?>
<div class="col-lg-5 col-md-6 col-xs-12">
<table class="table table-striped">


<?php if ($datedepot > $datecomp){
	$calcul_date=$datedepot-$datecomp;
$resul = $calcul_date *$row->prix_lbs*$restant;
if ($resul<10) $resul = 10;

?>
<thead>
<tr>
<th></th>
<th>the number of days</th>
<th>Amount</th>
<th>currency</th>
</tr>
</thead>
<tbody>
<tr class="danger">
<td><strong>Storage Fees [Remaining weight: <?php echo $restant;?> ]</strong></td>
<td align="center"><?php echo $calcul_date ;?></td>
<td align="center"><?php echo $resul ;?></td>
<td align="right"><strong>USD</strong></td>
</tr>
</tbody>
<?php }else{?>
<tr class="success">
<td colspan="4" align="center"><strong><?php echo "No Storage Fees "?>[
Weight (Lb) restan: <?php echo $row->weight* 2.20462-$total_poids ;?> ]</strong></td>
</tr>
<?php }?>
</table>
<?php echo form_open('facture/ajouterMontant/f/rech/'.$row->awbl,'class="form-inline"');?>
<strong>Amount to invoice</strong><br />
<input type="hidden" class="form-control" id="segmentid"  name=" segmentid" value="<?php echo $row->segmentid?>" />

<div class="form-group">
<input type="text" size="20" class="form-control" placeholder="Description" id="description" name="description" required>
</div>
<input type="hidden"name="signe" value="+" />
<div class="form-group">
<select class="form-control" name="montant" id="montant"required>
<option>---</option>
<?php if($row->other_freight > "0"){?>
<option value="<?php echo $row->other_freight."|".$fre2;?>"><?php echo $row->other_freight;?></option>
<?php }?>

<?php $f = 0;foreach($res as $r){$f++; $montant=$r->iddeg."montant_degroup";
if(round($r->montant,2) > "0"){  ?>
<option value="<?php echo round($r->montant,2)."|".$drt2;?>"><?php echo round($r->montant,2);?></option>
<?php }}?>
<?php foreach($frais as $fr){?>
  <option value="<?php echo round($fr->montant,2)."|".$fr->description;?>"><?php echo round($fr->montant,2)?></option>

<?php }?>
<?php if($row->collect=="1"){?>
<option value="<?php echo $row->freight."|".$fre;?>"><?php echo $row->freight;?></option>
<?php }?>
<?php
if($resul > 0){
?>
<option value="<?php echo  $resul."|".$drt;?>"><?php echo $resul ;?></option>
<?php
}
?>
</select>
</div>

<div class="form-group">
<button type="submit" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-plus"></i>
Add
</button>
</div>
<?php echo form_close();?>
<br />
<table class="table table-striped">
<thead>
<tr>
<th>#</th>
<th>Description</th>
<th>Amount</th>
<th>Discount</th>
<th></th>
<th>currency</th>
<th></th>
</tr>
</thead>
<?php echo form_open('facture/rabais_off/','class="form-inline"');?>
<tbody>
<?php $i=0;$total=0;$total2=0;foreach($lespaiements as $pmt){$i++;$total+=$pmt->apayer;$total2+=$pmt->rabais;$rabais=$pmt->idtx;?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $pmt->description?></td>
<td align="center"><?php echo round($pmt->apayer,2)?></td>
<td align="left">
  <input type="text" size="4" class="form-control"  id="rabais_item" name="rabais_item<?php echo $pmt->idtx?>" value="<?php echo round($pmt->rabais,2)?>">
</td>
<td align="center">
  <input type="hidden" id="segmentid" name="segmentid" value="<?php echo $row->segmentid;?>">
  <input type="hidden" id="idtx" name="idtx[]" value="<?php echo $pmt->idtx?>">
  <input type="hidden" id="awbl_1" name="awbl_1" value="<?php echo $row->awbl?>" >


  <div class="form-group">
  <button type="submit" class="btn btn-xs btn-primary">
  <i class="ace-icon fa fa-plus"></i>

  </button>
  </div>
</td>
<td align="center"><?php echo $pmt->monnaie_apayer?></td>
<td><?php if($pmt->status!=""){?>
<a href="#" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>facture/deleteFacture/f/rech/<?php echo $pmt->idtx?>/<?php echo $pmt->awbl.'/'.$row->segmentid?>')"><i class="fa fa-trash-o" aria-hidden="true"></i>	<?php }?></td>
</tr>
<?php }?>
<tr>
<td></td>
<td><strong>Total</strong></td>
<td align="center"><strong><?php echo round($total,2)?></strong></td>
<td align="center"><strong><?php echo round($total2,2)?></strong></td>
<td align="center"></td>
<td align="center"><strong>USD</strong></td>
<td></td>
</tr>
</tbody>
<?php echo form_close();

?>
</table>
<!-- -->

<?php echo form_open('facture/ajouterMontant2/f/rech/'.$row->awbl,'class="form-inline"');?>
<hr />
<strong>CCA</strong><br />
<div class="form-group">
<input type="text" size="25" class="form-control" placeholder="Description" id="description" name="description" required>
</div>
<input type="hidden" class="form-control" id="segmentid"  name=" segmentid" value="<?php echo $row->segmentid?>" />

<input type="hidden"name="signe" value="-" />
<div class="form-group">

<input type="text" size="7" class="form-control"  id="montant" name="montant" required>

</div>

<div class="form-group">
<button type="submit" class="btn btn-sm btn-danger">
<i class="ace-icon fa fa-plus"></i>
Add
</button>
</div>
<?php echo form_close();?>
<br />
<!-- -->

<a class="btn btn-sm btn-primary" href="#" onclick="confirmation_lien('Do you want to validate this transaction?','<?php echo base_url()?>facture/validerfacture/f/rech/<?php echo $this->session->client?>/<?php echo $pmt->awbl.'/'.$row->segmentid?>/<?php echo $nofacture?>')">
<i class="ace-icon fa fa-check"></i>
Validate
</a>

<?php if(strlen($nofacture)<15){?>
<a class="btn btn-sm btn-success" href="<?php echo base_url()?>facture/searchFacture/p/rechp/<?php echo $nofacture;?>">
<i class="ace-icon fa fa-money"></i>
payment
</a>
<?php }?>

<hr />
<p><strong>unbundling</strong></p>
<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-danger alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>

<?php if($row->weight*2.20462-$total_poids>0){?>

<?php echo form_open('facture/degrouper/','class="form-inline"');?>
<div class="form-group">
<input type="text" size="25" class="form-control" placeholder="# AWB" id="no_bill" name="no_bill" required />
</div>

<div class="form-group">
<input type="hidden" id="segmentid" name="segmentid" value="<?php echo $row->segmentid;?>">
<input type="text" size="7" class="form-control" placeholder="Weight in kilos" id="poids" name="poids" required />
<input type="hidden" id="awbl_1" name="awbl_1" value="<?php echo $row->awbl?>" >
<input type="hidden" id="prix_lbs" name="prix_lbs" value="<?php echo $row->prix_lbs?>" >
<input type="hidden" id="awbl_poids" name="awbl_poids" value="<?php echo $row->weight?>" >
<input type="hidden" id="d_depot" name="d_depot" value="<?php echo $datedepot?>" >
<input type="hidden" id="d_depot_comp" name="d_depot_comp" value="<?php echo $datecomp?>" >
<input type="hidden" id="total_poids" name="total_poids" value="<?php echo $total_poids?>" >
<input type="hidden" id="restant" name="restant" value="<?php echo $restant?>" >
<input  type="hidden" id="con" name="con" value="<?php echo $row->consignee?>">
<input  type="hidden" id="not" name="not" value="<?php echo dateVersChaine($row->datenotification)?>"  required/>
<input type="hidden" id="pack" name="pack" value="<?php echo $row->package?>">





</div>


<div class="form-group">
<button type="submit" class="btn btn-sm btn-success">
<i class="ace-icon fa fa-plus"></i>
Add
</button>
</div>
<?php echo form_close();
}
?>
<table class="table table-striped">
<thead>
<tr>
<th></th>
<th># AWB</th>
<th>Weight in kilos</th>
<th>Amount</th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>
<?php echo form_open('facture/update_degrouper/','class="form-inline"');?>
<tbody>
<?php
// if(isset($res==)) {
$f = 0;
foreach($res as $r){$f++; $montant=$r->iddeg."montant_degroup";?>
<!-- } -->
<tr>

<td><?php echo $f?>.</td>
<td><?php echo $r->nobuil?></td>
<td><?php echo round($r->poids,2)?></td>

<td class="center">
<span class="input-group">
<input type="hidden" id="segmentid" name="segmentid" value="<?php echo $row->segmentid;?>">
<input type="text" size="4%" class="form-control" id="<?php echo $montant;?>" placeholder="Montant" name="montant_degroup<?php echo $r->iddeg?>" value="<?php echo round($r->montant,2)?>">
<input type="hidden" id="iddeg" name="iddeg" value="<?php echo $r->iddeg?>" >
</span>
</td>	<td class="center">
USD
</td>
<td><a id="<?php echo $r->iddeg;?>" onclick="updating(this.id)" href="#"><i class="fa fa-edit bigger-120" aria-hidden="true"></i></a></td>
<td><a href="javascript:void(0)" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>facture/del_degrouper/f/rech/<?php echo $r->idbuil?>/<?php echo $r->iddeg.'/'.$row->segmentid.'/'.$r->nobuil?>')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
</td>
<td class="center">
  <!-- <a class="btn btn-xs btn-success" href="<?php echo base_url()?>facture/searchFacture/p/rechp/<?php echo $r->nobuil;?>">
  <i class="ace-icon fa fa-money"></i>
  payment
  </a> -->
</td>
</tr>
<input type="hidden" id="builid" value="<?php echo $r->idbuil;?>">
<input type="hidden" id="no_bil_degrou" value="<?php echo $r->nobuil;?>">
<?php }?>

</tbody>

<?php echo form_close();

?>
</table>
<hr />
<?php if($row->recupar != 'n'){?>
<h3>
Delivery Information</h3>
<table class="table table-striped">
<tbody>
<tr>
<td>Delivered on</td>
<td><?php echo dateverschainetext($row->datelivre)?></td>
</tr>
<tr>
<td>Delivered by</td>
<td><?php echo $row->livrepar?></td>
</tr>
<tr>
<td>Received by</td>
<td><?php echo $row->recupar."<br />".$row->nif?></td>
</tr>
</tbody>
</table>
<?php }?>
</div>
<?php }?>


</div>


</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script type="text/javascript">
var url="<?php echo base_url()?>facture/update_degrouper/f/rech/";
var urls="<?php echo base_url()?>facture/todo";
function updating(id){
nameid=id+"montant_degroup";
valeur=document.getElementById(nameid).value;
document.location.href=url+id+"/"+valeur+"/"+document.getElementById("no_bil_degrou").value+"/"+document.getElementById("builid").value+"/"+document.getElementById("segmentid").value;
}
var url="<?php echo base_url()?>facture/update_degrouper/f/rech/";
var urls="<?php echo base_url()?>facture/todo";
function updating(id){
nameid=id+"montant_degroup";
valeur=document.getElementById(nameid).value;
document.location.href=url+id+"/"+valeur+"/"+document.getElementById("no_bil_degrou").value+"/"+document.getElementById("builid").value+"/"+document.getElementById("segmentid").value;
}
$(document).ready(function(){
$("#codec").change(function(){
data=$(this).val();
danne=data.split("|");
$("#consignee").val(danne[1]);
});
});
$(document).ready(function(){
$("#montant").change(function(){
data=$(this).val();
danne=data.split("|");
$("#description").val(danne[1]);
});
});
$(document).ready(function(){
$("#montant").change(function(){
data=$(this).val();
danne=data.split("|");
$("#fre").val(danne[1]);
});
});
$(document).ready(function(){
$("#montan").change(function(){
data=$(this).val();
danne=data.split("|");
$("#fre2").val(danne[1]);
});
});
$(document).ready(function(){
$("#montant").change(function(){
data=$(this).val();
danne=data.split("|");
$("#drt").val(danne[1]);
});
});
$(document).ready(function(){
$("#montant").change(function(){
data=$(this).val();
danne=data.split("|");
$("#drt2").val(danne[1]);
});
});
</script>
