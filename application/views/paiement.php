<?php
if(isset($_SESSION['droit']['a15']) and $_SESSION['droit']['a15']=="1"  ) {
}if(isset($_SESSION['droit']['a19']) and $_SESSION['droit']['a19']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
foreach($lestaux as $res){}
foreach($lessegments as $awb){}


?>
<style>
.w3 {
	visibility: hidden;
	height: 4px;
	margin-top: 200px;
	padding-top: 200px;
}
</style>
<div class="page-header">

							<h1>

								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Rechercher une facture
								</small>

							</h1>

						</div>

					<div class="page-content">

						<div class="row">
							<div class="col-lg-4 col-lg-push-4">
							<?php echo form_open('facture/searchFac/f/rech','class="form-inline"');?>

								<div class="input-group">
								  <input autocomplete="off" type="text" name="noawbl" id="noawbl" size="30%" class="form-control" placeholder="No facture" value="<?php echo $id;?>" required />
								  <span class="input-group-btn">
									<button class="btn btn-sm btn-primary" type="submit">
													   <i class="ace-icon fa fa-search"></i>
													Recherche
													</button>
								  </span>
								</div>

							<?php echo form_close();?>

								</br>
								</div>
						</div>

						<?php if(count($lessegments)>0){?>
						<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-12">
<div class="table-responsive">
	<h4>AWB #	<b><?php	echo $awb->awbl;?></b></h4>
	<h4>Transactions</h4>
	<table class="table table-striped">
    <thead>
      <tr>
        <th></th>
        <th>Description</th>
		<th>Montant</th>
		<th></th>
	</tr>

    <tbody>
			<form name="listForm">

				<tr class="w3">

				<td></td>
						<td>
			<input value="0" style="visibility: hidden;" name="choice"  class="choixcb" type="checkbox" onchange="checkTotal()" required autofocu>
			<input  type="hidden" size="5" class="form-control" id="idtx" name="idtx"  value="0">
			<input  type="hidden" size="5" class="form-control" id="description" name="description"  value="0"></td>
					</tr>
			<?php $codepaiement=array();$i=0;$somme = 0;$discount = 0;$apayer2 = 0;$apayer1 = 0;$paiement=0;
			foreach($lessegments as $row){

		  $i++;
			$apayer2=$row->apayer-$row->rabais;
      $apayer1+=$row->apayer;
      $somme += $apayer2;
		  $discount += $row->rabais;
		  $paiement += $row->payer;
		  if($row->codetx=="PMT"){
			 $codepaiement[] = $row->nopaiement;
		  }
		  if($row->codetx=="FAC"){

			if($row->apayer !='0'){
				if($row->description =='Default_export'){


	?>

		<input type="hidden" value="<?php echo round($apayer2,2)?>" name="choice"  class="choixcb" type="checkbox" onchange="checkTotal()" required autofocu>
		<!-- <?php echo $row->description?> -->
		<input  type="hidden" size="5" class="form-control" id="idtx<?php echo $row->idtx?>" name="idtx"  value="<?php echo $row->idtx?>">
		<input  type="hidden" size="5" class="form-control" id="description<?php echo $row->idtx?>" name="description"  value="<?php echo $row->description?>">


<?php }else{ ?>

	<tr>

	<td></td>
			<td>
<input value="<?php echo round($apayer2,2)?>" name="choice"  class="choixcb" type="checkbox" onchange="checkTotal()" required autofocu>
<?php echo $row->description?>
<input  type="hidden" size="5" class="form-control" id="idtx<?php echo $row->idtx?>" name="idtx"  value="<?php echo $row->idtx?>">
<input  type="hidden" size="5" class="form-control" id="description<?php echo $row->idtx?>" name="description"  value="<?php echo $row->description?>"></td>
	<td align="right"><strong>$<?php echo round($apayer2,2)?><strong/></td>
			<td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
		</tr>


<?php }}}}

	  $balance = ($somme-$paiement);
		if($row->awbl_type =='MESDHASA2'){
		?>
		<tr>
		 <td></td>
			 <td align="right"><strong>Montant</strong>
	 </td>
		<td align="right"><strong>$<?php echo round($apayer1-"1",2)?><strong/></td>
			 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
		 </tr>
		 <tr>
			 <td></td>
				 <td align="right"><strong>discount</strong></td>
		 <td align="right"><strong>$<?php echo round($discount,2)?><strong/></td>
				 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
			 </tr>
			 <tr>
				 <td></td>
					 <td align="right"><strong>Total Facture</strong></td>
					 <td align="right"><strong>$<?php echo round($somme-"1",2)?><strong/></td>
						<td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
				 </tr>
		<tr>
			 <td></td>
		 <td></td>
		 <td></td>
		 <td></td>
		 </tr>
		<tr>
			 <td></td>
			 <td align="right"><strong>Total Paiement</strong></td>
		<td align="right"><strong>$<?php echo round($paiement-"1",2)?><strong/></td>
			 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
		 </tr>
		<tr>
			 <td></td>
			 <td align="right"><strong>Balance</strong></td>
		<td align="right"><strong>$<?php echo round($balance,2)?><strong/></td>
			 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
		 </tr>
	<?php }elseif($row->awbl_type =='export') {?>

		<tr>
	 	 <td></td>
	 		 <td align="right"><strong>Montant</strong>
	 </td>
	  <td align="right"><strong>$<?php echo round($apayer1-"1",2)?><strong/></td>
	 		 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 	 </tr>
	 	 <tr>
	 		 <td></td>
	 			 <td align="right"><strong>discount</strong></td>
	 	 <td align="right"><strong>$<?php echo round($discount,2)?><strong/></td>
	 			 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 		 </tr>
	 		 <tr>
	 			 <td></td>
	 				 <td align="right"><strong>Total Facture</strong></td>
	 				 <td align="right"><strong>$<?php echo round($somme-"1",2)?><strong/></td>
	 					<td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 			 </tr>
	 	<tr>
	 		 <td></td>
	 	 <td></td>
	 	 <td></td>
	 	 <td></td>
	 	 </tr>
	  <tr>
	 		 <td></td>
	 		 <td align="right"><strong>Total Paiement</strong></td>
	  <td align="right"><strong>$<?php echo round($paiement-"1",2)?><strong/></td>
	 		 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 	 </tr>
	  <tr>
	 		 <td></td>
	 		 <td align="right"><strong>Balance</strong></td>
	  <td align="right"><strong>$<?php echo round($balance,2)?><strong/></td>
	 		 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 	 </tr>
	<?php }else {?>
		<tr>
	 	 <td></td>
	 		 <td align="right"><strong>Montant</strong>
	 </td>
	  <td align="right"><strong>$<?php echo round($apayer1,2)?><strong/></td>
	 		 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 	 </tr>
	 	 <tr>
	 		 <td></td>
	 			 <td align="right"><strong>discount</strong></td>
	 	 <td align="right"><strong>$<?php echo round($discount,2)?><strong/></td>
	 			 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 		 </tr>
	 		 <tr>
	 			 <td></td>
	 				 <td align="right"><strong>Total Facture</strong></td>
	 				 <td align="right"><strong>$<?php echo round($somme,2)?><strong/></td>
	 					<td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 			 </tr>
	 	<tr>
	 		 <td></td>
	 	 <td></td>
	 	 <td></td>
	 	 <td></td>
	 	 </tr>
	  <tr>
	 		 <td></td>
	 		 <td align="right"><strong>Total Paiement</strong></td>
	  <td align="right"><strong>$<?php echo round($paiement,2)?><strong/></td>
	 		 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 	 </tr>
	  <tr>
	 		 <td></td>
	 		 <td align="right"><strong>Balance</strong></td>
	  <td align="right"><strong>$<?php echo round($balance,2)?><strong/></td>
	 		 <td class="center"><strong><?php echo $row->monnaie_apayer?><strong/></td>
	 	 </tr>
	<?php } ?>

 <input type="hidden" size="5" name="total" value="0" disabled/>

</form>

    </tbody>
  </table>
  </div>
	<div class="table-responsive">
		<h4>Paiement Effectué</h4>
		<table class="table table-striped">
	    <thead>
	      <tr>
	        <th></th>
	        <th>Description</th>
					<th>Montant</th>
					<th></th>
					<th>Date</th>
			<th>N0 Rapport</th>
			<th></th>
		</tr>

	    <tbody>
				<?php $y=0; foreach ($lespaiments_efec as $key) { $y++;?>

		  <tr>

				<td align="right"><?php echo $y?></td>
				<td align="left"><?php echo $key->description?></td>
				<td align="right"><?php echo $key->montant_hc?></td>
				<td align="right"><?php echo $key->monnaie?></td>
			<td align="right"><?php echo dateverschainetext($key->date_hc);?></td>
			<td class="center"><?php echo $key->norapport?></td>
	        <td class="center"></td>
	      </tr>


<?php }?>

	    </tbody>
			<?php if($row->description=="REMBOURSSEMENT"){?>

			<?php }else{?>

				 <?php }?>
			<td align="right"><strong>DELETE<strong/></td>
				 <?php foreach($codepaiement as $pm){?>
					<td class="center"><strong>
						<a class="btn btn-xs btn-warning" href="#" onclick="confirmation_lien('Do you want to delete this transaction?','<?php echo base_url()?>facture/deleteFacture_payer/<?php echo $pm?>/<?php echo $row->nofacture;?>')">
						<i class="ace-icon fa fa-trash"></i>
					Delete<?php echo $pm?>
					</a>
					<strong/></td>
				<?php }?>

	  </table>
	  </div>
	</div>

	<div class="col-lg-6 col-md-6 col-xs-12">
<?php echo form_open('facture/payerfacture/f/rech/'.$row->nofacture,'id="f1"');?>

<div class="table-responsive">
	<p style="font-size:20px"><strong>Client:</strong> <?php echo '[ '.$row->reference." ]  ".$row->societe;?></p>
	<h4>Paiement</h4>
	<table class="table">
    <tbody>
			<tr>
					<td class="center"></td>
					<td>Montant</td>
			<td>
			<input type="" size="5" class="form-control" id="montantenc" name="montantenc" value="" readonly>
			</td>
					<td>
			<select class="form-control" name="monnaie" id="monnaie" style="width:80px;" onchange="calculApayer()">
			<option value="USD">USD</option>
			<option value="HTG">HTG</option>
			</select>
			</td>
			</tr>
	  <tr>
        <td class="center"></td>
        <td>Montant encaiss&eacute;</td>
		<td>

			<input type="text" size="5" class="form-control" id="montant" name="montant" value="">
		</td>

		<input type="hidden" name="type_awbl" id="type_awbl" value="<?php echo $row->awbl_type?>" />

		<input  type="hidden" size="5" class="form-control" id="all_montant" name="all_montant" onblur="calculApayer()"  value=""readonly >
		<input  type="hidden" size="5" class="form-control" id="all_prix" name="all_prix"  value=""readonly >
		<input type="hidden" size="100" class="form-control" id="all_description" name="all_description"  value=""readonly >
      </tr>

	  <tr>
        <td class="center"></td>
        <td>Taux de jour</td>
		<td>
			<label class="form-control"><?php echo round($res->taux,2)?></label>
			<input type="hidden" name="htaux" id="htaux" value="<?php echo round($res->taux,2)?>" />
		</td>
        <td></td>
      </tr>
	  <tr>
        <td class="center"></td>
        <td>Type de paiement</td>
		<td>
			<select class="form-control"  required aria-required="true"  name="type" id="type" onchange="return paiement();" required >
				<option value="">--</option>
				<option value="CASH">CASH</option>
				<option value="CHEQUE">CHEQUE</option>
				<option value="EXTERNE">EXTERNE</option>
				<option value="CARTE DE CREDIT">CARTE DE CREDIT</option>
				<option value="VIREMENT">VIREMENT</option>
			</select>
		</td>
        <td></td>
      </tr>

	  <input type="hidden" name="nofacture" value="<?php echo $row->nofacture;?>" />
	  <input type="hidden" name="awbl" value="<?php echo $row->awbl;?>" />
	  <input type="hidden" name="codeclient" value="<?php echo $row->codeclient;?>" />
		<input type="hidden" name="monnaie_apayer" value="<?php echo $row->monnaie_apayer;?>" />
	  <input type="hidden" name="received" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />

    </tbody>
  </table>
  </div>
	<span id="span1" style="display: none">
		<div class="form-group">Banque: <input type="text" style="margin-left: 162px;" name="banque1" value=""><br></div>
		<div class="form-group">Nom du Compte: <input type="text" style="margin-left: 110px;" name="nom_compte1" value=""><br></div>
		<div class="form-group">No chèque: <input type="text" style="margin-left: 145px;" name="cheque" value=""><br></div>
	</span>
	<span id="span2" style="display: none">
		<div class="form-group">Carte: <input type="text" style="margin-left: 182px;" name="banque2" value=""><br></div>
		<div class="form-group">Nom du titulaire: <input type="text" style="margin-left: 115px;" name="nom_compte2" value=""><br></div>
		<div class="form-group">Crytogramme: <input type="text"  style="margin-left: 130px;" name="digit"  value=""><br></div>
	</span>
<div class="form-group">
	<textarea class="form-control" id="memo" name="memo" placeholder="Memo"></textarea>
  </div>



 <?php if(round($balance,2)>0){?>
 <a class="btn btn-lg btn-success" href="#" onclick="confirmation_action_paiement('Voulez-vous valider ce paiement?')">
 <i class="ace-icon fa fa-save"></i>
 Payer
</a>
<?php }?>

 <?php foreach($codepaiement as $pm){?>

			<a class="btn btn-sm btn-default" href="<?php echo base_url()?>facture/imprimerecu/<?php echo $pm?>/<?php echo $id;?>" target="_blank" >
 		<i class="ace-icon fa fa-print"></i>
 		Imprimer <?php echo $pm?>
 	</a>
 <?php }?>
  <a class="btn btn-md btn-primary" href="<?php echo base_url()?>facture/">
	<i class="ace-icon fa fa-close"></i>
	Fermer
</a>


<?php echo form_close();?>
<br/><br/><br/>


<div class="table-responsive">
	<h4>Remboursement</h4>
	<form class="form-inline" action="<?php echo base_url()?>facture/Rembourser_facture/f/rech/" method="POST">
	<div class="form-group">
		<label for="amount"></label>
		<input autocomplete="off" type="text" name="amount" id="amount" size="6%" class="form-control" placeholder="Amount" value="" required />
	</div>
	<div class="form-group">
		<select class="form-control"  required aria-required="true"  name="type" id="type" onchange="return paiement();" required >
			<option value="CASH">CASH</option>
			<option value="CHEQUE">CHEQUE</option>
			<option value="EXTERNE">EXTERNE</option>
			<option value="CARTE DE CREDIT">CARTE DE CREDIT</option>
			<option value="VIREMENT">VIREMENT</option>
		</select>
	</div>

	<div class="form-group">
<select class="form-control" name="monnaie" id="monnaie" style="width:80px;">
<option value="USD">USD</option>
<option value="HTG">HTG</option>
</select>
	</div>
	<div class="form-group">
		<label for="amount"></label>
		<textarea autocomplete="off" class="form-control" id="memo" name="memo" rows="2" cols="13" placeholder="Memo"></textarea>
	</div>
	<input type="hidden" name="htaux" id="htaux" value="<?php echo round($res->taux,2)?>" />
	<input type="hidden" name="nofacture" value="<?php echo $row->nofacture;?>" />
	<input type="hidden" name="awbl" value="<?php echo $row->awbl;?>" />
	<input type="hidden" name="codeclient" value="<?php echo $row->codeclient;?>" />
	<input type="hidden" name="type_awbl" id="type_awbl" value="<?php echo $row->awbl_type?>" />
	<input type="hidden" name="lien_p" id="lien_p" value="<?php echo $this->uri->segment(5)?>" />
	<input type="hidden" name="received" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />


	<button class="btn btn-sm btn-primary" type="submit">
						 <i class="ace-icon fa fa-plus"></i>

					</button>

				</form><br/>

	</div>

	</div>
</div>
<?php }?>


					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>

function checkTotal() {
		document.listForm.total.value = '';
		var sum = 0;
		var montant = '';
		var descp = '';
		for (i=0;i<document.listForm.choice.length;i++) {
		  if (document.listForm.choice[i].checked) {
		  	sum = sum + parseFloat(document.listForm.choice[i].value);
				montant += document.listForm.choice[i].value + ',';
				descp += document.listForm.description[i].value + ',';
		  }
		}

		document.listForm.total.value = (sum);
		$("#all_montant").val(sum);
		$("#montantenc").val(sum);
		$("#montant").val(sum);
		$("#all_description").val(descp);
		$("#all_prix").val(montant);
	}

function calculApayer(){
	var total = 0;
	if($('#monnaie').val()=="USD"){
		total = $('#all_montant').val();
		$('#montantenc').val(total);
		$('#montant').val(total);
		$('#labelencaisse').text(total);

	}else{
		total = $('#all_montant').val()*$('#htaux').val();
		$('#montantenc').val(Math.round(total*100)/100);
		$('#montant').val(Math.round(total*100)/100);
		$('#labelencaisse').text(Math.round(total*100)/100);
	}
}


function paiement(){
var selectBox = document.getElementById('type');
var userInput = selectBox.options[selectBox.selectedIndex].value;
if (userInput == "CHEQUE"){
document.getElementById('span1').style.display = 'block';
document.getElementById('span2').style.display = 'none';

}else if (userInput == "CARTE DE CREDIT") {
	document.getElementById('span2').style.display = 'block';
	document.getElementById('span1').style.display = 'none';

}else if (userInput == "EXTERNE") {
	document.getElementById('span2').style.display = 'none';
	document.getElementById('span1').style.display = 'none';

}else{
	document.getElementById('span1').style.display = 'none';
document.getElementById('span2').style.display = 'none';
}

return false;}

</script>
