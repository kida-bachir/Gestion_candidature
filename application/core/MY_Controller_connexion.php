<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller_connexion extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
	    //initialisation de la session	
		$this->load->model('M_sys_role', 'role');
	} 

	protected function start_session($data_user)
	{


		//$this->session->set_userdata($data_user);

//demba_debug($data_user);			
			//BAKS Recuperation des roles
			$id_profil 	= $data_user['can8_g1qsu_30q9o']['id_profil'];
		//	$ien 		=  $data_user['can8_g1qsu_30q9o']['ien'];
			$id_site 	= $data_user['can8_g1qsu_30q9o']['id_site'];

			$tab_mrole	= array();   ///Tableau des roles des menus
			$tab_smrole	= array();  ///Tableau des roles des sous menus
			$cur_menu	= '';
			
			$tab_role	= $this->role->get_conn_roles($id_profil, $id_site);

			// var_dump($tab_role);
			// exit();
			
			foreach($tab_role as $val)
			{
				///Tableau des droits sur les menus
				if($cur_menu != $val->mcode)
				{
					$tab_mrole[$val->mcode] = 1;
					$cur_menu = $val->mcode;
				}
				
				//Tableau des droits sur les sous menus
				//On ne recup�re que les valeurs positives
				if($val->d_read != '-1'){ $tab_smrole[$val->smcode]['d_read']	= $val->d_read;}
				if($val->d_add != '-1'){ $tab_smrole[$val->smcode]['d_add']	= $val->d_add;}
				if($val->d_upd != '-1'){ $tab_smrole[$val->smcode]['d_upd']	= $val->d_upd;}
				if($val->d_del != '-1'){ $tab_smrole[$val->smcode]['d_del']	= $val->d_del;}
			}
			
			///Chargement des donn�es de la tableau $data
			$data['menu_roles']		= $tab_mrole;
			$data['smenu_roles']	= $tab_smrole;
		
			//Mise des donn�es en session
			$this->session->set_userdata('menu_roles', $data['menu_roles']);
			$this->session->set_userdata('smenu_roles', $data['smenu_roles']);
			//BAKS FIN Recuperation des roles
			
			
			//donnees en session
			$this->session->set_userdata($data_user);	
			////$this->session->set_userdata('id_site',$data['connexions_item']['id_site']);
			//on log les donnees begin : Enregistrement des donnees de l'utilisateur dans la table z_connexions ip, navigateur, profil, nom 
	
			
			///$data['username']	= $data['connexions_item']['user_conn'];
			//@$data['email']		= $data['connexions_item']['email'];
			$data['username']	= $data_user['can8_g1qsu_30q9o']['nom'];
			//@$data['email']		= $data_user['can8_g1qsu_30q9o']['email'];

			//$pass=$this->conf->encrypt($data['connexions_item']['password'],'idyby');
			$this->session->set_userdata('username', $data['username']);
			//$this->session->set_userdata('pass', $pass);


	}

}
