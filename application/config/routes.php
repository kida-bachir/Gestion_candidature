<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    | -------------------------------------------------------------------------
    | URI ROUTING
    | -------------------------------------------------------------------------
    | This file lets you re-map URI requests to specific controller functions.
    |
    | Typically there is a one-to-one relationship between a URL string
    | and its corresponding controller class/method. The segments in a
    | URL normally follow this pattern:
    |
    |	example.com/class/method/id/
    |
    | In some instances, however, you may want to remap this relationship
    | so that a different class/function is called than the one
    | corresponding to the URL.
    |
    | Please see the user guide for complete details:
    |
    |	https://codeigniter.com/user_guide/general/routing.html
    |
    | -------------------------------------------------------------------------
    | RESERVED ROUTES
    | -------------------------------------------------------------------------
    |
    | There are three reserved routes:
    |
    |	$route['default_controller'] = 'welcome';
    |
    | This route indicates which controller class should be loaded if the
    | URI contains no data. In the above example, the "welcome" class
    | would be loaded.
    |
    |	$route['404_override'] = 'errors/page_missing';
    |
    | This route will tell the Router which controller/method to use if those
    | provided in the URL cannot be matched to a valid route.
    |
    |	$route['translate_uri_dashes'] = FALSE;
    |
    | This is not exactly a route, but allows you to automatically route
    | controller and method names that contain dashes. '-' isn't a valid
    | class or method name character, so it requires translation.
    | When you set this option to TRUE, it will replace ALL dashes in the
    | controller and method URI segments.
    |
    | Examples:	my-controller/index	-> my_controller/index
    |		my-controller/my-method	-> my_controller/my_method
*/

    $route['default_controller']    = 'Welcome/big_home';
    $route['404_override']          = 'Custom404';
    //$route['translate_uri_dashes']  = FALSE; 

    //$route['infos_utiles/([A-Za-z0-9-]+)']        = 'C_gest_info_utiles/list_by_category/$1';

    $route['en-cours']                   = 'Accueil/ongoing';
    $route['bienvenu']                   = 'Welcome/big_home';
    

    $route['sign-in']                   = 'Welcome/index';
    $route['verif-connexion']           = 'C_connexions/verif_connexion';
    $route['se-deconnecter']            = 'C_connexions/se_deconnecter';
    $route['back-office']              = 'Accueil/home';

    $route['liste/([A-Za-z0-9-]+)']     = 'perfplusfrmk/C_sama_list/index/$1';


	/////////////////////:params
	$route['liste-offres']                    = 'offres/C_Offres/index';
    $route['offre-details/([A-Za-z0-9-]+)']   = 'offres/C_Offres/show_one_elt/$1';
    $route['offre-ajouter']                   = 'offres/C_Offres/add_one_element';

    ///
	$route['params-liste-pays']                     = 'params/C_par_pays/index';
    $route['params-ajouter-pays']                   = 'params/C_par_pays/add_one_element';
    $route['params-modifier-pays/([A-Za-z0-9-]+)']  = 'params/C_par_pays/edit_one_elt/$1';
    $route['params-details-pays/([A-Za-z0-9-]+)']   = 'params/C_par_pays/show_one_elt/$1';
    $route['params-supprimer-pays/([A-Za-z0-9-]+)'] = 'params/C_par_pays/confirm_delete_one_elt/$1';
    $route['params-supprimer-pays-ok/([A-Za-z0-9-]+)'] = 'params/C_par_pays/delete_one_elt/$1';















    /////////sys
    $route['liste-utilisateurs']                    = 'sys/C_sys_niits/index';
    $route['ajouter-utilisateur']                   = 'sys/C_sys_niits/add_one_element';
    $route['modifier-utilisateur/([A-Za-z0-9-]+)']  = 'sys/C_sys_niits/edit_one_elt/$1';
    $route['details-utilisateur/([A-Za-z0-9-]+)']   = 'sys/C_sys_niits/show_one_elt/$1';
    $route['supprimer-utilisateur/([A-Za-z0-9-]+)'] = 'sys/C_sys_niits/delete_one_elt/$1';
    $route['liste-profils']                    = 'sys/C_sys_profils/index';
    $route['ajouter-profil']                   = 'sys/C_sys_profils/add_one_element';
    $route['modifier-profil/([A-Za-z0-9-]+)']  = 'sys/C_sys_profils/edit_one_elt/$1';
    $route['details-profil/([A-Za-z0-9-]+)']   = 'sys/C_sys_profils/show_one_elt/$1';
    $route['supprimer-profil/([A-Za-z0-9-]+)'] = 'sys/C_sys_profils/delete_one_elt/$1';
	$route['params-liste-menu']                     = 'sys/C_sys_menu/index';
	$route['params-ajouter-menu']                   = 'sys/C_sys_menu/add_one_element';
	$route['params-modifier-menu/([A-Za-z0-9-]+)']  = 'sys/C_sys_menu/edit_one_elt/$1';
	$route['params-details-menu/([A-Za-z0-9-]+)']   = 'sys/C_sys_menu/show_one_elt/$1';
	$route['params-supprimer-menu/([A-Za-z0-9-]+)'] = 'sys/C_sys_menu/delete_one_elt/$1';
	$route['params-liste-smenu']                     = 'sys/C_sys_smenu/index';
	$route['params-ajouter-smenu']                   = 'sys/C_sys_smenu/add_one_element';
	$route['params-modifier-smenu/([A-Za-z0-9-]+)']  = 'sys/C_sys_smenu/edit_one_elt/$1';
	$route['params-details-smenu/([A-Za-z0-9-]+)']   = 'sys/C_sys_smenu/show_one_elt/$1';
	$route['params-supprimer-smenu/([A-Za-z0-9-]+)'] = 'sys/C_sys_smenu/delete_one_elt/$1';
	
	$route['attribuer-roles/([A-Za-z0-9-]+)'] = 'sys/C_sys_profils/get_menu_liste/$1';
