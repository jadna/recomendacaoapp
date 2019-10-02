
<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
//d($servicie->showAllGroups());
//d($servicie->showAllPlaces());

$auxs_group = $servicie->showAllGroups();
$auxs_poi = $servicie->showAllPlaces();

// Função que converte para um array a latitude e longitude
function getPoints($array){

    foreach($array as $key => $value){
        $result[$key]['latitude'] = $value->latitude;
        $result[$key]['longitude'] = $value->longitude;    
    }

    return $result;
}

/** Função que calcula a distância do ponto de encontro do grupo para os pontos de interesse */
function calculateDistance($auxs_group, $auxs_poi){

    $points_group = getPoints($auxs_group);
    $points_poi = getPoints($auxs_poi);

    //print_r("<pre>".print_r($points_poi,true)."</pre>");

    foreach($points_poi as $key => $value){

        $teste[$key] = distancia(floatval($points_group[0]['latitude']), floatval( $points_group[0]['longitude']), floatval($points_poi[$key]['latitude']), floatval($points_poi[$key]['longitude']));
        
    }
}
print_r("<pre>".print_r($teste,true)."</pre>");

function distancia($lat1, $lon1, $lat2, $lon2) {

    $lat1 = deg2rad($lat1);
    $lat2 = deg2rad($lat2);
    $lon1 = deg2rad($lon1);
    $lon2 = deg2rad($lon2);
    
    $dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
    $dist = number_format($dist, 2, '.', '');
    print_r("<pre>".print_r($dist,true)."</pre>");
    return $dist;

}
    
   // echo distancia(-12.9813346,-38.4653612, -12.9741491,-38.4696483) . " Km<br />";


?>

