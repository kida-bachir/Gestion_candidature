<?php
class Global_bdd extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
		//$this->load->model('Utils_immo');	
		
		
		//if($temp=='1-'){

		//}
	}
///////////////////////////for school
	public function utils_get_id_year($the_year='') //recupere des donnees d'une table et les met dans une liste deroulante
	{
		//$retour = '';
		if(empty($the_year))	
		{
			@$tab_data_ses = $this->session->all_userdata();
		//	var_dump($tab_data_ses['man_school']['an_scoll']);
			$retour = $tab_data_ses['man_school']['an_scoll'];
		}
		else
		{
			$retour = $this->get_data_one_key('lst_annee_scolaire', 'id', $the_year, 'id');
		}
		
		return $retour;
	}




	public function get_date_mysql($name_post_val, $separator) //recupere des donnees d'une table et les met dans une liste deroulante
	{
		$retour = '';
		if(!empty($_POST[$name_post_val]))	
		{
			$pieces = explode($separator, $_POST[$name_post_val]);
			//$date_ = new DateTime($_POST['date_naiss']);
			$retour = $pieces[2].'-'.$pieces[1].'-'.$pieces[0];
		}
		
		return $retour;
	}
////////////////////////////////////////////////logs begin
	public function get_req_for_log($table,$name_col_id,$val_id_key,$list_col) //recupere des donnees d'une table et les met dans une liste deroulante
	{
		$sqlll = "INSERT INTO ".$this->get_name_bd_log().".`".$table."`(".$list_col.") ";
		$sqlll.= " SELECT ".$list_col." FROM `".$table."` WHERE ".$name_col_id."='".$val_id_key."'";
		//echo $sqlll;break;
		return $sqlll;
	}
	
	public function get_name_bd_log() //recupere des donnees d'une table et les met dans une liste deroulante
	{
		return "`man_256_immo_log`";
	}
