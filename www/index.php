
<?php
require 'config/kint_debugger/kint.phar';
require 'services/RecommendationSystemService.class.php';

$servicie = new RecommendationSystemService();

/* Get all places on database */
//d($servicie->showAllGroups());
//d($servicie->showAllPlaces());

$auxs_group = $servicie->showAllGroups();
$auxs_poi = $servicie->showAllPlaces();

//d($auxs_group);

foreach($auxs_group as $value){
    $result_group['latitude'] = $value->latitude;
    $result_group['longitude'] = $value->longitude;    
}

foreach($auxs_poi as $value){

    echo $value->latitude;
    echo $value->longitude;   

    $result_poi['latitude'] = $value->latitude;
    $result_poi['longitude'] = $value->longitude;    
}


?>

