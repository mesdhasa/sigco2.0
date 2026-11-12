<?php require_once('tete.php');
if(isset($_SESSION['droit']['a34']) and $_SESSION['droit']['a34']=="1"){

}else{
redirect('home');
}
?>

<div class="page-header">

<h1>

<small>

<i class="ace-icon fa fa-angle-double-right"></i>
Add Number AWB

</small>

</h1>

</div>

<div class="page-content">
<?php
if($this->session->flashdata('sms2')){
?>
<div class="alert alert-danger alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong><?php echo $this->session->flashdata('sms2');?></strong>
</div>
<?php } ?>

<div class="row">
							   <div class="col-lg-12">
							<div class="col-lg-4 col-lg-push-2">
              <?php echo form_open('entreprise/addAWB_comp','class="form-inline"');?>
<input type="hidden"  name="idcomp" id="idcomp" value="<?php echo $this->uri->segment(4)?>">

								<div class="input-group">
                <input autocomplete="off" type="text" name="awbnum" id="awbnum" size="20%" class="form-control" placeholder="AWB Number" value=""/>
								  <span class="input-group-btn">
									<button class="btn btn-sm btn-primary" type="submit">
                  <i class="ace-icon fa fa-plus"></i>
                             Ajouter
													</button>

								  </span>
								</div>

									<?php echo form_close();?>

														  </br>



								</div>
								<div class="col-lg-6 col-lg-push-1">
                  <?php echo form_open_multipart('entreprise/addAWB_comp_excel','class="form-inline"');?>
				  <input type="hidden"  name="idcomp" id="idcomp" value="<?php echo $this->uri->segment(4)?>">

                    <div class="input-group">
                 <input autocomplete="off" type="file" name="ExcelAwb" class="form-control" class="form-control" required />
<span class="input-group-btn">
<button class="btn btn-sm btn-success" type="submit">
<i class="ace-icon fa fa-search"></i>
Uploader
</button>

                      </span>
                    </div>

                      <?php echo form_close();?>

                                  </br>
                  </div>
						</div>
					</div>







<div class="row">
<div class="col-lg-12 col-md-12 col-xs-12">


<div class="table-responsive"><br>
<table id="simple-table" class="table  table-bordered table-hover table-condensed">
<thead>
<tr>
<th class="center"></th>
<th>Date </th>
<th>AWB</th>
</tr>
</thead>


<tbody>


<?php
if(count($lesawbcomp)>0){
$t=0;foreach($lesawbcomp as $row){$t++;?>
<tr>
<td><?php echo $t;?></td>
<td class="center"><?php echo dateVersChainetext($row->date_in);?></td>
<td class="center"><?php echo $row->awb;?></td>
</tr>
<?php }}?>

</tbody>
</table>
</div>
</div>
</div>


</div><!-- /.page-content -->
<?php require_once('pied.php');?>
<script>
jQuery(function($){
$("#awbnum").mask("999-99999999");
});
</script>