<?php show_breadcrumbs($breadcrumbs);   ?>


<!-- Page-Title -->
<?php
if (!empty($rdc2_rights['add'])) 
{
?>
    <div class='row'>
        <div class='col-sm-12' style='margin-bottom: 30px'>
            <a href="<?php echo site_url('params-ajouter-pays');  ?>">
                <button type='button' id='btn_add' class='btn btn-info'>Nouveau <span class='m-l-5'><i class='fa fa-plus-square'></i></span></button>
            </a>
        </div>
    </div>
<?php
}
?>



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
                                        <th>Code</th>
                                        <th>alpha2</th>
                                        <th>alpha3 </th>
                                        <th>nom_en_gb</th>
                                        <th>nom_fr_fr</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_data as $value) 
                                    {
                                     //   if($site_name == $value->id_source || $site_name=='ANSD')
                                      //  {
                                            ?>
                                            <tr>
                                                <td><?php echo $value->code; ?></td>
                                                <td><?php echo $value->alpha2; ?></td>
                                                <td><?php echo $value->alpha3; ?></td>
                                                <td><?php echo $value->nom_en_gb; ?></td>
                                                <td><?php echo $value->nom_fr_fr; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('params-details-pays/' . $value->id);  ?>" class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                                    <?php 
                                                        if($value->etat=='1')
                                                            {

                                                                echo "<span class='badge bg-success rounded-pill'> &nbsp; &nbsp; &nbsp; &nbsp; </span>"; 

                                                            }
                                                        else
                                                            echo "<span class='badge bg-danger rounded-pill'> &nbsp; &nbsp; &nbsp; &nbsp; </span>"; 
                                                    ?>
                                                    </a>
                                                </td>
                                                <!--td>
                                                    <a href="<?php //echo site_url('params-details-collectes/' . $value->id);  ?>" class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                                        <?php //show_state_color($value->statut); ?>
                                                    </a>
                                                </td-->
                                               
                                            </tr>
                                        <?php
                                        }

                                   
                                  //  }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 
    <div class='col-md-6'>
        <div class='panel panel-default'>
            <div class='panel-body'>

                <div class='card'>
                    <div class=" table-responsive">
                        <div class="col-sm-66">
                            <table id='datatable-buttons' class='datatable table table-striped table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Desciption </th>

                                        <th>validation</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_data as $value) {
                                    ?>
                                        <tr>

                                            <td><?php echo $value->description; ?></td>

                                            <td>
                                                <a href="<?php echo site_url('params-validation-collectes/' . $value->id);  ?>" class='on-default btn_edit' id='<?php echo $value->id; ?>'>
                                                    <?php show_state_color($value->statut); ?>
                                                </a>
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
    </div> -->

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
                url: '<?php echo site_url('params-supprimer-collectes/') ?>' + id,
                //type: "GET",
                //dataType: "HTML",
                success: function(data) {
                    window.location.replace('params-collectes');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
            $('#verticalycentered').modal('hide');

        });


    });
</script>