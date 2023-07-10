<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
    
   class C_sys_niits extends MY_Controller { 
    
   	public function __construct() 
   	{ 
   	    parent::__construct(); 
   	   	$this->load->model('M_sys_niits', 'm_modele'); 
		$this->load->model('Global_bdd', 'gl_bdd');
   	} 
    
   	public function index() 
   	{ 
   		$all_data 					= $this->m_modele->get_data_liste(); 
   		$data['all_data'] 			= $all_data; 
		$data['all_type_status'] 	=  array(''=>'Choisir...','attente'=>'attente','actif'=>'actif','résilié'=>'résilié','supprimé'=>'supprimé',); 
        $data['dat_form_serv'] 		= $this->gl_bdd->get_data_for_combo("e_services", "id", "libelle", " ");
        $data['dat_form_prof'] 		= $this->gl_bdd->get_data_for_combo("sys_type_profil", "id", "libelle_type_profil", " WHERE etat='1' ");
        $data['dat_form_agent'] 	= $this->gl_bdd->get_data_for_combo("p_agents", "code_agent", "CONCAT(prenom,' ',nom)", " ", " ORDER BY nom");

   		$this->load->view('sys/v_sys_niits', $data); 
   	} 
    
		public function get_liste_service() 
    { 
		$shown_service		= $_GET['id'];
        $all_data 			= $this->m_modele->get_data_liste_service($shown_service); 
        $data['all_data'] 	= $all_data; 
        $this->load->view('params/v_liste_services', $data); 
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
   		$val_id = $this->input->post('id'); 
   		if (!empty($val_id)) 
   		{ 
   			$this->m_modele->id = $this->input->post('id'); 
   		} 
			 $mdp=$this->input->post('mot_de_passe');
			 $mdpf= $mdp;


        /* $salt=sha1($this->input->post('email'),2019);
         $mdpcr=crypt($mdp,$salt);
         $mdpf= hash('sha512', $mdpcr);*/

   		//$this->m_modele->id_service = $this->input->post('id_service'); 
   		//$this->m_modele->nom = $this->input->post('nom'); 

   		$this->m_modele->email 			= $this->input->post('email'); 
   		$this->m_modele->code_agent 	= $this->input->post('code_agent'); 
   		$this->m_modele->id_type_profil = $this->input->post('id_type_profil'); 
   		$this->m_modele->mot_de_passe 	= $mdpf; 
   		$this->m_modele->etat 			= $this->input->post('etat'); 
   		echo json_encode( $this->m_modele->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); 
   	} 
    
   } 
