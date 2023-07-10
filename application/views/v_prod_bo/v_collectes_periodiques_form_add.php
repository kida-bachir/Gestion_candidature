<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">

		<h5 class="card-title"><?php echo $title ?></h5>

		<div class="row ">
			<div class="col-sm-8 col-sm-offset-3">

				<div class="well">
					<form method="POST" name="validation" action="<?php echo site_url('params-ajouter-collecte'); ?>">

						<!-- <div class="row mb-3">
						<div class="col-sm-2">
							<label class="text-center">Desciption</label>
						</div>
						<div class="col-sm-10">
							<?php
							$val_var = !empty($this->input->post('description')) ? $this->input->post('id_entreprise') : '';
							//echo form_dropdown('id_entreprise', $dt_list_entr, $val_var, " class='form-select'");
							echo form_error('id_entreprise', '<div class="error">', '</div>');
							?>
						</div>
					</div> -->

						<!-- <div class="row mb-3">
						<div class="col-sm-2">
							<label class="text-center">Produit</label>
						</div>
						<div class="col-sm-10">
							<?php
							$val_var = !empty($this->input->post('id_produit')) ? $this->input->post('id_produit') : '';
							//echo form_dropdown('id_produit', $dt_list_prod, $val_var, " class='form-select'");
							echo form_error('id_produit', '<div class="error">', '</div>');
							?>
						</div>
					</div> -->

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Description</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('description'); ?>" name="description">
								<?php echo form_error('description', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Mois</label>
							</div>
							<div class="col-sm-3">
								<select name="mois" class='form-select'>
									<option value="">Choisir...</option>
									<option value="01">Janvier</option>
									<option value="02">Février</option>
									<option value="03">Mars</option>
									<option value="04">Avril</option>
									<option value="05">Mai</option>
									<option value="06">Juin</option>
									<option value="07">Juillet</option>
									<option value="08">Aout</option>
									<option value="09">Septembre</option>
									<option value="10">Octobre</option>
									<option value="11">Novembre</option>
									<option value="12">Décembre</option>
								</select>
								<?php echo form_error('mois', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Année</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('annee'); ?>" name="annee"
								maxlength ="4" minlength ="4" size ="4" />
								<?php echo form_error('annee', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Source</label>
							</div>
							<div class="col-sm-3">
								<select name="id_source" class='form-select'>
									<option value="">Choisir...</option>
									<?php 
										if($dt_source=='1')
										{
											?><option value="bee">BEE</option><?php 
										} 
										else if($dt_source=='2')
										{
											?><option value="bec">BEC</option><?php 
										}
										else if($dt_source=='3')
										{
											?><option value="bec">BEC</option>
											<option value="bee">BEE</option><?php 
										}
									?>
								</select>
								<?php echo form_error('id_source', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Statut</label>
							</div>
							<div class="col-sm-10">
								<select name="statut" id="statut" class="form-select">
									<option value="">Choisir...</option>
									<option value="1">Actif</option>
									<option value="0">Inactif</option>
								</select>
								<?php echo form_error('statut', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<hr>
						<div class="row mb-3">
							<div class="col-sm-4">
							</div>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-success">Enregistrer</button>
							</div>
							<div class="col-sm-4">
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
</div>