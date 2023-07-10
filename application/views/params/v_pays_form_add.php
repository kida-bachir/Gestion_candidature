<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>


	<div class="row">
		<div class="col-sm-8 col-sm-offset-3">

			<div class="well">
				<form method="POST" name="validation" action="<?php  echo site_url('params-ajouter-pays')  ?>">
					<?php //a dynamiser
						//$val_var = !empty(set_value('code_elt')) ? set_value('code_elt') : $code_elt;
					?>
					<!--input type="hidden" value="<?php //echo $val_var; ?>" name="code_elt"  -->


					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">code</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('code')) ? set_value('code') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="code">
							<?php echo form_error('code', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Alpha2</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('alpha2')) ? set_value('alpha2') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="alpha2">
							<?php echo form_error('alpha2', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Alpha3</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('alpha3')) ? set_value('alpha3') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="alpha3">
							<?php echo form_error('alpha3', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Nom en anglais</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('nom_en_gb')) ? set_value('nom_en_gb') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="nom_en_gb">
							<?php echo form_error('nom_en_gb', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Nom en français</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('nom_fr_fr')) ? set_value('nom_fr_fr') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="nom_fr_fr">
							<?php echo form_error('nom_fr_fr', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Statut</label>
						</div>
						<div class="col-sm-8">
							<?php
							$options = array(
								''	=> 'Choisir...',
								'1'	=> 'Actif',
								'0'	=> 'Inactif',
							);

							$val_var = !empty($this->input->post('etat')) ? $this->input->post('etat') : '';
							echo form_dropdown('etat', $options, $val_var, " class='form-select'");

							?>
							<?php echo form_error('etat', '<div class="error">', '</div>'); ?>
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