////////////////////////////////////////////////logs end


	public function get_name_month($id_month) //recupere des donnees d'une table et les met dans une liste deroulante
	{
		$tab_dat = array
		(
			'01' => 'Janvier',
			'02' => 'F&eacute;vrier',
			'03' => 'Mars',
			'04' => 'Avril',
			'05' => 'Mai',
			'06' => 'Juin',
			'07' => 'Juillet',
			'08' => 'Ao�t',
			'09' => 'Septembre',
			'10' => 'Octobre',
			'11' => 'Novembre',
			'12' => 'D&eacute;cembre',
		);
		
		return @$tab_dat[$id_month];
	}
	
	
	public function get_data_for_combo($table, $tag, $nam, $where_cl='', $order_cl='') //recupere des donnees d'une table et les met dans une liste deroulante
	{
		$this->load->helper('url');
		$req_sql	= "SELECT ".trim($tag)." as tag,".$nam." as name FROM `".$table."` ";
		
		if(!empty($where_cl))
			$req_sql.=" ".$where_cl;			
			
		//TRI
		if(!empty($order_cl))
			$req_sql.=" ".$order_cl;
		else
			$req_sql.=" ORDER BY name";
		//	echo $req_sql;
		$query 		= $this->db->query($req_sql);
		$retour=array();
		
		//first elt
		$spacer_bdd	= " &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; ";
		//$retour[""] = $spacer_bdd." Choisir... ".$spacer_bdd;
		$retour[""] = "Choisir... ";
		
		foreach($query->result_array() as $one_elt)
		{
			$retour[$one_elt["tag"]] = $one_elt["name"];
		}
		return $retour;
	}
	
	
	
	public function get_data_for_combo_rach($table, $tag, $nam, $where_cl='', $order_cl='') //recupere des donnees d'une table et les met dans une liste deroulante
	{
		$this->load->helper('url');
		$req_sql	= "SELECT ".trim($tag)." as tag,".$nam." as name FROM `".$table."` ";
		
		if(!empty($where_cl))
			$req_sql.=" ".$where_cl;			
			
		//TRI
		if(!empty($order_cl))
			$req_sql.=" ".$order_cl;
		else
			$req_sql.=" ORDER BY name";
		//	echo $req_sql;
		$query 		= $this->db->query($req_sql);
		$retour=array();
		
		//first elt
		$spacer_bdd	= " &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; ";
		//$retour[""] = $spacer_bdd." Choisir... ".$spacer_bdd;
		//$retour[""] = "Choisir... ";
		
		foreach($query->result_array() as $one_elt)
		{
			$retour[$one_elt["tag"]] = $one_elt["name"];
		}
		return $retour;
	}	
	
	
	public function get_data_for_combo_local($list_data) //recupere des donnees d'une table et les met dans une liste deroulante
	{
	
		/*$this->load->helper('url');
		$req_sql	= "SELECT ".trim($tag)." as tag,".$nam." as name FROM `".$table."` ";
		
		if(!empty($where_cl))
			$req_sql.=" ".$where_cl;			
			
		//TRI
		if(!empty($order_cl))
			$req_sql.=" ".$order_cl;
		else
			$req_sql.=" ORDER BY name";
		//	echo $req_sql;
		$query 		= $this->db->query($req_sql);*/
		$retour	=	array();
		
		//first elt
		$spacer_bdd	= " &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; ";//si changer conformer � la ligne 105 (fct get_data_for_combo)
		$retour[""] = $spacer_bdd." Choisir... ".$spacer_bdd;
		
		foreach($list_data as $one_elt=>$labs)
		{
			$retour[$one_elt] = $labs;
		}
		return $retour;
	}
	
	public function get_data_for_combo_sql($sql_req) //recupere des donnees d'une table et les met dans une liste deroulante
	{
	
		/*$this->load->helper('url');
		$req_sql	= "SELECT ".trim($tag)." as tag,".$nam." as name FROM `".$table."` ";
		
		if(!empty($where_cl))
			$req_sql.=" ".$where_cl;			
			
		//TRI
		if(!empty($order_cl))
			$req_sql.=" ".$order_cl;
		else
			$req_sql.=" ORDER BY name";
		//	echo $req_sql;*/
		$query 		= $this->db->query($sql_req);
		$retour=array();
		
		//first elt
		$retour[""] = "Choisir...";
		
		foreach($query->result_array() as $one_elt)
		{
			$retour[$one_elt["tag"]] = $one_elt["name"];
		}
		return $retour;
	}
	
	public function get_data_for_combo_join($table, $tag, $nam, $where_cl='', $order_cl='') //recupere des donnees d'une table et les met dans une liste deroulante
	{
	
		$this->load->helper('url');
		$req_sql	= "SELECT ".trim($tag)." as tag,".$nam." as name FROM ".$table." ";
		
		if(!empty($where_cl))
			$req_sql.=" ".$where_cl;			
			
		//TRI
		if(!empty($order_cl))
			$req_sql.=" ".$order_cl;
		else
			$req_sql.=" ORDER BY name";
		//	echo $req_sql;
		$query 		= $this->db->query($req_sql);
		$retour=array();
		
		//first elt
		$retour[""] = "Choisir...";
		foreach($query->result_array() as $one_elt)
		{
			$retour[$one_elt["tag"]] = $one_elt["name"];
		}
		return $retour;
	}
	
	////////////retourne en dur les vlaurs sous forme de tableau									
	public function get_data_for_combo_static($table)
	{	
		
		switch($table)
		{

			case 'sexe';
				$retour = array(
					'' => 'Choisir...',
					'M' => 'Masculin',
					'F' => 'Féminin',
				);break;
			case 'sit_matrimoniale';
				$retour = array(
					'' => 'Choisir...',
					'1' => 'Celibataire',
					'2' => 'Marié',
					'3' => 'Divorcé',
					'4' => 'Veuf/Veuve',
				);break;

			case 'get_opts_0_1';
					$retour = array(
						'' => 'Choisir...',
						'1' => 'Actif',
						'0' => 'Inactif',
					)
			;break;
			
			default;
				echo 'Merci de faire un choix...';
			break;
		}



		return $retour;
	}	
	
	
												
	public function get_last_id_insert($table, $cle="id")
	{
		if(empty($table))
			return "erreur appelle fonction";
			
		$this->load->helper('url');
		$req_sql	= "SELECT ifnull(max(".$cle."),0)+1 AS next__ FROM ".$table." ";		
//echo $req_sql;
		$query_ = $this->db->query($req_sql);
		$retour = $query_->row_array()	;

		return $retour['next__'];		
	}
	
	public function get_last_id_insert_($table, $cle="id")
	{
		if(empty($table))
			return "erreur appelle fonction";
			
		$this->load->helper('url');
		$req_sql	= "SELECT ifnull(max(`".$cle."`),0) AS next__ FROM `".$table."` ";		
//echo $req_sql;
		$query_ = $this->db->query($req_sql);
		$retour = $query_->row_array()	;

		return $retour['next__'];		
	}
		
		
    public function record_count($table,$where="") {
		if(empty($where))
	        return $this->db->count_all($table);
		else 
		{// WHERE
		//echo "SELECT COUNT(*) AS next__  FROM ".$table." ".$where;
			$query_ = $this->db->query("SELECT COUNT(*) AS next__  FROM ".$table." ".$where);
			$retour = $query_->row_array()	;
			return $retour['next__'];	
		}		
    }
	
		
    public function count_nb_visites($type,$id) {
		if(empty($type) || empty($id))
	    {
			echo 'Pb de param�tres count_nb_visites';
		    return ;	
		}
		else 
		{
			$query_ = $this->db->query("SELECT COUNT(*) AS next__  FROM z_lecteurs_others_things WHERE id_elt='".$id."' AND type_='".$type."'");
			$retour = $query_->row_array()	;
			return $retour['next__'];	
		}
    }
	
	//$retour = $this->get_data_one_key('lst_annee_scolaire', 'id', $the_year, 'libelle');
	//select libelle from lst_annee_scolaire where id=$the_year
	public function get_data_one_key($table, $key_table, $key_value, $col_to_sel)
	{
		$req_sql	= "SELECT ".trim($col_to_sel)." AS ret__ FROM `".$table."` WHERE `".$key_table."`='".$key_value."';";
//echo $req_sql;
		$query_ = $this->db->query($req_sql);
		$retour = $query_->row_array()	;
		return @$retour['ret__'];
//		try{return $retour['ret__'];	}
//		catch (){}
	}
	
	public function get_data_many_keys($table, $col_to_sel, $key_table)
	{
		$req_sql = "SELECT ".trim($col_to_sel)." AS ret__ FROM `".$table."` ";
		$cmpt = 0;
		foreach($key_table as $key => $val)
		{
			if($cmpt == 0)
				$req_sql.="WHERE `".$key."`='".$val."'";
			else
				$req_sql.=" AND `".$key."`='".$val."'";
				$cmpt++;
		}
//echo $req_sql;
		$query_ = $this->db->query($req_sql);
		$retour = $query_->row_array()	;
		return $retour['ret__'];	
		
//			$key_table = array(
//				'mois' => $_POST['id_mois'],
//				'annee' => $_POST['id_annee'],
//				'statut' => 'actif',
//			);
//			$id_periodee = $this->Global_BDD->get_data_many_keys("dat_periodes", "id", $key_table);
	}


	
	public function get_data_from_sql($req)
	{
		///echo $req;
		$retour = $this->execute_request($req);
		$result = $retour->result_array()	;
		return $result;
	}	
	
	public function get_array_1_from_sql($req)
	{
		$out_s = array();
		$retour = $this->execute_request($req);
		$result = $retour->result_array();
		
		foreach($result as $one_elt)
		{
//var_dump($one_elt["id_quittance"]);
			$out_s[] = $one_elt["id_quittance"];
		}
		return $out_s;
	}
	
	public function execute_request($the_req)
	{
		return $this->db->query($the_req);
	}

	public function insert_one_key($the_table, $tab_data)
	{
		$ma_req_save= " INSERT INTO ".$the_table." SET ";
		foreach($tab_data as $one_key => $one_value)
		{
			if($one_value!=NULL)
				$ma_req_save.= " `".$one_key."`='".addslashes($one_value)."',";
			else
				$ma_req_save.= " `".$one_key."`=NULL,";
				
		}
		$ma_req_save = substr($ma_req_save,0,-1);//supprime le dernier caractere
//echo $ma_req_save;break;
		return $this->db->query($ma_req_save);
	}

	public function insert_one_key_mssql($the_table, $tab_data)
	{
		$ma_req_save= " INSERT INTO ".$the_table." (";
		$ma_req_save_val= "    VALUES ( ";
		
		foreach($tab_data as $one_key => $one_value)
		{
			if($one_key!='simen_key')
			{
				if($one_value!=NULL)
				{
					$ma_req_save.= " ".$one_key.",";
					$ma_req_save_val.= " '".addslashes($one_value)."',";
				}
				else
				{
					$ma_req_save.= " ".$one_key.",";
					$ma_req_save_val.= " NULL,";
				}			
			}
				
		}
		$ma_req_save 		= substr($ma_req_save,0,-1).')';//supprime le dernier caractere
		$ma_req_save_val 	= substr($ma_req_save_val,0,-1).')';//supprime le dernier caractere
//echo $ma_req_save;break;

		$sql= $ma_req_save .$ma_req_save_val;
		return $this->db->query($sql);
	}
	
	public function del_last_char($strstr)
	{	
		if(strlen($strstr)>0)
			return substr($strstr,0,-1);	
		else
			return '';
	}
	
