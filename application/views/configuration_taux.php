<?php
if(isset($_SESSION['droit']['a34']) and $_SESSION['droit']['a34']=="1"  ) {
}else{
	redirect('home/pas_access');
}
require_once('tete.php');
foreach($taux as $res){}

?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Configuration

								</small>

							</h1>

						</div>

<div class="page-content">
	<?php
	if($this->session->flashdata('sms')){
	?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?php echo $this->session->flashdata('sms');?></strong>
	</div>
	<?php } ?>

			<div class="row">
				<div class="col-lg-12 ">
				<?php echo form_open('entreprise/ajouter_comp','class="form-inline"');?>

				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" type="text" class="form-control" id="compagnie" placeholder="Compagnie" name="compagnie" value="" />
				</div>
				</div>
				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" type="text" class="form-control" id="droitdepot" placeholder="Droit dépot " name="droitdepot" value="" />
				</div>
				</div>
				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" type="text" class="form-control" id="prix_lbs" placeholder="Prix LBS " name="prix_lbs" value="" />
				</div>
				</div>
				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" type="text" class="form-control" id="sps" placeholder="SPS " name="sps" value="" />
				</div>
				</div>
				<div class="input-group">
					<span class="input-group-btn">
					<button class="btn btn-sm btn-primary" type="submit">
										 <i class="ace-icon fa fa-plus"></i>
								ajouter
									</button>
					</span>
				</div>
						<?php echo form_close();?>


												</br>
					</div>
				<div class="col-lg-12">
				<div class="table-responsive">
