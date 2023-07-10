<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_par_pays extends MY_Controller
{

	public function __construct()
	{
		//CONSTRUCTEUR
		parent::__construct();
		$this->load->model('paramss/M_Pays', 'm_modele');///Classse modéle générale de travail on travaille avec  l'alias
		$this->load->model('Global_bdd', 'gl_bdd');  //une classe globale regroupant bcp de méthodes

		$this->load->helper('djitte'); //pour la gestion des droits

		$this->m_modele->id_op_saisie = $this->session->can8_g1qsu_30q9o['id'];    ////////id du user connecté

		$this->link_list 	= 'params-liste-pays';    //////////lien du breadcrumb envers la liste sera utilisé de maniére dynamique
		$this->nom_elt 		= 'pays';  ///nom de l'élément du CRUD courant qui sera affichée de manière dynamique
	}


	public function index() //AFFICHAGE  de la liste des données
	{
		$id_site 			= $this->session->can8_g1qsu_30q9o['id_site'];
		$list_site_name 	= 	array(
			'1' =>  'bee',
			'2' =>  'bec',
			'3' =>  'ANSD',
		);
		$data['site_name'] 	= $list_site_name[$id_site];

		//demba_debug($data['site_name']);
		$data['all_data'] 	= $this->m_modele->get_data_liste($list_site_name[$id_site]); //CHARGER LES DOnnéeS POUR LA LISTe
		//$data['all_dat'] 	= $this->m_modele->get_data_liste($list_site_name[$id_site]); //CHARGER LES DOnnéeS POUR LA LISTe

		$data['rdc2_rights'] 	= rdc2_get_auth('params'); //retourne Array ( [add] => [update] => [delete] => [read] => 1 ) 
			//permet de voir si ce profil connecté est autorisé à ajouter des données
		//demba_debug($data['rdc2_rights']); 

		$data['title'] 			= 'Liste des ' . $this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);
		$data['contents']		= 'params/v_pays_liste'; //CHARGER la vue courrante
		$this->load->view('template/layout', $data);

		//$this->load->view('parametres/v_list_bailleurs', $data); 
	}


	//////////////////////////formulaire d'ajout d'un nouveau élément
	function add_one_element()
	{
		$this->load->helper('security'); //pour controller les failes xss
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['title'] 			= 'Formulaire ajout:' . $this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);

		//definition des champs a controller
		$this->form_validation->set_rules('code'		, 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('alpha2'		, 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('alpha3'		, 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('nom_en_gb'	, 'Champ', 'xss_clean|trim');
		$this->form_validation->set_rules('nom_fr_fr'	, 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('etat'		, 'Champ', 'required|xss_clean|trim');

		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

		//demba_debug($code_courrier);
		//demba_debug($_POST);

		if ($this->form_validation->run() === FALSE) 
		{
			$data['contents']	= 'params/v_pays_form_add';
		} 
		else //si tout est ok
		{

			///$sql_doublons = "SELECT id FROM c_collectes_periodiques 
			//	WHERE mois='" . $this->input->post('mois') . "' AND annee='" . $this->input->post('annee') . "'  AND id_source ='" . $this->input->post('id_source') . "'";
			//$res_search_doublons = $this->gl_bdd->get_data_from_sql($sql_doublons); //rech doublons BD
			//demba_debug($res_search_doublons ['0'] ['id']);

			//if (empty($res_search_doublons['0']['id'])) {
				$data_to_insert 	= array(

					'code' 			=> $this->input->post('code'),
					'alpha2'		=> $this->input->post('alpha2'),
					'alpha3'	 	=> $this->input->post('alpha3'),
					'nom_en_gb' 	=> $this->input->post('nom_en_gb'),
					'nom_fr_fr'		=> $this->input->post('nom_fr_fr'),
					'etat'		 	=> $this->input->post('etat'), //attention pb etat statut dans la vue

					'date_creation'		=> date('Y-m-d'),
					'id_op_saisie' 	=> $this->m_modele->id_op_saisie,
				);
				$result_add = $this->m_modele->insert_one_element($data_to_insert); //insertion des données code BD

		//demba_debug($_POST);

				/////////////////on historise l'action
				//$data_hist 	= array(
				//	'texte' 	=> "Collecte bureau(" . $this->input->post('id_source') . ") période de :" . $this->input->post('mois') . " - " . $this->input->post('annee'),
				//	'type'		=> 'nouvelle collecte',
				//	'id_site' 	=> $this->session->can8_g1qsu_30q9o['id_site'],
				//);
				//$this->db->insert('z_trace_activities', $data_hist);

				if ($result_add == '1') //si insertion avec succés on redirige
				{
					redirect($this->link_list);
				}
			//} 
			//else 
			//{
			//	demba_debug("Doublons non autorisé!");
			//}
		}
		$this->load->view('template/layout', $data);
	} //end of function




	////////////show details dans le CRUD courant
	function show_one_elt()
	{
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$data['code_elt']		= $code_elt;

		$data['rdc2_rights'] 	= rdc2_get_auth('params'); //retourne Array ( [add] => [update] => [delete] => [read] => 1 ) 
			//permet de voir si ce profil connecté est autorisé à supprimer des données
		
		$curr_profil 			= strtolower($this->session->can8_g1qsu_30q9o['profil']) ;
		if($curr_profil ==  'agent saisie bec')
			$data['is_auth_validate'] 	= '0';
		else		
			$data['is_auth_validate'] 	= '1';


		$data['title'] 					= "Détails sur le " . $this->nom_elt; //qui ser affiché sur la fiche
		$data['date_one_element']		= $this->m_modele->get_data_one_elt($code_elt);

		//$id_site 						=  $data['date_one_element']['id_source'];
		//$data['date_one_element_val']	= $this->m_modele->get_data_entry_one_elt($code_elt, $id_site, $mois, $annee);
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, $data['title']);
		$data['contents']		= 'params/v_pays_show';
		$this->load->view('template/layout', $data);
	} //end on function


	////////////pour la suppression
	function confirm_delete_one_elt()
	{	
		$data['title'] 					= "Supprimer le " . $this->nom_elt; //qui ser affiché sur la fiche
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, $data['title']);

		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$data['code_elt']		= $code_elt;
		$data['contents']		= 'params/v_pays_confirm_delete';
		$this->load->view('template/layout', $data);
	} //end on function

	function delete_one_elt()
	{ 
		/*
			INSERT INTO `lst_pays` (`id`, `code`, `alpha2`, `alpha3`, `nom_en_gb`, `nom_fr_fr`, `etat`, `date_last_modif`)
		 	VALUES ('193', '686', 'SN', 'SEN', 'Senegal', 'Sénégal', '1', current_timestamp());
		 */
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$this->db->where('id', $code_elt);
		$this->db->delete('lst_pays');

		redirect('params-liste-pays');
	} //end on function


	//////////////////////////formulaire dE  MODIF D 1 élément
	function edit_one_elt()
	{
		///////:chargement des données à modifier
		$args 					= func_get_args();
		$code_elt 				= $args[0];
		$data['code_elt']		= $code_elt;
		$data['dat_one_elt']	= $this->m_modele->get_data_one_elt($code_elt);
		$data['title'] 			= 'Formulaire modification:' . $this->nom_elt;
		$data['breadcrumbs']	= array($this->link_list, $this->nom_elt, @$data['title']);
		// $data['dt_list_sect'] 	= $this->gl_bdd->get_data_for_combo("c_bee_sections", "id", "libelle", " ");
		//$data['dt_list_source'] = $this->gl_bdd->get_data_for_combo("c_bec_gammes", "id", "CONCAT(code,' / ',libelle)", " ");

		$this->load->helper('security'); //pour controller les failes xss
		$this->load->helper('form');
		$this->load->library('form_validation');

		// a_dynamiser  definition des champs a controller
		$this->form_validation->set_rules('description', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('mois', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('annee', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('id_source', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_rules('statut', 'Champ', 'required|xss_clean|trim');
		///$this->form_validation->set_rules('statut', 'Champ', 'required|xss_clean|trim');
		$this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
		$this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

		//demba_debug($code_courrier);

		if ($this->form_validation->run() === FALSE) {
			// a_dynamiser
			$data['contents']	= 'v_prod/v_collectes_periodiques_form_edit';
		} else //si tout est ok
		{
			//$code_courrier 		= cod_get_next_courr('arrivee');
			// a_dynamiser
			$data_to_insert 	= array(
				'description' 	=> $this->input->post('description'),
				'mois' 			=> $this->input->post('mois'),
				'annee' 		=> $this->input->post('annee'),
				'id_source'		=> $this->input->post('id_source'),
				'statut' 			=> $this->input->post('statut'),
				'date_creation'	=> $this->input->post('date_creation'),

				//'etat' 				=> '1',
				//'id_op_saisie' 	=> $this->m_modele->id_op_saisie,

			);
			$result_add = $this->m_modele->update_one_ss($this->input->post('code_elt'), $data_to_insert); //insertion des données code BD

			if ($result_add == '1') //si insertion avec succés on redrige
			{
				redirect($this->link_list);
				//$data['date_one_cour']	= $this->m_modele->get_data_one_courrier_arr($code_courrier);
				//$data['contents']		= 'courrier_arr/v_add_img';
			}
		}
		$this->load->view('template/layout', $data);
	} //end of function




}
