<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">

		<h5 class="card-title"><?php echo $title ?></h5>

		<div class="row ">
			<div class="col-sm-8 col-sm-offset-3">

				<div class="well">
					<form method="POST" name="validation" action="<?php echo site_url('params-ajouter-entreprises-secteur'); ?>">


						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Libellé</label>
							</div>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value('libelle'); ?>" name="libelle">
								<?php echo form_error('libelle', '<div class="error">', '</div>'); ?>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-2">
								<label class="text-center">Commentaires</label>
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
									<option value="1">Actif</option>
									<option value="0">Inactif</option>
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