<?php
?>
<style>
table {
    border-collapse: collapse;
	    display: table; /* check so these really applies */
    width: 100%;
}
.td1{
	width:20%;
}
.td2{
	width:60%;

}
.td3{

  border-style: solid;
  border-width: 0px 0px 1px 0px;
}
.td4{
  border-style: solid;
  border-width: 1px 1px 1px 1px;
}
.td5{
  border-style: solid;
  border-width: 1px 1px 0px 1px;
}
.mes_p{
	margin:0px;
	padding:5px;
}
.mes_p1{
	margin:0px;
  padding-left: 140px;
}
.mes_p2{
  padding-left: 80px;
  margin-top:5px;
}
.mes_p3{
	margin:5px;
  padding-left: 85px;
}
.mes_p4{
	margin:0px;
  padding-left: 10px;
}
.mes_p5{
	margin:5px;
  padding-left: 95px;
}
.mes_p6{
	margin-top:0px;
  padding-left: 160px;
}
.mes_p7{
  margin-top:0px;
	margin-left:200px;
}
.span1{
  margin-top:0px;
	margin-left:20px;
  display: block;
  text-decoration-style: dotted;
}
.mes_p8{
	margin-top:0px;
}
table, th {
    border: 1px solid black;
	border-width:1px;
}
td, th{
	padding:4px;
	font-size: 12px;
	text-align:left;
}

.blank{
	border-left:0px;
	border-bottom:0px;
	border-top: 0px;
	border-right:0px;
}



.mes_p{
	margin:0px;
	padding:5px;
}
</style>

<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
Réservation
</small>

    </h1>

					<div class="page-content">

            <?php
            if($this->session->flashdata('sms_ajouter_reservation')){
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $this->session->flashdata('sms_ajouter_reservation');?></strong>
            </div>
            <?php } ?>
						<div class="row">
							<div class="col-lg-7 col-md-6 col-xs-12">


<form class="form-horizontal" autocomplete="off"  action="<?php echo base_url()?>export/export/ajouter_reservation" method="POST">
    <!-- <div class="form-group">
      <label class="control-label col-sm-3" for="compagnie"><strong>Compagnie:</strong></label>
        <div class="col-sm-9">
          <select  required class="form-control" name="compagnie" id="compagnie" onchange="return showcompagnie();">
          <option value="">---- Compagnie ----</option>
          <?php foreach($compagnie as $row){?>
          <option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

          <?php }?>
          </select>
        </div>
      </div>
<span id="span1" style="display: none">
  <div class="form-group" >
      <label class="control-label col-sm-3" for="no_reservation"><strong>No Réservation:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="no_reservation" placeholder="No Réservation" name="no_reservation"  re>
      </div>
    </div>
</span>
    <div class="form-group">
        <label class="control-label col-sm-3" for="awblnum"><strong>No AWBL:</strong></label>
        <div class="col-sm-9">
    <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="" required>
        </div>
      </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="shipper"><strong>Nom Expéditeur (Shipper):</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="shipper" placeholder="Nom Expéditeur (Shipper)" name="shipper" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="consignee"><strong>Nom Consignataire (Consignee):</strong></label>
      <div class="col-sm-9">
        <textarea name="consignee" id="consignee" placeholder="Nom Consignataire (Consignee)" class="form-control"></textarea>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-3" for="code_destination"><strong>Code Destination:</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="code_destination" placeholder="Code Destination" name="code_destination" value="">
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="code_origine"><strong>Code d’Origine:</strong></label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="code_origine" placeholder="Code d’Origine" name="code_origine" value="">
        </div>
      </div>
    <div class="form-group">
          <label class="control-label col-sm-3" for="pwd"><strong>Pre-paid:</strong></label>
          <div class="col-sm-9">
            <input type="checkbox" name="pp" value="1">
    	  </div>
        </div>
    <div class="form-group">
          <label class="control-label col-sm-3" for="pwd"><strong>Collect:</strong></label>
          <div class="col-sm-9">
            <input type="checkbox" name="cc" value="1">
    	  </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="pwd"><strong>No chage:</strong></label>
          <div class="col-sm-9">
            <input type="checkbox" name="nc" value="1">
        </div>
        </div>
