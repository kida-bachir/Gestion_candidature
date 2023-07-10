<?php show_breadcrumbs($breadcrumbs);   ?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>


		<div class="row">
			<div class="col-lg-10">
				<table class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td>Utilisateur </td>
							<td><strong><?php echo $date_one_element['_agent']; ?></strong></td>
						</tr>
						<tr>
							<td>Profil</td>
							<td><strong><?php echo $date_one_element['_profil']; ?></strong></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><strong><?php echo $date_one_element['email']; ?></strong></td>
						</tr>
						<tr>
							<td>Bureau</td>
							<td><strong><?php echo $date_one_element['_service']; ?></strong></td>
						</tr>
						<tr>
							<td>Commentaires</td>
							<td><strong><?php echo $date_one_element['commentaires']; ?></strong></td>
						</tr>
						<tr>
							<td>Etat</td>
							<td><strong><?php echo $date_one_element['etat']; ?></strong></td>
						</tr>
						<tr>
							<td>Compte crée par</td>
							<td><strong><?php echo $date_one_element['_created_by']; ?></strong></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<!--end du row -->



	</div>
</div>