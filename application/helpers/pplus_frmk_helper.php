<?php

	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');
	}

	function pplus_frmk_helper()
	{
		if (!is_array($data)) {
			return '<option value="">Choisir...</option>';
		}
		$pulldown_list = '<option value="">Choisir...</option>';
		foreach ($data as $value)
		{
			$selected = '';
			$chained='';
			if($default_value ==  $value->$key && $default_value != null)
				$selected = 'selected';
			
			if($chained_attr != null && isset($value->$chained_attr ))
				$chained='class="'.$value->$chained_attr.'"';
			else if($chained_attr != null && !isset($value->$chained_attr ))  
				$chained='class="-1234"';
			
			$pulldown_list .= '<option '.$selected.'  value="' . $value->$key . '" '.$chained.' >' . $value->$label . '</option>';
		}
		return $pulldown_list;
	}

