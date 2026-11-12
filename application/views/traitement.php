<?php require_once('tete.php');
if(isset($_SESSION['droit']['a2']) and $_SESSION['droit']['a2']=="1"){

}else{
	redirect('home');
}
if(isset($_POST['ficxml'])){
	$_SESSION['xml'] = $_POST['ficxml'];
	$indexGoTo =base_url('import/xml/i/ajouter/'.$id);
	header(sprintf("Location: %s", $indexGoTo));
	exit();
}
$str = "";
if (isset($_FILES["doc"]["tmp_name"]) and is_uploaded_file($_FILES["doc"]["tmp_name"])) {

date_default_timezone_set('Europe/London');


$file = $_FILES["doc"]["tmp_name"];
$fp = fopen($file, "r");
  while(!feof($fp))
	{
      $data = fgets($fp, filesize($file));

	  $at1  = str_replace("</Place_of_unloading_code>","</Place_of_unloading_code>
<Place_of_boarding_code>USMIA</Place_of_boarding_code>",$data);

      $at2 = str_replace("</Value_segment>","</Value_segment>
 <Location>
	<Location_code>4003</Location_code>
	<Location_info>MESDHASA</Location_info>
 </Location>",$at1);

 $at3 = str_replace("<Notify>","<Notify><Notify_code></Notify_code>",$at2);
		$str .= $at3;
    }

fclose($fp);


libxml_use_internal_errors(true);
@$a = simplexml_load_string($str);

if ($a === false) {
      echo '<div class="alert alert-danger">
				<strong>Error!</strong> Failed loading XML.
			</div>';
    foreach(libxml_get_errors() as $error) {
        echo "\t", $error->message;
    }
die();
	}

}

?>

<div class="page-header">

<h1>
	<a href="javascript:history.go(-2)"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
	<small><i class="ace-icon fa fa-angle-double-right"></i>Traitement manifest</small>
	</h1>
</div>
					<div class="page-content">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
<form name="f1" enctype="multipart/form-data" action="" method="post">
<div class="input-group">
  <input autocomplete="off" type="file" name="doc" class="form-control" class="form-control" required />
  <span class="input-group-btn">
	<button class="btn btn-sm btn-primary" type="submit">
	   <i class="ace-icon fa fa-search"></i>
	Uploader
	</button>
	<a class="btn btn-sm btn-primary"  style="margin-left:10px" href="<?php echo base_url()?>import/creer/i/ajouter">
	   <i class="ace-icon fa fa-close"></i>
	Fermer
	</a>
  </span>
</div>

</form>
<hr />
<form name="f2" enctype="multipart/form-data" action="" method="post">
<textarea name="ficxml" class="form-control" id="ficxml" cols="155" rows="45"><?php echo $str;?></textarea>

<button class="btn btn-sm btn-primary" type="submit">
					   <i class="ace-icon fa fa-search"></i>
					Visualier
					</button>

</form>
				               <!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>

<?php require_once('pied.php');?>
