<?php
require_once APPPATH . 'views/vtete.php';
foreach($awbl_notif as $rs){}
?>
<div class="page-header">
MEMO
</div>
<div class="page-content">
	<div class="row">
		<div class="col-lg-6 col-md-12 col-xs-12">
		<?php echo form_open('import/add_memo');?>

		  <div class="form-group">
			<label for="memo">Memo:</label>
			<textarea id="memo" rows="8" name="memo" class="form-control" ><?php echo $rs->remarque_notifcation?></textarea>
		  </div>

			<input type="hidden" id="idmemo" name="idmemo" value="<?php echo $rs->id?>" />
		  <button type="submit" class="btn btn-primary">
		  <i class="ace-icon fa fa-save"></i>
	Sauvegarder
		  </button>

		<?php echo form_close();?>
		</div>
	</div>

</div>
<!-- /.page-content -->
<?php require_once APPPATH . 'views/pied.php';?>