<div class="form-group">
      <label class="control-label col-sm-3" for="nature_of_goods"><strong>Description Colis (Nature of Goods):</strong></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="nature_of_goods" placeholder="Description Colis (Nature of Goods)" name="nature_of_goods" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="notify_adress"><strong>Remarque:</strong></label>
      <div class="col-sm-9">
        <textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"></textarea>
      </div>
    </div> -->
    <table>
      <tr>
        <td class='td1'></td>
        <td class='td2'></td>
        <td class='td1'></td>
      </tr>

      <tr>
        <td ><p class='mes_p'>AW-16-01</p></td>
        <td ><p class='mes_p6'>Amerijet International -PAP</p></td>
        <td class=''></td>
      </tr>
      <tr>
        <td colspan='2'class='td3' ><p class='mes_p8'>Reservation Inquiry Screen<span class='mes_p7'>PA/</span></p>
        </td>
        <td class='td3'></td>
      </tr>
      <tr>
        <td colspan='2'class='td4'>
        <p class='mes_p'>*1. Reservation No:<span class='span1'></span></p>
          <div class="form-group">
              <label class="control-label col-sm-3" for="awblnum">
  <p class='mes_p'>2. Airbil No:<span class='span1'></span></p></label>
          <div class="col-sm-5">
          <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="" required>
            </div>
            </div>
        </td>

        <td rowspan='2'class='td4'>
        <p class='mes_p'>Station</p>
        <p class='mes_p'>Operation</p>
        <p class='mes_p'>Date:<span class='span1'></span></p>
        <p class='mes_p'>Time</p>
        <p class='mes_p'>Quote#</p>
    </td>
      </tr>
      <tr>
        <td class='td4'>
        <p class='mes_p'>3. +Suvey</p>
        </td>

        <td rowspan='2'class='td4'>
        <p class='mes_p1'>Scheduled Routing</p>
        <p class='mes_p2'>7. ____-_____-____ FLT ____ _____ ____</p>
        <p class='mes_p3'>____-_____-____ FLT ____ _____ ____</p>
        <p class='mes_p3'>____-_____-____ FLT ____ _____ ____</p>
        <p class='mes_p3'>____-_____-____ FLT ____ _____ ____</p>
        </td>
      </tr>
      <tr>
        <td class='td4'>
        <p class='mes_p'>4. Origin:<span class='span1'></span></p>
        <p class='mes_p'>5. Dest:<span class='span1'></span></p>
        </td>
        <td class='td4'></td>
      </tr>
      <tr>
        <td class='td4'>
        <p class='mes_p'>6. U/M ___</p>
        <p class='mes_p4'>. Dim Unit ___</p>
        </td>
        <td rowspan='2' class='td4'>
        <p class='mes_p1'>Pieces Act wt vol wt</p>
        <p class='mes_p2'>8.+Loose  ____ ____ ____</p>
        <p class='mes_p2'>9.+Pallet ____ ____ ____</p>
        <p class='mes_p5'>Total ____ ____ ____</p>
        </td>
        <td class='td4'>15.Charges Code ___</td>
      </tr>
      <tr>
        <td class='td4'>Charge</td>
        <td class='td4'>16. +Insurance ___</td>
      </tr>
      <tr>
        <td colspan='2' class='td5'>
        <p class='mes_p'>10.Pripority ___</p>
        </td>
        <td class='td4'>
        <p class='mes_p'>17. +Promotion code</p>
        </td>
      </tr>
      <tr>
        <td colspan='2' class='td4'>
        <p class='mes_p'>11.Comm Class ___</p>
        <p class='mes_p'>12. +Tendered By _____ __________</p>
        <p class='mes_p'>13. +Consignee:<span class='span1'></span></p>
        <p class='mes_p'>14. +Remarks:<span class='span1'></span></p>
        </td>
        <td class='td4'>
           <p class='mes_p'>18. +Spot rate</p>
    </td>
      </tr>



    </table>
    <div class="form-group">
    <input type="hidden" id="" name="" value="">
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


					</div><!-- /.page-content -->

<script>
function showcompagnie(){
var selectBox = document.getElementById('compagnie');
var userInput = selectBox.options[selectBox.selectedIndex].value;
if (userInput == "2"){
document.getElementById('span1').style.display = 'block';
    }else{
document.getElementById('span1').style.display = 'none';
}
return false;}

</script>
