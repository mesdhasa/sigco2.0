<?php
if(isset($_SESSION['droit']['a15']) and $_SESSION['droit']['a15']=="1"  ) {
}else{
	redirect('home');
}
	$desc = "";
		$qte = "";
		$awbl = "";
		$montant = "";
		$totalfreight = 0;
		$montanttotal = 0;
	foreach($information as $if){
		$montanttotal += round($if->mt,2);
	}
	$numfac = $if->nofacture;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Facture</title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url()?>assets/images/logo.png">
      </div>
      <h1>INVOICE <?php echo $numfac;?></h1>
      <div id="company" class="clearfix">
        <div>MESDHASA<br />TRANSCARGO<br />
		AMERIJET HAITI / ITN CONSOLIDATORS</div>

		<div>Ph: (509) 2813-1424 / 1484</div>
		<div>Cell:(509)3815-6944</div>
		<div>VOIP: 786-871-0114</div>
		<div>VOIP: 786-410-4772</div>
        <div><a href="mailto:mesdhasa.com">mesdhasa.com</a></div>
      </div>
      <div id="project">
        <div><span>CLIENT</span> <?php echo $if->societe;?></div>
		<div><span>ADRESSE</span> <?php echo $if->adresse;?></div>
        <div><span>DATE</span> <?php
		echo dateverschainetext($if->date);
		?></div>
        <div><span>DUE DATE</span> <?php
		$date = $if->date;
		echo dateverschainetext(date('Y-m-d', strtotime($date.' + 30 DAY')));

		?></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service"></th>
			<th class="qty">QTE</th>
            <th class="desc">DESCRIPTION</th>
            <th>MONTANT</th>
            <th>MONNAIE</th>
						<th>MONTANT PAYE</th>
						<th></th>
          </tr>
        </thead>
        <tbody>
          <?php

					foreach($information as $if){?>
		  <tr>
            <td class="service"></td>
			<td class="qty"><?php echo $if->qty;?></td>
            <td class="desc"> <?php echo $if->package."<br /> ( AWBL: ".$if->awbl." )";?></td>
            <td class="unit"></td>
            <td class="total"></td>
						<td class="unit"></td>
          </tr>
					<?php $codepaiement=array();$i=0;$somme = 0;$discount = 0;$apayer2 = 0;$apayer1 = 0;$paiement=0;



					foreach($lessegments as $row){

						$somme_prod = 0;
						foreach($lespaiments_efec as $st){
						 if($st->description == $row->description){
							 	if($st->monnaie=='USD'){
									$somme_prod += floatval($st->montant_hc);
								}else{
									$somme_prod += floatval($st->montant_hc)/floatval($st->taux);
								}

						 }
						}

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
					?>
					<tr>
					<td class="service"></td>
					<td class="qty"></td>
					<td class="desc"> <?php echo $row->description?></td>
					<td class="unit"><strong>$<?php echo round($apayer2,2)?><strong/></td>
					<td class="total"><strong><?php echo $row->monnaie_apayer?><strong/></td>
					<td class="unit"><?php echo round($somme_prod,2)?></td>
					</tr>
					<?php }}}

					$balance = ($somme-$paiement);
					?>
          <?php }?>

          <tr>
            <td colspan="5" class="grand total"> <strong>TOTAL</strong></td>
						<td class="grand total">$<?php echo $montanttotal;?> USD</td>
            <td class="grand total"></td>
          </tr>
					  <tr>
						<td colspan="5" class="unit"><strong>discount</strong></td>
						<td class="total">$<?php echo round($discount,2 )." ".$row->monnaie_apayer?></td>
						  </tr>
							<tr>
							<td colspan="5" class="unit"> <strong>Total Facture</strong></td>
							<td class="total">$<?php echo round($somme,2 )." ".$row->monnaie_apayer?></td>
								</tr>
								<tr>
								<td colspan="5" class="unit"><strong>Total Paiement</strong></td>
								<td class="total">$<?php echo round($paiement,2 )?></td>
									</tr>
									<tr>
									<td colspan="5" class="unit"><strong> BALANCE</strong></td>
									<td class="total">$<?php echo round($balance,2)." ".$row->monnaie_apayer?></td>
										</tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">PLEASE ISSUE THE CK TO THE ORDER OF MESDHASA</div>
      </div>
    </main>
    <footer>
      Invoice was created by DORALYA system.
    </footer>
  </body>
  <script>
	window.print();


</script>
</html>
