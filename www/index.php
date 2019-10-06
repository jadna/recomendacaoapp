
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



/** Função que converte o retorno do bd em um array a latitude e longitude do grupo*/
function getPointsGroup($array){

    foreach($array as $key => $value){

        $result[$key]['id'] = $value['id'];
        $result[$key]['nome'] = $value['nome'];
        $result[$key]['latitude'] = $value['latitude'];
        $result[$key]['longitude'] = $value['longitude'];   
       
    }

    //print_r("<pre>".print_r($result,true)."</pre>"); 
    return $result;
}

/**Esta função vai pegar todos os pontos de interesse e colocar em um vetor */
function getPointsLocal($array){

    foreach($array as $key => $value){
        $result[$key]['id'] = $value->id;
        $result[$key]['latitude'] = $value->latitude;
        $result[$key]['longitude'] = $value->longitude;  
        $result[$key]['amenity'] = $value->amenity;
    }

    return $result;
}

/**Esta função vai pegar a media das avaliações dos POI */
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

/**Função que calcula a distancia de todos do grupo ao ponto de encontro */
function groupDistance($auxs_group){

    $groups = getPointsGroup($auxs_group);

    // Defini o ponto de encontro
    $pointEncontro['id'] = $groups[0]['id'];
    $pointEncontro['nome'] = $groups[0]['nome'];
    $pointEncontro['latitude'] = $groups[0]['latitude'];
    $pointEncontro['longitude'] = $groups[0]['longitude'];

    //print_r("<pre>".print_r($pointEncontro,true)."</pre>");
    
    foreach($groups as $key=>$value){

        if($value['id'] != $pointEncontro['id']){
           
            $result[$key]['id'] = $value['id'];
            $result[$key]['nome'] = $value['nome'];
            $result[$key]['distance'] = distance($pointEncontro['latitude'], $pointEncontro['longitude'], $value['latitude'], $pointEncontro['longitude']);
            //print_r("<pre>".print_r($result,true)."</pre>");
        }else{
            $result[$key]['pe_id'] = $value['id'];
            $result[$key]['pe_nome'] = $value['nome'];
        }
    }

    return $result;
    
}

/** Função que calcula a distância do ponto de encontro do grupo para os pontos de interesse */
function recommendation($auxs_poi, $auxs_group, $get_avg){

    $poi = getPointsLocal($auxs_poi); //print_r($poi);
    $group = getPointsGroup($auxs_group);
    $rating = getRating($get_avg);

    foreach($poi as $key => $value){

        if($poi[$key]['id'] == $rating[$key]['idPoi']){

            $result[$key]['idPoi'] = $poi[$key]['id'];
            $result[$key]['rating'] = $rating[$key]['rating'];
            $result[$key]['distance'] = distance(floatval($group[0]['latitude']), floatval( $group[0]['longitude']), floatval($poi[$key]['latitude']), floatval($poi[$key]['longitude'])); 
            $result[$key]['amenity'] = $poi[$key]['amenity'];
        } 
    }

    //print_r("<pre>".print_r($result,true)."</pre>");
    arsort($result);

    return $result;
}

    /** Mostra a distancia de cada membro do grupo ao ponto de encontro */
    $groupDistance = groupDistance($auxs_group);
   
    foreach($groupDistance as $value){ 
        
        if($value['id'] != $groupDistance[0]['id']){
            echo "Nome: ".$value['nome'], ' => '."Distancia do ponto de encontro: ".$value['distance'], '<br>';
        }

    }

    echo "Nome ponto encontro: ".$groupDistance[0]['pe_nome'], '<br><br>';       
    //print_r("<pre>".print_r($groupDistance,true)."</pre>");

    $recommendation = recommendation($auxs_poi, $auxs_group, $get_avg);
    //print_r($recommendation);
    //arsort($recommendation);
    foreach($recommendation as $result) {

        //echo $result['rating'], '<br>';
        echo "Rating of Group: ".number_format($result['rating'], 2,".", " "), '<br>';
        echo "POI: ".$result['amenity'], '<br>';
        echo "Distance of Group: ".$result['distance'], '<br><br>';
    }
    
    //print_r("<pre>".print_r($recommendation,true)."</pre>");


?>

