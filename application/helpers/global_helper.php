<?php

function btn_add_action($smenu_code)
{
	$ins=get_instance();
    $tab_smrole = $ins->session->smenu_roles;
	
	if(isset($tab_smrole[$smenu_code]['d_add']))
	{
		echo '<div class="row">
                <div class="col-sm-12" style="margin-bottom: 30px">
                    <button type="button" id="btn_add" class="btn btn-primary">Ajouter <span lass="m-l-5"><i
                                class="fa fa-plus-square"></i></span></button>
                </div>
            </div>';
	}
}


function btn_edit_action($id, $smenu_code)
{
    $tab_smrole = $ins->session->smenu_roles;
	if(isset($tab_smrole[$smenu_code]['d_upd']))
	{
		echo '<a href="#" class="on-default btn_edit"
          id="'.$id.'"><i class="fa fa-pencil"></i></a>&nbsp;';
	}
}



function check_exist_dat($table,$col_tbl_name, $value_to_search)
{
	$CI = get_instance();
	$value_to_search = addslashes($value_to_search);
	$sql = "SELECT COUNT(*) AS nb_elt
			FROM ".$table." 
			WHERE ".$col_tbl_name."='".trim($value_to_search)."' ";
	
	//$query = $this->db->query($sql);
	$query 	= $CI->db->query($sql);

	return $query->row_array()["nb_elt"];
}


function btn_delete_action($id, $smenu_code)
{
	$tab_smrole = $ins->session->smenu_roles;
	if(isset($tab_smrole[$smenu_code]['d_del']))
	{
		echo '<a href="#" class="on-default btn_delete"
          id="'.$id.'"><i class="fa fa-trash-o" style="color:red"></i></a>&nbsp;';
	}
}


function btn_show_action($id, $smenu_code)
{
    $tab_smrole = $ins->session->smenu_roles;
	if(isset($tab_smrole[$smenu_code]['d_read']))
	{
		echo '<a href="#" class="on-default btn_edit"
           id="'.$id.'"><i class="fa fa-eye" style="color:#CCCCCC"></i></a>';
	}
}
unset($tab_smrole);

function format_date($value)
{

    if($value == NULL)
        return '';
    else
        return date('d/m/Y', strtotime($value));

}

/*
* @$table: 		Tableau dans lequel on fait la recherche
* @$to_find: 	Param�tre de recherche
* @$colonne:  	Colonne sur le sous tableaux
* @$cle:		La colonne du tableau associatif
*/

function multi_array_search($table, $to_find, $colonne, $cle)
{
	$val = $table[array_search($to_find, array_column($table, $colonne))][$cle];
	return $val;
}


function demba_debug($var, $exit='1')
{
	print_r($var);
	if($exit=='1')
		exit();
}


function show_status_img($value)
{	
	$val_ret = array(
		'' 	=> 'badge badge-info',
		'impute_attente' 	=> 'badge badge-warning',
		'traité' 			=> 'badge badge-info',
		'rejeté' 			=> 'badge badge-danger',
		'cloture' 			=> 'badge badge-success',
		'archivé' 			=> 'badge badge-light',
		
		'validé' 			=> 'badge badge-success',
		'en_attente' 		=> 'badge badge-warning',
		'a_traité' 			=> 'badge badge-info',
		'en_cours' 			=> 'badge badge-warning',
	);
//demba_debug($value);
	return "<span class='".$val_ret[$value]."'> &nbsp; &nbsp; </span>";
}

	
	function show_breadcrumbs($breadcrumbs)
	{
		//demba_debug($breadcrumbs);
		get_breadcrumbs($breadcrumbs['0'],$breadcrumbs['1'],$breadcrumbs['2']);
	}
	
	function get_breadcrumbs($link_list,$nom_elt,$title)
	{
		?>
		<nav style="--bs-breadcrumb-divider: '>';">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url('back-office')  ?>">Accueil</a></li>
			<li class="breadcrumb-item"><a href="<?php echo site_url($link_list)  ?>">  Liste des <?php echo $nom_elt; ?>s  </a></li>
			<li class="breadcrumb-item active"><?php echo $title ?></li>
		</ol>
		</nav>
		<?php
	}

	//affiche les boutons vert ou rouge du champ etat
	function show_state_color($val)
	{
		if($val=='1')
		{
			?><span class="badge bg-success"> &nbsp; Actif &nbsp;</span><?php 
		}
		else if(empty($val))
		{
			?><span class="badge bg-danger">Inactif</span><?php 
		}
	}


		//affiche les boutons vert ou rouge du champ etat
		function show_state_user_color($val)
		{
			if(empty($val))
			{
				?><span class="badge bg-danger">&nbsp; Inactif &nbsp; </span><?php 
			}
			else if($val=='actif')
			{
				?><span class="badge bg-success">&nbsp; &nbsp; Actif &nbsp; &nbsp; &nbsp; </span><?php 
			}
			else if($val=='suspendu')
			{
				?><span class="badge bg-warning">Suspendu</span><?php 
			}
			else if($val=='blocke')
			{
				?><span class="badge bg-danger">&nbsp; &nbsp; Blocke &nbsp; </span><?php 
			}
		}


	function get_browser_name()
	{
		/*
		$user_agent  = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
		elseif (strpos($user_agent, 'Edge')) return 'Edge';
		elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
		elseif (strpos($user_agent, 'Safari')) return 'Safari';
		elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
		elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
		
		return 'Other';
		*/
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}


	function formatter_montant($val)
	{
		if(empty($val))
			return $val;
		else
			echo number_format($val,0," "," "); 
	}