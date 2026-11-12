<?php
if(isset($_SESSION['droit']['a9']) and $_SESSION['droit']['a9']=="1"  ) {
}else{
	redirect('home/pas_access');
}
?>




<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
Recheche warehouse
</small>

    </h1>
  </div>


					<div class="page-content">
            <?php
            if($this->session->flashdata('sms')){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $this->session->flashdata('sms');?></strong><a  target="_blank" href="<?php echo base_url()?>" class="alert-link">PDF wharehouse</a>.
            </div>
            <?php } ?>
            <?php
            if($this->session->flashdata('sms2')){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $this->session->flashdata('sms2');?></strong>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-lg-7">

                <div class="col-lg-6 col-lg-push-6">
                  <!-- <?php echo form_open('export/export/add_wr','class="form-inline"');?>

                    <div class="input-group">
                      <input autocomplete="off" type="text" name="awblnum" id="awblnum" size="30%" class="form-control" placeholder="" value="" required />
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

                      <?php echo form_close();?> -->

                      <span class="input-group-btn">
                              <a href="<?php echo base_url()?>creer-warehouse" class="btn btn-sm btn-primary" role="button">
                              <i class="ace-icon fa fa-plus bigger-120" aria-hidden="false">	Créer warehouse </i>
                              </a>
                      </span>
                                  </br>
                  </div>
                  <div class="col-lg-6 col-lg-push-4">
                    <?php echo form_open('export/export/antrepot','class="form-inline"');?>
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

                </div></br>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="table-responsive">
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr>
    <th></th>
    <th class="center">No warehouse</th>
    <th class="center">Propriétaire</th>
    <th class="center">Nature Of Goods</th>
    <th class="center">Gross Weight</th>
    <th></th>
    <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(count($leswarehouse)>0){
      $r=0;foreach($leswarehouse as $row){$r++;

        ?>


  <tr>
    <td class="center"><?php echo $r;?></td>
    <td class="center"><?php echo $row->code_warehouse.'-'.$row->no_warehouse;?></td>
    <td class="center"><?php echo $row->nom_p;?></td>
    <td class="center"><?php echo $row->nature_and_quantity;?></td>
    <td class="center"><?php echo $row->gross_weight;?></td>
    <td class="center">
    <a href="<?php echo base_url()?>modifier_warehouse/<?php echo $row->no_warehouse;?>" class="btn btn-xs btn-primary" role="button">
    <i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
    </a>
    </td>



    <?php if($row->no_awbl != NULL){?>
    <td class="center">
      <button onclick="confirmation_lien('Voulez-vous supprimer?','<?php echo base_url()?>export/export/supprimer_warehouse/<?php echo $row->id_warehouse;?>/<?php echo $row->no_warehouse;?>')" class="btn btn-xs btn-danger" role="button" disabled>
    <i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
    </button>
    </td>
  <?php }else {?>
    <td class="center">
      <button onclick="confirmation_lien('Voulez-vous supprimer?','<?php echo base_url()?>export/export/supprimer_warehouse/<?php echo $row->id_warehouse;?>/<?php echo $row->no_warehouse;?>')" class="btn btn-xs btn-danger" role="button" >
    <i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
    </button>
    </td>
  <?php }?>

      </tr>
    <?php }}?>
    </tbody>
  </table>
                </div>
              </div>

            </div>


					</div><!-- /.page-content -->
