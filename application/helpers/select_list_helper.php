<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function create_select_list($data, $key, $label, $default_value=null,$chained_attr=null)
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


    function gen_option_for_a_select($data, $selected_id='')
    {
    //print_r($data);
    //exit();  
        if (!is_array($data)) {
            return '<option value=""> Choisir...</option>';
        }
    // $pulldown_list = '<option value=""></option>';
            $txt_check = "";

        $pulldown_list = '';
        foreach ($data as $key=>$one_label)
        {
            if(!empty($selected_id))
            {
                if($key== $selected_id)
                    $txt_check = " selected='selected' ";
                else
                    $txt_check = "";
            }
                

            $pulldown_list .= '<option value="'.$key.'" '.$txt_check.'> '. $one_label . '</option>';
        }
        return $pulldown_list;
    }



function gen_option_for_month($add_defaul='y',$set_default='',$filter='')
{
    $pulldown_list = '<option value="1" >Janvier</option>';

        $pulldown_list .= '<option value="2" >Février</option>';
        $pulldown_list .= '<option value="3" >Mars</option>';
        $pulldown_list .= '<option value="4" >Avril</option>';
        $pulldown_list .= '<option value="5" >Mai</option>';
        $pulldown_list .= '<option value="6" >Juin</option>';
        $pulldown_list .= '<option value="7" >Juillet</option>';
        $pulldown_list .= '<option value="8" >Aout</option>';
        $pulldown_list .= '<option value="9" >Septembre</option>';
        $pulldown_list .= '<option value="10" >Octobre</option>';
        $pulldown_list .= '<option value="11" >Novembre</option>';
        $pulldown_list .= '<option value="12" >Décembre</option>';

    return $pulldown_list;
}


function gen_option_for_a_select_with_opt_group($data,$col_id_name='_id',$col_libelle_name='_libelle', $col_id_gr_name="_groupe", $col_libelle_gr_name="_groupe_libelle")
{
	if (!is_array($data)) {
        return '<option value=""></option>';
    }
    else
    {
        $pulldown_list = '<option value="">Choisir...</option>';
        $curr_group = "";
        $counting = 1;

        foreach ($data as $one_data)
        {
            if($one_data[$col_id_gr_name]==$curr_group)
            {
                $pulldown_list .= '<option value="'.$one_data[$col_id_name].'" >' . $one_data[$col_libelle_name] . '</option>';
            }
            else
            {
                if($counting != 1)
                {
                    $pulldown_list .= '</optgroup>';
                }

                $pulldown_list .= '<optgroup label="'.$one_data[$col_libelle_gr_name].'">';
                $pulldown_list .= '<option value="'.$one_data[$col_id_name].'" >' . $one_data[$col_libelle_name] . '</option>';
            }
            //toujours
            $counting++;
            $curr_group = $one_data[$col_id_gr_name];
        }
    }
//var_dump($pulldown_list);
//exit();
        return $pulldown_list;
}


    function swap_1($data_list, $id_name="_id", $libelle_name="_libelle")
    {
        $retour 	= array();
        foreach($data_list as $one_row)
        {
            $retour[$one_row[$id_name]][] =  $one_row[$libelle_name];
        }/////foreach
        return $retour;
    }

    function swap_tab_to_array($data_list, $libelle_name="_libelle")
    {
        $retour 	= array();
        foreach($data_list as $one_row)
        {
            $retour[] =  $one_row[$libelle_name];
        }/////foreach
        return $retour;
    }