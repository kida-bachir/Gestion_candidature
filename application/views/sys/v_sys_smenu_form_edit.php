<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>


		<div class="row">
			<div class="col-sm-8 col-sm-offset-3">

				<div class="well">
					<form method="POST" name="validation" action="<?php echo site_url('params-modifier-smenu/' . $code_elt); ?>">
						<?php //a dynamiser
						$val_var = !empty(set_value('code_elt')) ? set_value('code_elt') : $code_elt;
						?>
						<input type="hidden" value="<?php echo $val_var; ?>" name="code_elt">
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Menu</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty($this->input->post('id_menu')) ? $this->input->post('id_menu') : $dat_one_elt['id_menu'];
								echo form_dropdown('id_menu', $dt_list_sect, $val_var, " class='form-select'");

								?>
								<?php echo form_error('id_menu', '<div class="error">', '</div>'); ?>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Code</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('code')) ? set_value('code') : $dat_one_elt['code'];
								?>
								<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="code">
								<?php echo form_error('code', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Libellé</label>
							</div>
							<div class="col-sm-10">
								<?php
								$val_var = !empty(set_value('libelle')) ? set_value('libelle') : $dat_one_elt['libelle'];
								?>
								<input type="text" class="form-control" value="<?php echo $val_var; ?>" name="libelle">
								<?php echo form_error('libelle', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Etat</label>
							</div>
							<div class="col-sm-10">
								<?php
								$options = array(
									''	=> 'Choisir...',
									'1'	=> 'Actif',
									'0'	=> 'Inactif',
								);

								$val_var = !empty($this->input->post('etat')) ? $this->input->post('etat') : $dat_one_elt['etat'];
								echo form_dropdown('etat', $options, $val_var, " class='form-select'");

								?>
								<?php echo form_error('etat', '<div class="error">', '</div>'); ?>
							</div>
						</div>


						<!--div class="row mb-3">
						<div class="col-sm-2">
							<label class="text-center">Structure</label>
						</div>
						<div class="col-sm-10">
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