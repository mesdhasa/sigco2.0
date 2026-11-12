<?php
if(isset($_SESSION['droit']['a10']) and $_SESSION['droit']['a10']=="1"  ) {
}else{
	redirect('home/pas_access');
}
?>
<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
Recherche AWB
</small>

    </h1>
  </div>


<div class="page-content">

 <div class="row">
	<div class="col-lg-12">
			<?php
            if($this->session->flashdata('sms2')){
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $this->session->flashdata('sms2');?></strong>
            </div>
            <?php } ?>
	</div>

	<div class="col-lg-12">
	<div class="col-lg-6  ">

                <?php

if (!empty($nowh)) {
	// code...

								echo form_open('export/export/add_wr2','class="form-inline"');?>
                <div class="input-group">
									<label  class="form-control"><?php echo $nowh; ?></label>
                  <input  type="hidden"  name="no_warehouse" id="no_warehouse" size="10" class="form-control" value="<?php echo $nowh; ?>" required />
                </div>
                  <div class="input-group">
                    <span class="input-group-btn">
                      <select class="form-control" name="compagnie" required>
                      <option value="">---- Compagnie ----</option>
                      <?php foreach($compagnie as $row){?>
                      <option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

                      <?php }?>
                      </select>
                    <button class="btn btn-sm btn-primary" type="submit">
                               <i class="ace-icon fa fa-plus"></i>
                          Ajouter
                            </button>

                    </span>
                  </div>

                    <?php echo form_close();

}
										?>
                        </div>
                  <div class="col-lg-6">
                    <?php echo form_open('export/export/Airway_Bill','class="form-inline"');?>
                    <div class="input-group">
                      <input autocomplete="off" type="text" name="custum" id="custum" size="20%" class="form-control" placeholder="" value=""/>
                      <span class="input-group-btn">
                      <button class="btn btn-sm btn-primary" type="submit">
                                 <i class="ace-icon fa fa-search"></i>
                              Recherche
                              </button>
                      </span>
                    </div>
                    <?php echo form_close();?>

                    </div>
	</div>

 </div>
<div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
			  <hr />
              <div class="table-responsive">
                <table class="table table-striped table-condensed table-bordered table-hover">
                    <thead>
                      <tr>
                    <th></th>
                    <th >No warehouse</th>
                    <th>No. AWB</th>
                    <th>Consignee Name</th>
                    <th>Consignee Adress</th>
                    <th>Gross Weight in ( Kgs )</th>
                    <th>Nature of Goods</th>
                    <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(count($leswarehouse)>0){
                      $r=0;foreach($leswarehouse as $row){$r++;

                        ?>
												<?php if($row->void=="1"){?>
													<tr style="text-decoration: line-through;">
				                    <td class="center"><?php echo $r;?></td>
				                    <td class="center"><?php echo $row->code_warehouse.'-'.$row->no_warehouse;?></td>
				                    <td class="center"><?php echo $row->awb_number?></td>
				                    <td class="center"><?php echo $row->name_consignee?></td>
				                    <td class="center"><?php echo $row->address_consignee?></td>
				                    <td class="center"><?php echo $row->gross_weight?></td>
				                    <td class="center"><?php echo $row->nature_and_quantity?></td>
				                    <td class="center">
				                    <a href="<?php echo base_url()?>modifier_Airway_Bill/<?php echo $row->awb_number;?>" class="btn btn-xs btn-primary" role="button">
				                    <i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
				                    </a>
				                    </td>
				                      </tr>
												<?php }else{?>
													<tr>
														<td class="center"><?php echo $r;?></td>
														<td class="center"><?php echo $row->code_warehouse.'-'.$row->no_warehouse;?></td>
														<td class="center"><?php echo $row->awb_number?></td>
														<td class="center"><?php echo $row->name_consignee?></td>
														<td class="center"><?php echo $row->address_consignee?></td>
														<td class="center"><?php echo $row->gross_weight?></td>
														<td class="center"><?php echo $row->nature_and_quantity?></td>
														<td class="center">
														<a href="<?php echo base_url()?>modifier_Airway_Bill/<?php echo $row->awb_number;?>" class="btn btn-xs btn-primary" role="button">
														<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
														</a>
														</td>
															</tr>
												<?php }?>

                    <?php }}?>

                    </tbody>
                  </table>
                </div>
              </div>

            </div>



</div>


				<!-- /.page-content -->
