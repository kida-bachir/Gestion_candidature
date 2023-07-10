<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>


	<div class="row">
		<div class="col-sm-8 col-sm-offset-3">

			<div class="well">
				<form method="POST" name="validation" action="<?php  echo site_url('offre-ajouter')  ?>">
					<?php //a dynamiser
						//$val_var = !empty(set_value('code_elt')) ? set_value('code_elt') : $code_elt;
					?>
					<!--input type="hidden" value="<?php //echo $val_var; ?>" name="code_elt"  -->

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Catégorie</label>
						</div>
						<div class="col-sm-8">
						<?php
							$options = array(
								''	=> 'Choisir...',
								'1'	=> 'Actif',
								'0'	=> 'Inactif',
							);
							$val_var = !empty($this->input->post('id_categorie')) ? $this->input->post('id_categorie') : '';
							echo form_dropdown('id_categorie', $dt_categ, $val_var, " class='form-select'");
							
							echo form_error('id_categorie', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Libellé</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('libelle')) ? set_value('libelle') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="libelle">
							<?php echo form_error('libelle', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Date lancement</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('date_publication')) ? set_value('date_publication') : '';
							?>
							<input type="date" class="form-control" value="<?php echo $val_var; ?>" name="date_publication">
							<?php echo form_error('date_publication', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Date clôture</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('date_cloture')) ? set_value('date_cloture') : '';
							?>
							<input type="date" class="form-control" value="<?php echo $val_var; ?>" name="date_cloture">
							<?php echo form_error('date_cloture', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Description</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('description')) ? set_value('description') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="description">
							<?php echo form_error('description', '<div class="error">', '</div>'); ?>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-4">
							<label class="text-center">Autres comments</label>
						</div>
						<div class="col-sm-8">
							<?php
								$val_var = !empty(set_value('text_details')) ? set_value('text_details') : '';
							?>
							<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="text_details">
							<?php echo form_error('text_details', '<div class="error">', '</div>'); ?>
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


					<!--div class="row mb-3">
					<div class="col-sm-4">
						<label class="text-center">Structure</label>
					</div>
					<div class="col-sm-8">
						<select name="id_structure_deposant" id="id_structure_deposant" class="form-select" required="" aria-required="true">
							<?php
							//echo gen_option_for_a_select($dt_struct);
							?>
						</select>                            
						<?php //echo form_error('id_structure_deposant', '<div class="error">', '</div>'); 
						?>
					</div>
				</div-->



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