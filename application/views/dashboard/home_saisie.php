


    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo site_url('front-office'); ?>l">Accueil</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
	
	
 <div class="row">

	<!-- Sales Card -->
	<div class="col-xxl-3 ">
	  <div class="card info-card sales-card">

		<div class="card-body">
		  <h5 class="card-title">Données</h5>

		  <div class="d-flex align-items-center">

			<div class="ps-3">
			  <h6><?php echo $all_collectes ?></h6>
			  <span class="text-success small pt-1 fw-bold"><?php echo $act_datas ?> actives </span> 

			</div>
		  </div>
		</div>

	  </div>
	</div><!-- End Sales Card -->
	

	<!-- Sales Card -->
	<div class="col-xxl-3 ">
	  <div class="card info-card sales-card">

		<div class="card-body">
		  <h5 class="card-title">Collectes</h5>

		  <div class="d-flex align-items-center">

			<div class="ps-3">
			  <h6><?php echo $all_collectes ?></h6>
			  <span class="text-success small pt-1 fw-bold"><?php echo $act_collectes ?> actives </span> 

			</div>
		  </div>
		</div>

	  </div>
	</div><!-- End Sales Card -->
	

	<!-- Sales Card -->
	<div class="col-xxl-3 ">
	  <div class="card info-card sales-card">

		<div class="card-body">
		  <h5 class="card-title">Produits entreprises</h5>

		  <div class="d-flex align-items-center">

			<div class="ps-3">
			  <h6><?php echo $nb_prod_entre ?> </h6>
			  <span class="text-success small pt-1 fw-bold"><?php echo $nb_prod ?> produits </span> 

			</div>
		  </div>
		</div>

	  </div>
	</div><!-- End Sales Card -->
	

	<!-- Sales Card -->
	<div class="col-xxl-3 ">
	  <div class="card info-card sales-card">

		<div class="card-body">
		  <h5 class="card-title">Indices</h5>

		  <div class="d-flex align-items-center">

			<div class="ps-3">
			  <h6>15</h6>
			  <span class="text-success small pt-1 fw-bold">12 actives </span> 

			</div>
		  </div>
		</div>

	  </div>
	</div><!-- End Sales Card -->
	


	
  </div>	
	
	
	
	
      <div class="row">

        <div class="col-lg-8"><!-- Left side columns -->
<div class="col-12">
  <div class="card recent-sales overflow-auto">

	<div class="card-body">
	  <h5 class="card-title">Dernières saisies <span>| Mois</span></h5>

	  <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
		    <div class="dataTable-top"><div class="dataTable-dropdown"><label><select class="dataTable-selector"><option value="5">5</option><option value="10" selected="">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select> ligne par page</label></div><div class="dataTable-search"><input class="dataTable-input" placeholder="Rechercher..." type="text"></div></div><div class="dataTable-container">
		<table class="table table-borderless datatable dataTable-table">
		 <thead>
		  <tr>
		      <th scope="col" data-sortable=""><a href="#" class="dataTable-sorter">Période</a></th>
			  <th scope="col" data-sortable=""><a href="#" class="dataTable-sorter">Entreprise</a></th>
			  <th scope="col" data-sortable=""><a href="#" class="dataTable-sorter">Produit</a></th>
			  <th scope="col" data-sortable=""><a href="#" class="dataTable-sorter">Valeur</a></th></tr>
		 </thead> 
		 <tbody>
		  <?php
		  foreach($dat_hist as $one_row)
		  {
			?>  
			<tr>
				<th scope="row"><a href="#"><?php echo $one_row->_mois.' '.$one_row->annee; ?></a></th>
				<td><?php echo $one_row->_libelle_entreprise; ?></td>
				<td><?php echo $one_row->_libelle_prod.' ('.$one_row->_unite.')'; ?></td>
				<td><?php echo $one_row->valeur ?></td>
			</tr>
			 <?php
		  }
		  ?>
	     </tbody>
	    </table>
	
	</div><div class="dataTable-bottom"><div class="dataTable-info">Affichage de 1 à 5 de 5 lignes</div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list"></ul></nav></div></div>

	</div>

  </div>
</div>
        </div><!-- End Left side columns -->

        <div class="col-lg-4"><!-- Right side columns -->
<div class="col-12">
  <div class="card top-selling overflow-auto">

	<div class="filter">
	  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
	  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
		<li class="dropdown-header text-start">
		  <h6>Filter</h6>
		</li>

		<li><a class="dropdown-item" href="#">Today</a></li>
		<li><a class="dropdown-item" href="#">This Month</a></li>
		<li><a class="dropdown-item" href="#">This Year</a></li>
	  </ul>
	</div>

	<div class="card-body pb-0">
	  <h5 class="card-title">Top Selling <span>| Today</span></h5>

	  <table class="table table-borderless">
		<thead>
		  <tr>
			<th scope="col">Product</th>
			<th scope="col">Price</th>
			<th scope="col">Sold</th>
			<th scope="col">Revenue</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
			<td>$64</td>
			<td class="fw-bold">124</td>
			<td>$5,828</td>
		  </tr>
		  <tr>
			<td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
			<td>$46</td>
			<td class="fw-bold">98</td>
			<td>$4,508</td>
		  </tr>
		  <tr>
			<td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
			<td>$59</td>
			<td class="fw-bold">74</td>
			<td>$4,366</td>
		  </tr>
		  <tr>
			<td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
			<td>$32</td>
			<td class="fw-bold">63</td>
			<td>$2,016</td>
		  </tr>
		  <tr>
			<td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
			<td>$79</td>
			<td class="fw-bold">41</td>
			<td>$3,239</td>
		  </tr>
		</tbody>
	  </table>

	</div>

  </div>
</div>
        </div><!-- End Right side columns -->

      </div>
    </section>

