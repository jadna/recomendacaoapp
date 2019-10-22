<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
// d($servicie->showAllGroups());
// d($servicie->showAllPlaces());
// d($servicie->showAvg());
// d($servicie->showPreferencias(7));

$auxGrupo = $servicie->showAllGroups();

function getDadosPessoas($array)
{

    foreach ($array as $key => $value) {

        $result[$key]['id'] = $value['id'];
        $result[$key]['nome'] = $value['nome'];
        $result[$key]['latitude'] = $value['latitude'];
        $result[$key]['longitude'] = $value['longitude'];
    }

    //print_r("<pre>".print_r($result,true)."</pre>"); 
    return $result;
}


// d($servicie->showPreferencias(7));
// d($servicie->showPreferencias(8));
//d($servicie->showPreferencias(9)->preferencia);

/**Esta função monta o perfi do grupo de acordo com as preferencias em comum dos usuarios */
function perfilGrupo($auxGrupo)
{

    $servicie = new RecommendationSystemService();

    $usuario = getDadosPessoas($auxGrupo);


    foreach ($usuario as $key => $value) {

        foreach ($servicie->showPreferencias($value['id']) as $key => $showPreferencias) {
            $auxPreferencias[] = $showPreferencias['preferencia'];
        }
    }


    $preferencias_iguais =  array_count_values($auxPreferencias);

    echo "Perfil do Grupo: ";
    foreach ($preferencias_iguais as $key => $preferencia) {
        if ($preferencia >= count($usuario)) {
            //echo 'preferencia :' . $key . ' Opção escolhida: ' . $preferencia . ' vezes. <br/> ';
            echo $key.' ';
            $perfilGrupo[] = $key;
        }
    }

     return $perfilGrupo;
}

/**Pega os locais de acordo com o perfil definido na função perfilGrupo */
function getLocais($perfilGrupo){

    $servicie = new RecommendationSystemService();
   
    foreach ($perfilGrupo as $key => $value) {

        foreach ($servicie->getLocaisAmenity($value) as $key => $return) {
            $result[$key]['id'] = $return->id;
            $result[$key]['local'] = $return->local;
            $result[$key]['amenity'] = $return->amenity;
            $result[$key]['latitude'] = $return->latitude;
            $result[$key]['longitude'] = $return->longitude;
        }
    }

    return $result;
    //print_r("<pre>".print_r($result,true)."</pre>"); 
}

function getAvaliacoes($auxGrupo, $locais){

    $servicie = new RecommendationSystemService();
    $usuario = getDadosPessoas($auxGrupo);

    for ($i=0; $i < 10; $i++) { 

        //echo "Locais: ".$locais[$i]['local'];
        for ($j=0; $j < count($usuario); $j++) { 
            

            $retorno[$i][$j]['id'] = $servicie->getAvaliacoes($locais[$i]['id'], $usuario[$j]['id'])[0]['id'];
            $retorno[$i][$j]['pessoa_id'] = $servicie->getAvaliacoes($locais[$i]['id'], $usuario[$j]['id'])[0]['pessoa_id'];
            $retorno[$i][$j]['local_id'] = $servicie->getAvaliacoes($locais[$i]['id'], $usuario[$j]['id'])[0]['local_id'];
            $retorno[$i][$j]['avaliacao'] = $servicie->getAvaliacoes($locais[$i]['id'], $usuario[$j]['id'])[0]['avaliacao'];
  
            //echo $retorno[$i][$j]['avaliacao'];
        }
        
        //echo "<br>";
    }

    print_r("<pre>".print_r($retorno,true)."</pre>");

}

function calculaDistancia($auxGrupo, $locais){

    $servicie = new RecommendationSystemService();
    $usuario = getDadosPessoas($auxGrupo);

    //$distancia = GetDrivingDistance($locais[0]['latitude'], $usuario[0]['latitude'], $locais[0]['longitude'], $usuario[0]['longitude']);
   // print_r("<pre>".print_r($distancia,true)."</pre>");

    for ($i=0; $i < 10; $i++) { 

        for ($j=0; $j < count($usuario); $j++) { 
            
            //$distancia[$i][$j]['pessoa_id']

            $distancia[$i][$j] = GetDrivingDistance($usuario[$j]['latitude'], $usuario[$j]['longitude'], $locais[$i]['latitude'], $locais[$i]['longitude']);
            $distancia[$i][$j]['nome_pessoa'] = $usuario[$j]['nome'];
            $distancia[$i][$j]['pessoa_id'] = $usuario[$j]['id'];
            $distancia[$i][$j]['local'] = $locais[$i]['local'];
            $distancia[$i][$j]['amenity'] = $locais[$i]['amenity'];
            $distancia[$i][$j]['local_id'] = $locais[$i]['id'];
            
            //sleep(3);
            
        }
        
       
    }

    print_r("<pre>".print_r($distancia,true)."</pre>");

}

echo "<br>";
$perfilGrupo = perfilGrupo($auxGrupo);
echo "<br>";
$locais = getLocais($perfilGrupo);
echo "<br>";
getAvaliacoes($auxGrupo, $locais);
calculaDistancia($auxGrupo, $locais);
//print_r("<pre>".print_r(perfilGrupo($auxGrupo),true)."</pre>"); 
















function GetDrivingDistance($lat1, $long1, $lat2, $long2)
{

    //print_r($lat1);
    $key = "AIzaSyC97oj_73Oab6zrUkHfWH-gq7zF2omHkOo";
    $key = 'AIzaSyBtZYh0ihnATs4hXq0Udrz15IZDRmvfn9c';
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&mode=driving&language=en&key=" . $key;

    //print_r($url);
    //curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en&key=AIzaSyC2JyVnACw_WJNJ7q7cSqkOsEAXy_4EgQE");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($ch);
    //print_r($result);
    curl_close($ch);
    $response = json_decode($result, true);
    $distance = $response['rows'][0]['elements'][0]['distance']['text'];
    $time = $response['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $distance, 'time' => $time);
}

// $teste = GetDrivingDistance(-12.9407711, -12.943778, -38.3692486, -38.385332);

// print_r($teste);