/*	
	public function update_one_key($the_table, $key_name, $key_value, $tab_data)
	{
		$ma_req_save = " UPDATE ".$the_table." SET ";
		foreach($tab_data as $one_key => $one_value)
		{
			$ma_req_save.= " `".$value."`='".addslashes($this->input->post($key))."',";
		}
		$ma_req_save = substr($ma_req_save,0,-1);//supprime le dernier caractere
		$ma_req_save.= " WHERE `".$key_name."`='".addslashes($key_value)."';";		
		
		return $this->db->query($ma_req_save);	
	}*/

	public function update_one_key($the_table, $key_name, $key_value, $tab_data)
	{
		$ma_req_save = " UPDATE ".$the_table." SET ";
		foreach($tab_data as $one_key => $one_value)
		{
			$ma_req_save.= " `".$one_key."`='".addslashes($one_value)."',";
		}
		$ma_req_save = substr($ma_req_save,0,-1);//supprime le dernier caractere
		$ma_req_save.= " WHERE `".$key_name."`='".addslashes($key_value)."';";		
//var_dump($ma_req_save);break;		
		return $this->db->query($ma_req_save);
	}

	public function update_one_key_mssql($the_table, $key_name, $key_value, $tab_data)
	{
		$ma_req_save = " UPDATE ".$the_table." SET ";
		foreach($tab_data as $one_key => $one_value)
		{
			if($one_key!='simen_key')
			{
				$ma_req_save.= " ".$one_key."='".addslashes($one_value)."',";
			}
		}
		$ma_req_save = substr($ma_req_save,0,-1);//supprime le dernier caractere
		$ma_req_save.= " WHERE ".$key_name."='".addslashes($key_value)."';";		
//var_dump($ma_req_save);break;		
		return $this->db->query($ma_req_save);
	}
	
	public function set_on_bd_int($table, $to_do, $current_elt_id="", $id_name="id")
	{
		if($to_do=="insertion_")
		{
			$ma_req_save = $this->Global_insert_update->get_requete(0, $table ,"");
				if(!empty($current_elt_id))
					$ma_req_save.= ",".$id_name."='".$current_elt_id."'";
		}
		else if($to_do=="update")
		{
		//var_dump($current_elt_id);
			//$ma_req_save = $this->Global_insert_update->get_requete(1, "inf_annonces" ,$current_elt_id);
			//$ma_req_save_details_obs = "Insert into interv_details_solutions (`id_interv`,`description`) VALUES";
				
		}
	//var_dump($ma_req_save);break;	
		$res2 = $this->db->query($ma_req_save);
		
		if($res2==false )
		{
			echo "erreur pendant l'enregistrement!!!";
					var_dump($ma_req_save);//break;
		}
	}//fin  de lafonction
	


	public function add_photo($table, $id_table, $the_link)
	{
		$data['sama_title'] 	= 'Ajouter une photo';		
		@$num_photo = !empty($_GET['num_photo'])?$_GET['num_photo']:$this->input->post('num_photo');
		
		//var_dump($num_photo);
		@$key_value = !empty($_GET['idint'])?$_GET['idint']:$this->input->post('id_ann');
		//@$type 		= !empty($_GET['type'])?$_GET['type']:$this->input->post('the_type');
		$this->samay_don['key_value']	= $key_value;
		$this->form_validation->set_rules('the_im', 'L\'image', 'trim|xss_clean');
		$this->form_validation->set_message('required', '<b style="color:#FF3333;text-decoration:blink">Choisissez une image!</b>');		
		
//		if ($this->form_validation->run() == TRUE)
//		{
			$config['upload_path'] 		= getcwd().$this->rep_file_base;//defini dans le fichier
			$config['allowed_types'] 	= 'gif|jpg|png|bmp|jpeg|png';
			$config['max_size']			= '600';
			$config['max_width']  		= '1024';
			$config['max_height']  		= '768';
			$config['encrypt_name']		= FALSE;
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('the_im'))
			{
				$error = array( 'error' => $this->upload->display_errors());
				$this->samay_don['sama_errors']= $error['error'];
			}
			else
			{
				$this->samay_don = array('upload_data' => $this->upload->data());
	//mise � jour de la table
//var_dump("UPDATE inf_annonces SET photo".$num_photo."='".$this->samay_don['upload_data']['file_name']."' WHERE id='".$key_value."'");break;
			$result_update = $this->Global_BDD->execute_request("UPDATE ".$table." SET photo".$num_photo."='".$this->samay_don['upload_data']['file_name']."' WHERE ".$id_table."='".$key_value."'");
				if(!empty($result_update))
					header($the_link."/".$key_value);//redirect
			}			
