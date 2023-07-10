<?php
class M_sys_profils extends  MY_Model
{

  public $id;
  public $id_op_saisie;
  public $id_actions;
	public $id_type_profil;
	public $id_sous_menu;
	public $d_read;
	public $d_add;
	public $d_upd;
	public $d_del;

  public function get_db_table()
  {
    return 'sys_type_profil';
  }

  public function get_db_table_pk()
  {
    return 'id';
  }

  public function get_data_liste()
  {
    return $this->db->select("
            u.id,u.libelle_type_profil,u.date_last_modif,u.etat
         ")
      ->from('sys_type_profil u')
      ->get()
      ->result();

    //result_array
  }

  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
       u.id,u.libelle_type_profil,u.date_last_modif,u.etat
          ")
          ->from('sys_type_profil u')
      ->where('u.id', $id_elt)
      ->get()
      ->row_array();

    //result_array
  }


  /////////////////////SAVING
  function insert_one_elt($data)
  {
    return $this->db->insert('sys_type_profil', $data);
  }

      /////////////////////SAVING
      function update_one_ss($id_val,$data)
      {
        $this->db->where('id', $id_val);
        return $this->db->update('sys_type_profil', $data);
      }	


}
