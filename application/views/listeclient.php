<?php
if(isset($_SESSION['droit']['a21']) and $_SESSION['droit']['a21']=="1"  ) {
}else{
	redirect('home');
}
require_once("tete.php");
?>

				<div class="page-header">

					<h1>

						<small>

							<i class="ace-icon fa fa-angle-double-right"></i>
                                  Liste des clients
						</small>

					</h1>

				</div>

					<div class="page-content">
						<div class="row">
                          <div class="col-lg-12">
											<div class="table-responsive">

						<form method="get" action="<?php echo current_url();?>" class="form-inline" style="margin-bottom:10px">
							<input type="text" name="q" class="form-control" placeholder="R&eacute;f&eacute;rence ou nom" value="<?php echo e($recherche);?>" />
							<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-search"></i> Rechercher</button>
							<span class="text-muted">&nbsp;<?php echo (int) $pagination['total'];?> client(s) &ndash; page <?php echo (int) $pagination['page'];?> / <?php echo (int) $pagination['pages'];?></span>
						</form>
						<div class="sigco-pagination-barre"><?php echo $pagination['selecteur'];?> <?php echo $pagination['liens'];?></div>
						<table data-sigco-pagination="serveur" class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
								<th></th>
								<th>reference</th>
								<th>Nom client ou Soci&eacute;t&eacute;</th>
								<th>Adresse</th>
								<th>Ville</th>
								<th>Adresse email</th>
								<th>T&eacute;l&eacute;phone</th>
								<th></th>
								<!-- <th></th> -->
							</tr>
							</thead>

							<tbody>
							<?php $c=$pagination['offset'];foreach($lesclients as $row){$c++;?>
							 <tr>
								<td><?php echo $c;?></td>
								<td><?php echo e($row->reference);?></td>
								<td><?php echo e($row->societe);?></td>
								<td><?php echo e($row->adresse);?></td>
								<td><?php echo e($row->ville);?></td>
								<td><?php echo e($row->email);?></td>
								<td><?php echo e($row->phone);?></td>
								<td class="center" style="width:5%">
									<div class="action-buttons">
										<a title="Afficher" class="btn btn-xs btn-info" href="<?php echo base_url()?>client/modifier/c/liste_client/<?php echo rawurlencode($row->codeclient);?>">
											<i class="ace-icon fa fa-plus bigger-120"></i>
										</a>
									</div>
								</td>
								<!-- <td class="center" style="width:5%">
									<div class="action-buttons">
										<a title="Etat Compte" class="btn btn-xs btn-success" target="_blank" href="<?php echo base_url()?>client/etat_compte/c/liste_client/<?php echo $row->codeclient;?>">
											<i class="ace-icon fa fa-money bigger-120"></i>
										</a>
									</div>
								</td> -->
							</tr>
							<?php }?>
							</tbody>
						</table>
						<?php echo $pagination['liens'];?>


												</div>

											</div>

						</div><!-- /.row -->

					</div><!-- /.page-content -->

<?php

require_once("pied.php");

?>
