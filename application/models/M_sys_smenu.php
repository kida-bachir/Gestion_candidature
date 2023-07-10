<?php

class M_sys_smenu extends  MY_Model{
  
  public $id;
  public $id_menu;
  public $code;
  public $libelle;
  public $date_last_modif;
  public $etat;
 // public $id_op_saisie;
 

  public function get_db_table()
  {
     return 'sys_sous_menu';
  }

  public function get_db_table_pk()
  {
      return 'id';
  }
  
  public function get_data_liste(){

    $sql_ll="SELECT sm.id,sm.code, sm.libelle, sm.etat,m.libelle _menu
    ,(SELECT r.id FROM sys_type_action r  WHERE r.id_sous_menu=sm.id LIMIT 0,1) _has_soon1
     FROM `sys_sous_menu`  sm
     INNER JOIN sys_menu m ON (m.id=sm.id_menu)
   ";		    
   $query = $this->db->query($sql_ll);
   return $query->result(); 
}


  



  
}
