<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_sys_niits extends MY_Controller
{

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
		$data['all_type_status'] 	=  array('' => 'Choisir...', 'attente' => 'attente', 'actif' => 'actif', 'résilié' => 'résilié', 'supprimé' => 'supprimé',);
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
		$this->form_validation->set_rules('code_agent', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('_profil', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('email', 'Champ', 'required|xss_clean|trim');
		//$this->form_validation->set_rules('bureau', 'Champ', 'required|xss_clean|trim');

		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

		//demba_debug($code_courrier);

		if ($this->form_validation->run() === FALSE) {
			// a_dynamiser
			$data['contents']	= 'sys/v_sys_niits_form_edit';
		} else //si tout est ok
		{
			//$code_courrier 		= cod_get_next_courr('arrivee');
			// a_dynamiser
			$data_to_insert 	= array(
				'code_agent' 	=> $this->input->post('code_agent'),
				'_profil' 	=> $this->input->post('_profil'),
				'email' 	=> $this->input->post('email'),
				//'bureau' 	=> $this->input->post('bureau'),
				'commentaires' 		=> $this->input->post('commentaires'),
				'etat' 		=> $this->input->post('etat'),

			);

			$result_add = $this->m_modele->update_one_ss($this->input->post('code_elt'), $data_to_insert); //insertion des données code BD
			//demba_debug($result_add);
			if ($result_add == '1') //si insertion avec succés on redrige
			{
				redirect($this->link_list);
				//$data['date_one_cour']	= $this->m_modele->get_data_one_courrier_arr($code_courrier);
				//$data['contents']		= 'courrier_arr/v_add_img';
			}
		}
		$this->load->view('template/layout', $data);
	} //end of function

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

	public function save()
	{
		$val_id = $this->input->post('id');
		if (!empty($val_id)) {
			$this->m_modele->id = $this->input->post('id');
		}
		$mdp = $this->input->post('mot_de_passe');
		$mdpf = $mdp;


		/* $salt=sha1($this->input->post('email'),2019);
         $mdpcr=crypt($mdp,$salt);
         $mdpf= hash('sha512', $mdpcr);*/

		//$this->m_modele->id_service = $this->input->post('id_service'); 
		//$this->m_modele->nom = $this->input->post('nom'); 

		$this->m_modele->email 			= $this->input->post('email');
		//$this->m_modele->bureau 			= $this->input->post('bureau');
		$this->m_modele->code_agent 	= $this->input->post('code_agent');
		$this->m_modele->id_type_profil = $this->input->post('id_type_profil');
		$this->m_modele->mot_de_passe 	= $mdpf;
		$this->m_modele->etat 			= $this->input->post('etat');
		echo json_encode($this->m_modele->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}


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
		$data['contents']		= 'sys/v_sys_niits_show';
		$this->load->view('template/layout', $data);
	} //end on function
}
