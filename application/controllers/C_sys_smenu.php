<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
    
    class C_sys_smenu extends MY_Controller { 
     
        public function __construct() 
        { 
            parent::__construct(); 
           $this->load->model('M_sys_smenu', 'm_modele');  
           $this->load->model('Global_bdd'		, 'gl_bdd');
           //$this->m_modele->id_site 		= $this->session->l75_uilhcho_32_l['login'];//obligatoire pour le filtre
           //$this->m_modele->id_op_saisie 	= 1;//obligatoire pour le filtre
    
        } 
        
     
        public function index() 
        { 
            $all_data                   = $this->m_modele->get_data_liste(); 
            $data['all_data']           = $all_data; 
            $data['dt_sit_mat'] 		= $this->gl_bdd->get_data_for_combo("sys_menu", "id", "libelle", " WHERE etat='1'  ");
            //$data['dt_smenu'] 		= $this->gl_bdd->get_data_for_combo("sys_menu", "id_menu", "etat", " WHERE etat='1'  ");
           // $data['dt_s_prop'] 		    = $this->gl_bdd->get_data_for_combo("j_proprietaires", "id","id");
            //$data['dt_s_prop']             = $this->gl_bdd->get_data_for_combo("j_proprietaires", "id", "CONCAT(prenom,' ',nom)");
            //$data['dt_sect_act'] 		= $this->gl_bdd->get_data_for_combo("lst_professions_categories", "id", "libelle", " WHERE etat='1'  ");
            //$data['dt_national'] 		= $this->gl_bdd->get_data_for_combo("lst_pays", "id", "nom_fr_fr", " WHERE etat='1'  ");
//demba_debug($data['dt_sit_mat']);
			/*$data['dt_sexe'] 	= array( // Sexe
				'' 		=> 'Choisir...', 
				'M' 	=> 'Masculin', 
				'F' 	=> 'Féminin', 
			);
			$data['dt_freq_sit'] 	= array( // Fréquence des situations propriétaires
				'' 				=> 'Choisir...', 
				'Mensuelle' 		=> 'Mensuelle', 
				'Bimensuelle' 		=> 'Bimensuelle', 
				'Trimestrielle' 	=> 'Trimestrielle', 
				'Semestrielle' 		=> 'Semestrielle', 
				'Annuelle' 			=> 'Annuelle', 
			);*/

            $data['all_type_status'] 	=  $this->m_modele->get_data_forform_etat(); 
            $this->load->view('sys/v_j_smenu', $data); 
        } 
     
        public function get_record(){ 
            $args =func_get_args(); 
            $this->m_modele->id =  $args[0]; 
            $this->m_modele->get_record(); 
            echo json_encode($this->m_modele, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
        } 
     
        public function delete(){ 
            $args =func_get_args(); 
            $this->m_modele->id =  $args[0]; 
            echo json_encode($this->m_modele->delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
        } 
     
        public function save(){ 
//var_dump($_POST);
//exit();
            $val_id = $this->input->post('id'); 
            if (!empty($val_id)) 
            { 
                $this->m_modele->id = $this->input->post('id'); 
            } 
            $this->m_modele->code       = $this->input->post('code'); 
            $this->m_modele->libelle    = $this->input->post('libelle'); 
            $this->m_modele->etat       = $this->input->post('etat'); 
            $this->m_modele->id_menu    = $this->input->post('id_menu'); //#daick_modif
            //$this->m_modele->date_creation = date('Y-m-d');//#daick_modif
          //  $this->m_modele->id_op_saisie = $this->input->post('id_op_saisie'); 
            //$this->m_modele->id_site = $this->input->post('id_site');
            $this->m_modele->date_last_modif = date("Y-m-d H:i:s"); 
            
            echo json_encode( $this->m_modele->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
        } 
		
		public function show_smenu()
        {
            $args                   = func_get_args(); 
            $id              = $args[0];         
			$result                 = $this->m_modele->get_data_liste($id);
           // $data['id_bien_prop']   = $this->gl_bdd->get_data_one_key('j_z_situation_initiale_prop','id_proprietaire',$id_prop ,'id');  
            $data['d_infos_menu'] 	= $result[0];
            //$result_2               = $this->m_modele->get_sum_caution($data['id_bien_prop']);
            //$data['total_caution']  = $result_2['total_caution'];
            $this->load->view('sys/v_show_smenu',$data);
        } 
     
    } 
 