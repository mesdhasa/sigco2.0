<?php
if(isset($_SESSION['droit']['a28']) and $_SESSION['droit']['a28']=="1"){

}else{
	redirect('home/pas_access');
}
?>
<div class="page-content">
						<div class="page-header">
							<h1>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Gestion des groupes
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
<?php if($this->session->flashdata('sms')){?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->session->flashdata('sms');?></strong>
</div>
<?php } ?>
							<div class="col-lg-3 col-md-12 col-xs-12">
							<div class="col-lg-12 col-xs-12 col-sm-12 pricing-box">
										<div class="widget-box widget-color-red">
											<div class="widget-header">
												<h5 class="widget-title bigger lighter">Liste des groupes</h5>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<ul class="list-unstyled spaced2">
														<?php if(isset($lesgroupes)){
															foreach($lesgroupes as $row){
															?>
														<?php if($row->cree_par == "sys"){?>

														<li>
															<strong>[ <?php echo $row->nom_groupe;?> ]</strong>
														</li>
														<?php }else{?>
														<li>
															<i class="ace-icon fa fa-check green"></i>
															<a href="javascript:void(0)" onclick="confirmation_lien('Voulez-vous supprimer cet enrefistrement?','<?php echo base_url()?>groupe_supp/<?php echo $row->idgroupe_user;?>')"><i class="ace-icon fa fa-times red"></i></a>
															<a href="<?php echo base_url()?>gestion-groupe-edit/<?php echo $row->idgroupe_user;?>"> <?php echo $row->nom_groupe;?></a>
														</li>
														<?php }}}?>
													</ul>

												</div>


											</div>
										</div>
									</div>

							</div>

							<?php

							if(isset($legroupe) and count($legroupe)>0){
								$lesAccess = array();
							foreach($legroupe as $rs){
								$lesAccess['a1'] = $rs->a1;
								$lesAccess['a2'] = $rs->a2;
								$lesAccess['a3'] = $rs->a3;
								$lesAccess['a4'] = $rs->a4;
								$lesAccess['a5'] = $rs->a5;
								$lesAccess['a6'] = $rs->a6;
								$lesAccess['a7'] = $rs->a7;
								$lesAccess['a8'] = $rs->a8;
								$lesAccess['a9'] = $rs->a9;
								$lesAccess['a10'] = $rs->a10;
								$lesAccess['a11'] = $rs->a11;
								$lesAccess['a12'] = $rs->a12;
								$lesAccess['a13'] = $rs->a13;
								$lesAccess['a14'] = $rs->a14;
								$lesAccess['a15'] = $rs->a15;
								$lesAccess['a16'] = $rs->a16;
								$lesAccess['a17'] = $rs->a17;
								$lesAccess['a18'] = $rs->a18;
								$lesAccess['a19'] = $rs->a19;
								$lesAccess['a20'] = $rs->a20;
								$lesAccess['a21'] = $rs->a21;
								$lesAccess['a22'] = $rs->a22;
								$lesAccess['a23'] = $rs->a23;
								$lesAccess['a24'] = $rs->a24;
								$lesAccess['a25'] = $rs->a25;
								$lesAccess['a26'] = $rs->a26;
								$lesAccess['a27'] = $rs->a27;
								$lesAccess['a28'] = $rs->a28;
								$lesAccess['a29'] = $rs->a29;
								$lesAccess['a30'] = $rs->a30;
								$lesAccess['a31'] = $rs->a31;
								$lesAccess['a32'] = $rs->a32;
								$lesAccess['a33'] = $rs->a33;
								$lesAccess['a34'] = $rs->a34;
								$lesAccess['a35'] = $rs->a35;
								$lesAccess['a36'] = $rs->a36;
								$lesAccess['a37'] = $rs->a37;
								$lesAccess['a38'] = $rs->a38;
								$lesAccess['a39'] = $rs->a39;
								$lesAccess['a40'] = $rs->a40;
								$lesAccess['a41'] = $rs->a41;
								$lesAccess['a42'] = $rs->a42;
								$lesAccess['a43'] = $rs->a43;
								$lesAccess['a44'] = $rs->a44;
								$lesAccess['a45'] = $rs->a45;
								$lesAccess['a46'] = $rs->a46;
								$lesAccess['a47'] = $rs->a47;
								$lesAccess['a48'] = $rs->a48;
								$lesAccess['a49'] = $rs->a49;
								$lesAccess['a50'] = $rs->a50;
								$lesAccess['a51'] = $rs->a51;
								$lesAccess['a52'] = $rs->a52;
								$lesAccess['a53'] = $rs->a53;
								$lesAccess['a54'] = $rs->a54;
								$lesAccess['a55'] = $rs->a55;
								$lesAccess['a56'] = $rs->a56;
								$lesAccess['a57'] = $rs->a57;
								$lesAccess['a58'] = $rs->a58;
								$lesAccess['a59'] = $rs->a59;
								$lesAccess['a60'] = $rs->a60;
								$lesAccess['a61'] = $rs->a61;
								$lesAccess['a62'] = $rs->a62;
								$lesAccess['a63'] = $rs->a63;
								$lesAccess['a64'] = $rs->a64;
								$lesAccess['a65'] = $rs->a65;
								$lesAccess['a66'] = $rs->a66;
								$lesAccess['a67'] = $rs->a67;
								$lesAccess['a68'] = $rs->a68;
								$lesAccess['a69'] = $rs->a69;
								$lesAccess['a70'] = $rs->a70;
								$lesAccess['a71'] = $rs->a71;
								$lesAccess['a72'] = $rs->a72;
								$lesAccess['a73'] = $rs->a73;
								$lesAccess['a74'] = $rs->a74;
								$lesAccess['a75'] = $rs->a75;
								$lesAccess['a76'] = $rs->a76;
								$lesAccess['a77'] = $rs->a77;
								$lesAccess['a78'] = $rs->a78;
								$lesAccess['a79'] = $rs->a79;
								$lesAccess['a80'] = $rs->a80;
								$lesAccess['a81'] = $rs->a81;
								$lesAccess['a82'] = $rs->a82;
								$lesAccess['a83'] = $rs->a83;
								$lesAccess['a84'] = $rs->a84;
								$lesAccess['a85'] = $rs->a85;
								$lesAccess['a86'] = $rs->a86;
								$lesAccess['a87'] = $rs->a87;
								$lesAccess['a88'] = $rs->a88;
								$lesAccess['a89'] = $rs->a89;
								$lesAccess['a90'] = $rs->a90;
								$lesAccess['a91'] = $rs->a91;
								$lesAccess['a92'] = $rs->a92;
								$lesAccess['a93'] = $rs->a93;
								$lesAccess['a94'] = $rs->a94;
								$lesAccess['a95'] = $rs->a95;
								$lesAccess['a96'] = $rs->a96;
								$lesAccess['a97'] = $rs->a97;
								$lesAccess['a98'] = $rs->a98;
								$lesAccess['a99'] = $rs->a99;
								$lesAccess['a100'] = $rs->a100;
							}
							echo form_open('groupe_param/modifier');?>

							<div class="col-lg-9 col-md-12 col-xs-12">
							<input type="hidden" name="id" id="id" value="<?php echo $rs->idgroupe_user?>" />
							<h4><strong><?php echo $rs->nom_groupe;?></strong></h4>
							<?php
							$tag = 0;?>

			<div class="col-lg-4 pricing-box">
			<div class="widget-box widget-color-green">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">IMPORT</h5>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
	<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
	<span class="lbl"> <?php echo "<strong>Import</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
	<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
	<span class="lbl"> <?php echo "<strong>Cr&eacute;er un vol</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
	<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
	<span class="lbl"> <?php echo "<strong>Notification</strong>";?></span>
</label>
</li>


<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
	<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
	<span class="lbl"> <?php echo "<strong>Recherche de vol</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
	<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
	<span class="lbl"> <?php echo "<strong>Pointage</strong>";?></span>
</label>
</li>


						</ul>

					</div>


				</div>
			</div>
		</div>
		<div class="col-lg-4 pricing-box">
		<div class="widget-box widget-color-green">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">Export</h5>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					<ul class="list-unstyled spaced2">
						<li><?php $tag++?>
						<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
						<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
						<span class="lbl"> <?php echo "<strong>Export</strong>";?></span>
						</label>
						</li>
<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Créer un manifeste</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Recherche un manifeste</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Warehouse Receipt</strong>";?></span>
</label>
</li>


<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Airway Bill</strong>";?></span>
</label>
</li>


					</ul>

				</div>


			</div>
		</div>
	</div>
	<div class="col-lg-4 pricing-box">
	<div class="widget-box widget-color-green">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">Livraison</h5>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Livraison</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Livrer un colis</strong>";?></span>
</label>
</li>

				</ul>

			</div>


		</div>
	</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Rechercher</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Rechercher</strong>";?></span>
</label>
</li>


			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Facturation</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Facturation</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Rechercher un AWB</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Rapports impayées</strong>";?></span>
</label>
</li>


<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Rapports de caisse</strong>";?></span>
</label>
</li>



			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Paiement</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Paiement</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Rechercher une facture</strong>";?></span>
</label>
</li>
			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Clients</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Clients</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Ajouter un client</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Liste des clients</strong>";?></span>
</label>
</li>

			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Utilisateurs</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Utilisateurs</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Ajouter un utilisateur</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Liste des utilisateurs</strong>";?></span>
</label>
</li>







			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">gestion groupes</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>gestion groupes</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Ajouter des groupes</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Lister les groupes</strong>";?></span>
</label>
</li>

			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter"> Rapports</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong> Rapports</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Cr&eacute;er un num&eacute;ro de rapport</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Autre rapports (*)</strong>";?></span>
</label>
</li>


<!-- <li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Revenue report</strong>";?></span>
</label>
</li> -->

			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Entreprise</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Entreprise</strong>";?></span>
</label>
</li>

<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Configuration</strong>";?></span>
</label>
</li>

			</ul>

		</div>


	</div>
</div>
</div>
<div class="col-lg-4 pricing-box">
<div class="widget-box widget-color-green">
	<div class="widget-header">
		<h5 class="widget-title bigger lighter">Autorisation</h5>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<ul class="list-unstyled spaced2">



<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>	Autorisation</strong>";?></span>
</label>
</li>
<li><?php $tag++?>
<label class="middle" title="<?php echo "[ a".$tag." ]";?>">
<input class="ace" type="checkbox" name="a<?php echo $tag?>"  id="a<?php echo $tag?>" <?php if(isset($lesAccess["a".$tag]) and $lesAccess["a".$tag]=='1') echo " checked";?> />
<span class="lbl"> <?php echo "<strong>Delete airway Bill</strong>";?></span>
</label>
</li>

			</ul>

		</div>


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

	<a href="<?php echo base_url()?>gestion-groupe" class="btn btn-sm" data-dismiss="modal">
		<i class="ace-icon fa fa-times"></i>
		Fermer
	</a>

	</div>

	</div>
							<?php echo form_close();}
							?>
						</div><!-- /.row -->
					</div><!-- /.page-content -->
