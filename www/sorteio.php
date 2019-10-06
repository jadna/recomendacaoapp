<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
d($servicie->showAllGroups());


    $result_group = $servicie->showAllGroups();
    
    foreach($result_group as $key=>$value){
        
        $grupo[$key]['id'] = $value['id'];
        $grupo[$key]['nome'] = $value['nome'];
        $grupo[$key]['latitude'] = $value['latitude'];
        $grupo[$key]['longitude'] = $value['longitude'];
        $grupo[$key]['grupo'] = $value['grupo'];

    }

    // PEga todos os locais
    $result_poi = $servicie->showAllPlaces();
    foreach($result_poi as $key=>$value){

        $poi[$key]['id'] = $value->id;
        $poi[$key]['latitude'] = $value->latitude;
        $poi[$key]['longitude'] = $value->longitude;  
        $poi[$key]['amenity'] = $value->amenity;
    
    }
    //print_r("<pre>".print_r($grupo,true)."</pre>"); 

    for($i=0; $i<sizeof($grupo); $i++){

        $idPessoa = $grupo[$i]['id'];
        $min_rating = 1; $max_rating = 5;
        $min_poi = 1; $max_poi = 99;

        for($j=0; $j<10; $j++){

            $idLocal = $poi[$j]['id'];
            $rating[$j] = rand($min_rating, $max_rating);
            //$poi[$j] = $poi[$j];// = rand($min_poi, $max_poi);

            $result[$j]['pessoa_id'] = $idPessoa;
            $result[$j]['local_id'] = $idLocal;
            $result[$j]['avaliacao'] = $rating[$j];

            echo $idPessoa. ", ".$idLocal. ", ". $rating[$j],"<br>";
        }

    }

?>