<?php

   class M_e_services extends  MY_Model{
  
      public $id;
      public $libelle;
      public $commentaires;
      public $date_last_modif;
  
      public function get_db_table()
      {
         return 'e_services';
      }
  
      public function get_db_table_pk()
      {
          return 'id';
      }
  	
      public function get_data_liste(){
  
  		$sql_ll="SELECT id ,libelle,commentaires,date_last_modif FROM e_services  ";		    
  		
  		$query = $this->db->query($sql_ll);
  		
  		return $query->result(); 
      }
  
  }
