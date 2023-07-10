<?php
class M_sys_niits extends  MY_Model
{

  public $id;
  public $id_op_saisie;

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
    return $this->db->select("
            u.id,CONCAT(u.prenom,' ',u.nom) _agent,u.email,u.commentaires, u.date_creation,u.etat,
            p.libelle_type_profil AS _profil, p.date_last_modif
            ,s.libelle _service
         ")
      ->from('sys_almustakhdam u')
      ->join('sys_type_profil p', 'p.id=u.id_type_profil')
      ->join('sys_sites s', 's.id=u.id_site')
      ->get()
      ->result();

    //result_array
  }

  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
        u.prenom, u.nom, u.id_type_profil,u.id_site,
        u.id,CONCAT(u.prenom,' ',u.nom) _agent,u.email, u.date_creation
        ,u.etat,u.commentaires
        ,p.libelle_type_profil AS _profil
        ,CONCAT(by.prenom,' ',by.nom) _created_by
        ,s.libelle _service
          ")
      ->from('sys_niits u')
      ->join('sys_type_profil p', 'p.id=u.id_type_profil')
      ->join('sys_sites s', 's.id=u.id_site')
      ->join('sys_niits by', 'by.id=u.id_op_saisie', 'LEFT')
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
  function update_one_ss($id_val, $data)
  {
    $this->db->where('id', $id_val);
    return $this->db->update('sys_almustakhdam', $data);
  }
}
