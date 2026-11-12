<?php
if(isset($_SESSION['droit']['a28']) and $_SESSION['droit']['a28']=="1"  ) {
}else{
	redirect('home');
}
require_once("tete.php");
?>
<div class="page-header">
<h1><small><i class="ace-icon fa fa-angle-double-right"></i>Gestion des groupes</small></h1>
</div>
					<div class="page-content">
						<div class="row">

						<div class="col-lg-4 pricing-box">
						<div class="widget-box widget-color-red">
							<div class="widget-header">
								<h5 class="widget-title bigger lighter">Liste des groupes</h5>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<ul class="list-unstyled spaced2">

										<li>
											<i class="ace-icon fa fa-check green"></i>
											Administrateur
										</li>
										<li>
											<i class="ace-icon fa fa-check green"></i>
											<a href=""></a>
										</li>
									</ul>
												</div>
											</div>
										</div>
						</div>
			<form role="form" data-toggle="validator" id="form1" name="form1" method="post" action="">
			<input type="hidden" name="" id="" value="" />
			<input type="hidden" name="" id="" value="" />
			<div class="col-lg-2 pricing-box">
							<div class="widget-box widget-color-green">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter">Tableau de bord </h5>
								</div>

								<div class="widget-body">
									<div class="widget-main">
										<ul class="list-unstyled spaced2">
											<li>
											<label class="middle">
												<input class="ace" type="checkbox" name="a1"/>
												<span class="lbl"> Afficher</span>
											</label>
											</li>
											<li>
											<label class="middle">
												<input class="ace" type="checkbox" name="a2" />
												<span class="lbl"> Ajouter</span>
											</label>
											</li>
											<li>
											<label class="middle">
												<input class="ace" type="checkbox" name="a3"  />
												<span class="lbl"> Modifier</span>
											</label>
											</li>
											<li>
											<label class="middle">
												<input class="ace" type="checkbox" name="a4" />
												<span class="lbl"> Supprimer</span>
											</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-2 pricing-box">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Import</h5>
										</div>

										<div class="widget-body">
										<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a5"  />
														<span class="lbl"> Afficher</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a6" />
														<span class="lbl"> Ajouter</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a7" />
														<span class="lbl"> Modifier</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a8" />
														<span class="lbl"> Supprimer</span>
													</label>
													</li>

												</ul>
											</div>

										</div>
									</div>
					</div>
					<div class="col-lg-2 pricing-box">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Cr&eacute;er un vol</h5>
										</div>

										<div class="widget-body">
										<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a5"  />
														<span class="lbl"> Afficher</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a6" />
														<span class="lbl"> Ajouter</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a7" />
														<span class="lbl"> Modifier</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a8" />
														<span class="lbl"> Supprimer</span>
													</label>
													</li>

												</ul>
											</div>

										</div>
									</div>
					</div>
					<div class="col-lg-2 pricing-box">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Rechercher un vol Import</h5>
										</div>

										<div class="widget-body">
										<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a5"  />
														<span class="lbl"> Afficher</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a6" />
														<span class="lbl"> Ajouter</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a7" />
														<span class="lbl"> Modifier</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a8" />
														<span class="lbl"> Supprimer</span>
													</label>
													</li>

												</ul>
											</div>

										</div>
									</div>
					</div>
					<div class="col-lg-2 pricing-box">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Export</h5>
										</div>

										<div class="widget-body">
										<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a5"  />
														<span class="lbl"> Afficher</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a6" />
														<span class="lbl"> Ajouter</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a7" />
														<span class="lbl"> Modifier</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a8" />
														<span class="lbl"> Supprimer</span>
													</label>
													</li>

												</ul>
											</div>

										</div>
									</div>
					</div>
					<div class="col-lg-2 pricing-box">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Cr&eacute;er un vol</h5>
										</div>

										<div class="widget-body">
										<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a5"  />
														<span class="lbl"> Afficher</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a6" />
														<span class="lbl"> Ajouter</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a7" />
														<span class="lbl"> Modifier</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a8" />
														<span class="lbl"> Supprimer</span>
													</label>
													</li>

												</ul>
											</div>

										</div>
									</div>
					</div>
					<div class="col-lg-2 pricing-box">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Rechercher un vol Export</h5>
										</div>

										<div class="widget-body">
										<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a5"  />
														<span class="lbl"> Afficher</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a6" />
														<span class="lbl"> Ajouter</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a7" />
														<span class="lbl"> Modifier</span>
													</label>
													</li>
													<li>
													<label class="middle">
														<input class="ace" type="checkbox" name="a8" />
														<span class="lbl"> Supprimer</span>
													</label>
													</li>

												</ul>
											</div>

										</div>
									</div>
					</div>





						<div class="col-lg-12">

						<div class="modal-footer">

						<button class="btn btn-sm btn-primary">
							<i class="ace-icon fa fa-floppy-o"></i>
							Sauvegarder
						</button>

						<a href="index.php" class="btn btn-sm" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Fermer
						</a>

						</div>

						</div>
						</form>
						</div>
					</div>
				<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
<?php
require_once("pied.php");
?>
