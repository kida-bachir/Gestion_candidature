<?php show_breadcrumbs($breadcrumbs);   ?>

<!-- Page-Title -->
<div class='row'>
    <div class='col-sm-12' style='margin-bottom: 30px'>
        <a href="<?php echo site_url('ajouter-profil');  ?>">
            <button type='button' id='btn_add' class='btn btn-info'>Nouveau <span class='m-l-5'><i class='fa fa-plus-square'></i></span></button>
        </a>
    </div>
</div>



<div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirmer la suppression!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Confirmer-vous la suppression de l'élément?
            <input type='hidden' class='hiddenid' name ='hiddenid' value="" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary">Supprimer</button>
        </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->


<div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-default'>
            <div class='panel-body'>

            <div class='card'>
                <div class=" table-responsive">
                    <div class="col-sm-12">
                    <table id='datatable-buttons' class='datatable table table-striped table-bordered'>
                        <thead>
                        <tr>
                            <th>Libellé </th>
                            <th>Date last modif</th>
                            <th>Etat </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_data as $value) 
                        { 
                        ?>
                            <tr>
                                <td><?php echo $value->libelle_type_profil	; ?></td>
                                <td><?php echo $value->date_last_modif; ?></td>
                             <td>
                             <a href="<?php echo site_url('attribuer-roles/'.$value->id) ?>"
                             	profil="<?php echo $value->libelle_type_profil;?>" 
                                id_profil="<?php echo $value->id;?>" 
                             class="btn-role btn btn-inverse waves-effect waves-light btn-xs m-b-5">
                             <i class="fa fa-cog fa-lg"></i><span> Role</span></a>
                             </td>
                                <td> <?php  show_state_color($value->etat);  ?></td>
                                <td class='actions' style='width: 1%; text-align: center; white-space: nowrap'>
                                
                                <?php 
                                    //if(!empty($auth['update'])  /*&& empty($value->_nb_impute)*/ )//si autorisé à modifié et non encore imputé
                                    //{
                                    ?>
                                        <a href='<?php echo site_url('modifier-profil/'.$value->id); ?>' class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                            <i class='fa fa-pencil'></i></a>
                                        &nbsp;
                                        <a href='#' class='on-default btn_delete' id='<?php echo $value->id; ?>' data-bs-toggle="modal" data-bs-target="#verticalycentered">
                                            <i class='fa fa-trash-o' style='color:red'></i>
                                        </a>
                                        &nbsp;
                                        <a href="<?php echo site_url('details-profil/'.$value->id);  ?>" class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                            <i class='fa fa-eye' style='color:#CCCCCC'></i></a>
                                    <?php 
                                    //} 
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
            </div>

            </div>
        </div>
    </div>

</div> <!-- End Row -->





<script type="text/javascript">
    $(document).ready(function () {

        $(document).on("click", ".btn_delete", function () {
            var passedID 	    = $(this).attr('id');
            $(".modal-body .hiddenid ").val(passedID);
        });

        $(".btn-primary").click(function () {
            var id 	    = $(".hiddenid").val();
			$.ajax(
			{
				url: '<?php echo site_url('supprimer-profil/') ?>' + id,
				//type: "GET",
				//dataType: "HTML",
				success: function (data) {
                    window.location.replace('liste-profils');
				},
				error: function (jqXHR, textStatus, errorThrown) {
					alert('Error adding / update data');
				}
			});
			$('#verticalycentered').modal('hide'); 

        });



        		
		$('.btn-role').on('click', function (event)
		{
			var id_cur_profil 	= $(this).attr('id_profil');
			var cur_profil 		= $(this).attr('profil');

            //alert(cur_profil);
			//Appel controller/action/id
			$.ajax(
			{
				url: '<?php echo site_url('sys/C_sys_profils/get_menu_liste/') ?>' + id_cur_profil,
				type: "GET",
				dataType: "HTML",
				success: function (data) {
					//alert(data);
					$('#modal-body').html(data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					alert('Error adding / update data');
				}
			});

			$("#role_profil").text(cur_profil);
			$("#id_role_profil").val(id_cur_profil);
			$('#modal_role').modal('show');
		});





    });
</script>