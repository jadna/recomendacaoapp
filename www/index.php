
<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
d($servicie->showAllGroups());
d($servicie->showAllPlaces());
d($servicie->getAvg());

$auxs_poi = $servicie->showAllPlaces();
$auxs_group = $servicie->showAllGroups();
$get_avg = $servicie->getAvg();



/** Função que converte o retorno do bd em um array a latitude e longitude */
function getPoints($array){

    foreach($array as $key => $value){
        $result[$key]['id'] = $value->id;
        $result[$key]['latitude'] = $value->latitude;
        $result[$key]['longitude'] = $value->longitude;    
    }

    return $result;
}


/** Função que calcula a distância do ponto de encontro do grupo para os pontos de interesse */
function calculateDistance($auxs_poi, $auxs_group){

    $result_poi = getPoints($auxs_poi);
    $result_group = getPoints($auxs_group);
    //print_r("<pre>".print_r($result_poi,true)."</pre>");

    foreach($result_poi as $key => $value){

        $result[$key]['distance'] = distancia(floatval($result_group[0]['latitude']), floatval( $result_group[0]['longitude']), floatval($result_poi[$key]['latitude']), floatval($result_poi[$key]['longitude'])); 
        //print_r("<pre>".print_r($teste,true)."</pre>");
    }
    return $result;
}

/** Função que calcula a distância entre dois pontos através do método de Havesin */
function distancia($lat1, $lon1, $lat2, $lon2) {

    $lat1 = deg2rad($lat1);
    $lat2 = deg2rad($lat2);
    $lon1 = deg2rad($lon1);
    $lon2 = deg2rad($lon2);
    
    $dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
    $dist = number_format($dist, 2, '.', '');
    
    return $dist;

}

    $distancias = calculateDistance($auxs_poi, $auxs_group);
    print_r("<pre>".print_r($distancias,true)."</pre>");


?>

