<?php show_breadcrumbs($breadcrumbs);   ?>
<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>


		<div class="row">
			<div class="col-sm-8 col-sm-offset-3">

				<div class="well">
					<form method="POST" name="validation" action="<?php echo site_url('modifier-utilisateur/' . $code_elt); ?>">
						<?php
						$val_var = !empty(set_value('code_elt')) ? set_value('code_elt') : $code_elt;
						?>
						<input type="hidden" value="<?php echo $val_var; ?>" name="code_elt">
						
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Prénom</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('prenom')) ? set_value('prenom') : $dat_one_elt['prenom'];
								?>
								<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="prenom">
								<?php echo form_error('prenom', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Nom</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('nom')) ? set_value('nom') : $dat_one_elt['nom'];
								?>
								<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="nom">
								<?php echo form_error('nom', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Profil</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty($this->input->post('id_type_profil'))?$this->input->post('id_type_profil'):$dat_one_elt['id_type_profil'];
								echo form_dropdown('id_type_profil', $dt_list_prof, $val_var," class='form-select'");
								echo form_error('id_type_profil', '<div class="error">', '</div>'); 
								 ?>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Email</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('email')) ? set_value('email') : $dat_one_elt['email'];
								?>
								<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="email">
								<?php echo form_error('email', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Service:</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('id_site')) ? set_value('id_site') : $dat_one_elt['id_site'];
								//$val_var = !empty($this->input->post('id_site'))?$this->input->post('id_site'):$dat_one_elt['id_site'];
								echo form_dropdown('id_site', $dt_list_serv, $val_var," class='form-select'");
								echo form_error('id_site', '<div class="error">', '</div>'); 
								?>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Commentaire</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('commentaires')) ? set_value('commentaires') : $dat_one_elt['commentaires'];
								?>
								<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="commentaires">
								<?php echo form_error('commentaires', '<div class="error">', '</div>'); ?>
							</div>
						</div>



						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Etat compte</label>
							</div>
							<div class="col-sm-10">

								<?php
								$options = array(
									''	=> 'Choisir...',
									'actif'		=> 'Actif',
									'suspendu'	=> 'Suspendu',
									'blocke'	=> 'Blocke',
								);
									$val_var = !empty(set_value('etat')) ? set_value('etat') : $dat_one_elt['etat'];
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