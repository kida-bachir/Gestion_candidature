<?php
/*
	Ce helper contient les urls de base de chaque application pour les appels d'API
	
	Paramètres:
		Entrée:
		$application: ce sera le nom de l'application pour laquelle on suite utiliser une API
		
		Retour:
		$api_url: url de base de l'API appelée
		
		NB: pas de caractère accentués
*/
function api_url($application)
{
	$application = strtolower($application);
	
	switch($application)
	{
		
		//Appel sur PLANETE HEADMASTER
		case 'planete_head':
		$url = 'http://w/planete/';
		break;
		
		//Appel sur PLANETE EVALUATION
		case 'planete_eval':
		$url = 'http://eval.simendev.com/';
		break;
		
		//Appel sur PLANETE EXAMEN
		case 'planete_x':
		$url = 'http://x.simendev.com/';
		break;
		
		//Appel sur PLANETE MANAGER
		case 'manager':
		$url = 'http://manager.simendev.com/api/simenv1/';
		break;
		
		//Appel sur PETTAO
		case 'pettao':
		$url = 'http://pettao.simendev.com/';
		break;
		
		//Appel sur BATIMEN
		case 'batimen':
		$url = 'http://batimen.simendev.com/';
		break;
		
		//Appel sur CODECO
		case 'codeco':
		$url = 'http://codeco.simendev.com/';
		break;
		
		//Appel sur IEN
		case 'ien':
		$url = 'http://ien.simendev.com/';
		break;
		
		//Appel sur MEN ERREUR
		case 'men_erreur':
		$url = 'http://erreur.simendev.com/';
		break;
		
		//Appel sur MEN LOCALITES
		case 'localite':
		$url = 'http://localite.simendev.com/';
		break;
		
		//Appel sur API
		case 'api':
		$url = 'http://w/api/';
		break;
		
		default :
		$url = base_url();
		break;
	}
	
	return $url;
}