<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_sys_profils extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('sys/M_sys_profils', 'm_modele');
		$this->load->model('Global_bdd'		, 'gl_bdd');
		$this->load->model('M_sys_role', 'role');

		$this->m_modele->id_op_saisie = $this->session->can8_g1qsu_30q9o['id'];

		$this->link_list 	= 'liste-profils';
		$this->nom_elt 		= 'profils';
	}

	public function index() //AFFICHAGE  de la liste des données
	{
		$data['all_data'] 	= $this->m_modele->get_data_liste(); //CHARGER LES DONES POUR LA LISTES

		$data['title'] = 'Liste ' . $this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);
		$data['contents']		= 'sys/v_sys_profils_liste'; //CHARGER la vue courrante
		$this->load->view('template/layout', $data);
 

		//$this->load->view('parametres/v_list_bailleurs', $data); 
	}


	//////////////////////////formulaire d'ajout d'un nouveau élément
	function add_one_element()
	{
		$this->load->helper('security'); //pour controller les failes xss
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] = 'Formulaire ajout:' . $this->nom_elt;

		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);

		//definition des champs a controller
		$this->form_validation->set_rules('libelle_type_profil'	, 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('etat'				, 'Champ', 'required|xss_clean|trim');

		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

		//demba_debug($code_courrier);

		if ($this->form_validation->run() === FALSE) {
			$data['contents']	= 'sys/v_sys_profils_form_add';
		} 
		else //si tout est ok
		{
			//$code_courrier 		= cod_get_next_courr('arrivee');
			$data_to_insert = array(
				'libelle_type_profil' 	=> $this->input->post('libelle_type_profil'),
				'etat' 				=> $this->input->post('etat'),
				'date_creation' 	=> date('m-d-Y'),
				'id_op_saisie' 	=> $this->m_modele->id_op_saisie,
			);
			$result_add = $this->m_modele->insert_one_elt($data_to_insert); //insertion des données code BD

			if ($result_add == '1') //si insertion avec succés on redrige
			{
				redirect($this->link_list);
			}
		}
		$this->load->view('template/layout', $data);
	} //end of function



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
		$data['contents']		= 'sys/v_sys_profils_show';
		$this->load->view('template/layout', $data);
	} //end on function


	////////////show details
	function delete_one_elt()
	{
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$this->db->where('id', $code_elt);
		$this->db->delete('sys_type_profil');
	} //end on function


	//////////////////////////formulaire dE  MODIF D 1 élément
	function edit_one_elt()
	{
		///////:chargement des données à modifier
		$args 					= func_get_args(); 
		$code_elt 				= $args[0]; 
		$data['code_elt']		= $code_elt;
		$data['dat_one_elt']	= $this->m_modele->get_data_one_elt($code_elt);
		$data['title'] 			= 'Formulaire modification:'.$this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list,$this->nom_elt,@$data['title']);
		$data['dt_list_sect'] 	= $this->gl_bdd->get_data_for_combo("c_bee_sections", "id", "libelle", " ");

		$this->load->helper('security');//pour controller les failes xss
		$this->load->helper('form');
		$this->load->library('form_validation');

		// a_dynamiser  definition des champs a controller
		$this->form_validation->set_rules('libelle_type_profil'	, 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('etat'				, 'Champ', 'required|xss_clean|trim');
		
		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');
			
		//demba_debug($code_courrier);

		if ($this->form_validation->run() === FALSE) 
		{
			// a_dynamiser
			$data['contents']	= 'sys/v_sys_profils_form_edit';
		}
		else //si tout est ok
		{
			//$code_courrier 		= cod_get_next_courr('arrivee');
			// a_dynamiser
			$data_to_insert 	= array(
				'libelle_type_profil' 	=> $this->input->post('libelle_type_profil'),
				'etat' 				=> $this->input->post('etat'),
			);
			$result_add = $this->m_modele->update_one_ss($this->input->post('code_elt'),$data_to_insert);//insertion des données code BD

			if($result_add=='1') //si insertion avec succés on redrige
			{
				redirect($this->link_list);
				//$data['date_one_cour']	= $this->m_modele->get_data_one_courrier_arr($code_courrier);
				//$data['contents']		= 'courrier_arr/v_add_img';
			}
		}
		$this->load->view('template/layout',$data);

	}//end of function









	public function get_menu_liste()
	{
		$args = func_get_args();
		if(!empty($args['0']))
		{
			$data_profil_in_bd = $this->m_modele->get_data_one_elt($args['0']);
			if(empty($data_profil_in_bd))
			{
				//loguer les manipulation par url non autorisé

				//demba_debug($data_profil_in_bd);
				header("Location:".site_url('liste-profils'));;
			}
		}


		//demba_debug($data_profil_in_bd);
		$choosen_profil_name = $this->gl_bdd->get_data_one_key('sys_type_profil', 'id', $args['0'], 'libelle_type_profil');
		$data['title'] = 'Liste des rôles pour le profil: <strong>'.$choosen_profil_name.'</strong>';
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);

		$data['data_menu'] 	= $this->role->get_menu_liste($args[0]);
		$data['id_profil']	=  $args[0];
		//$this->load->view('sys/V_sys_role', $data);

		
		$data['contents']		= 'sys/v_sys_role'; //CHARGER la vue courrante
		$this->load->view('template/layout', $data);
	}
	
	protected function curent_role($role, $tab_role)
	{
		switch($role)
		{
			case 'read':
				$tab_role[0] =  '1';
			break;
			
			case 'add':
				$tab_role[1] =  '1';
			break;
			
			case 'upd':
				$tab_role[2] =  '1';
			break;
			
			case 'del':
				$tab_role[3] =  '1';
			break;
		}
		return $tab_role;
	}
	
	//Enregistrer les modifs sur les roles
	public function save_role_action()
	{
		//Repérage des liens
		$cur_id_lk 		= 0;
		$tab_temp_role 	= array();
		$id_pfl			= $this->input->post('id_role_profil');
		
		///RAZ des sous-menus associés au profil
		$this->role->raz_sous_menu_active($id_pfl);
		
		//print_r($_POST);
		foreach($_POST['btn_role'] as $btn_role)
		{
			$tab_role		= explode('_', $btn_role);
			$role 			= $tab_role[0];
			$id_lk			= $tab_role[1];
			
			if($cur_id_lk != $id_lk) //Chagement de lien
			{
				if($cur_id_lk != 0)  ///Passage Nx
				{
					$this->role->save_role_action($cur_id_lk, $id_pfl, $this->tab_post_role);
					$this->tab_post_role	= array('-1','-1','-1','-1');
					
					$this->tab_post_role = $this->curent_role($role, $this->tab_post_role);
					
				}else //Passage N0
				{
					$this->tab_post_role = $this->curent_role($role, $this->tab_post_role);
				}
				
				$cur_id_lk = $id_lk;
			}else
			{
				$this->tab_post_role = $this->curent_role($role, $this->tab_post_role);
			}
		}
		
		if($cur_id_lk != 0)  ///On est pas au premier parcours
		{
			$d = $this->role->save_role_action($cur_id_lk, $id_pfl, $this->tab_post_role);
			$this->tab_post_role	= array('-1','-1','-1','-1');
		}

		echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
		

}//end class
