<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_sys_menu extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('sys/M_sys_menu', 'm_modele');
        $this->load->model('Global_bdd', 'gl_bdd');

        $this->m_modele->id_op_saisie = $this->session->can8_g1qsu_30q9o['id'];

        $this->link_list     = 'params-liste-menu';
        $this->nom_elt       = 'menu';
    }

    public function index() //AFFICHAGE  de la liste des données 
    {
        $data['all_data']     = $this->m_modele->get_data_liste(); //CHARGER LES DONES POUR LA LISTES

        $data['title'] = 'Liste ' . $this->nom_elt;
        $data['breadcrumbs']    = array($this->link_list, $this->nom_elt, @$data['title']);
        $data['contents']        = 'sys/v_sys_menu_liste'; //CHARGER la vue courrante
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

        $data['breadcrumbs']    = array($this->link_list, $this->nom_elt, @$data['title']);
        //$data['dt_list_sect']     = $this->gl_bdd->get_data_for_combo("c_entreprises_categories", "id", "libelle", " ", " ");

        //definition des champs a controller
        //$this->form_validation->set_rules('', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('code', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('libelle', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('etat', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('rang', 'Champ', 'xss_clean|trim');

        $this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
        $this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

        //demba_debug($code_courrier);

        if ($this->form_validation->run() === FALSE) {
            $data['contents']    = 'sys/v_sys_menu_form_add';
        } else //si tout est ok
        {
            //$code_courrier 		= cod_get_next_courr('arrivee');
            $data_to_insert     = array(
                'code'     => $this->input->post('code'),
                'libelle'     => $this->input->post('libelle'),
                'etat'             => $this->input->post('etat'),
                'rang'             => $this->input->post('rang'),


            );
            $result_add = $this->m_modele->insert_one_modele_vehicule($data_to_insert); //insertion des données code BD

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
        $args                     = func_get_args();
        $code_elt                 = $args[0];
        $data['code_elt']        = $code_elt;
        $data['title']             = "Détails sur le " . $this->nom_elt;
        $data['date_one_element']    = $this->m_modele->get_data_one_elt($code_elt);

        $data['breadcrumbs']    = array($this->link_list, $this->nom_elt, $data['title']);
        //demba_debug($data['breadcrumbs']);
        $data['contents']        = 'sys/v_sys_menu_show';
        $this->load->view('template/layout', $data);
    } //end on function


    ////////////show details
    function delete_one_elt()
    {
        $args                     = func_get_args();
        $code_elt                 = $args[0];
        $this->db->where('id', $code_elt);
        $this->db->delete('sys_menu');
    } //end on function



    //////////////////////////formulaire dE  MODIF D 1 élément
    function edit_one_elt()
    {
        ///////:chargement des données à modifier
        $args                     = func_get_args();
        $code_elt                 = $args[0];
        $data['code_elt']        = $code_elt;
        $data['dat_one_elt']    = $this->m_modele->get_data_one_elt($code_elt);
        $data['title']             = 'Formulaire modification:' . $this->nom_elt;
        $data['breadcrumbs']    = array($this->link_list, $this->nom_elt, @$data['title']);
        //$data['dt_list_sect']     = $this->gl_bdd->get_data_for_combo("c_entreprises_categories", "id", "libelle", "commentaires", " ");

        $this->load->helper('security'); //pour controller les failes xss
        $this->load->helper('form');
        $this->load->library('form_validation');

        // a_dynamiser  definition des champs a controller
        $this->form_validation->set_rules('code', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('libelle', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('etat', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('rang', 'Champ', 'required|xss_clean|trim');
        $this->form_validation->set_message('required', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Champ obligatoire</b>');
        $this->form_validation->set_message('xss_clean', '<b style="color:#FF3333;font-size:9px;text-decoration:blink">Faille XSS ....</b>');

        //demba_debug($code_courrier);

        if ($this->form_validation->run() === FALSE) {
            // a_dynamiser
            $data['contents']    = 'sys/v_sys_menu_form_edit';
        } else //si tout est ok
        {
            //$code_courrier 		= cod_get_next_courr('arrivee');
            // a_dynamiser
            $data_to_insert     = array(
                'code'         => $this->input->post('code'),
                'libelle'     => $this->input->post('libelle'),
                'etat'         => $this->input->post('etat'),
                'rang'         => $this->input->post('rang'),


            );
            $result_add = $this->m_modele->update_one_menu($this->input->post('code_elt'), $data_to_insert); //insertion des données code BD

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
