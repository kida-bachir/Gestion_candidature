<?php
class M_connexions extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}	


	public function identification($login,$pass)
	{

		$sql_ll = "
		SELECT u.id page_bidar_, CONCAT(UPPER(u.prenom), ' ',UPPER(u.nom)) AS user_conn
						,p.libelle_type_profil AS profil_name
						,p.id AS id_profil
						,u.id_site id_site
						,u.email email
						,u.id_site /*sit.libelle*/ _site_name
			FROM sys_almustakhdam u
			INNER JOIN sys_type_profil p ON (u.id_type_profil=p.id)
			
		";

		$sql_ll.="WHERE u.email=? AND  u.mot_de_passe=? AND u.etat='actif' ";//merci de renseigner le mail dans la table agent sino cela ne marchera pas
			
	//demba_debug($sql_ll);							
		$query = $this->db->query($sql_ll,array($login,$pass));								

		return $query->row_array();
	}
}