//		}
//		else
//		{
//		var_dump('posterror<br />'.$_POST);	
//		}
		$this->samay_don['title'] = 'Prets';
		$this->samay_don['page_menu_name'] 	= 'prets';//$this->prets_model->set_pret_mat();
		$this->load->view('templates/entete', $this->samay_don);
		//$this->load->view('templates/menu_gauche', $this->samay_don);
		$this->load->view('gest_annonces/v_image_add', $this->samay_don);		
		$this->load->view('templates/basdepage', $this->samay_don);	
	}	
	

	public function securite_bdd($var_input)
	{
		/*if(ctype_digit($var_input))//pour les entier
		{
			$var_input=intval($var_input);
		}
		else ///pour les autres 
		{
			$var_input = addslashes($var_input);
			//$var_input = mysql_real_escape_string($var_input);
			//$var_input = addcslashes($var_input,'%_');
		}
		
		return $var_input;*/
		return $this->db->escape($var_input);
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function update_one_key_bis($the_table, $key_name1, $key_value1, $key_name2, $key_value2, $key_name3, $key_value3, $tab_data)
	{
		$ma_req_save = " UPDATE ".$the_table." SET ";
		foreach($tab_data as $one_key => $one_value)
		{
			$ma_req_save.= " `".$one_key."`='".addslashes($one_value)."',";
		}
		$ma_req_save = substr($ma_req_save,0,-1);//supprime le dernier caractere
		$ma_req_save.= " WHERE `".$key_name1."`='".addslashes($key_value1)."' ";		
		$ma_req_save.= " AND `".$key_name2."`='".addslashes($key_value2)."' ";
		$ma_req_save.= " AND `".$key_name3."`='".addslashes($key_value3)."' ";
		$ma_req_save.= " LIMIT 1 ;";		
//var_dump($ma_req_save);	break;
		return $this->db->query($ma_req_save);
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		public function the_session_expired(){
		@$tab_data_ses = $this->session->all_userdata();
//var_dump($tab_data_ses['man_school']);break;
		//$is_authorised 			= $this->get_injection_url(@$tab_data_ses['man_school']['profil']);
		//$is_authorised_regex 	= $this->get_injection_url_regex($tab_data_ses['man_school']['profil']);
		$is_authorised			= "";
		$is_authorised_regex	= "";
		$prenom	= $tab_data_ses['lfc_jafr12_s']['pag_bidar_s'];
		$statut	= $tab_data_ses['lfc_jafr12_s']['statut'];
		$id		= $tab_data_ses['lfc_jafr12_s']['page_bidar_'];
		//$nom	= $tab_data_ses['man_jadelmas']['nom'];
		//$nom	= $tab_data_ses['man_jadelmas']['nom'];
	//var_dump($prenom);	
	//var_dump($id);	
//	break;	
		if (empty($prenom) || empty($id) || !empty($is_authorised) || !empty($is_authorised_regex) ) 
		{ // On teste
		////si l'url contient deja index.php	
			$tab_data_ses = $this->session->all_userdata();
			$this->session->sess_destroy();			 
//			 $pos = strpos($_SERVER['REQUEST_URI'], 'index.php/');
//				if ($pos !== false) {
//					$suite_req='';
//				} 
//				else {
//					$suite_req='index.php/';
//				}
//				header("Location:".$suite_req."se_connecter?erreur=login");
				header("Location:".base_url('')."index.php/sign-in?erreur=login");
				
				//header("Location:se_connecter?erreur=login"); // redirection en cas d'echec		
				exit();
			}
			else if($statut == 'attente'){
				//$this->session->unset_userdata('statut');
				//$this->session->set_userdata('statut','temporaire']);
				header("Location:".base_url('')."index.php/first-connect");
				exit();
			}
			else 
			{
				return 1;
			}
			
			//return 1;
	}

	public function get_injection_url($id_profil)
	{
		$pieces = explode("/", $_SERVER['REQUEST_URI']);
		$reqqq = "SELECT par_id FROM param_aut_menu WHERE par_id='".$id_profil."' AND id=(SELECT id FROM `param_menus` WHERE `nom` = '".$pieces[count($pieces)-1]."')";


		$res_req = $this->get_data_from_sql($reqqq);	
		return (!empty($res_req));
	}	

	public function get_injection_url_regex($id_profil)
	{
		$pieces = explode("/", $_SERVER['REQUEST_URI']);
		$reqqq = "SELECT id FROM param_aut_mot_regex WHERE id_profil='".$id_profil."' AND '".$pieces[count($pieces)-1]."' LIKE CONCAT('%-',`mot`,'%')";
//var_dump($reqqq);break;
		//break;	
		$res_req = $this->get_data_from_sql($reqqq);	
		return (!empty($res_req));
	}	
	
/************************************ print for excel ************************************************************/		
/*
dont forget to include 
folder:::	racine\application\third_party
file  :::	racine\application\libraries\Excel.php

*/	
	public function print_an_excel_file($file_name___, $list_cols, $list_data)
	{
			//= 'laye_ndiaye';
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle($file_name___);
			$i=0;
			foreach($list_cols as $one_col)//ecriture des entetes
			{
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, '1', $one_col); 
				$i++;
			}
			$i=1;
			foreach($list_data as $one_line_data)//ecriture des donnees
			{
				$i++;$j=0;
				foreach($one_line_data as $one_data)//ecriture des entetes '=SUM(A10:E9)'
				{
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $i, $one_data); 
					$j++;
				}
			}
			
		$filename = $file_name___.'__'.date("Y_m_d___H_i_s").'.xls'; //save our workbook as this file name
		//$filename='entrepot_pauvrete'.date().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
		//$objWriter->save($rep_to_save_excel_files.$file_name___.'__'.date("Y_m_d___H_i_s").'.xls');
		//- See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.igQkvT7i.dpuf	
		
		
		//$list_data=null;

	}//END OF THE FUNCTION
	
