<?php
class M_sys_menu extends  MY_Model
{

  public $id;

  public function get_db_table()
  {
    return 'sys_menu';
  }

  public function get_db_table_pk()
  {
    return 'id';
  }

  public function get_data_liste()
  {
    return $this->db->select("
      p.id,p.code, p.libelle, p.etat,p.rang  ")
      ->from('sys_menu p')
      //->join('sys_sous_menu sm', 'sm.id=p.id')
      ->order_by('p.rang', 'ASC')
      ->get()
      ->result();

    //result_array
  }

  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
    p.id, p.code, p.libelle, p.etat, p.date_last_modif,
    ,CONCAT(u.prenom,' ',u.nom) rang
          ")
      ->from('sys_menu p')
      ->join('sys_niits AS u', 'u.id=p.rang', 'LEFT')
      ->where('p.id', $id_elt)

      //order
      ->get()
      ->row_array();

    //result_array
  }


  /////////////////////SAVING
  function insert_one_modele_vehicule($data)
  {
    return $this->db->insert('sys_menu', $data);
  }

  /////////////////////SAVING
  function update_one_menu($id_val, $data)
  {
    //demba_debug($id_val);
    $this->db->where('id', $id_val);
    return $this->db->update('sys_menu', $data);
  }
}
