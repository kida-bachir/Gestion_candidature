<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_entreprises extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('prod/M_entreprises', 'm_modele');
		$this->load->model('Global_bdd', 'gl_bdd');
		$this->m_modele->id_op_saisie = $this->session->can8_g1qsu_30q9o['id'];
		$this->link_list 	= 'params-liste-des-entreprises';
		$this->nom_elt 		= 'entreprises';
		//$this->m_modele->id_op_saisie = $this->session->dia_7zlsj_cposm['id'];
	}

	public function index() //AFFICHAGE  de la liste des données
	{
		$data['all_data'] 	= $this->m_modele->get_data_liste(); //CHARGER LES DONES POUR LA LISTES
		$data['title'] = 'Liste ' . $this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);
		$data['contents']	= 'v_prod/v_list_entreprises'; //CHARGER la vue courrante
		$this->load->view('template/layout', $data);
	}





	//////////////////////////formulaire d'ajout d'un nouveau élément
	function add_one_element()
	{
		$this->load->helper('security'); //pour controller les failes xss
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] = 'Ajouter une entreprise';
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);
		//definition des champs a controller
		$this->form_validation->set_rules('sigle', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('libelle', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('commentaires', 'Champ', 'xss_clean|trim');
		$this->form_validation->set_rules('etat', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

		//demba_debug($code_courrier);

		if ($this->form_validation->run() === FALSE) {
			$data['contents']	= 'v_prod/v_form_ajouter_entreprise';
		} else //si tout est ok
		{
			//$code_courrier 		= cod_get_next_courr('arrivee');
			$data_to_insert 	= array(
				'sigle' 		=> $this->input->post('sigle'),
				'libelle' 		=> $this->input->post('libelle'),
				'commentaires' 	=> $this->input->post('commentaires'),
				'etat' 			=> $this->input->post('etat'),

				//'etat' 				=> '1',
				'id_op_saisie' 			=> $this->m_modele->id_op_saisie,
			);
			$result_add = $this->m_modele->insert_one_modele_vehicule($data_to_insert); //insertion des données code BD

			if ($result_add == '1') //si insertion avec succés on redrige
			{
				redirect($this->link_list);
				//redirect('params-liste-des-entreprises');
				//$data['date_one_cour']	= $this->m_modele->get_data_one_courrier_arr($code_courrier);
				//$data['contents']		= 'courrier_arr/v_add_img';
			}
		}
		$this->load->view('template/layout', $data);
	} //end of function


	//////////////////////////formulaire demodifier d'un nouveau élément
	function edit_one_elt()
	{
		///////:chargement des données à modifier
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$data['code_elt']		= $code_elt;
		$data['dat_one_elt']	= $this->m_modele->get_data_one_elt($code_elt);

		$data['title'] 			= 'Formulaire modification:' . $this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);
		$this->load->helper('security'); //pour controller les failes xss
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] = 'Ajouter une entreprise';

		//definition des champs a controller
		$this->form_validation->set_rules('sigle', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('libelle', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('commentaires', 'Champ', 'xss_clean|trim');
		$this->form_validation->set_rules('etat', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

		//demba_debug($code_courrier);

		if ($this->form_validation->run() === FALSE) {
			$data['contents']	= 'v_prod/v_form_edit_entreprise';
		} else //si tout est ok
		{
			//$code_courrier 		= cod_get_next_courr('arrivee');
			$data_to_insert 	= array(
				'sigle' 		=> $this->input->post('sigle'),
				'libelle' 		=> $this->input->post('libelle'),
				'commentaires' 	=> $this->input->post('commentaires'),
				'etat' 			=> $this->input->post('etat'),

				//'etat' 				=> '1',
				//'id_op_saisie' 			=> $this->m_modele->id_op_saisie,
			);
			$result_add = $this->m_modele->update_one_s($this->input->post('code_elt'), $data_to_insert); //insertion des données code BD

			if ($result_add == '1') //si insertion avec succés on redrige
			{
				redirect('params-liste-des-entreprises');
				//$data['date_one_cour']	= $this->m_modele->get_data_one_courrier_arr($code_courrier);
				//$data['contents']		= 'courrier_arr/v_add_img';
			}
		}
		$this->load->view('template/layout', $data);
	} //end of function


	////////////show details
	function delete_one_elt()
	{
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$this->db->where('id', $code_elt);
		$this->db->delete('c_entreprises');
	} //end on function

	////////////show details
	function show_one_elt()
	{
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$data['code_elt']		= $code_elt;
		$data['title'] 			= "Détails sur le " . $this->nom_elt;
		$data['date_one_element']	= $this->m_modele->get_data_one_elt($code_elt);

		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, $data['title']);
		//demba_debug($data['breadcrumbs']);
		$data['contents']		= 'v_prod/v_show_entreprises';
		$this->load->view('template/layout', $data);
	} //end on function
	/////////////////FOR THE AJAX
	public function get_record()
	{
		$args = func_get_args();
		$this->m_modele->id =  $args[0];
		$this->m_modele->get_record();
		echo json_encode($this->m_modele, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function delete()
	{

		$args = func_get_args();
		$this->m_modele->id =  $args[0];
		echo json_encode($this->m_modele->delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
}
