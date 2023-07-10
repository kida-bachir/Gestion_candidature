<?php
class M_front extends  CI_Model
{

   public $id;



   public function get_data_liste()
   {
      return $this->db->select("
       p.id,c.libelle _categ_offre,p.id_categorie,p.libelle, p.description,p.date_publication,p.date_cloture, p.img_1, p.etat
         
          ")
         ->from('c_offres p')
         ->join('c_categorie_des_offres AS c', 'c.id=p.id_categorie', 'INNER')
         ->get()
         ->result();

      //result_array
   }


   public function get_data_one_elt($id_elt)
   {
      return $this->db->select("
               p.id,c.libelle _categ_offre ,p.id_categorie,p.libelle, p.description,p.date_publication,p.date_cloture, p.img_1, p.etat

              ")
         ->from('c_offres p')
         ->join('c_categorie_des_offres AS c', 'c.id=p.id_categorie', 'INNER')
         ->where('p.id', $id_elt)

         //order
         ->get()
         ->row_array();

      //result_array
   }

   /////////////////////SAVING
   function insert_one_element_principal($data)
   {
      return $this->db->insert('c_offres', $data);
   }

   /////////

   function update_one_s($id_val, $data)
   {
      //demba_debug($id_val);
      $this->db->where('id', $id_val);
      return $this->db->update('c_offres', $data);
   }
}
