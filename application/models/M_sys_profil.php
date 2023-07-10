<?php 
class M_sys_profil extends MY_Model
{
	public $id;
	public $libelle_type_profil;
	public $etat;
	
	private $insert_role = '';
	private $update_role = '';
			


	public function get_db_table(){
		return 'sys_type_profil';
	}
	public function get_db_table_pk(){
		return 'id';
	}
	
	public function get_data_liste()
	{
		$sql = "SELECT pr.* 
				,(SELECT sm.id FROM sys_almustakhdam sm  WHERE sm.id_type_profil=pr.id LIMIT 0,1) _has_soon1
		FROM sys_type_profil pr
				";
	
		$query = $this->db->query($sql);
		return $query->result();
	}

}
