


    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo site_url('front-office'); ?>">En cours</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

<div class="card-body">

              <h5 class="card-title">Résultat chargement</h5>

              
              <?php  
              if(empty($we_have_errors))
              {
                ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Données enegistrer avec succès <h3>(<?php echo $nb_migrated_row;  ?> lignes chargées) </h3>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

                <a href="<?php echo site_url('params-details-collectes/'.$code_elt);  ?>">
                  <button type="button" id="btn_add" class="btn btn-info">
                    Retourner à la page <span class="m-l-5"><i class="fa fa-plus-square"></i></span>
                  </button>
                </a>

                <?php  
              }
              else
              {
                ?><div class="alert alert-danger alert-dismissible fade show" role="alert">
               Erreurs lors du chargement
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php  
              }
              ?>

            </div>

      </div>
    </section>

