<?php
class M_collectes_periodiques extends  MY_Model
{

  public $id;

  public function get_db_table()
  {
    return 'c_collectes_periodiques';
  }

  public function get_db_table_pk()
  {
    return 'id';
  }

  public function get_data_liste($id_site_name)
  {
    //demba_debug();
    if ($id_site_name == 'ANSD')
    {
      return $this->db->select("
        p.id,p.description,p.annee,p.id_source,p.id_op_saisie, p.statut,p.date_creation,p.date_last_modif
        ,(SELECT COUNT(*) FROM c_bec_saisie_dp s_bec WHERE s_bec.mois=p.mois AND s_bec.annee=p.annee) _nb_elts_bec
        ,(SELECT COUNT(*) FROM c_bee_saisie_dp s_bee WHERE s_bee.mois=p.mois AND s_bee.annee=p.annee) _nb_elts_bee
        ,CASE p.mois
        WHEN '01' THEN 'Janv.'
        WHEN '02' THEN 'Fevr.'
        WHEN '03' THEN 'Mars'
        WHEN '04' THEN 'Avr.'
        WHEN '05' THEN 'Mai.'
        WHEN '06' THEN 'Juin'
        WHEN '07' THEN 'Juil.'
        WHEN '08' THEN 'Aout'
        WHEN '09' THEN 'Sept.'
        WHEN '10' THEN 'Oct.'
        WHEN '11' THEN 'Nov.'
        WHEN '11' THEN 'Dec.'
      END mois

          ")
        ->from('c_collectes_periodiques p')
        ->get()
        ->result();
    } 
    else 
    {
      return $this->db->select("
      p.id,p.description,p.annee,p.id_source,p.id_op_saisie, p.statut,p.date_creation,p.date_last_modif
      ,(SELECT COUNT(*) FROM c_bec_saisie_dp s_bec WHERE s_bec.mois=p.mois AND s_bec.annee=p.annee) _nb_elts_bec
      ,(SELECT COUNT(*) FROM c_bee_saisie_dp s_bee WHERE s_bee.mois=p.mois AND s_bee.annee=p.annee) _nb_elts_bee
      ,
      CASE p.mois
      WHEN '01' THEN 'Janv.'
      WHEN '02' THEN 'Fevr.'
      WHEN '03' THEN 'Mars'
      WHEN '04' THEN 'Avr.'
      WHEN '05' THEN 'Mai.'
      WHEN '06' THEN 'Juin'
      WHEN '07' THEN 'Juil.'
      WHEN '08' THEN 'Aout'
      WHEN '09' THEN 'Sept.'
      WHEN '10' THEN 'Oct.'
      WHEN '11' THEN 'Nov.'
      WHEN '11' THEN 'Dec.'
    END mois

        ")
        ->from('c_collectes_periodiques p')
        ->where('p.id_source', $id_site_name)
        ->get()
        ->result();
    }


    //result_array
  }

  ///for val



  public function get_data_one_elt($id_elt)
  {
    return $this->db->select("
    p.id,p.description,p.mois,p.annee,p.id_source,p.id_op_saisie, p.statut,
    ,CONCAT(u.prenom,' ',u.nom) _id_op_saisie
          ")
      ->from('c_collectes_periodiques p')
      ->join('sys_niits AS u', 'u.id=p.id_op_saisie', 'LEFT')
      ->where('p.id', $id_elt)
      ->get()
      ->row_array();

    //result_array
  }

  
  public function get_one_period_form_one_collecte($id_elt)
  {
    return $this->db->select("
        mois,annee
          ")
      ->from('c_collectes_periodiques')
      ->where('id', $id_elt)
      ->get()
      ->row_array();

    //result_array
  }

  public function get_data_entry_one_elt($id_elt, $id_site, $mois, $annee)
  {
    if ($id_site == 'ansd' || $id_site == 'bec') {
      return $this->db->select("
      d.id,pe.identifiant_produit code,d.etat,d.mois,d.annee,d.valeur
      ,pr.libelle _libelle_prod
      ,e.libelle _libelle_entreprise ,e.sigle sigle,g.libelle _libelle_gamme
      ,u.libelle _unite
      ,CASE d.mois
        WHEN '01' THEN 'Janv.'
        WHEN '02' THEN 'Fevr.'
        WHEN '03' THEN 'Mars'
        WHEN '04' THEN 'Avr.'
        WHEN '05' THEN 'Mai.'
        WHEN '06' THEN 'Juin'
        WHEN '07' THEN 'Juil.'
        WHEN '08' THEN 'Aout'
        WHEN '09' THEN 'Sept.'
        WHEN '10' THEN 'Oct.'
        WHEN '11' THEN 'Nov.'
        WHEN '11' THEN 'Dec.'
      END mois
  
  ")
        ->from('c_bec_saisie_dp d')
        ->join('c_bec_produits_entreprises pe', 'pe.id=d.id_produit_entreprise','LEFT')
        ->join('c_entreprises e', 'e.id=pe.id_entreprise','LEFT')
        ->join('c_bec_produits pr', 'pr.id=pe.id_produit','LEFT')
        ->join('c_bec_gammes g', 'g.id=pr.id_gamme','LEFT')
        ->join('n_type_unites u', 'u.id=pe.id_unite','LEFT')
        ->where('d.mois', $mois)
        ->where('d.annee', $annee)
        ->order_by('d.id', 'DESC')
        ->get()
        ->result();
    } 
    else if ($id_site == "bee") ////bee 
    {
      return $this->db->select("
        d.id,d.code_produit_pays AS identifiant_produit,d.poids,d.valeur,d.etat,d.annee,d.date_creation
        ,p.libelle _libelle_prod ,c.nom_fr_fr
        ,CONCAT(u.prenom,' ',u.nom) _created_by
            ,CASE d.mois
              WHEN '01' THEN 'Janv.'
              WHEN '02' THEN 'Fevr.'
              WHEN '03' THEN 'Mars'
              WHEN '04' THEN 'Avr.'
              WHEN '05' THEN 'Mai.'
              WHEN '06' THEN 'Juin'
              WHEN '07' THEN 'Juil.'
              WHEN '08' THEN 'Aout'
              WHEN '09' THEN 'Sept.'
              WHEN '10' THEN 'Oct.'
              WHEN '11' THEN 'Nov.'
              WHEN '11' THEN 'Dec.'
            END mois
        
        ")
        ->from('c_bee_saisie_dp d')
        ->join('c_bee_produits_pays pp','pp.code=d.code_produit_pays','LEFT')
        ->join('c_bee_produits p','p.id=pp.id_produit','LEFT')
        ->join('c_bee_pays c','c.code_ansd=right(d.code_produit_pays,3)','LEFT')
        ->join('sys_niits u','u.id=d.id_op_saisie','LEFT')
        ->where('d.mois', $mois)
        ->where('d.annee', $annee)
        ->get()
        //->row_array();
        ->result();
    }
  }


  /////////////////////SAVING
  function insert_one_modele_vehicule($data)
  {
    return $this->db->insert('c_collectes_periodiques', $data);
  }

  /////////////////////SAVING
  function update_one_ss($id_val, $data)
  {
    $this->db->where('id', $id_val);
    return $this->db->update('c_collectes_periodiques', $data);
  }



  public function update_course_status($course_id, $status)
  {
    $data['status'] = $status;
    $this->db->where('id', $course_id);
    $this->db->update('c_collectes_periodiques', $data);
  }
}
