
<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
d($servicie->showAllGroups());
d($servicie->showAllPlaces());
d($servicie->showAvg());

$auxs_poi = $servicie->showAllPlaces();
$auxs_group = $servicie->showAllGroups();
$get_avg = $servicie->showAvg();



/** Função que converte o retorno do bd em um array a latitude e longitude */
function getPoints($array){

    foreach($array as $key => $value){
        $result[$key]['id'] = $value->id;
        $result[$key]['latitude'] = $value->latitude;
        $result[$key]['longitude'] = $value->longitude;    
    }

    return $result;
}

function getRating($array){

    foreach($array as $key => $value){
        $result[$key]['idPoi'] = $value->local_id;
        $result[$key]['rating'] = $value->rating;
    }

    return $result;
}

/** Função que calcula a distância entre dois pontos através do método de Havesin */
function distance($lat1, $lon1, $lat2, $lon2) {

    $lat1 = deg2rad($lat1);
    $lat2 = deg2rad($lat2);
    $lon1 = deg2rad($lon1);
    $lon2 = deg2rad($lon2);
    
    $dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
    $dist = number_format($dist, 2, '.', '');
    
    return $dist;

}

/** Função que calcula a distância do ponto de encontro do grupo para os pontos de interesse */
function recommendation($auxs_poi, $auxs_group, $get_avg){

    $poi = getPoints($auxs_poi); //print_r($poi);
    $group = getPoints($auxs_group);
    $rating = getRating($get_avg);

    foreach($poi as $key => $value){

        if($poi[$key]['id'] == $rating[$key]['idPoi']){

            //$result[$key]['idPoi'] = $poi[$key]['id'];
            $result[$key]['rating'] = $rating[$key]['rating'];
            $result[$key]['distance'] = distance(floatval($group[0]['latitude']), floatval( $group[0]['longitude']), floatval($poi[$key]['latitude']), floatval($poi[$key]['longitude'])); 

        }
        
        
    }
    rsort($result);

    return $result;
}

    $recommendation = recommendation($auxs_poi, $auxs_group, $get_avg);
    //arsort($recommendation);
    foreach($recommendation as $result) {

        //echo $result['rating'], '<br>';
        echo "Rating of Group: ".number_format($result['rating'], 2,".", " "), '<br>';
        echo "Distance of Group: ".$result['distance'], '<br><br>';
    }
    
    print_r("<pre>".print_r($recommendation,true)."</pre>");


?>

