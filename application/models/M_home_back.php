<?php 
class M_home_back extends CI_Model {
	public $id;
	

	//stats dashboard
		
	public function get_data_histo() 
	{			
		$sql_ll = "
			SELECT h.texte, h.type, h.date_act, h.id_site
			FROM z_trace_activities h 
		";
		//$sql_ll.=$where_req;

		$query = $this->db->query($sql_ll);
		return $query->result(); 

	}

		//stats dashboard
		
		public function get_global_stat() 
		{			

			$sql_ll = "
				SELECT COUNT(*) collectes
				,(SELECT COUNT(*) collectes FROM c_collectes_periodiques where statut='1') _actives
				,(SELECT COUNT(*) FROM c_bec_saisie_dp) bec_all_data
				,(SELECT COUNT(*) FROM c_bec_saisie_dp where etat='2') bec_all_data_act
				,(SELECT COUNT(*) FROM c_bee_saisie_dp) 				bee_all_data
				,(SELECT COUNT(*) FROM c_bee_saisie_dp where etat='2') 	bee_all_data_act
				
				,(SELECT COUNT(*) FROM c_bec_produits ) nb_prod
				,(SELECT COUNT(*) FROM c_bec_produits_entreprises ) nb_prod_entre
				,(SELECT COUNT(*) FROM c_entreprises ) nb_entr

				,(SELECT COUNT(*) FROM sys_niits) 	all_user
				FROM c_collectes_periodiques
			";
		//	$sql_ll.=$where_req;
	
			$query = $this->db->query($sql_ll);
			return $query->result_array()['0']; 
	
		}

	//stats dashboard
	public function get_stat_state_agents() 
	{			
		$sql_ll = "
			SELECT COUNt(*) _nb_elts,s.libelle
			FROM p_agents a 
			INNER JOIN d_agents_statuts s ON (s.id=a.curr_statut)
			GROUP BY s.id
		";

		$query = $this->db->query($sql_ll);
		return $query->result_array(); 
	}

	//stats get_next_conges
	public function get_next_conges() 
	{			
		return $this->db->select("c.id,a.prenom,a.nom,c.date_deb_prev
		,t.libelle _type_absence 
		,s.libelle _service 
				")
		->from('p_agents_abcenses_conges c')
		->join('p_agents              a','a.code_agent=c.code_agent','INNER')
		->join('d_par_conges_raisons_absences  t','t.id=c.id_raison_absence','INNER')
		->join('p_agents_affectations_postes  aff','aff.code_agent=a.code_agent','LEFT')
		->join('e_services  s','s.id=aff.id_structure_act','LEFT')
		//->where('a.code_courrier',$code_courr_arr)
		//->order_by('c.libelle')
		->get()
		->result();
	}

	//stats dashboard
	public function get_data_histo_one_agent($id_elt) 
	{			
        return $this->db->select("
            d.id,pe.identifiant_produit code,d.etat,d.mois,d.annee,d.valeur
            ,g.libelle _libelle_prod
            ,e.libelle _libelle_entreprise ,e.sigle sigle,g.libelle _libelle_gamme
            ,u.libelle _unite
            ,CASE d.mois
              WHEN '01' THEN 'Janv.'
              WHEN '02' THEN 'Fevr.'
              WHEN '03' THEN 'Mars'
              WHEN '04' THEN 'Avr.'
              WHEN '05' THEN 'Mai.'
              WHEN '06' THEN 'Juin'
              WHEN '07' THEN 'Juil.'
              WHEN '08' THEN 'Aout'
              WHEN '09' THEN 'Sept.'
              WHEN '10' THEN 'Oct.'
              WHEN '11' THEN 'Nov.'
              WHEN '11' THEN 'Dec.'
            END _mois
        
        ")
        ->from('c_bec_saisie_dp d')
        ->join('c_bec_produits_entreprises pe','pe.id=d.id_produit_entreprise')
        ->join('c_entreprises e','e.id=pe.id_entreprise')
      //  ->join('c_bec_produits pr','pr.id=pe.id_produit')
        ->join('c_bec_gammes g','g.id=pe.id_gamme')
        ->join('n_type_unites u','u.id=pe.id_unite')
		->where('d.id_op_saisie',$id_elt)
        ->order_by('d.id', 'DESC')
        ->get()
        ->result();
	}
	

}//end class
