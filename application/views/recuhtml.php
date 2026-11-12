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
		foreach($lessegments as $if){
		$montanttotal += round($if->mt,2);
		}
		$numfac = $if->nopaiement;

		$somme = 0;$paiement= 0;$apayer2 = 0; $topayer =0; $i=0; foreach($lespaiement_histo as $row2){

	 		$apayer2=$row2->apayer-$row2->rabais;
	   $somme += $apayer2;
		  $paiement += $row2->payer;
			$balance = ($somme-$paiement);
	 			if($row2->codetx!="FAC"){
						$i++;
					$topayer=$i;
				}}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Re&ccedil;u</title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url()?>assets/images/logo.png">
      </div>
      <h1>Re&ccedil;u <?php echo $numfac;?></h1>
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

      </div>
    </header>
    <main>

			<table>
				<thead>
					<tr>
						<th class="service"></th>
						<th class="qty">QTE</th>
						<th class="desc" >DESCRIPTION</th>
						<th colspan="3">MONTANT</th>
						<th>MONNAIE</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach($lessegments as $if){?>
			<tr>
						<td class="service"></td>
			<td class="qty"><?php echo $if->qty;?></td>
						<td class="desc"> <?php echo $if->package."<br /> ( AWBL: ".$if->awbl." )";?></td>
						<td class="unit"></td>
						<td class="total"></td>

					</tr>
					<?php $i=0; foreach($infohisto as $row){

					?>
					<tr>
					<td class="service"></td>
					<td class="qty"></td>
					<td class="desc"> <?php echo $row->description?></td>
					<td colspan="3"  ><strong><?php echo $row->montant_hc?><strong/></td>
					<td class="total"><strong><?php echo $row->monnaie?><strong/></td>

					</tr>
					<?php }

?>
					<?php }?>

					<tr>
						<td colspan="8" class="grand total"> TOTAL FACTURE: &nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;&nbsp;<?php echo round($somme,2 );?>&nbsp;USD<br/><br/>
							<span> MONTANT PAY&Eacute;:&nbsp;&nbsp;&nbsp;$&nbsp;&nbsp;<?php echo round($if->encaisse,2)." ".$if->monnaie;?></span><br/><br/>
							<span> BALANCE:&nbsp;&nbsp;&nbsp;$&nbsp;&nbsp;<?php echo round($balance,2 );?>&nbsp;USD</span><br/><br/>

				</td>
					</tr>

					<tr>
				             <td class="service">MEMO</td>
				 			<td class="qty"><?php echo $if->memofac;?></td>
				             </tr>
				</tbody>
			</table>
    </main>
    <footer>
      receipt was created by DORALYA system.
    </footer>
  </body>
  <script>

    window.print();

</script>
</html>
