<?php require_once('tete.php');
// Compteurs calcules par MySQL dans Home::index (AUDIT-011)
$impayee = isset($impayee) ? (int) $impayee : 0;
$duedate = isset($duedate) ? (int) $duedate : 0;
$t = isset($stock_total) ? $stock_total : 0;

?>

					<div class="page-content">
					<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
						<p class="text-muted" style="text-align:right; margin:0 0 4px">
							<small id="tdb-etat" style="display:none"><i class="fa fa-refresh fa-spin"></i> Mise &agrave; jour des indicateurs&hellip;</small>
							<?php if ( ! empty($tdb_calcule_le)) { ?><small>Indicateurs calcul&eacute;s &agrave; <?php echo date('H:i', $tdb_calcule_le); ?></small><?php } ?>
						</p>
						<div class="row">


						<div class="col-lg-3 col-md-6 col-sm-12">
				<div style="width: 100%; border:solid 1px #cccccc; padding:3px; margin-bottom:5px; min-height:260px;">
				<div style="text-align:center"><h4>AWB recens&eacute;</h4></div>

					<div style="text-align:center"><h1><?php
					echo count($lessegments).'<br /><hr />';
					$som = 0;
					foreach($lessegments as $sqty){
						$som += (float) $sqty->qty;
					}
					echo $som.' colis';
					?></h1></div>

				</div>
				<a class="btn btn-block btn-sm btn-primary" href="<?php echo base_url()?>import/pointage/i/ptg">
	   <i class="ace-icon fa fa-eye"></i>
	Afficher
	</a>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12">
				<div style="width: 100%; border:solid 1px #cccccc; padding:3px; margin-bottom:5px; min-height:260px;">
					<div style="text-align:center"><h4>Collect / Pre-paid / No charge</h4>
					<p style="text-align:center; font-size:18px; font-weight:bold"><span id="tdb-stock"><?php echo $t;?></span> colis</p>

					</div>
					<div id="canvas-holder2" style="width:87%">
						<canvas id="chart-area2" />
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12">
				<div style="width: 100%; border:solid 1px #cccccc; padding:3px; margin-bottom:5px; min-height:260px;">
				    <div style="text-align:center"><h4>AWB non livr&eacute; / Droit d&eacute;pot</h4></div>
					<div id="canvas-holder3" style="width:100%">
						<canvas id="chart-area3" />
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-sm-12">
				<div style="width: 100%; border:solid 1px #cccccc; padding:3px; margin-bottom:5px; min-height:260px;">
				    <div style="text-align:center"><h4>Facture impay&eacute;e / pay&eacute;e</h4></div>
					<div id="canvas-holder4" style="width:100%">
						<canvas id="chart-area4" />
					</div>
				</div>
			</div>

			</div>
			<div class="row">


			<div class="col-lg-3 col-md-6 col-sm-12">
				<div style="width: 100%; border:solid 1px #cccccc; padding:3px; margin-bottom:5px; min-height:260px;">
				    <div style="text-align:center"><h4>AWB import / export</h4></div>
					<div id="canvas-holder5" style="width:100%">
						<canvas id="chart-area5" />
					</div>
				</div>
			</div>



						</div><!-- /.row -->
					</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    <?php echo $awblimport;?>,
                    <?php echo $awblexport;?>,
                ],
                backgroundColor: [
                    window.chartColors.red,
					window.chartColors.blue,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Import",
                "Export"
            ]
        },
        options: {
            responsive: true
        }
    };
//=============================
    var config2 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php echo $awblnonlivre;?>,
                    <?php echo $awblretard;?>,
                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.blue,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Non livré",
                "Droit dépot"
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
//=============================
    var config3 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php echo $awblcc;?>,
                    <?php echo $awblpp;?>,
                    <?php echo $awblnc;?>,
					<?php echo $awblnone;?>,
                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.blue,
					window.chartColors.orange,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Collect",
                "Pre-paid",
                "No charge",
				"None"
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
//=============================
    var config4 = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    <?php echo $impayee;?>,
					<?php echo $duedate;?>,

                ],
                backgroundColor: [
                    window.chartColors.red,
					window.chartColors.orange,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Impayée",
				"Due date"
            ]
        },
        options: {
            responsive: true
        }
    };
//=============================
    window.onload = function() {

		var ctx2 = document.getElementById("chart-area2").getContext("2d");
        window.myDoughnut = new Chart(ctx2, config3);

		var ctx3 = document.getElementById("chart-area3").getContext("2d");
        window.myDoughnut = new Chart(ctx3, config2);

		var ctx4 = document.getElementById("chart-area4").getContext("2d");
        window.myPie = new Chart(ctx4, config4);

		var ctx5 = document.getElementById("chart-area5").getContext("2d");
        window.myPie = new Chart(ctx5, config);

		// Compteurs perimes ou absents : recalcul en arriere-plan puis mise a jour des graphiques
		<?php if ( ! empty($tdb_a_rafraichir)) { ?>
		var etat = document.getElementById('tdb-etat');
		if (etat) { etat.style.display = 'inline'; }
		jQuery.getJSON('<?php echo base_url('home/compteurs'); ?>', function (c) {
			config.data.datasets[0].data  = [c.awblimport, c.awblexport];
			config2.data.datasets[0].data = [c.awblnonlivre, c.awblretard];
			config3.data.datasets[0].data = [c.awblcc, c.awblpp, c.awblnc, c.awblnone];
			config4.data.datasets[0].data = [c.impayee, c.duedate];
			jQuery.each(Chart.instances, function (i, g) { g.update(); });
			jQuery('#tdb-stock').text(c.stock_total);
			if (etat) { etat.style.display = 'none'; }
		});
		<?php } ?>
    };
</script>