<table class="table table-striped table-condensed table-bordered table-hover">
<thead>
<tr>
<th></th>
<th  class="center"class="center">Compagnie</th>
<th  class="center" style="max-width:99px;">Nbres de jours dépot</th>
<th class="center">Prix / LBS</th>
<th class="center">SPS</th>
<th class="center">Statut</th>
<th></th>
</tr>
</thead>
<tbody>
	<?php $c=0;foreach($lescompagnie as $row){$c++;?>
<tr>
	<td><?php echo $c;?></td>
	<td class="center"><?php echo $row->compagnie;?></td>
<td class="center"><?php echo $row->droitdepot;?></td>
<td class="center" class="center" class="center"><?php echo round($row->prix_lbs,3);?></td>
<td class="center" class="center"><?php echo $row->sps;?></td>
<?php if($row->statut=="1"){?>
	<td class="center" bgcolor="#00FF00">
	activated
	</td>
<?php }else {?>
	<td class="center" bgcolor="#FF0000">inactivated</td>
	<?php }?>
	<td class="center">
	<a href="<?php echo base_url()?>entreprise/edit_entreprise/ent/<?php echo $row->idcompagnie;?>" class="btn btn-xs btn-primary" role="button">
	<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
	</a>
	</td>
</tr>
<?php }?>
</tbody>
</table>
					</div>
				</div>
			</div>
			<div class="col-lg-8 ">
			<?php echo form_open('entreprise/ajouter_frais','class="form-inline"');?>

			<div class="form-group">
			<div class="col-sm-3">
				 <input autocomplete="off" type="text" class="form-control" id="description" placeholder="Description" name="description" value="" />
			</div>
			</div>
			<div class="form-group">
			<div class="col-sm-3">
				 <input autocomplete="off" type="text" class="form-control" id="montant" placeholder="Montant " name="montant" value="" />
			</div>
			</div>
			<div class="input-group">
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
				<div class="row">
					<div class="col-lg-4 ">
					<div class="table-responsive">
	<table class="table table-striped table-condensed table-bordered table-hover">
	<thead>
	<tr>
	<th></th>
	<th>Montant</th>
	<th>Description</th>
	<th>Statut</th>
	<th></th>
	</tr>
	</thead>
	<tbody>
		<?php $f=0;foreach($lesfrais as $row){$f++;?>

	<tr>
		<td><?php echo $f;?></td>
		<td class="center"><?php echo round($row->montant,3);?></td>
	<td class="center"><?php echo $row->description;?></td>
	<?php if($row->status=="1"){?>
		<td class="center" bgcolor="#00FF00">
		activated
		</td>
	<?php }else {?>
		<td class="center" bgcolor="#FF0000">inactivated</td>
		<?php }?>
		<td class="center">
		<a href="<?php echo base_url()?>entreprise/edit_frais/ent/<?php echo $row->idfrais;?>" class="btn btn-xs btn-primary" role="button">
		<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
		</a>
		</td>
	</tr>
<?php }?>
	</tbody>
	</table>
						</div>
					</div>
				</div>
				<div class="row">
				    <div class="col-lg-8 ">
				    <?php echo form_open('entreprise/ajouter_charges_codes','class="form-inline"');?>

				    <div class="form-group">
				    <div class="col-sm-2">
				       <input autocomplete="off" type="text" class="form-control" id="code" placeholder="CODE" name="code" value="" />
				    </div>
				    </div>
				    <div class="form-group">
				    <div class="col-sm-3">
				       <input autocomplete="off" type="text" class="form-control" id="description_code" placeholder="DESCRIPTION " name="description_code" value="" />
				    </div>
				    </div>
				    <div class="input-group">
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

				      <div class="col-lg-4 ">
				      <div class="table-responsive">
				<table class="table table-striped table-condensed table-bordered table-hover">
				<thead>
				<tr>
				<th></th>
				<th>Code</th>
				<th>Description</th>
				<th>Statut</th>
				<th></th>
				</tr>
				</thead>
				<tbody>
				<?php $f=0;foreach($lescharges_codes as $row){$f++;?>

				<tr>
				<td><?php echo $f;?></td>
				<td class="center"><?php echo $row->charges_codes;?></td>
				<td class="center"><?php echo $row->description;?></td>
				<?php if($row->statut=="1"){?>
				<td class="center" bgcolor="#00FF00">
				activated
				</td>
				<?php }else {?>
				<td class="center" bgcolor="#FF0000">inactivated</td>
				<?php }?>
				<td class="center">
				<a href="<?php echo base_url()?>entreprise/edit_charges_codes/ent/<?php echo $row->id_charges_codes;?>" class="btn btn-xs btn-primary" role="button">
				<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
				</a>
				</td>
				</tr>
				<?php }?>
				</tbody>
				</table>
				        </div>
				      </div>
				</div>
				<div class="row">
				    <div class="col-lg-8 ">
				    <?php echo form_open('entreprise/ajouter_commodity','class="form-inline"');?>

				    <div class="form-group">
				    <div class="col-sm-3">
				       <input autocomplete="off" type="text" class="form-control" id="code" placeholder="CODE" name="code" value="" />
				    </div>
				    </div>
				    <div class="form-group">
				    <div class="col-sm-3">
				       <input autocomplete="off" type="text" class="form-control" id="description" placeholder="DESCRIPTION " name="description" value="" />
				    </div>
				    </div>
				    <div class="input-group">
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

				      <div class="col-lg-4 ">
				      <div class="table-responsive">
				<table class="table table-striped table-condensed table-bordered table-hover">
				<thead>
				<tr>
				<th></th>
				<th>Code</th>
				<th>Description</th>
				<th>Statut</th>
				<th></th>
				</tr>
				</thead>
				<tbody>
				<?php $f=0;foreach($lescommodity as $row){$f++;?>

				<tr>
				<td><?php echo $f;?></td>
				<td class="center"><?php echo $row->commodity;?></td>
				<td class="center"><?php echo $row->description;?></td>
				<?php if($row->statut=="1"){?>
				<td class="center" bgcolor="#00FF00">
				activated
				</td>
				<?php }else {?>
				<td class="center" bgcolor="#FF0000">inactivated</td>
				<?php }?>
				<td class="center">
				<a href="<?php echo base_url()?>entreprise/edit_commodity/ent/<?php echo $row->id_commodity;?>" class="btn btn-xs btn-primary" role="button">
				<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
				</a>
				</td>
				</tr>
				<?php }?>
				</tbody>
				</table>
				        </div>
				      </div>
				</div>
				<div class="col-lg-8 ">
				<?php echo form_open('entreprise/update_taux','class="form-inline"');?>

				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" size="6" type="text" class="form-control" id="taux" placeholder="Taux" name="taux" value="<?php echo round($res->taux,2)?>" />
				</div>
				</div>
				<div class="input-group">
          <span class="input-group-btn">
            <input type="hidden" id="id" name="id" value="<?php echo $res->id_taux?>" />
    			<button class="btn btn-sm btn-primary" type="submit">
    								 <i class="ace-icon fa fa-edit "></i>
    					Modifier
    							</button>
    			</span>
				</div>
						<?php echo form_close();?>


												</br>
					</div>
					<div class="row">
						<div class="col-lg-4 ">
						<div class="table-responsive">
		<table class="table table-striped table-condensed table-bordered table-hover">
		<thead>
		<tr>
		<th></th>
		<th>Taux</th>
		<th>Statut</th>
		<th></th>
		</tr>
		</thead>
		<tbody>
			<?php $f=0;foreach($lestaux as $row){$f++;?>
		<tr>
			<td><?php echo $f;?></td>
			<td class="center"><?php echo round($row->taux,2);?></td>
				<?php if($row->statut=="1"){?>
					<td class="center" bgcolor="#00FF00">
					activated
					</td>
				<?php }else {?>
					<td class="center" bgcolor="#FF0000">inactivated</td>
					<?php }?>
			<td class="center">
			<a href="<?php echo base_url()?>entreprise/edit_taux/ent/<?php echo $row->id_taux?>" class="btn btn-xs btn-primary" role="button">
			<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
			</a>
			</td>		</tr>
	<?php }?>
		</tbody>
		</table>
							</div>
						</div>
					</div>

					<div class="col-lg-8 ">
						<?php echo form_open('entreprise/ajouter_currency','class="form-inline"');?>

				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" size="6" type="text" class="form-control" id="name_currency" placeholder="Name" name="name_currency" value="" />
				</div>
				</div>
				<div class="form-group">
				<div class="col-sm-3">
					 <input autocomplete="off" size="6"  type="text" class="form-control" id="code_currency" placeholder="Code" name="code_currency" value="" />
				</div>
				</div>


				<div class="input-group">
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
					<div class="row">
						<div class="col-lg-4 ">
						<div class="table-responsive">
			<table class="table table-striped table-condensed table-bordered table-hover">
			<thead>
			<tr>
			<th></th>
			<th>Name</th>
			<th>Code</th>
			<th>Statut</th>
			<th></th>
			</tr>
			</thead>
			<tbody>
				<?php $c=0;foreach($currency as $row){$c++;?>
			<tr>
			<td><?php echo $c;?></td>
			<td class="center"><?php echo $row->name ;?></td>
			<td class="center"><?php echo $row->code ;?></td>
			<?php if($row->statut=="1"){?>
				<td class="center" bgcolor="#00FF00">
				activated
				</td>
			<?php }else {?>
				<td class="center" bgcolor="#FF0000">inactivated</td>
				<?php }?>
			<td class="center">
			<a href="<?php echo base_url()?>entreprise/edit_currency/ent/<?php echo $row->id_currency?>" class="btn btn-xs btn-primary" role="button">
			<i class="ace-icon fa fa-edit bigger-120" aria-hidden="false"></i>
			</a>
			</td>		</tr>
		<?php }?>

			</tbody>
			</table>
							</div>
						</div>
					</div>
</div><!-- /.page-content -->
<?php require_once('pied.php');?>
