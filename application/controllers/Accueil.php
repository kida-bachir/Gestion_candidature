<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accueil extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text_helper');
		$this->load->helper('security');
		//$this->load->helper('gest_menus');
					
		//initialisation de la session	
		$this->load->library('calendar') ;
		$this->load->library('session');		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('javascript');

		$this->load->model('M_home_back', 'm_modele'); 
		$this->m_modele->id_op_saisie = $this->session->can8_g1qsu_30q9o['id'];
		//$this->m_modele->id_site = $this->session->can8_g1qsu_30q9o['id_site'];

	}

	public function home()
	{	
		$curr_profil = strtolower($this->session->can8_g1qsu_30q9o['profil']) ;
		//liste des congés à venir
		//$data['stat_glob_acc']	= $this->m_modele->get_global_stat();
		//demba_debug($this->session->can8_g1qsu_30q9o['profil']);
		$site_name				= $this->session->can8_g1qsu_30q9o['_site_name'];


		if(in_array($curr_profil,array('votant')))//agent de saisie
		{
			$data['nb_prod_entre']	= $data['stat_glob_acc']['nb_prod_entre'];
			$data['nb_prod']		= $data['stat_glob_acc']['nb_prod'];

			//$data['dat_hist']		= $this->m_modele->get_data_histo_one_agent($this->m_modele->id_op_saisie);	
			//demba_debug($data['dat_hist'])		;
			$data['contents']		= 'dashboard/home_user';
		}
		else
		{
				
			///getting the historic
			//$data['histo']	= $this->m_modele->get_data_histo();
			$data['contents']	= 'dashboard/home';
		}	
		$this->load->view('template/layout',$data);
	}

	
	public function ongoing()
	{	
		$data['contents']		= 'dashboard/ongoing';
		$this->load->view('template/layout',$data);
	}


	
	public function home_global()
	{	
		$curr_profil = strtolower($this->session->can8_g1qsu_30q9o['profil']) ;
		//liste des congés à venir
		//$data['stat_glob_acc']	= $this->m_modele->get_global_stat();
		//demba_debug($this->session->can8_g1qsu_30q9o['profil']);
		$site_name				= $this->session->can8_g1qsu_30q9o['_site_name'];


		$data['contents'] = 'frontoffice/front_office';
		$this->load->view('template/layout',$data);
	}
	
	
}

