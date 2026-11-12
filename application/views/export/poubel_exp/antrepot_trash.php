<?php
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
wharehouse
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
  <form autocomplete="off"  action="<?php echo base_url()?>export/export/ajouter_warehouse" method="POST">

    <div class="form-group">
        <label class="control-label col-sm-6" for="awblnum"><strong>No AWBL:</strong></label>
        <div class="col-sm-3 col-sm-pull-4">
    <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="<?php echo $rs->no_awbl;?>" disabled>
    <input type="hidden" id="awblnum" name="awblnum" value="<?php echo $rs->no_awbl;?>" />

        </div></br>
      </div>

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
      <div class="col-lg-3 col-md-3 col-xs-3">
        <form class="form-inline" action="<?php echo base_url()?>export/export/ajouter_pcs" method="POST">
        <div class="form-group">
          <label for="qt">No PCS:</label>
          <input autocomplete="off" type="text" name="qt" id="qt" size="6%" class="form-control" placeholder="" value="" required />
        </div>
        <div class="form-group">
          <label for="dim1"></label>
          <input autocomplete="off" type="text" name="dim1" id="dim1" size="6%" class="form-control" placeholder="" value="" required />
        </div>
        <div class="form-group">
          <label for="dim2"></label>
          <input autocomplete="off" type="dim2" name="dim" id="dim2" size="6%" class="form-control" placeholder="" value="" required />
        </div>
        <div class="form-group">
          <label for="dim3"></label>
          <input autocomplete="off" type="text" name="dim3" id="dim3" size="6%" class="form-control" placeholder="" value="" required />
        </div>
        <button class="btn btn-sm btn-primary" type="submit">
                   <i class="ace-icon fa fa-plus"></i>
              Ajouter
                </button>
              </form></br>
      </div>
      <table class="table table-striped table-condensed table-bordered table-hover">
      <tr>
      <th  class="left">Nbr/PCS</th>
      <th  class="left">Lenght/Inches</th>
      <th  class="left">Width/Inches</th>
      <th  class="left">Height/Inches</th>
      <th  class="left">Volumetric Weight (Kg)</th>
      </tr>
      <?php
      if(count($antrepot2)>0){

      $r=0;  $totalpieces =0;  $totalvolum =0;foreach($antrepot2 as $row){$r++;

        $totalpieces +=$row->no_pieces;

      $totalvolum +=$row->total_Vo_weight;
        ?>

      <tr>
      <td class="center">
      <span class="input-group">
      <input autocomplete="off" type="text" name="qt" id="qt" size="7%" class="form-control" value="<?php echo $row->no_pieces;?>"  />
      </span>
      </td>
      <td class="center">
      <span class="input-group center">
      <input autocomplete="off" type="text" name="dim" id="dim1" size="7%" class="form-control" placeholder="" value="<?php echo $row->dim1;?>"  />
      </span>
      </td>
      <td class="center">
      <span class="input-group center">
      <input autocomplete="off" type="text" name="dim2" id="dim2" size="7%" class="form-control" placeholder="" value="<?php echo $row->dim2;?>"/>
      </span>
      </td>
      <td class="center">
      <span class="input-group center">
      <input autocomplete="off" type="text" name="dim3" id="dim3" size="7%" class="form-control" placeholder="" value="<?php echo $row->dim3;?>" />
      </span>
      </td>
      <td class="center">
      <span class="input-group center">
      <input type="text" autocomplete="off" type="readonly" name="dim41" id="dim41" size="7%" class="form-control" placeholder="" value="<?php echo $row->total_Vo_weight;?>" readonly>
      </span>
      </td>
      </tr>
        <?php }}?>

      <tr>
      <td colspan="4"  align="right"><strong>Total PCS</strong></td>
      <td align="right"><strong><?php echo $totalpieces ;?><strong/></td>
      </tr>
      <tr>
      <td colspan="4"  align="right"><strong>Total Volumetric weight</strong></td>
      <td align="right"><strong><?php echo $totalvolum ;?><strong/></td>
      </tr>
      <tr>
      <td colspan="4"  align="right"><strong>Gross Weight</strong></td>
      <td class="center">
      <span class="input-group center">
      <input autocomplete="off" type="text" name="gross_weight" id="gross_weight" size="7%" class="form-control" placeholder="" value="" />
      </span>
      </td></tr>
      </table>
      <div class="form-group">
      <input type="hidden" id="" name="" value="">

      <input type="hidden" name="entered_by" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />
      <button type="submit" class="btn btn-sm btn-primary">
      <i class="ace-icon fa fa-save"></i>
      Sauvegarder
      </button>

      <a href="<?php echo base_url()?>" class="btn btn-sm btn-primary">
      <i class="ace-icon fa fa-close"></i>
      Fermer
      </a>
      </div>
      </form>
</div>




</div>
