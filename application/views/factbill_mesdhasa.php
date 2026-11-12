<?php
if(isset($_SESSION['droit']['a15']) and $_SESSION['droit']['a15']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
$fre = "Freight";
$drt = "Storage Fees ";
foreach($lessegments as $row){}
$total_poids = 0;

$sps="";
$totalsps=$row->sps;
$poidsps=$row->weight;
$resul = "";

?>

<div class="page-header">
<form id="frmclient" name="frmclient" action="<?php echo base_url().'facture/getclient_exp/f/rech/'.$row->awbl?>" method="POST">
<input type="hidden" class="form-control" id="segmentid"  name=" segmentid" value="" />
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
<strong style="font-size:20px; text-align:right;">    <?php echo dateVersChainetext($row->datecreated);?>  <?php echo $row->typeawbl?></strong>

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

<form class="form-horizontal" action="<?php echo base_url()?>facture/update_buill_mesdhasa" method="POST">
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
<label class="control-label col-sm-2" for="weight"><strong>Weight:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" value="<?php echo $row->weight?>">
</div>
</div>
<?php }else{?>
<div class="form-group">
<label class="control-label col-sm-2" for="weight"><strong>Weight:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" name="weight" value="<?php echo $row->weight?>">
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
<label class="control-label col-sm-2" for="currency"><strong>Currency:</strong></label>
<div class="col-sm-2">
<input autocomplete="off" type="text" class="form-control" id="currency" placeholder="Currency" name="currency" value="<?php echo $row->currency?>">
</div>
</div>

<!-- <div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>Pre-paid:</strong></label>
<div class="col-sm-10">
<input id="<?php echo $row->awbl?>a" <?php if($row->prepaid=="1") echo "checked=\"checked\"";?> onchange="Clkppcl('<?php echo $row->awbl?>','b')" class="choixcb" type="checkbox">
</div>
</div> -->
<!-- <div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>Collect:</strong></label>
<div class="col-sm-10">
<input id="<?php echo $row->awbl?>b" <?php if($row->collect=="1") echo "checked=\"checked\"";?> onchange="Clkppcl('<?php echo $row->awbl?>','a')" class="choixcb" type="checkbox">
</div>
</div> -->
<!-- <div class="form-group">
<label class="control-label col-sm-2" for="pwd"><strong>No charge:</strong></label>
<div class="col-sm-10">
<input id="<?php echo $row->awbl;?>c" <?php if($row->nocharge=="1") echo "checked=\"checked\"";?>  onchange="Clkppcl('<?php echo $row->awbl;?>','a','b')" class="choixcb" type="checkbox">
</div>
</div> -->

<!-- <div class="form-group">
<label class="control-label col-sm-2 col-lg-pull-0" for="datenotification"><strong>Notification:</strong></label>
<div class="col-sm-3">
<input autocomplete="off" type="text" class="form-control" id="datecustum" placeholder="Date Notification" name=" datenotification" value="<?php echo dateVersChaine($row->datenotification)?>"  required/>
</div>
</div> -->
<!-- <fieldset>
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
 </fieldset> -->
<div class="form-group">
<label class="control-label col-sm-2" for="remarque"><strong>Note:</strong></label>
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
<!-- <a href="<?php echo base_url()?>facture/facturehtml/<?php echo $nofacture?>" target="_blank" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-print"></i>
Print
</a> -->
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

<?php echo form_open('facture/ajouterMontant_mesdhasa/f/rech/'.$row->awbl,'class="form-inline"');?>
<strong>Amount to invoice</strong><br />
<input type="hidden" class="form-control" id="segmentid"  name=" segmentid" value="<?php echo $row->segmentid?>" />

<div class="form-group">
<input type="text" size="25" class="form-control" placeholder="Description" id="description" name="description" required>
</div>
<input type="hidden"name="signe" value="+" />
<div class="form-group">
  <input type="text" size="10" class="form-control" placeholder="Description" id="montant" name="montant" required>

<!-- <select class="form-control" name="montant" id="montant"required>
<option>---</option>
<?php foreach($frais as $fr){?>
<option value="<?php echo round($fr->montant,2)."|".$fr->description;?>"><?php echo round($fr->montant,2)?></option>

<?php }?>
<?php if($row->collect=="1"){?>
<option value="<?php echo $row->freight."|".$fre;?>"><?php echo $row->freight;?></option>
<?php }?>
<?php if($row->prepaid=="1"){?>
<option value="<?php echo $row->freight."|".$fre;?>"><?php echo $row->freight;?></option>
<?php }?>
<?php
if($resul > 0){
?>
<option value="<?php echo  $resul."|".$drt;?>"><?php echo $resul ;?></option>
<?php
}
?>
</select> -->
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
<?php echo form_open('facture/rabais_off_mesdhasa/','class="form-inline"');?>
<tbody>

<?php  $i=0;$total=0;$total2=0;foreach($lespaiements as $pmt){$i++;$total+=$pmt->apayer;$total2+=$pmt->rabais;$rabais=$pmt->idtx;
  if ($i==1){?>

<?php }else {?>
  <tr>
  <td><?php echo $i-"1";?></td>
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
  <a href="#" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>facture/deleteFacture_mesdhasa/f/rech/<?php echo $pmt->idtx?>/<?php echo $pmt->awbl.'/'.$row->segmentid?>')"><i class="fa fa-trash-o" aria-hidden="true"></i>	<?php }?></td>
  </tr>
<?php }}?>
<tr>
<td></td>
<td><strong>Total</strong></td>
<td align="center"><strong><?php echo round($total-"1",2)?></strong></td>
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

<?php echo form_open('facture/ajouterMontant2_mesdhasa/f/rech/'.$row->awbl,'class="form-inline"');?>
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

<a class="btn btn-sm btn-primary" href="#" onclick="confirmation_lien('Do you want to validate this transaction?','<?php echo base_url()?>facture/validerfacture_mesdhasa/f/rech/<?php echo $this->session->client?>/<?php echo $pmt->awbl.'/'.$row->segmentid?>/<?php echo $nofacture?>')">
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


<hr />

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

</script>
