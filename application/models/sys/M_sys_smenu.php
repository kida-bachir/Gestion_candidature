<?php
class M_sys_smenu extends  MY_Model
{

  public $id;

  public function get_db_table()
  {
    return 'sys_sous_menu';
  }

  public function get_db_table_pk()
  {
    return 'id';
  }

  public function get_data_liste()
  {
    return $this->db->select("
      p.id,p.id_menu,p.code, p.libelle, p.etat,
  
      sm.libelle AS _nom_section
      ")
      ->from('sys_sous_menu p')
      ->join('sys_menu sm', 'sm.id=p.id_menu')
      ->get()
      ->result();

    //result_array
  }

  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
    p.id,p.id_menu, p.code, p.libelle, p.date_last_modif,p.etat
    
          ")
      ->from('sys_sous_menu p')
      //->join('sys_niits AS u', 'u.id=p.id_op_saisie', 'LEFT')
      ->where('p.id', $id_elt)
      ->get()
      ->row_array();

    //result_array
  }



  /////////////////////SAVING
  function insert_one_modele_vehicule($data)
  {
    return $this->db->insert('sys_sous_menu', $data);
  }

  /////////////////////SAVING
  function update_one_ss($id_val, $data)
  {

    //demba_debug($data);
    $this->db->where('id', $id_val);
    return $this->db->update('sys_sous_menu', $data);
  }
}
