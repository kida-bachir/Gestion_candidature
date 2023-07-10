<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

	function get_folder_img_to_show($space="")//l'afficage passe par local host alors que le test d'existe sur le folder physique
	{
		return base_url()."hp7gl0es1/c_arr/";
	}

	function get_folder_img_work($space="")
	{
		return FCPATH."hp7gl0es1/c_arr/";
	}

	function get_url_img_products()
	{
		return 'yegles18/products/';
	}

	function get_file_extention($file_name)
	{
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		return $ext;
	}

	function get_valid_extension($file_name)
	{											                        

		$retour		= 0 ;
		$tab_aut_ext= array('png','gif','pdf','jpg','jfif','jpeg');

		$tab 		= explode('.',$file_name);
		$extension 	= $tab[count($tab)-1];
		$extension 	= strtolower($extension);
		//demba_debug($extension);
		if(in_array($extension,$tab_aut_ext))
		{
			$retour		= '1' ;
		}
		return $retour;
	}
	