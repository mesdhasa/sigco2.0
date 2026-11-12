<?php
if(isset($_SESSION['droit']['a21']) and $_SESSION['droit']['a21']=="1"  ) {
}else{
	redirect('home');
}
require_once('tete.php');
foreach($client as $rs){}
?>

<div class="page-header">

							<h1>

								<small>

									<i class="ace-icon fa fa-angle-double-right"></i>
									Modifier un client

								</small>

							</h1>

						</div>

<div class="page-content">
	<div class="row">
		<div class="col-lg-6 col-md-12 col-xs-12">
		<?php echo form_open('client/updateclient');?>

		  <div class="form-group">
			<label for="ref">Code (*):</label>
			<input autocomplete="off" type="text" class="form-control" id="ref" name="ref" value="<?php echo $rs->reference?>" required >
		  </div>
		  <div class="form-group">
			<label for="societe">Nom client ou Soci&eacute;t&eacute; (*):</label>
			<input autocomplete="off" type="text" class="form-control" id="societe" name="societe"
			value="<?php echo $rs->societe?>" required >
		  </div>
			<div class="form-group">
			<label for="societe">Date cr&eacute;ation / Date anniversaire:</label>
		  </div>
						<?php
			$date_an=$rs->date_naissance;
			if ($date_an=="") {
				$jours = 00;
				$mois = 00;
				$annees = 0000;
			 ?>
			 <div class="form-group col-md-4">
			 <select id="jour" name="jour" class="form-control" >
				 <option value="">-- Jour (*) --</option>
				 <?php for($j=1;$j<=31;$j++){?>
				 <option value="<?php echo valeur_n_chiffres($j,2) ?>" <?php if($jours==valeur_n_chiffres($j,2)) echo " selected "?>><?php echo valeur_n_chiffres($j,2)?></option>
				 <?php }?>
			 </select>
			 </div>
			 <div class="form-group col-md-4">
				 <select id="mois" name="mois" class="form-control" >
					 <option value="">-- Mois (*) --</option>
					 <?php for($m=1;$m<=12;$m++){?>
					 <option value="<?php echo valeur_n_chiffres($m,2)?>" 	<?php if($mois==valeur_n_chiffres($m,2)) echo " selected "?>><?php echo mois_full($m)?></option>
					 <?php }?>
				 </select>
			 </div>

			 <div class="form-group col-md-4">
				 <select id="annee" name="annee" class="form-control" >
					 <option value="">-- Année (*) --</option>
					 <?php for($a=1900;$a<=date('Y');$a++){?>
					 <option value="<?php echo $a?>"<?php if($annees==$a) echo " selected "?>><?php echo $a?></option>
					 <?php }?>
				 </select>
		 </div></br>
			 <?php 		} else {
		 				$datenaissance = explode('-',$date_an);
		 				$jours = $datenaissance[2];
		 				$mois = $datenaissance[1];
		 				$annees = $datenaissance[0];
		 		?>
				<div class="form-group col-md-4">
				<select id="jour" name="jour" class="form-control" >
					<option value="">-- Jour (*) --</option>
					<?php for($j=1;$j<=31;$j++){?>
					<option value="<?php echo valeur_n_chiffres($j,2) ?>" <?php if($jours==valeur_n_chiffres($j,2)) echo " selected "?>><?php echo valeur_n_chiffres($j,2)?></option>
					<?php }?>
				</select>
				</div>
				<div class="form-group col-md-4">
					<select id="mois" name="mois" class="form-control" >
						<option value="">-- Mois (*) --</option>
						<?php for($m=1;$m<=12;$m++){?>
						<option value="<?php echo valeur_n_chiffres($m,2)?>" 	<?php if($mois==valeur_n_chiffres($m,2)) echo " selected "?>><?php echo mois_full($m)?></option>
						<?php }?>
					</select>
				</div>

				<div class="form-group col-md-4">
					<select id="annee" name="annee" class="form-control" >
						<option value="">-- Année (*) --</option>
						<?php for($a=1900;$a<=date('Y');$a++){?>
						<option value="<?php echo $a?>"<?php if($annees==$a) echo " selected "?>><?php echo $a?></option>
						<?php }?>
					</select>
			</div></br>
			 <?php  	}?>

		  <div class="form-group">
			<label for="adresse">Adresse (*):</label>
			<textarea id="adresse" name="adresse" class="form-control"><?php echo $rs->adresse?></textarea>
		  </div>
			<div class="form-group">
			<label for="ville">Ville (*):</label>
			<textarea id="ville" name="ville" class="form-control"><?php echo $rs->ville?></textarea>
		  </div>
		  <div class="form-group">
			<label for="email">Adresse email (*):</label>
			<input autocomplete="off" type="email" class="form-control" id="email" name="email"
			value="<?php echo $rs->email?>" required >
		  </div>
		  <div class="form-group">
			<label for="phone">T&eacute;l&eacute;phone (*):</label>
			<input autocomplete="off" type="text" class="form-control" id="phone" name="phone"
			value="<?php echo $rs->phone?>" required >
		  </div>
		  <div class="form-group">
			<label for="memo">Memo:</label>
			<textarea id="memo" name="memo" class="form-control"><?php echo $rs->memo?></textarea>
		  </div>
		  <div class="form-group">
		<input type="hidden" id="codeclient" name="codeclient" value="<?php echo $rs->codeclient?>" />
		  <button type="submit" class="btn btn-primary">
		  <i class="ace-icon fa fa-save"></i>
	Sauvegarder
		  </button>
		  <a class="btn btn-primary" href="<?php echo base_url();?>client/lst/c/liste_client">
		   <i class="ace-icon fa fa-close"></i>
				Fermer
		</a>
		</div>

		<?php echo form_close();?>
		</div>
	</div>


</div><!-- /.page-content -->
<?php require_once('pied.php');?>
