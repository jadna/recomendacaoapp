<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
d($servicie->showAllGroups());
d($servicie->showAllPlaces());
d($servicie->showAvg());
d($servicie->showPreferencias(7));

$auxGrupo = $servicie->showAllGroups();

function getDadosPessoas($array){

    foreach($array as $key => $value){

        $result[$key]['id'] = $value['id'];
        $result[$key]['nome'] = $value['nome'];
        $result[$key]['latitude'] = $value['latitude'];
        $result[$key]['longitude'] = $value['longitude'];   
       
    }

    //print_r("<pre>".print_r($result,true)."</pre>"); 
    return $result;
}



function perfilGrupo($auxGrupo){

    $servicie = new RecommendationSystemService();

    $usuario = getDadosPessoas($auxGrupo);
    //print_r("<pre>".print_r($usuario,true)."</pre>"); 

    foreach($usuario as $key=>$value){
        $auxPreferencias[$key] = $servicie->showPreferencias($value['id']);
    }

    foreach($auxPreferencias as $key => $value){

        $result[$key]['pgitreferencia'] = $value['preferencia'];
        $result[$key]['nome'] = $value['nome'];
        $result[$key]['latitude'] = $value['latitude'];
        $result[$key]['longitude'] = $value['longitude'];   
       
    }
    print_r("<pre>".print_r($auxPreferencias,true)."</pre>"); 
    for($i=0; $i< count($usuario); $i++){

        //$preferenciasUsuarios[$i]['pessoa_id'] = $usuario[$i]['id'];
        $preferenciasUsuarios[$i] = $servicie->showPreferencias($usuario[$i]['id']);
        foreach($preferenciasUsuarios as $key => $value){

            $result[$key]['preferencia'] = $value['preferencia'];     
        }
        
    }
    //$teste = array_intersect($preferenciasUsuarios, $aux);
    print_r("<pre> U".print_r($result,true)."</pre>"); 


    return $preferenciasUsuarios;

}
perfilGrupo($auxGrupo);
//print_r("<pre>".print_r(perfilGrupo($auxGrupo),true)."</pre>"); 
















/*function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{

    print_r($lat1);
    $key = "AIzaSyC97oj_73Oab6zrUkHfWH-gq7zF2omHkOo";
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en&key=".$key;
   print_r($url);
    //curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en&key=AIzaSyC2JyVnACw_WJNJ7q7cSqkOsEAXy_4EgQE");
    $ch = curl_init();
    print_r($ch);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);
    $response = json_decode($result, true);
    $distance = $response['rows'][0]['elements'][0]['distance']['text'];
    $time = $response['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $distance, 'time' => $time);
}

$teste = GetDrivingDistance(-12.9407711, -12.943778, -38.3692486, -38.385332);

print_r($teste);*/



?>