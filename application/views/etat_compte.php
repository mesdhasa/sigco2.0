<?php
if(isset($_SESSION['droit']['a21']) and $_SESSION['droit']['a21']=="1"  ) {
}else{
	redirect('home');
}
foreach($lespaiement as $row){}
 ?>
<style>
td, th{
	padding:4px;
  margin: 4px;
	font-size: 11px;
	text-align:center;
}
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url()?>assets/images/logo.png">
      </div>
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
        <div><span>CLIENT</span><?php echo $row->societe;?></div>
        <div><span>ADRESSE</span><?php echo $row->adresse;?></div>
		<div><span>E-mail</span><?php echo $row->email;?></div>
        <div><span>DATE</span><?php echo dateverschainetext($this->session->ladate);?></div>

      </div>
    </header>
    <main>

      <div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th align='center'>Date</th>
<th align='center'>Companie</th>
<th align='center'>AWB /B/L</th>
<th align='center'>Description</th>
<th align='center'>PCS</th>
<!-- <th>A.F.</th> -->
<th align='center'>TOTAL</th>
</tr>
</thead>

<tbody>
  <?php $c=0; $a=0;foreach($lespaiement as $res){$c++;
    $a+=round($res->balance,2);
    ?>
<tr>
<td align='center'><?php echo dateverschainetext($res->Date_of_arrival);?></td>
<td align='center'><?php echo $res->Carrier_name ?></td>
<td align='center'><?php echo $res->awbl ?></td>
<td align='center'><?php echo $res->package ?></td>
<td align='center'><?php echo $res->qty ?></td>
<!-- <td></td> -->
<td align='center'><?php echo round($res->balance,2)?></td>
</tr>
<?php }?>
<tr>
<td align='center' colspan='3'> MAke All Checks payable to MESDHASA. if you have any</td>
<td align='center'></td>
<td align='center'>TOTAL</td>
<!-- <td></td> -->
<td align='center'><?php echo $a ?></td>
</tr>
</tbody>
</table>


        </div>

    </main>
    <footer>
      receipt was created by DORALYA system.
    </footer>
  </body>
  <script>

    window.print();

</script>
</html>
