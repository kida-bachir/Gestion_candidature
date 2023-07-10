<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_z_historique extends MY_Controller
{
    public function __construct()
    { 
        parent::__construct();
        $this->load->model('M_z_historique', 'm_modele');  
        $this->m_modele->id_site_saisie 		=$this->session->can8_g1qsu_30q9o['id_site'];//obligatoire pour le filtre
        $this->m_modele->id_op_saisie 	=$this->session->can8_g1qsu_30q9o['id'];//obligatoire pour le filtre	
         
    }

	public function index()
    {
		$all_data = $this->m_modele->get_data_liste();  //echo json_encode($all_data); exit;
		$data['all_data'] = $all_data; 
		$data['title'] = "Liste des historiques d'accès";
		$data['breadcrumbs']	= array('C_z_historique', "Historique", @$data['title']);
		$data['contents']		= 'z/v_historique'; //CHARGER la vue courrante
		$this->load->view('template/layout', $data);
    }

	public function index_err()
    {
		$all_data = $this->m_modele->get_data_liste_err();  //echo json_encode($all_data); exit;
		$data['all_data'] = $all_data; 
		$data['title'] = "Liste des erreur d'accès";
		$data['breadcrumbs']	= array('C_z_historique', "Erreur conexion", @$data['title']);
		$data['contents']		= 'z/v_historique_err'; //CHARGER la vue courrante
		$this->load->view('template/layout', $data);
    }

    public function get_record()
    {
        $args = func_get_args(); 
        $this->m_modele->id = $args[0];
        $this->m_modele->get_record();
//demba_debug( $this->m_modele->get_record());
        echo json_encode($this->m_modele, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }

    public function delete()
    {
        $args = func_get_args();
        $this->m_modele->id = $args[0];
        echo json_encode($this->m_modele->delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    }

	public function save()
    {	
         
        
        if(!empty($this->input->post('id')))
        { 
			$this->m_modele->id				= $this->input->post('id');
		}
		else
		{
			$this->m_modele->date_saisie 					= date("Y-m-d H:i:s");
		}
		
		$this->m_modele->libelle			= $this->input->post('libelle');
		$this->m_modele->etat						= $this->input->post('etat'); 
		
		$this->m_modele->date_last_modif 					= date("Y-m-d H:i:s");

		echo json_encode($this->m_modele->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

    
    }

}
