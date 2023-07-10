<?php
class M_entreprises_secteur extends  MY_Model
{

  public $id;

  public function get_db_table()
  {
    return 'c_entreprises_secteurs';
  }

  public function get_db_table_pk()
  {
    return 'id';
  }

  public function get_data_liste()
  {
    return $this->db->select("
      p.id, p.libelle, p.commentaires,p.id_op_saisie, p.etat,
        
         ")
      ->from('c_entreprises_secteurs p')
      //->join('c_bee_sections s','s.id=p.libelle')
      ->get()
      ->result();

    //result_array
  }

  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
    p.id, p.libelle, p.commentaires, p.date_last_modif,p.etat
    ,CONCAT(u.prenom,' ',u.nom) _id_op_saisie
          ")
      ->from('c_entreprises_secteurs p')
      ->join('sys_niits AS u', 'u.id=p.id_op_saisie', 'LEFT')
      ->where('p.id', $id_elt)

      //order
      ->get()
      ->row_array();

    //result_array
  }


  /////////////////////SAVING
  function insert_one_modele_vehicule($data)
  {
    return $this->db->insert('c_entreprises_secteurs', $data);
  }

  /////////////////////SAVING
  function update_one_s($id_val, $data)
  {
    //demba_debug($id_val);
    $this->db->where('id', $id_val);
    return $this->db->update('c_entreprises_secteurs', $data);
  }
}
