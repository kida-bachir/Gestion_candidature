<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."core/MY_Controller_connexion.php");

class C_connexions extends MY_Controller_connexion {

	public function __construct()
	{		

		parent::__construct();	
	    //initialisation de la session	
		$this->load->library('session');
		$this->load->model('M_connexions', 'conn');	
        $this->load->model('Global_bdd'  , 'gl_bdd');  
		//$this->load->model('M_sys_role', 'role');	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('javascript');
	}
 
	public function verif_connexion()
	{
		$login = $this->input->post('username');
		$pass = $this->input->post('password');
		//$ien = $this->input->post('ien');
		$ien = null;
		$datas_user = $this->get_user($login, $pass, $ien);


		//demba_debug($datas_user);
 		if(empty($datas_user))
		{
			//on logue l'erreur de connexion
			$this->histo_save_err_conn($login,$pass);
			header("Location:".site_url()."sign-in?erreur=login&text=error_log");
		}
		else
		{

			$this->start_session($datas_user);
			$photo = '';//file_get_contents("https://apps.education.sn/C_personnel_api/get_pic_src/".$ien);
			$this->session->set_userdata('photo', $photo);
			//histo
			$this->histo_save_enter($datas_user['can8_g1qsu_30q9o'],'in');

			header("Location:".site_url("back-office"));
		}
	}

	public function se_deconnecter()
	{
		//demba_debug($this->session->can8_g1qsu_30q9o);
		//	$this->conn->histo_save_enter($this->session->can8_g1qsu_30q9o,'out');
		$this->histo_save_enter($this->session->can8_g1qsu_30q9o,'out');
		$this->session->sess_destroy();	// destruction des donnees de la session
		header("Location:".site_url());
	}

	private function get_user($login, $pass, $ien)
	{
		
		$datas_user = null;
		$connexion_items = $this->conn->identification($login, $pass, $ien);
		if ($connexion_items != null)
			$datas_user = array(
				'can8_g1qsu_30q9o'=> array(
					'nom'			=> $connexion_items['user_conn'],
					'id'			=> $connexion_items['page_bidar_'],
					'id_site'		=> $connexion_items['id_site'],
					'profil'     	=> $connexion_items['profil_name'],
					'id_profil'		=> $connexion_items['id_profil'],
					'email'			=> $connexion_items['email'],
					'_site_name'	=> strtolower($connexion_items['_site_name']),
				//	'id_type_struct'	=> $connexion_items['id_type_struct'],//$connexion_items['id_profil'],// a dynamiser bddiack
				//	'id_typ_struct_n'=> $connexion_items['id_typ_struct_n'],//$connexion_items['id_profil'],// a dynamiser bddiack
				//	'id_structure'	=> $connexion_items['id_structure'],//$connexion_items['id_profil'],// a dynamiser bddiack
				//	'nom_structure'	=> $connexion_items['nom_structure'],//$connexion_items['id_profil'],// a dynamiser bddiack
				   // 'id_atlas'		=> $connexion_items['id_atlas'],
					'logged_in' 		=> TRUE
				 )
			);

		//demba_debug($connexions_item);
		return $datas_user;
	}


	
	private function histo_save_enter($ses_val, $sens)
	{
		//	demba_debug($ses_val);
		$the_data = array(
			'ip'			=> $_SERVER['REMOTE_ADDR'] ,
			'name_' 		=> $ses_val['nom'],
			'profil_' 		=> $ses_val['profil'],
			'id_site' 		=> '1',
			'navigateur'	=> $_SERVER['HTTP_USER_AGENT'],
			'sens' 			=> $sens,
			//'profil_' 	=> $_SERVER['HTTP_USER_AGENT'],
				
		);
		$this->gl_bdd->insert_one_key("z_connexions", $the_data);
	}

	
	private function histo_save_err_conn($login,$pass)
	{
		//demba_debug($login);
		if(empty($login))
			$login='empty';
		if(empty($pass))
			$pass='empty';

		$the_data = array(
			'ip'			=> $_SERVER['REMOTE_ADDR'] ,
			'login' 		=> $login,
			'mdp' 			=> $pass,
			'navigateur'	=> $_SERVER['HTTP_USER_AGENT'],
			//'profil_' 	=> $_SERVER['HTTP_USER_AGENT'],
				
		);
		$this->gl_bdd->insert_one_key("z_log_error_connexions", $the_data);
	}


}
