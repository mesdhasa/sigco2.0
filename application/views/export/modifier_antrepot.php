<?php
if(isset($_SESSION['droit']['a9']) and $_SESSION['droit']['a9']=="1"  ) {
}else{
redirect('home/pas_access');
}
foreach($antrepot as $rs){}
?>

<style>

legend
{
font-size:13px;
font-weight:bold;
margin-bottom: 0px;
width: auto;
border: 1px solid #ddd;
border-radius: 4px;
padding: 5px 5px 5px 10px;
background-color: #ffffff;
}
fieldset {
display: block;
margin-inline-start: 2px;
margin-inline-end: 2px;
padding-block-start: 0.35em;
padding-inline-start: 0.75em;
padding-inline-end: 0.75em;
padding-block-end: 0.625em;
min-inline-size: min-content;
border-width: 2px;
border-style: groove;
border-color: threedface;
border-image: initial;
}
/**
* The file contains styles for GWT widgets in the Clean theme.
*/
td, select, button {
font-family: Arial Unicode MS, Arial, sans-serif;
font-size: small;
}

</style>

<div class="page-header">
<h1>
<small>
<i class="ace-icon fa fa-angle-double-right"></i>
warehouse
</small>
</h1>
</div>

<div class="page-content">
<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong><?php echo $this->session->flashdata('sms');?></strong>
</div>

<?php } ?>
<div class="row">
<div class="col-lg-8 col-md-8 col-xs-8">
<h5>Warehouse No.: <strong><?php echo $this->uri->segment(2);?> </strong></h5>
<h5>AWB Number No.: <strong><?php echo $rs->no_awbl;?> </strong></h5>

<form class="form-inline"  id="fr_mod_antrepot"action="<?php echo base_url()?>export/export/ajouter_pcs" method="POST">
<div class="form-group">
<label for="qt">No PCS:</label>
<input autocomplete="off" type="text" name="qt" id="qt" size="6%" class="form-control" placeholder="Nbr/PCS" value="" required />
</div>
<div class="form-group">
<label for="dim1"></label>
<input autocomplete="off" type="text" name="dim1" id="dim1" size="6%" class="form-control" placeholder="Lenght/In" value="" required />
</div>
<div class="form-group">
<label for="dim2"></label>
<input autocomplete="off" type="text" name="dim2" id="dim2" size="6%" class="form-control" placeholder="Width/In" value="" required />
</div>
<div class="form-group">
<label for="dim3"></label>
<input autocomplete="off" type="text" name="dim3" id="dim3" size="6%" class="form-control" placeholder="Height/In" value="" required />
</div>

<input type="hidden" id="warehouse" name="warehouse" value="<?php echo $rs->no_warehouse;?>">

<button class="btn btn-sm btn-primary" type="submit" id="btn_mod_antrepot">
<i class="ace-icon fa fa-plus"></i>
Ajouter
</button>
</form></br>
</div>
</div>
<div class="row">
<form autocomplete="off"  id="fr_modifier_ajouter_warehouse" action="<?php echo base_url()?>export/export/modifier_ajouter_warehouse" method="POST">
<!-- <div class="form-group">
<label class="control-label col-sm-6" for="awblnum"><strong>No AWBL:</strong></label>
<div class="col-sm-3 col-sm-pull-5">
<input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="<?php echo $rs->no_awbl;?>" disabled>
<input type="hidden" id="awblnum" name="awblnum" value="<?php echo $rs->no_awbl;?>" />

</div>
</div> -->
<!-- <div class="form-group">
<label class="control-label col-sm-2 col-sm-pull-5" for="compagnie"><strong>Compagnie</strong></label>
<div class="col-sm-3 col-sm-pull-5"  style="position: relative;  margin-bottom: -0px; margin-top: -40px; margin-left: 910px;">
<select class="form-control" name="compagnie">
<option value="">---- Compagnie ----</option>
<?php foreach($compagnie as $row){?>
<option value="<?php echo $row->idcompagnie?>" <?php if($rs->idcompagnie==$row->idcompagnie) echo " selected"?>><?php echo strtoupper($row->compagnie);?></option>
<?php }?>

</select>
</div>
</div> -->
</br>
<div class="col-lg-6 col-md-6 col-xs-12">



<fieldset class="formElement-Grow-1" style="">
<legend>Chauffeur</legend>
<div style="position: relative;"><table>
<colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Nom</div></td><td>
<input type="text" autocomplete="off" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="nom"  name="nom" value="<?php echo $rs->nom_ch;?>">
</td></tr><tr><td></br>
<div class="gwt-Label">Prénom</div></td><td>
<input type="text"  autocomplete="off" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="prenom"  name="prenom" value="<?php echo $rs->prenom_ch;?>">
</td></tr><tr><td></br>
<div class="gwt-Label">Tel</div></td><td>
<input type="text" autocomplete="off" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel"  name="tel" value="<?php echo $rs->tel_ch;?>">
</td></tr><tr><td>
<div class="gwt-HTML">CIN / NIF</div></td><td>
<textarea class="form-control" autocomplete="off" id="cin"  name="cin" rows="2" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"><?php echo $rs->cin_ch;?></textarea>
</td></tr></tbody></table>
</div>
</fieldset>
</div>
<div class="col-lg-6 col-md-6 col-xs-12">
<fieldset class="formElement-Grow-1" style="">
<legend>Propriétaire</legend>
<div style="position: relative;"><table>
<colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Nom</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="nomp"  name="nomp" value="<?php echo $rs->nom_p;?>">
</td></tr><tr><td></br>
<div class="gwt-Label">E-mail</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="email"  name="email" value="<?php echo $rs->email_p;?>">
</td></tr><tr><td></br>
<div class="gwt-Label">Tel</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel"  name="tel" value="<?php echo $rs->tel_p;?>">
</td></tr><tr><td>
<div class="gwt-HTML">Remarque</div></td><td>
<textarea class="form-control" id="remarque"  name="remarque" rows="2" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"><?php echo $rs->remarque;?></textarea>
</td></tr></tbody></table>
</div>
</fieldset>
</br>
</div>

