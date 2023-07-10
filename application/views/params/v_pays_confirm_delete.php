<?php show_breadcrumbs($breadcrumbs);   ?>


<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $title ?></h5>

		<div class="row">
			<div class="col-lg-10">
				<table class="table table-bordered table-striped">
					<tbody>

						<tr>
							<td>Confirmé?</td>
							<td><a href=<?php   echo site_url('params-supprimer-pays-ok/'.$code_elt) ?> ><button type="button" class="btn btn-danger">Cliquer ici pour supprimer</button></a></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<!--end du row -->


	</div>
</div>