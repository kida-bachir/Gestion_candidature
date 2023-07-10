<?php
class M_sys_niits extends  MY_Model
{

  public $id;
  public $id_op_saisie;

  public function get_db_table()
  {
    return 'sys_niits';
  }

  public function get_db_table_pk()
  {
    return 'id';
  }

  public function get_data_liste()
  {
    return $this->db->select("
            u.id,CONCAT(u.prenom,' ',u.nom) _agent,u.email,u.date_creation,u.etat,
            p.libelle_type_profil AS _profil
         ")
      ->from('sys_niits u')
      ->join('sys_type_profil p','p.id=u.id_type_profil')
      ->get()
      ->result();

    //result_array
  }

  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
      u.id,CONCAT(u.prenom,' ',u.nom) _agent,u.email,u.date_creation
        ,u.etat,u.commentaires
        ,p.libelle_type_profil AS _profil
        ,CONCAT(by.prenom,' ',by.nom) _created_by
          ")
          ->from('sys_niits u')
          ->join('sys_type_profil p','p.id=u.id_type_profil')
          ->join('sys_niits by','by.id=u.id_op_saisie', 'LEFT')
      ->where('u.id', $id_elt)
      ->get()
      ->row_array();

    //result_array
  }


  /////////////////////SAVING
  function insert_one_elt($data)
  {
    return $this->db->insert('sys_niits', $data);
  }

      /////////////////////SAVING
      function update_one_ss($id_val,$data)
      {
        $this->db->where('id', $id_val);
        return $this->db->update('sys_niits', $data);
      }	


}