/********************************************end print for excel******************************************************************************/	
	
	
		
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////////////////////////////////////////////////Refresh for ajax begin ///////////////////////////////////////////////////////	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	public function ajax_get_list_contracts_of_bien($id_bien)
	{
		//$this->db->select('id, date_deb')->from('j_contrat_location')->where(" (j_b_id =$id_bien AND est_supprime = 'Non') ")->order_by('date_deb');
		
		$this->db->select('ct.id, l.prenom, l.nom');
		$this->db->from('j_contrat_location ct');
		$this->db->join('j_locataires l', 'l.id =ct.id');
		$this->db->where("(ct.j_b_id = ".$id_bien." AND ct.est_supprime = 'Non' )");
		$this->db->order_by('l.nom');	
	
		$query = $this->db->get();
		return $query->result();
	}	
	
	public function ajax_get_list_bien_of_a_prop($id_prop)
	{
		$this->db->select('b.id,t.nom,b.nom_bien');
		$this->db->from('j_biens b');
		$this->db->join('j_type_biens t', 't.id =b.j_t_id');
		$this->db->where("(b.j_p_id = ".$id_prop." AND b.est_supprime = 'Non' AND b.id_parent IS NULL)");
		$this->db->order_by('b.nom_bien');	
	
		$query = $this->db->get();
		return $query->result();
	}	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////////////////////////////////////////////////Refresh for ajax end ///////////////////////////////////////////////////////	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		

