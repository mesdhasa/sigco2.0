<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<li class="<?php if(!isset($act)) echo "active";?>">
						<a href="<?php echo base_url()?>home">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Tableau de bord </span>
						</a>

						<b class="arrow"></b>
					</li>
				<?php if(isset($_SESSION['droit']['a1']) and $_SESSION['droit']['a1']=="1"){?>
				<li class="<?php if(isset($act) and $act=="i") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-indent"></i>
							<span class="menu-text"> Import </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
<?php if(isset($_SESSION['droit']['a2']) and $_SESSION['droit']['a2']=="1"){?>

							<li class="<?php if(isset($y) and $y=="ajouter") echo "active";?>">
								<a href="<?php echo base_url()?>import/">
									<i class="menu-icon fa fa-caret-right"></i>
									Cr&eacute;er un vol
								</a>

								<b class="arrow"></b>
							</li>
<?php }?>
<?php if(isset($_SESSION['droit']['a3']) and $_SESSION['droit']['a3']=="1"){?>

							 <li class="<?php if(isset($y) and $y=="precol") echo "active";?>">
								<a href="<?php echo base_url()?>import/precol/i/precol">
									<i class="menu-icon fa fa-caret-right"></i>
									Notification
								</a>

								<b class="arrow"></b>
							</li>
<?php }?>
<?php if(isset($_SESSION['droit']['a4']) and $_SESSION['droit']['a4']=="1"){?>

							<li class="<?php if(isset($y) and $y=="lister") echo "active";?>">
								<a href="<?php echo base_url()?>import/recherchevol/i/lister">
									<i class="menu-icon fa fa-caret-right"></i>
									Recherche de vols
								</a>

								<b class="arrow"></b>
							</li>
<?php }?>
<?php if(isset($_SESSION['droit']['a5']) and $_SESSION['droit']['a5']=="1"){?>

							<li class="<?php if(isset($y) and $y=="ptg") echo "active";?>">
								<a href="<?php echo base_url()?>import/pointage/i/ptg">
									<i class="menu-icon fa fa-caret-right"></i>
									Pointage
								</a>

								<b class="arrow"></b>
							</li>
<?php }?>
							<!-- li class="<?php if(isset($y) and $y=="searchawbl") echo "active";?>">
								<a href="<?php echo base_url()?>import/pointage/i/searchawbl">
									<i class="menu-icon fa fa-caret-right"></i>
									Rechercher un AWBL
								</a>

								<b class="arrow"></b>
							</li -->
						</ul>
					</li>

					<?php }?>
					<?php if(isset($_SESSION['droit']['a6']) and $_SESSION['droit']['a6']=="1"){?>

					<li class="<?php if(isset($act) and $act=="e") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-indent"></i>
							<span class="menu-text"> Export </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a7']) and $_SESSION['droit']['a7']=="1"){?>
							<li class="<?php if(isset($y) and $y=="ajouter") echo "active";?>">
								<a href="<?php echo base_url()?>manifeste">
									<i class="menu-icon fa fa-caret-left"></i>
								Créer un manifeste
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a8']) and $_SESSION['droit']['a8']=="1"){?>

							<li class="<?php if(isset($y) and $y=="recherche") echo "active";?>">
								<a href="<?php echo base_url()?>recherche_un_manifeste">
									<i class="menu-icon fa fa-caret-left"></i>
									Recherche un manifeste
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>

							<!-- <li class="<?php if(isset($y) and $y=="reservation") echo "active";?>">
								<a href="<?php echo base_url()?>reservation">
									<i class="menu-icon fa fa-caret-left"></i>
								Réservation
								</a>

								<b class="arrow"></b>
							</li> -->
							<?php if(isset($_SESSION['droit']['a9']) and $_SESSION['droit']['a9']=="1"){?>
							<li class="<?php if(isset($y) and $y=="warehouse") echo "active";?>">
								<a href="<?php echo base_url()?>warehouse">
									<i class="menu-icon fa fa-caret-left"></i>
							Warehouse Receipt
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a10']) and $_SESSION['droit']['a10']=="1"){?>
							<li class="<?php if(isset($y) and $y=="airway") echo "active";?>">
								<a href="<?php echo base_url()?>Airway_Bill">
									<i class="menu-icon fa fa-caret-left"></i>
						Airway Bill
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>

						</ul>
					</li>
							<?php }?>
							<?php if(isset($_SESSION['droit']['a11']) and $_SESSION['droit']['a11']=="1"){?>

					<li class="<?php if(isset($act) and $act=="l") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-arrow-left"></i>
							<span class="menu-text"> Livraison </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a12']) and $_SESSION['droit']['a12']=="1"){?>

							<li class="<?php if(isset($y) and $y=="liv") echo "active";?>">
								<a href="<?php echo base_url()?>livraison/index/l/liv">
									<i class="menu-icon fa fa-caret-right"></i>
									Livrer un colis
								</a>

								<b class="arrow"></b>
							</li>

						<?php }?>

						</ul>

												<ul class="submenu">
													<?php if(isset($_SESSION['droit']['a12']) and $_SESSION['droit']['a12']=="1"){?>

													<li class="<?php if(isset($y) and $y=="rap") echo "active";?>">
														<a href="<?php echo base_url()?>livraison/rap_livraison/l/rap">
															<i class="menu-icon fa fa-caret-right"></i>
													POD Report
														</a>

														<b class="arrow"></b>
													</li>

												<?php }?>

												</ul>
												<ul class="submenu">
													<?php if(isset($_SESSION['droit']['a12']) and $_SESSION['droit']['a12']=="1"){?>

													<li class="<?php if(isset($y) and $y=="non") echo "active";?>">
														<a href="<?php echo base_url()?>livraison/non_livraison/l/non">
															<i class="menu-icon fa fa-caret-right"></i>
												W/H INVENTORY
														</a>

														<b class="arrow"></b>
													</li>

												<?php }?>

												</ul>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a13']) and $_SESSION['droit']['a13']=="1"){?>

					<li class="<?php if(isset($act) and $act=="recherche") echo "active";?>">
						<a href="<?php echo base_url()?>recherche/index/recherche">
							<i class="menu-icon fa fa-search"></i>
							<span class="menu-text"> Recherche</span>
						</a>

						<b class="arrow"></b>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a14']) and $_SESSION['droit']['a14']=="1"){?>

					<li class="<?php if(isset($act) and $act=="f") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-files-o"></i>
							<span class="menu-text"> Facturation </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a15']) and $_SESSION['droit']['a15']=="1"){?>
							<li class="<?php if(isset($y) and $y=="rech") echo "active";?>">
								<a href="<?php echo base_url()?>facture">
									<i class="menu-icon fa fa-caret-right"></i>
									Rechercher un AWB
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a16']) and $_SESSION['droit']['a16']=="1"){?>

							<li class="<?php if(isset($y) and $y=="rap") echo "active";?>">
								<a href="<?php echo base_url()?>facture/rapport/f/rap">
									<i class="menu-icon fa fa-caret-right"></i>
									Rapports impayées
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a17']) and $_SESSION['droit']['a17']=="1"){?>

														<li class="<?php if(isset($y) and $y=="rap_caisse") echo "active";?>">
															<a href="<?php echo base_url()?>facture/rap_caisse/f/rap_caisse">
																<i class="menu-icon fa fa-caret-right"></i>
																Rapports de caisse
															</a>

															<b class="arrow"></b>
														</li>
													<?php }?>
													<!-- <?php if(isset($_SESSION['droit']['a17']) and $_SESSION['droit']['a17']=="1"){?>

																					<li class="<?php if(isset($y) and $y=="caisse") echo "active";?>">
																						<a href="<?php echo base_url()?>facture/rap_caisse2/f/caisse">
																							<i class="menu-icon fa fa-caret-right"></i>
																							Rapports de caisse #2
																						</a>

																						<b class="arrow"></b>
																					</li>
																				<?php }?> -->
						</ul>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a18']) and $_SESSION['droit']['a18']=="1"){?>

					<li class="<?php if(isset($act) and $act=="p") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Paiement </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a19']) and $_SESSION['droit']['a19']=="1"){?>
							<li class="<?php if(isset($y) and $y=="rechp") echo "active";?>">
								<a href="<?php echo base_url()?>facture/searchFacture/p/rechp">
									<i class="menu-icon fa fa-caret-right"></i>
									Rechercher une facture
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>

						</ul>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a20']) and $_SESSION['droit']['a20']=="1"){?>

					<li class="<?php if(isset($act) and $act=="c") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Clients </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a21']) and $_SESSION['droit']['a21']=="1"){?>

							<li class="<?php if(isset($y) and $y=="client") echo "active";?>">
								<a href="<?php echo base_url()?>client/ajouter/c/client">
									<i class="menu-icon fa fa-caret-right"></i>
									Ajouter un client
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a22']) and $_SESSION['droit']['a22']=="1"){?>

							<li class="<?php if(isset($y) and $y=="liste_client") echo "active";?>">
								<a href="<?php echo base_url()?>client/lst/c/liste_client">
									<i class="menu-icon fa fa-caret-right"></i>
									Liste des clients
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>

						</ul>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a23']) and $_SESSION['droit']['a23']=="1"){?>

			<li class="<?php if(isset($act) and $act=="u") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Utilisateurs </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a24']) and $_SESSION['droit']['a24']=="1"){?>

							<li class="<?php if(isset($y) and $y=="add") echo "active";?>">
								<a href="<?php echo base_url()?>utilisateur">
									<i class="menu-icon fa fa-caret-right"></i>
									Ajouter un utilisateur
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a25']) and $_SESSION['droit']['a25']=="1"){?>

							<li class="<?php if(isset($y) and $y=="liste") echo "active";?>">
								<a href="<?php echo base_url()?>utilisateur/lister/u/liste">
									<i class="menu-icon fa fa-caret-right"></i>
									Liste des utilisateurs
								</a>

								<b class="arrow"></b>
							</li>

						<?php }?>

						</ul>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a26']) and $_SESSION['droit']['a26']=="1"){?>

					<li class="<?php if(isset($act) and $act=="gp") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text">gestion groupes</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a27']) and $_SESSION['droit']['a27']=="1"){?>

							<li class="<?php if(isset($y) and $y=="add_gp") echo "active";?>">
								<a href="<?php echo base_url()?>ajouter-un-groupe">
									<i class="menu-icon fa fa-caret-right"></i>
									Ajouter des groupes
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a28']) and $_SESSION['droit']['a28']=="1"){?>

							<li class="<?php if(isset($y) and $y=="lst_gp") echo "active";?>">
								<a href="<?php echo base_url()?>gestion-groupe">
									<i class="menu-icon fa fa-caret-right"></i>
									Lister les groupes
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>

						</ul>
					</li>
				<?php }?>

					<?php if(isset($_SESSION['droit']['a29']) and $_SESSION['droit']['a29']=="1"){?>

					<li class="<?php if(isset($act) and $act=="rapports") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-text"></i>
							<span class="menu-text"> Rapports </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a30']) and $_SESSION['droit']['a30']=="1"){?>

							<li class="">
								<a href="javascript:void(0)" onclick="confirmation_lien('Voulez-vous générer ce numéro de rapport?','<?php echo base_url()?>import/set_numRapport')">
									<i class="menu-icon fa fa-caret-right"></i>
									Cr&eacute;er un num&eacute;ro de rapport
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>
						<?php if(isset($_SESSION['droit']['a31']) and $_SESSION['droit']['a31']=="1"){?>

							<!-- <li class="<?php if(isset($y) and $y=="droit") echo "active";?>">
								<a href="<?php echo base_url()?>rapports/larecherche/rapports/droit">
									<i class="menu-icon fa fa-caret-right"></i>
						Droit de depot
								</a>

								<b class="arrow"></b>
							</li> -->
						<?php }?>
						<?php if(isset($_SESSION['droit']['a32']) and $_SESSION['droit']['a32']=="1"){?>

							<!-- <li class="<?php if(isset($y) and $y=="revenue") echo "active";?>">
								<a href="<?php echo base_url()?>rapports/revenue_report/rapports/revenue">
									<i class="menu-icon fa fa-caret-right"></i>
					Revenue report
								</a>

								<b class="arrow"></b>
							</li> -->
						<?php }?>

						</ul>
					</li>
				<?php }?>
				<?php if(isset($_SESSION['droit']['a33']) and $_SESSION['droit']['a33']=="1"){?>

					<li class="<?php if(isset($act) and $act=="ent") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text">Entreprise</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if(isset($_SESSION['droit']['a34']) and $_SESSION['droit']['a34']=="1"){?>

							<li class="<?php if(isset($y) and $y=="configuration") echo "active";?>">
								<a href="<?php echo base_url()?>entreprise/conf/ent/configuration">
									<i class="menu-icon fa fa-caret-right"></i>
								Configuration
								</a>

								<b class="arrow"></b>
							</li>
						<?php }?>

						</li>
					<?php }?>

						</ul>

					</li>

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
