<?php show_breadcrumbs($breadcrumbs);   ?>


<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>

		<form method="post" action="<?php echo site_url('saisie-valider-donnees/' . $code_elt)   ?>">
			<input type='hidden' value='<?php echo $code_elt;  ?>' name='code_elt'>
			<input type='hidden' value='<?php echo $date_one_element['id_source'];  ?>' name='id_source'>

			<div class="row">

				<div class="col-lg-5">

					<table class="table table-bordered table-striped">
						<tbody>

						<?php 
							if(!empty($is_auth_validate))
							{							
						?>
							<tr>
								<td>
									<div>

										<a href="<?php echo site_url('params-valider-all-collectes/' . $code_elt);  ?>" class='on-default btn_edit'>
											<button type="button" <?php echo site_url('params-valider-all-collectes/'  . $code_elt);  ?> class="btn btn-success">Valider tout</button>
									</div>
								</td>
							</tr>
						<?php 
							}
						?>
							
							<tr>
								<td>Description</td>
								<td><strong><?php echo $date_one_element['description']; ?></strong></td>
							</tr>

							<tr>
								<td>Mois</td>
								<td><strong><?php echo $date_one_element['mois']; ?></strong></td>
							</tr>
							<tr>
								<td>Annee</td>
								<td><strong><?php echo $date_one_element['annee']; ?></strong></td>
							</tr>
							<tr>
								<td>Source</td>
								<td><strong><?php echo $date_one_element['id_source']; ?></strong></td>
							</tr>
							<tr>
								<td>Statut</td>
								<td><strong><?php echo show_state_color($date_one_element['statut']); ?></strong></td>
							</tr>


							<!-- <tr>
							<td>Date de modification</td>
							<td><strong><?php echo show_state_color($date_one_element['date_last_modif']); ?></strong></td>
						</tr> -->
							<tr>
								<td>Enregistré par</td>
								<td><strong><?php echo $date_one_element['_id_op_saisie']; ?></strong></td>
							</tr>
						</tbody>
					</table>
					<?php 
							if(!empty($is_auth_validate))
							{							
						?>
					<div>
						<button type="submit" class="btn btn-success">Valider</button>
					</div>

					<?php 
							}
						?>

				</div>



				<div class="col-lg-7">

					<table id='datatable-buttons' class='datatable table table-striped table-bordered'>

						<thead>
							<tr>
								<th>Sigle </th>
								<th>Code Prod</th>
								<th>Libellé prod</th>
								<th>Valeur</th>
								<th>Unité</th>
								<th>Validité</th>
							</tr>
						</thead>


						<tbody>
							<?php
							if (!empty($date_one_element_val))
								foreach ($date_one_element_val as $value) {
							?>
								<tr>
									<td><?php
										if (!empty($value->sigle))
											echo $value->sigle;
										else echo '';
										?></td>
									<td><?php
										if (!empty($value->code))
											echo $value->code;
										else if (!empty($value->identifiant_produit))
											echo $value->identifiant_produit;
										?></td>
									<td><?php echo $value->_libelle_prod; ?></td>
									<td><?php echo $value->valeur; ?></td>
									<td><?php
										if (!empty($value->_unite))
											echo $value->_unite;
										else echo '';
										?></td>

									<td>
										<?php
										if ($value->etat == '2') {
										?><span class="badge bg-success"> Oui </span><?php
																					} else {
																						?>


											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="gridCheck1" name="<?php echo 'field_' . $value->id ?>">
												<label class="form-check-label" for="gridCheck1">
													Non
												</label>
											</div>
										<?php
																					}

										?>

									</td>


								</tr>

							<?php
								}
							?>

						</tbody>

					</table>




				</div>



			</div>
			<!--end du row -->
		</form>

	</div>
</div>