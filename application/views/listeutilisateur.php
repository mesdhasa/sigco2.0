<?php
if(isset($_SESSION['droit']['a25']) and $_SESSION['droit']['a25']=="1"  ) {
}else{
	redirect('home');
}
require_once("tete.php");
?>

				<div class="page-header">

					<h1>

						<small>

							<i class="ace-icon fa fa-angle-double-right"></i>
                                  Liste des utilisateurs
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
								<th>Email</th>
								<th>Nom</th>
								<th>Pr&eacute;nom</th>
								<th>T&eacute;l&eacute;phone</th>
								<th>T&eacute;l&eacute;phone 2</th>
								<th>Groupe</th>
								<th></th>
							</tr>
							</thead>

							<tbody>
		<?php $c=0;foreach($lesutilisateurs as $row){$c++;?>
							 <tr>
								 <td><?php echo $c;?></td>
	 							<td><?php echo $row->adresse_email;?></td>
								<td><?php echo $row->nompers;?></td>
								<td><?php echo $row->prenompers;?></td>
								<td><?php echo $row->telephones;?></td>
								<td><?php echo $row->tel2;?></td>
								<td><?php echo $row->nom_groupe;?></td>

								<td class="center" style="width:5%">

									<div class="action-buttons">

										<a title="Afficher" class="btn btn-xs btn-info" href="<?php echo base_url()?>utilisateur/modifier/u/liste_utilisateur/<?php echo $row->identreprise;?>">

											<i class="ace-icon fa fa-plus bigger-120"></i>

										</a>

									</div>

								</td>
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
