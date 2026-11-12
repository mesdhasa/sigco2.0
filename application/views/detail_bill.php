<?php
if(isset($_SESSION['droit']['a13']) and $_SESSION['droit']['a13']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
$i=0;$total=0;
foreach($lessegments as $row){}
foreach($lespaiements as $pmt){$i++;$total+=$pmt->apayer;}
  $total_poids = 0;
  $res = array ();
  $res = $this->Parser->get_degroupage($row->awbl);
  if(count($res)>0){
  	foreach($res as $r){
  		$total_poids += $r->poids;
  	}
  }

  if($row->datenotification =="0000-00-00"){
  $datedepot ="";
  $datecomp = "";
  $datelivre = "";
  $dateprelivre ="";
  $resul = "";
  }else{
  $datedepot = diff_date($row->datenotification,$this->session->ladate);
  $datecomp = $row->droitdepot;
  $datelivre = diff_date($row->datenotification,$row->datelivre);
  $dateprelivre =$row->datelivre;
  $resul = "";
  }
  if($row->datelivre!=""){
   $datedepot = diff_date($row->datenotification,$row->datelivre);
  }

?>

<div class="page-header">
<h1>
 <a href="javascript:history.go(-2)"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
                <small>

                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Details

                </small>

              </h1>

  <div class="col-lg-7 col-lg-offset-5">
    <p style="text-align:right; margin-top:-30px;">

      <strong style="font-size:20px; text-align:right;"> <?php echo $row->refdouane?>|<?php echo $row->custum?> | <?php echo $row->compagnie?> <?php echo dateVersChainetext($row->Date_of_arrival);?>  <?php echo $row->typeawbl?></strong>
</p>
</div>
</div>

					<div class="page-content">

            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="table-responsive">
      <table id="simple-table" class="table  table-bordered table-hover table-condensed">
                    <p></p>
                      <thead>
                        <tr>
                          <th class="center"width="100">Date</th>
                          <th class="center"width="100">Compagnie</th>
                          <th class="center"width="130">No de douane</th>
                          <th class="center" width="100">AWB No.</th>
                          <th class="center">Qty</th>
                          <th class="center">Package</th>
                          <th class="center">Consignee</th>
                          <th class="center">Weight (KGS)</th>
                          <th class="center">Freight</th>
                          <th class="center">Weight charge</th>
                          <th class="center">Currency</th>
                          <th class="center">PP</th>
                          <th class="center">CC</th>
                          <th class="center">NC</th>
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                          <td class="center"><?php echo dateVersChainetext($row->Date_of_arrival);?></td>
                          <td class="center"><?php echo strtoupper($row->compagnie);?></td>
                          <td class="center"><?php echo $row->custum;?></td>
                          <td class="center"><?php echo $row->awbl;?></td>
                          <td class="center"><?php echo $row->qty;?></td>
                          <td class="left"><?php echo $row->package;?></td>
                          <td class="left"><?php echo $row->consignee;?></td>
                          <td class="center"><?php echo $row->weight;?></td>
                            <td class="left"><?php 		echo $row->freight;?></td>
                              <td class="center"><?php echo $row->weight_charge;?></td>
                          <td class="center"><?php echo $row->currency;?></td>
                          <td class="center">
                          <?php if($row->prepaid=="1"){?>
                          <i class="fa fa-check" aria-hidden="true"></i>
                          <?php }?>
                          </td>
                          <td class="center">
                          <?php if($row->collect=="1"){?>
                          <i class="fa fa-check" aria-hidden="true"></i>
                          <?php }?>
                          </td>
                          <td class="center">
                          <?php if($row->nocharge=="1"){?>
                          <i class="fa fa-check" aria-hidden="true"></i>
                          <?php }?>
                          </td>
                      		</tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-xs-3">
            <h4>Information livraison</h4>
            <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Livré le</td>
                    <td><?php echo dateverschainetext($row->datelivre)?></td>
                  </tr>
                  <tr>
                    <td>Livré par</td>
                    <td><?php echo $row->livrepar?></td>
                  </tr>
                  <tr>
                    <td>Reçu par</td>
                    <td><?php echo $row->recupar."<br />".$row->nif?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-xs-3">
              <h4>Information de notification</h4>
              <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td>Date notification</td>
                      <td><?php echo dateverschainetext($row->datenotification)?></td>
                    </tr>
                    <tr>
                      <td>Notified person</td>
                      <td><?php echo $row->person_notif?></td>
                    </tr>
                    <tr>
                      <td>Droit dépot</td>
                      <?php if ($datedepot > $datecomp){
                         $resul = $datedepot *$row->prix_lbs* $row->weight;
                         if ($resul<10) $resul = 10;
                        ?>
                      <td>OUI</td>
                      	<?php }else{?>
                          <td>NON</td>
                          	 <?php }?>
                    </tr>
                  </tbody>
                </table>
</div>
<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1  col-xs-3">
  <h4>Information droit dépot</h4>
  <table class="table table-striped">
    <?php if ($datedepot > $datecomp){
       $resul = $datedepot * $row->prix_lbs * $row->weight;
       if ($resul<10) $resul = 10;
      ?>
      <tbody>
        <tr>
          <td>Droit depot</td>
          <td>[Poids restant: <?php echo $row->weight-$total_poids;?> ]</td>
        </tr>
        <tr>
          <td>Nbre de Jours</td>
          <td><?php echo $datedepot ;?></td>
        </tr>
        <tr>
          <td>Montant</td>
          <td><?php echo $resul ;?></td>
        </tr>
      </tbody>
    <?php }else{?>
      <tbody>
        <tr>
          <td>Droit depot</td>
          <td>[Poids restant: <?php echo $row->weight-$total_poids;?> ]</td>
        </tr>
        <tr>
          <td>Nbre de Jours</td>
          <td><?php echo $datedepot ;?></td>
        </tr>
        <tr>
          <td>Montant</td>
          <td>N/A</td>
        </tr>
      </tbody>
      <?php }?>
    </table>
</div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-xs-12">
    <h4>Dégroupage</h4>
  <div class="table-responsive">
<table id="simple-table" class="table  table-bordered table-hover table-condensed">
        <p></p>
          <thead>
            <tr>
              <th class="center" width="100">Date</th>
              <th class="center" width="100">No Rapport</th>
              <th class="center" width="100">AWB No.</th>
              <th class="center" width="100">Qty</th>
              <th class="center"width="100">Montant droit dépot</th>
            </tr>
          </thead>
          <?php if (!empty($res)){ ?>
          <tbody>
            <?php
         foreach($res as $r){?>
            <tr>
              <td class="center"><?php echo dateVersChainetext($r->datecreated);?></td>
              <td class="center"><?php echo $r->norapport?></td>
              <td class="center"><?php echo $r->nobuil?></td>
              <td class="center"><?php echo round($r->poids,2)?></td>
              <td class="center"><?php echo round($r->montant,2)?></td>
              </tr>
               <?php }?>
          </tbody>
        <?php }else{?>
          <tbody>
            <tr>
              <td class="center"></td>
              <td class="center"></td>
              <td class="center"></td>
              <td class="center"></td>
              <td class="center"></td>
              </tr>
          </tbody>
           <?php }?>
        </table>

    </div>
  </div>
</div>
<div class="row">
  <?php
 foreach ($lespaiements as $pmt) {
 }?>
  <div class="col-lg-12 col-md-12 col-xs-12">
    <h4>Transaction	<?php if(strlen($pmt->nofacture)<15){?>

			<small style="color:#000000; font-size:22px;">
				No facture: <strong><?php echo $pmt->nofacture;?></strong>
			</small>

			<?php }?></h4>

    <table class="table table-striped">
        <tbody>

            <td></td>
            <td>Description</td>
            <td>Montant</td>
            <td>Monnaie</td>
            <td></td>
            <td></td>
            <?php
            $total_du=0;$versement=0;$balance_a=0;
            // print_r($lespaiements);
          $codepaiement=array();$i=0;$somme = 0;$discount = 0;$apayer2 = 0;$paiement=0;foreach ($lespaiements as $pmt){;
              $i++;
              $somme += $pmt->apayer;
              $paiement += $pmt->payer;
              $discount += $pmt->rabais;
              $apayer2=$somme-$discount ;

              // echo "string".$pmt->codetx;
              if($pmt->codetx=="PMT"){
                $versement+=$pmt->payer;
               $codepaiement[] = $pmt->nopaiement;

              }
              if($pmt->codetx=="FAC"){
                $total_du+=$pmt->apayer;

              if($pmt->apayer !='0'){
?>
          <tr>
            <td></td>
            <td><?php echo $pmt->description?></td>
            <td><?php echo round($pmt->apayer,2)?></td>
            <td><?php echo $pmt->monnaie_apayer?></td>
            <td></td>
            <td></td>
          </tr>
        <?php }}}
        // echo "Total apayer: ".$total_du."<br/>";
        // echo "Versement: ".$versement."<br/>";
        // echo "Votre balance: ".($total_du-$versement)."<br/>";
        $balance = ($apayer2-$paiement);
        // echo "string".$somme."/".$paiement;
        ?>
        <tr>
          <td></td>
          <td></td>
            <td></td>
            <td align="right"><strong>Montant</strong></td>
        <td align="right"><strong>$<?php echo round($somme,2)?><strong/></td>
            <td class="center"><strong><?php echo $pmt->monnaie_apayer?><strong/></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
              <td></td>
              <td align="right"><strong>discount</strong></td>
          <td align="right"><strong>$<?php echo round($discount,2)?><strong/></td>
              <td class="center"><strong><?php echo $pmt->monnaie_apayer?><strong/></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
                <td></td>
                <td align="right"><strong>Total Facture</strong></td>
            <td align="right"><strong>$<?php echo round($apayer2,2)?><strong/></td>
                <td class="center"><strong><?php echo $pmt->monnaie_apayer?><strong/></td>
              </tr>
          <tr>
            <td></td>
            <td></td>
              <td></td>
              <td align="right"><strong>Total Paiement</strong></td>
          <td align="right"><strong>$<?php echo round($paiement,2)?><strong/></td>
              <td class="center"><strong><?php echo $pmt->monnaie_apayer?><strong/></td>
            </tr>
          <tr>
            <td></td>
            <td></td>
              <td></td>
              <td align="right"><strong>Balance</strong></td>
          <td align="right"><strong>$<?php echo round($balance,2)?><strong/></td>
              <td class="center"><strong><?php echo $pmt->monnaie_apayer?><strong/></td>
            </tr>
            <!-- <?php foreach($codepaiement as $pm){?>
            <tr class="danger">
              <td ></td>
              <td></td>
                <td></td>
                <td align="right"><strong></strong></td>
            <td align="right"><strong>DELETE<strong/></td>
                <td class="center"><strong>
                  <a class="btn btn-xs btn-warning" href="#" onclick="confirmation_lien('Do you want to delete this transaction?','<?php echo base_url()?>recherche/deleteFacture_detail1/<?php echo $pm?>/<?php echo $id;?>/<?php echo $this->uri->segment(5);?>')">
                  <i class="ace-icon fa fa-trash"></i>
                Delete <?php echo $pm?>
                </a>
                <strong/></td>

              </tr>
    <?php }?> -->
        </tbody>
      </table>
			<div class="table-responsive">
				<h4>Paiement Effectué</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Description</th>
							<th>Montant</th>
							<th></th>
							<th>Mode de paiement</th>
							<th>Date</th>
					<th>N0 Rapport</th>
					<th></th>
				</tr>
					<tbody>
						<?php $y=0; foreach ($lespaiments_efec as $key) { $y++;?>

							<tr>

								<td align="right"><?php echo $y?></td>
								<td align="left"><?php echo $key->description?></td>
								<td align="left"><?php echo $key->montant_hc?></td>
								<td align="left"><?php echo $key->monnaie?></td>
								<td align="left"><?php echo $key->mode_paiement?>&nbsp;&nbsp;<?php echo $key->banque?>&nbsp;<?php echo $key->banque2?>&nbsp;<?php echo $key->nom_compte?>&nbsp;<?php echo $key->nom_compte2?>&nbsp;<?php echo $key->no_chque?>&nbsp;<?php echo $key->digit?></td>
							<td align="left"><?php echo dateverschainetext($key->date_hc);?></td>
							<td class="left"><?php echo $key->norapport?></td>
									<td class="left"></td>
								</tr>


		<?php }?>

					</tbody>

				</table>
				</div>
  </div>
</div>
          </div><!-- /.page-content -->
<?php require_once('pied.php');?>