///man_periode
	public function get_periode_details()
	{
		$ret=array();
		$retour = $this->execute_request("SELECT `id`,CONCAT(`mois`,'_',`annee`) AS descccm FROM `dat_periodes` WHERE `annee`>= YEAR(CURDATE())-1 AND `annee`<= YEAR(CURDATE()) ");
		$result = $retour->result_array()	;
		foreach($result as $one_row)
		{
			$ret[$one_row['id']] = $one_row['descccm'];
		}
		
//var_dump($ret);break;		
		return $ret;
	}
	
	public function get_month_and_year($id_periode){
		$retour = $this->execute_request("SELECT mois , annee from dat_periodes where `id` =".$id_periode);
		$result = $retour->result_array();
		$current_periode="";
		foreach($result as $one_row)
		{
			$current_periode.= $this->Utils_immo->get_months($one_row['mois']).' '.$one_row['annee'];
		}
		return $current_periode;
		
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function get_data_many_keys_cible($table, $col_to_sel, $key_table)    //// TAFSIR ADDED
	{
		$db_cible = $this->load->database('group_cible', TRUE);	// Chargement BD CIBLE
		$req_sql = "SELECT ".trim($col_to_sel)." AS ret__ FROM `".$table."` ";
		$cmpt = 0;
		foreach($key_table as $key => $val)
		{
			if($cmpt == 0)
				$req_sql.="WHERE `".$key."`='".$val."'";
			else
				$req_sql.=" AND `".$key."`='".$val."'";
				$cmpt++;
		}
//echo $req_sql;
		$query_ = $db_cible->query($req_sql);
		$retour = $query_->row_array()	;
		return $retour['ret__'];	
		
//			$key_table = array(
//				'mois' => $_POST['id_mois'],
//				'annee' => $_POST['id_annee'],
//				'statut' => 'actif',
//			);
//			$id_periodee = $this->Global_BDD->get_data_many_keys("dat_periodes", "id", $key_table);
	}
	
	public function update_one_key_cible($the_table, $key_name, $key_value, $tab_data)   //// TAFSIR ADDED
	{
		$db_cible = $this->load->database('group_cible', TRUE);	// Chargement BD CIBLE
		
		$ma_req_save = " UPDATE ".$the_table." SET ";
		foreach($tab_data as $one_key => $one_value)
		{
			$ma_req_save.= " `".$one_key."`='".addslashes($one_value)."',";
		}
		$ma_req_save = substr($ma_req_save,0,-1);//supprime le dernier caractere
		$ma_req_save.= " WHERE `".$key_name."`='".addslashes($key_value)."';";		
		
		return $db_cible->query($ma_req_save);
	}
	
	public function to_Php_Date($sql_date){
		return implode('/', array_reverse( explode('-',$sql_date) ) ) ;
	}
	
	public function to_Sql_Date($php_date){
		return implode('-', array_reverse( explode('/',$php_date) ) ) ;
	}	


/**
*
*/

	
	public function demba_delete_one_elt($table,$curr_id_name='id',$curr_id,$name_url_list,$text_ok)
	{
		$data['title'] 	= $text_ok;
		$id_valeur 		= $curr_id;
		$requete 		= " DELETE FROM ".$table." WHERE $curr_id_name =".$id_valeur."; ";
		$this->execute_request($requete);
		// on charge la view qui contient le corps de la page
		$data['contents'] 			= "designs/v_delete_gobal";
		$data['text_ok'] 			= $text_ok;
		$data['name_url_list'] 		= $name_url_list;
		//$data['infos_inscrip'] 		= $this->Inscription_model->get_one_elt($id_valeur);
		//$data['current_stat'] 		= 1;
		// on charge la page dans le template
		////$this->load->view('demba_templates/template', $data);
		$this->load->view('designs/template_data_tables', $data);	

	}	
	
	public function delete_one_row_mssql($table,$curr_id_name='id',$id_valeur)
	{
		//$data['title'] 	= $text_ok;
		//$id_valeur 		= $curr_id;
		$requete 		= " DELETE FROM ".$table." WHERE $curr_id_name =".$id_valeur."; ";
		$retour 		= $this->execute_request($requete);
		// on charge la view qui contient le corps de la page
		//$data['contents'] 			= "designs/v_delete_gobal";
		//$data['text_ok'] 			= $text_ok;
		//$data['name_url_list'] 		= $name_url_list;
		//$data['infos_inscrip'] 		= $this->Inscription_model->get_one_elt($id_valeur);
		//$data['current_stat'] 		= 1;
		// on charge la page dans le template
		////$this->load->view('demba_templates/template', $data);
		//$this->load->view('designs/template_data_tables', $data);	
		return $retour;

	}	
	
	
	
		
}//end class
?>
