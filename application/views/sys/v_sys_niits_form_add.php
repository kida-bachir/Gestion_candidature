<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>

		<div class="row">
			<div class="col-sm-8 col-sm-offset-3">

				<div class="well">
					<form method="POST" name="validation" action="<?php echo site_url('ajouter-utilisateur'); ?>">

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Prénom</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('prenom'); ?>" name="prenom">
								<?php echo form_error('prenom', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Nom</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('nom'); ?>" name="nom">
								<?php echo form_error('nom', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Profil</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty($this->input->post('id_type_profil')) ? $this->input->post('id_type_profil') : '';
								echo form_dropdown('id_type_profil', $dt_list_prof, $val_var, " class='form-select'");
								?>
								<?php echo form_error('id_type_profil', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Service</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty($this->input->post('id_site')) ? $this->input->post('id_site') : '';
								echo form_dropdown('id_site', $dt_list_serv, $val_var, " class='form-select'");
								?>
								<?php echo form_error('id_site', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Email</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('email'); ?>" name="email">
								<?php echo form_error('email', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						<!-- <div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Bureau</label>
							</div>
							<div class="col-sm-10">
								<select name="bureau" class="form-select">
									<option value="">Choisir...</option>
									<option value="01">BEC</option>
									<option value="02">BEE</option>
								</select>
								<?php echo form_error('bureau', '<div class="error">', '</div>'); ?>
							</div>
						</div> -->

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Commentaires:</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('commentaires'); ?>" name="commentaires">
								<?php echo form_error('commentaires', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Etat</label>
							</div>
							<div class="col-sm-10">
								<select name="etat" id="etat" class="form-select">
									<option value="">Choisir...</option>
									<option value="actif">Actif</option>
									<option value="suspendu">suspendu</option>
									<option value="blocke">blocke</option>
								</select>
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