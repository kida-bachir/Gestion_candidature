<?php
  class M_sys_almustakhdam extends  MY_Model{
  
      public $id;
     // public $id_service;
     // public $ien;
      public $email;
     // public $nom;
      public $code_agent	;
      public $id_type_profil;
      public $mot_de_passe;
      public $etat;
      public $date_last_modif;
  
      public function get_db_table()
      {
         return 'sys_almustakhdam';
      }
  
      public function get_db_table_pk()
      {
          return 'id';
      }
  	
      public function get_data_liste()
      {
        $sql_ll="
        SELECT n.id,n.`email` _email,a.`nom` _nom,a.`prenom` _prenom
          ,n.`id_type_profil`,n.`mot_de_passe`
          ,  pr.libelle_type_profil _the_prof  
          , n.`etat` etat
          ,COALESCE(s.libelle,'Aucun') _the_serv
          FROM `sys_almustakhdam` n  
          INNER JOIN `p_agents` a ON(a.code_agent=n.code_agent) 
          INNER JOIN `sys_type_profil` pr ON(pr.id=n.id_type_profil)
          LEFT JOIN `p_agents_affectations_postes` aff ON(aff.code_agent=a.code_agent)
          LEFT JOIN `e_services` s ON(s.id=aff.id_structure_act)
        ";	    
        $query = $this->db->query($sql_ll);
        
        return $query->result(); 
      }

      public function get_list_email_admin()
      {
        $sql_ll="
          SELECT `email` FROM sys_almustakhdam WHERE id_type_profil='1'
        
        ";		    
        $query = $this->db->query($sql_ll);
        
        return $query->result_array(); 
      }
  
  }
