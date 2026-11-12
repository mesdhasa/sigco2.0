<?php
foreach($awb as $rs){}
?>



<div class="page-header">
  <h1>

      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
wharehouse
</small>

    </h1>

					<div class="page-content">
<?php if(count($awb)>0){?>



<?php } ?>
						<?php
if($this->session->flashdata('sms')){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-12">


<form autocomplete="off" class="form-horizontal" action="<?php echo base_url()?>export/export/ajouter_warehouse" method="POST">

    <div class="form-group">
        <label class="control-label col-sm-3" for="awblnum"><strong>No AWBL:</strong></label>
        <div class="col-sm-9">
    <input type="text" class="form-control" id="awblnum" placeholder="AWBL Number" name="awblnum" value="<?php echo $_POST['awblnum']?>" disabled>
    <input type="hidden" id="awblnum" name="awblnum" value="<?php echo $_POST['awblnum']?>" />

        </div>
      </div>
      <?php if(count($awb)>0){?>
      <div class="form-group">
        <label class="control-label col-sm-3" for="compagnie"><strong>Carrier:</strong></label>
          <div class="col-sm-9">
            <select class="form-control" name="compagnie" id="compagnie" onchange="return showcompagnie();">
            <option value="">---- Carrier ----</option>
            <?php foreach($compagnie as $row){?>
              <option value="<?php echo $row->idcompagnie?>" <?php if($rs->idcompagnie==$row->idcompagnie) echo " selected"?>><?php echo strtoupper($row->compagnie);?></option>
            <?php }?>
            </select>
          </div>
        </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="shipper"><strong>Shipper:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="shipper" placeholder="Shipper" name="shipper" value="<?php echo $rs->shipper?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="consignee"><strong>Consignee:</strong></label>
      <div class="col-sm-9">
        <textarea name="consignee" id="consignee" placeholder="Consignee" class="form-control"><?php echo $rs->consignee?></textarea>
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="code_destination"><strong>Dest:</strong></label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="code_destination" placeholder="Dest" name="code_destination" value="<?php echo $rs->code_destinataire?>">
        </div>
      </div>
    <?php } else { ?>
      <div class="form-group">
        <label class="control-label col-sm-3" for="compagnie"><strong>Carrier:</strong></label>
          <div class="col-sm-9">
            <select  required class="form-control" name="compagnie" id="compagnie" onchange="return showcompagnie();">
            <option value="">---- Carrier ----</option>
            <?php foreach($compagnie as $row){?>
            <option value="<?php echo $row->idcompagnie?>"><?php echo strtoupper($row->compagnie)?></option>

            <?php }?>
            </select>
          </div>
        </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="shipper"><strong>Shipper:</strong></label>
      <div class="col-sm-9">
  <input type="text" class="form-control" id="shipper" placeholder="Shipper" name="shipper" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="consignee"><strong>Consignee:</strong></label>
      <div class="col-sm-9">
        <textarea name="consignee" id="consignee" placeholder="Consignee" class="form-control"></textarea>
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="code_destination"><strong>Dest:</strong></label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="code_destination" placeholder="Dest" name="code_destination" value="">
        </div>
      </div>
<?php }?>
      <div class="form-group">
          <label class="control-label col-sm-3" for="control_no"><strong>Control No:</strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="control_no" placeholder="Control No" name="control_no" value="">
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3" for="no_of_pieces"><strong>No of Pieces:</strong></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="no_of_pieces" placeholder="No of Pieces" name="no_of_pieces" value="">
            </div>
          </div>
	<div class="form-group">
      <label class="control-label col-sm-3" for="actual_weight"><strong>Actual Weight:</strong></label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="actual_weight" placeholder="Actual Weight" name="actual_weight" value="">
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="volume_weight"><strong>Volume Weight:</strong></label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="volume_weight" placeholder="Volume Weight" name="volume_weight" value="">
        </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-3" for="no_exception_noted"><strong>No Exception Noted:</strong></label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="no_exception_noted" placeholder="No Exception Noted" name="no_exception_noted" value="">
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="exception_noted"><strong>Exception Noted:</strong></label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="exception_noted" placeholder="Exception Noted" name="exception_noted" value="">
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-3" for="cooler"><strong>Cooler</strong></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="cooler" placeholder="Cooler" name="cooler" value="">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="receiving"><strong>Receiving:</strong></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="receiving" placeholder="Receiving" name="receiving" value="">
                </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-sm-3" for="office"><strong>Office:</strong></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="office" placeholder="Office" name="office" value="">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="container"><strong>Container:</strong></label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="container" placeholder="Container" name="container" value="">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-sm-3" for="commodity"><strong>Commodity:</strong></label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="commodity" placeholder="Commodity" name="commodity" value="">
                      </div>
                    </div>

          <div class="form-group">
              <label class="control-label col-sm-3" for="received"><strong>Received:</strong></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="received" placeholder="Received" name="received" value="">
              </div>
            </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="notify_adress"><strong>Remarque:</strong></label>
      <div class="col-sm-9">
        <textarea name="remarque" id="remarque" placeholder="Remarque" class="form-control"></textarea>
      </div>
    </div>
	<div class="form-group">
  <input type="hidden" id="" name="" value="">
  <?php if(count($awb)>0){?>
  <input type="hidden" id="idreserv" name="idreserv" value="<?php echo $rs->id_reservation?>" />
  <input type="hidden" id="code_reser" name="code_reser" value="<?php echo $rs->no_reservation?>" />
  <?php }?>
  <input type="hidden" name="entered_by" value="<?php echo $_SESSION['account']['prenom']." ".$_SESSION['account']['nom']?>" />
  <button type="submit" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-save"></i>
  Sauvegarder
  </button>

   <a href="<?php echo base_url()?>" class="btn btn-sm btn-primary">
  <i class="ace-icon fa fa-close"></i>
  Fermer
  </a>
    </div>
  </form>
</div>
<div class="col-lg-6 col-md-6 col-xs-12">

  <form class="form-inline" action="/action_page.php">
  <div class="form-group">
    <label for="qt">No PCS:</label>
    <input autocomplete="off" type="text" name="qt" id="qt" size="7%" class="form-control" placeholder="" value="" required />
  </div>
  <div class="form-group">
    <label for="dim1"></label>
    <input autocomplete="off" type="text" name="dim1" id="dim1" size="7%" class="form-control" placeholder="" value="" required />
  </div>
  <div class="form-group">
    <label for="dim2"></label>
    <input autocomplete="off" type="dim2" name="dim" id="dim2" size="7%" class="form-control" placeholder="" value="" required />
  </div>
  <div class="form-group">
    <label for="dim3"></label>
    <input autocomplete="off" type="text" name="dim3" id="dim3" size="7%" class="form-control" placeholder="" value="" required />
  </div>
  <button class="btn btn-sm btn-primary" type="submit">
             <i class="ace-icon fa fa-plus"></i>
        Ajouter
          </button>
        </form>
            <div class="table-responsive">
        <table class="table table-striped table-condensed table-bordered table-hover">
           <thead>
             <tr>
               <th class="center">No. PCS</th>
               <th class="center">DESCRIPTION OF CONTENTS</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td class="center">John</td>
               <td class="center">Doe</td>
             </tr>
           </tbody>
         </table>
       </div>
</div>

										</div>


					</div><!-- /.page-content -->
