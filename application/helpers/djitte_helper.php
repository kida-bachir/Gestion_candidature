<?php

	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');
	}

	function is_authorised($type, $smenu)
	{
		$arr_type = array(
			'add' => 'd_add',
			'update' => 'd_upd',
			'delete' => 'd_del',
			'read' => 'd_read',
		);
		$ins=get_instance();
		$tab_smrole = $ins->session->smenu_roles;
		//demba_debug($tab_smrole[$smenu][$arr_type[$type]]);

		$retour = null;
		if (!empty($tab_smrole[$smenu][$arr_type[$type]])) {
			$retour = $tab_smrole[$smenu][$arr_type[$type]];
		}

		return $retour;
	}


//Array ( [add] => [update] => [delete] => [read] => 1 ) 

	function rdc2_get_auth($smenu)
	{
		$retour  = array(
			'add' 		=> is_authorised('add',$smenu),
			'update' 	=> is_authorised('update',$smenu),
			'delete' 	=> is_authorised('delete',$smenu),
			'read' 		=> is_authorised('read',$smenu),
		);

		return $retour;
	}


	function change_encoding($chaine) 
	{
		$txt = str_replace(array('é','è','ê'), '&eacute;', $chaine);
		$txt = str_replace(array("'","’"), " ", $txt);

		return $txt;
	}