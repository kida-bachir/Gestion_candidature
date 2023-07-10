<?php

    //echo date_pasre_fr2en('15/10/2015');
    //echo date_parse_en2fr('2010-11-10');

    // dd/mm/yyyy ==> yyyy-mm-dd
    function date_pasre_fr2en($date, $sep='/')
    {
        if($date == null || $date == '')
            return '';
        else
        {
            $dateConvert = $date == '' ? NULL : date('Y-m-d', strtotime(str_replace($sep, '-', $date)));
            return $dateConvert;
        }
    }

    // dd/mm/yyyy ==> yyyy-mm-dd
    function date_pasre_fr2en_2($date, $sep='/')
    {
        //"03/28/2019"==>"2019-03-28"
        $oldDate = $date;
        $arr = explode($sep, $oldDate);
        $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
        return $newDate;
    }

    
    // mm/dd/yyyy ==> yyyy-mm-dd
    function date_parse_en2francais($date, $sep='/')
    {
        if($date == null || $date == '')
            return '';
        else
        {
            $dateConvert = $date == '' ? NULL : date('Y-d-m', strtotime(str_replace($sep, '-', $date)));
            return $dateConvert;
        }
    }

    // yyyy-mm-dd ==>  dd/mm/yyyy
    function date_parse_en2fr($date)
    {

        if(empty($date))
            return "";
        else
        {
            $new_date = date('d/m/Y',strtotime($date));
//demba_debug($new_date);
            return $new_date;
        }

    }

    function date_parse_en2fr_short($date)
    {
        $retour = "";
        $my_tab = explode("-",$date);
        $tab_month = array(
            '' => '',
            '00' => '',
            '01' => 'Janv.',
            '02' => 'Févr.',
            '03' => 'Mars',
            '04' => 'Avr.',
            '05' => 'Mai.',
            '06' => 'Juin',
            '07' => 'Juil.',
            '08' => 'Août',
            '09' => 'Sept.',
            '10' => 'Oct.',
            '11' => 'Nov.',
            '12' => 'Déc.'
            
        );

        if(isset($my_tab['1']))
        {
            if(strlen($my_tab['1'])==1)
                $my_tab['1'] = "0".$my_tab['1'];
            if($date == null || $date == '')
            $retour =  '';
            else
            {
                $new_date = $my_tab['2']." ".$tab_month[$my_tab['1']]." ".$my_tab['0'];
                $retour =  $new_date;
            }            
        }
        return $retour;
    }


    function datetime_parse_en2fr_short($date)
    {
        $tab = explode(' ',$date);
        return date_parse_en2fr_short($tab[0]).$tab[1];
    }

    function diff_n_jour($deb, $end)
    {
        $start = strtotime($deb);
        $end = strtotime($end);
        $days_between = ceil(abs($end - $start) / 86400);
        return $days_between;
    }