<?php 
class M_z_historique extends MY_Model {
	public $id;
	public $ip;
	public $login;
	public $date_conn;
	public $navigateur;
	public $statut;
	public $sens;
	public $page_bid;
	public $profil_id;
	public $est_supprime;
	public $id_op_saisie;
	public function get_db_table()
	{
		return ' z_connexions';
	}

	public function get_db_table_pk()
	{
		return 'id';
	}

	public function get_data_liste($table='') 
	{			
		return $this->db->select('m.*, m.date_last_modif as _date')
		->from('z_connexions m')
        ->order_by('m.id', 'DESC')
		->get()
		->result();
		
	}

	public function get_data_liste_err($table='') 
	{			
		return $this->db->select('m.*')
		->from('z_log_error_connexions m')
        ->order_by('m.id', 'DESC')
		->get()
		->result();
		
	}	

	

}
