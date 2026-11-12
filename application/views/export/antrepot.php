<?php
if(isset($_SESSION['droit']['a9']) and $_SESSION['droit']['a9']=="1"  ) {
}else{
	redirect('home/pas_access');
}
require_once('tete.php');?>

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

<div class="row">
	<?php echo form_open('export/export/ajouter_warehouse',array('id'=>'fr_antrepot','method'=>'post'));?>




<div class="col-lg-6 col-md-6 col-xs-12">



<fieldset class="formElement-Grow-1" style="">
<legend>Chauffeur</legend>
<div style="position: relative;"><table>
<colgroup><col></colgroup><tbody><tr><td>
<div class="gwt-Label">Nom</div></td><td>
<input type="text" autocomplete="off" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="nom"  name="nom" value="">
</td></tr><tr><td></br>
<div class="gwt-Label">Prénom</div></td><td>
<input type="text"  autocomplete="off" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="prenom"  name="prenom" value="">
</td></tr><tr><td></br>
<div class="gwt-Label">Tel</div></td><td>
<input type="text" autocomplete="off" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel"  name="tel" value="">
</td></tr><tr><td>
<div class="gwt-HTML">CIN / NIF</div></td><td>
<textarea class="form-control" autocomplete="off" id="cin"  name="cin" rows="2" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"></textarea>
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
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="nomp"  name="nomp" value="">
</td></tr><tr><td></br>
<div class="gwt-Label">E-mail</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="email"  name="email" value="">
</td></tr><tr><td></br>
<div class="gwt-Label">Tel</div></td><td>
<input type="text" class="form-control" style="width: 187px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;" id="tel"  name="tel" value="">
</td></tr><tr><td>
<div class="gwt-HTML">Remarque</div></td><td>
<textarea class="form-control" id="remarque"  name="remarque" rows="2" style="width: 354px; font-size: 11pt; font-family: Consolas, Inconsolata, monospace; text-transform: uppercase;"></textarea>
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
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
<input type="text" autocomplete="off" type="readonly" name="dim41" id="dim41" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim42" id="dim42" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim43" id="dim43" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim44" id="dim44" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim45" id="dim45" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim46" id="dim46" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim47" id="dim47" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>

<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim48" id="dim48" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>
<tr>
<td class="center">
<span class="input-group">
<input autocomplete="off" type="text" name="qt[]" id="qt" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim1[]" id="dim1" size="7%" class="form-control" placeholder="" value=""  />
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim2[]" id="dim2" size="7%" class="form-control" placeholder="" value=""/>
</span>
</td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="dim3[]" id="dim3" size="7%" class="form-control" placeholder="" value="" />
</span>
</td>

<td class="center">
<span class="input-group center">
  <input type="text" autocomplete="off" type="readonly" name="dim49" id="dim49" size="7%" class="form-control" placeholder="" value="" readonly>
</span>
</td>
</tr>
<tr>
<td colspan="5"  align="right"><strong>Total PCS</strong></td>
<td align="right"><strong><strong/></td>
</tr>
<tr>
<td colspan="5"  align="right"><strong>Total Volumetric weight</strong></td>
<td align="right"><strong><strong/></td>
</tr>
<tr>
<td colspan="5"  align="right"><strong>Nature Of Goods</strong></td>
<td class="center">
<span class="input-group center">
  <textarea autocomplete="off" id="nature_of_goods" name="nature_of_goods" class="form-control"></textarea>
</span>
</td></tr>
<tr>
<td colspan="5"  align="right"><strong>Gross Weight (Kg)</strong></td>
<td class="center">
<span class="input-group center">
<input autocomplete="off" type="text" name="gross_weight" id="gross_weight" size="7%" class="form-control" placeholder="" value="" />
</span>
</td></tr>


</table>

<div class="form-group">
<input type="hidden" id="" name="" value="">

<input type="hidden" name="entered_by" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />

<button type="submit" id="btn_antrepot" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-save"></i>
Sauvegarder
</button>

<a href="<?php echo base_url()?>" class="btn btn-sm btn-primary">
<i class="ace-icon fa fa-close"></i>
Fermer
</a>
</div>
	<?php echo form_close();?>
</div>
</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
$(function()
{

 $('#btn_antrepot').on('click',function()
 {
	 $(this).html('Please wait ...').attr('disabled','disabled');
	 $('#fr_antrepot').submit();

 });
});
</script>
