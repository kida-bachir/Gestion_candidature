<?php show_breadcrumbs($breadcrumbs);   ?>

<!-- Page-Title -->
<div class='row'>
    <div class='col-sm-12' style='margin-bottom: 30px'>
        <a href="<?php echo site_url('ajouter-utilisateur');  ?>">
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
                <input type='hidden' class='hiddenid' name='hiddenid' value="" />
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
                                        <th>Agent </th>
                                        <th>Profil</th>
                                        <th>Service/Site</th>
                                        <th>Email</th>
                                        <th>Commentaire</th>
                                        <th>Etat compte</th>
                                        <th>Date création</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_data as $value) {
                                    ?>
                                        <tr>
                                            <td><?php echo $value->_agent; ?></td>
                                            <td><?php echo $value->_profil; ?></td>
                                             <td><?php echo $value->_service; ?></td> 
                                            <td><?php echo $value->email; ?></td>

                                            <td><?php echo $value->commentaires; ?></td>

                                            <td>
                                                <a href="<?php echo site_url('details-utilisateur/' . $value->id);  ?>" class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                                    <?php show_state_user_color($value->etat);  ?>
                                                </a>
                                            </td>

                                            <td><?php echo $value->date_creation; ?></td>
                                            <td class='actions' style='width: 1%; text-align: center; white-space: nowrap'>

                                                <?php
                                                //if(!empty($auth['update'])  /*&& empty($value->_nb_impute)*/ )//si autorisé à modifié et non encore imputé
                                                //{
                                                ?>
                                                <a href='<?php echo site_url('modifier-utilisateur/' . $value->id); ?>' class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                                    <i class='fa fa-pencil'></i></a>

                                                &nbsp;
                                                <a href="<?php echo site_url('details-utilisateur/' . $value->id);  ?>" class='on-default btn_edit' id='<?php echo $value->id; ?>'>
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
    $(document).ready(function() {

        $(document).on("click", ".btn_delete", function() {
            var passedID = $(this).attr('id');
            $(".modal-body .hiddenid ").val(passedID);
        });

        $(".btn-primary").click(function() {
            var id = $(".hiddenid").val();
            $.ajax({
                url: '<?php echo site_url('supprimer-utilisateur/') ?>' + id,
                //type: "GET",
                //dataType: "HTML",
                success: function(data) {
                    window.location.replace('liste-utilisateurs');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
            $('#verticalycentered').modal('hide');

        });


    });
</script>