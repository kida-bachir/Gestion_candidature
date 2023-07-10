<?php
function curlPost($t_param, $url)
{
	//Debut du code CURL
	$curl = curl_init();
	$params_string = http_build_query($t_param);
	 
	$opts = array(
		CURLOPT_URL => $url,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $params_string,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HEADER => false
	);
	 
	curl_setopt_array($curl, $opts);
	 
	$curl_reponse = curl_exec($curl);
	
	return $curl_reponse;
}

function curlGet($url)
{
	$curl_reponse = file_get_contents($url);
	
	return $curl_reponse;
}