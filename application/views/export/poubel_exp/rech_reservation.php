
<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
Rechrche une Réservation
</small>

    </h1>
  </div>


					<div class="page-content">

            <?php
            if($this->session->flashdata('sms')){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong> <?php echo $this->session->flashdata('sms');?></strong>
            </div>
            <?php } ?>
            <?php
            if($this->session->flashdata('sms_modifier')){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo $this->session->flashdata('sms_modifier');?></strong><a  target="_blank" href="<?php echo base_url()?>reservation.pdf/">" class="alert-link">PDF Reservation</a>.
            </div>
            <?php } ?>

            <div class="row">
              <div class="col-lg-7">

                <div class="col-lg-4 col-lg-push-5">
                    <span class="input-group-btn">
                            <a href="<?php echo base_url()?>creer-une-reservation" class="btn btn-sm btn-primary" role="button">
                            <i class="ace-icon fa fa-plus bigger-120" aria-hidden="false">	Créer une Réservation </i>
                            </a>
                    </span>
                                </br>
                  </div>
                  <div class="col-lg-8 col-lg-push-5">
                    <?php echo form_open('export/export/recherche_reservation','class="form-inline"');?>
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
              <div class="table-responsive">
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr>
    <th></th>
    <th>Carrier</th>
    <th>Reservation N0</th>
    <th>AWBL N0</th>
    <th>Shipper</th>
    <th>Consignee</th>
    <th>Dest</th>
    <th>Origin</th>
    <th>Nature of Goods</th>
    <th class="center">PP</th>
    <th class="center">CC</th>
    <th class="center">NC</th>
    <th></th>
    <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(count($lesreservation)>0){
      $r=0;foreach($lesreservation as $row){$r++;?>

  <tr>
    <td class="center"><?php echo $r;?></td>
    <td class="center"><?php echo strtoupper($row->compagnie);?></td>
    <td class="left"><?php echo $row->code_reservation.'-'.$row->no_reservation;?></td>
    <td class="center"><?php echo $row->no_awbl;?></td>
    <td class="center"><?php echo $row->shipper;?></td>
    <td class="center"><?php echo $row->consignee;?></td>
    <td class="center"><?php echo $row->code_destinataire;?></td>
    <td class="center"><?php echo $row->code_origine;?></td>
    <td class="center"><?php echo $row->description_colis;?></td>
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
    <td class="center">
    <a href="<?php echo base_url()?>modifier-une-reservation/<?php echo $row->id_reservation;?>" class="btn btn-xs btn-primary" role="button">
    <i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
    </a>
    </td>
    <td class="center">
    <button onclick="confirmation_lien('Voulez-vous supprimer?','<?php echo base_url()?>reservation_supp/<?php echo $row->id_reservation;?>')" class="btn btn-xs btn-danger" role="button">
    <i class="ace-icon fa fa-trash bigger-120" aria-hidden="false"></i>
    </button>
    </td>

      </tr>
    <?php }}?>
    </tbody>
  </table>
                </div>
              </div>

            </div>


					</div><!-- /.page-content -->
<script>
jQuery(function($){
   $("#awblnum").mask("999-99999999");
});
</script>