<table class="table table-striped table-condensed table-bordered table-hover">
<tr>
<th  class="left">Nbr/PCS</th>
<th  class="left">Lenght/Inches</th>
<th  class="left">Width/Inches</th>
<th  class="left">Height/Inches</th>
<th  class="left">Volumetric Weight (Kg)</th>
<th  class="left"></th>
</tr>
<?php
if(count($antrepot2)>0){

$r=0;  $totalpieces =0; $vo_weight=0;  $totalvolum =0;foreach($antrepot2 as $row){$r++;
$t1=round($row->dim1)*round($row->dim2)*round($row->dim3);
$t2=$t1*$row->no_pieces;
$vo_weight=$t2/366;
$totalpieces +=$row->no_pieces;

$totalvolum +=$vo_weight;
?>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off"type="readonly" name="qt1[]" id="qt1" size="7%" class="form-control" value="<?php echo $row->no_pieces;?>"   />
</span>
</td>
<td class="center">
<span class="input-group center">

<input type="hidden" name="lesid[]" value="<?php echo $row->id_wc?>">

<input autocomplete="off" type="text" name="dimm1[]" id="dimm1" size="7%" class="form-control" placeholder="" value="<?php echo $row->dim1;?>"   />
</span>
</td>

<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dimm2[]" id="dimm2" size="7%" class="form-control" placeholder="" value="<?php echo $row->dim2;?>" />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dimm3[]" id="dimm3" size="7%" class="form-control" placeholder="" value="<?php echo $row->dim3;?>" />
</span>
</td>

<td class="center">
<span class="input-group center">
<input type="text" autocomplete="off" type="readonly" name="dim41" id="dim41" size="7%" class="form-control" placeholder="" value="<?php echo round($vo_weight);?>" readonly>
</span>
</td>

<td class="center">
<a href="#" onclick="confirmation_lien('Voulez-vous supprimer cet enregistrement?','<?php echo base_url()?>export/export/delete_warehouse_colis/<?php echo $row->id_wc;?>/<?php echo $rs->no_warehouse;?>')"
class="btn btn-xs btn-danger">
<i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
</button>

</td>
</tr>
<?php }?>

<tr>
<td colspan="4"  align="right"><strong>Total PCS</strong></td>
<td align="right"><strong><?php echo $totalpieces ;?><strong/></td>
</tr>
<tr>
<td colspan="4"  align="right"><strong>Total Volumetric weight</strong></td>
<td align="right"><strong><?php echo round($totalvolum)?><strong/></td>
</tr>
<tr>
<?php }?>
<tr>
<td colspan="4"  align="right"  style="padding-top: 18px;"><strong>Nature Of Goods</strong></td>
<td style="width: 254px; margin-left: 900; ">
<span class="input-group center">
<textarea autocomplete="off" id="nature_of_goods" name="nature_of_goods"  rows="2" style="width: 254px; margin-left: 900; font-size: 11pt; " class="form-control"><?php echo $rs->nature_and_quantity;?></textarea>
</span>
</td></tr>
<td colspan="4"  align="right"><strong>Gross Weight (Kg)</strong></td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="gross_weight" id="gross_weight" size="7%" class="form-control" placeholder="" value="<?php echo $rs->gross_weight;?>" />
</span>
</td></tr>
</table>
<div class="form-group">
<input type="hidden" id="warehouse" name="warehouse" value="<?php echo $rs->no_warehouse;?>">

<!-- <input type="hidden" id="idwarehouse" name="idwarehouse" value="<?php echo $rs->id_warehouse;?>"> -->


<input type="hidden" name="entered_by" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />
<button type="submit"  id="btn_modifier_ajouter_warehouse" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-save"></i>
Sauvegarder
</button>
<a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url()?>export/export/warehousepdf/<?php echo $rs->no_warehouse;?>">

<i class="ace-icon fa fa-file-pdf-o"></i>
Imprimer
</a>
<?php  if(empty($rs->no_awbl)) {?>

<a class="btn btn-sm btn-danger"  href="<?php echo base_url()?>Airway_Bill/<?php echo $rs->no_warehouse;?>">

<i class="ace-icon fa fa-plus"></i>
Add Airway Bill
</a>


<a href="#" onclick="confirmation_lien('Voulez-vous créer Airway Bill par un numéro préexistant dans la base ?','<?php echo base_url()?>Airway_Bill2/<?php echo $rs->no_warehouse;?>')"
class="btn btn-xs btn-warning">
<i class="ace-icon fa fa-plus bigger-120" aria-hidden="false">Add Existing AWB</i>
</a>



<?php } else{?>
<a class="btn btn-sm btn-danger"  href="<?php echo base_url()?>modifier_Airway_Bill/<?php echo $rs->no_awbl;?>">
<i class="ace-icon fa fa-eye"></i>
View Airway Bill
</a>
<?php }?>
<a href="<?php echo base_url()?>" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-close"></i>
Fermer
</a>
</div>
</div>
</form>




</div>
<script>



$(function()
{
$('#btn_mod_antrepot').on('click',function()
{

$(this).html('Please wait ...').attr('disabled','disabled');
$('#fr_mod_antrepot').submit();

});

$('#btn_modifier_ajouter_warehouse').on('click',function()
{

$(this).html('Please wait ...').attr('disabled','disabled');
$('#fr_modifier_ajouter_warehouse').submit();

});

});
</script>
