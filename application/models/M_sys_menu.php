<?php

class M_sys_menu extends  MY_Model{
  
  public $id;
  public $code;
  public $libelle;
  public $etat;
  public $rang;
  public $date_last_modif;

 // public $id_op_saisie;
 

  public function get_db_table()
  {
     return 'sys_menu';
  }

  public function get_db_table_pk()
  {
      return 'id';
  }
  
  public function get_menu_liste(){
    
    $sql_ll="SELECT m.id,m.code, m.libelle, m.etat,m.rang
    ,(SELECT sm.id FROM sys_sous_menu sm  WHERE sm.id_menu=m.id LIMIT 0,1) _has_soon1
     FROM `sys_menu` m
   ";		    
   $query = $this->db->query($sql_ll);
   return $query->result(); 
}


  



  
}
