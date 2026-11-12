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

						<table class="table table-striped table-bordered table-hover">
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
							<?php $c=0;foreach($lesclients as $row){$c++;?>
							 <tr>
								<td><?php echo $c;?></td>
								<td><?php echo $row->reference;?></td>
								<td><?php echo $row->societe;?></td>
								<td><?php echo $row->adresse;?></td>
								<td><?php echo $row->ville;?></td>
								<td><?php echo $row->email;?></td>
								<td><?php echo $row->phone;?></td>
								<td class="center" style="width:5%">
									<div class="action-buttons">
										<a title="Afficher" class="btn btn-xs btn-info" href="<?php echo base_url()?>client/modifier/c/liste_client/<?php echo $row->codeclient;?>">
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


												</div>

											</div>

						</div><!-- /.row -->

					</div><!-- /.page-content -->

<?php

require_once("pied.php");

?>
