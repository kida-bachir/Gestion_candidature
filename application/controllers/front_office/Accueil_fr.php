<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil_fr extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('offress/M_Offres', 'm_modele');///Classse modéle générale de travail on travaille avec  l'alias
		//$this->load->model('Global_bdd', 'gl_bdd');  //une classe globale regroupant bcp de méthodes

		$this->load->helper('djitte'); //pour la gestion des droits


		$this->m_modele->id_op_saisie = $this->session->can8_g1qsu_30q9o['id'];    ////////id du user connecté

		$this->link_list 	= 'liste-offres';    //////////lien du breadcrumb envers la liste sera utilisé de maniére dynamique
		$this->nom_elt 		= 'offre';  ///nom de l'élément du CRUD courant qui sera affichée de manière dynamique
	}

	public function index()
	{
		$data_tab = array(
			'bad_token' =>'Erreur car jeton incorrect ou expiré!',
			'error_log' => 'Login et/ou mot de passe incorrect',
			'' =>'',
		);
		$data = array();
		if(!empty($_REQUEST['text']))
		{
			if(!empty( $data_tab[$_REQUEST['text']]))
				$data['error_mess']= $data_tab[$_REQUEST['text']];
		}

		$this->load->view('dashboard/sign-in', $data);
	}
	
	public function big_home_ok()
	{
		$data['all_data'] 	= $this->m_modele->get_data_liste($list_site_name[$id_site]); //CHARGER LES DOnnéeS POUR LA LISTe
		
		demba_debug($data['all_data']);
		$data['contents']	= 'frontoffice/the_front_office';
		$this->load->view('template/layout', $data);
	}

	
}
