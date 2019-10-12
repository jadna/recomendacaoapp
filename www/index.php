
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

        /*$result[$key]['id'] = $value->id;
        $result[$key]['nome'] = $value->nome;
        $result[$key]['latitude'] = $value->latitude;
        $result[$key]['longitude'] = $value->longitude;  */
    
       
    }


    //print_r("<pre>".print_r($result,true)."</pre>"); 
    return $result;
}

/**Esta função vai pegar todos os pontos de interesse e colocar em um vetor */
function getPointsLocal($array){

    foreach($array as $key => $value){
        $result[$key]['id'] = $value->id;
        $result[$key]['local'] = $value->local;
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
    $pointEncontro['id'] = $groups[5]['id'];
    $pointEncontro['nome'] = $groups[5]['nome'];
    $pointEncontro['latitude'] = $groups[5]['latitude'];
    $pointEncontro['longitude'] = $groups[5]['longitude'];

    //print_r("<pre>".print_r($pointEncontro,true)."</pre>");
    
    foreach($groups as $key=>$value){

        if($value['id'] != $pointEncontro['id']){
           
            $result[$key]['id'] = $value['id'];
            $result[$key]['nome'] = $value['nome'];
            $result[$key]['latitude'] = $value['latitude'];
            $result[$key]['longitude'] = $value['longitude'];
            $result[$key]['distance'] = distance($pointEncontro['latitude'], $pointEncontro['longitude'], $value['latitude'], $pointEncontro['longitude']);
            //print_r("<pre>".print_r($result,true)."</pre>");
        }else{
            $result[$key]['pe_id'] = $value['id'];
            $result[$key]['pe_nome'] = $value['nome'];
            $result[$key]['latitude'] = $value['latitude'];
            $result[$key]['longitude'] = $value['longitude'];
            $result[$key]['distance'] = distance($pointEncontro['latitude'], $pointEncontro['longitude'], $value['latitude'], $pointEncontro['longitude']);
        }
    }

    return $result;
    
}

/** Função que calcula a distância do ponto de encontro do grupo para os pontos de interesse */
function recommendation($auxs_poi, $auxs_group, $get_avg){

    $poi = getPointsLocal($auxs_poi); 
    $group = getPointsGroup($auxs_group);
    $rating = getRating($get_avg);//print_r($poi);

    foreach($poi as $key => $value){

        if($poi[$key]['id'] == $rating[$key]['idPoi']){

            $result[$key]['idPoi'] = $poi[$key]['id'];
            $result[$key]['local'] = $poi[$key]['local'];
            $result[$key]['rating'] = $rating[$key]['rating'];
            $result[$key]['latitude'] = $poi[$key]['latitude'];
            $result[$key]['longitude'] = $poi[$key]['longitude'];
            $result[$key]['distance'] = distance(floatval($group[5]['latitude']), floatval( $group[5]['longitude']), floatval($poi[$key]['latitude']), floatval($poi[$key]['longitude'])); 
            $result[$key]['amenity'] = $poi[$key]['amenity'];
            $result[$key]['ponto_recomendado'] = $result[$key]['distance']*$result[$key]['rating'];
        } 
    }

    // FAz isso para ordenar pelo ponto de recomendação todo o vetor
    foreach ($result as $user) {
        $distancias[] = $user['ponto_recomendado'];
    }
        
    array_multisort($distancias, SORT_DESC, $result);
    //print_r("<pre>".print_r($result,true)."</pre>");
    
    return $result;
}
    

    /** Mostra a distancia de cada membro do grupo ao ponto de encontro */
    $groupDistance = groupDistance($auxs_group);
   
    foreach($groupDistance as $value){ 

        $pref_pessoas = $servicie->showPreferencias($value['id']);
        if($value['id'] != $groupDistance[1]['id']){
            
            echo "Nome: ".$value['nome']
            ." Latitude: ".$value['latitude']
            ." Longitude: ".$value['longitude']
            ." Distancia: ".$value['distance']
            ." Preferencias: ";

            foreach($pref_pessoas as $val){
                echo $val['preferencia'];
            }
        }else{
            $pref_pessoas = $servicie->showPreferencias($value['pe_id']);
            echo "Nome: ".$value['pe_nome']
                ." Latitude: ".$value['latitude']
                ." Longitude: ".$value['longitude']
                ." Distancia: ".$value['distance']
                ." Preferencias: ";

            foreach($pref_pessoas as $val){
                echo $val['preferencia'];
            }
        }

        echo '<br>';

    }

    echo '<br><br>';       
   

    $recommendation = recommendation($auxs_poi, $auxs_group, $get_avg);

    /*foreach($recommendation as $key=>$result) {
       
        echo "P[".$key."]: ".number_format($result['ponto_recomendado'], 2,".", " ")
        ." Latitude: ".$result['latitude']
        ." Longitude: ".$result['longitude']
        ." Amenity: ".$result['amenity']
        ." Nome: ".$result['local']
        .'<br>';
    }*/

    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table border='1' >";
    $dadosXls .= "          <tr>";
    $dadosXls .= "          <th>Cod.</th>";
    $dadosXls .= "          <th>Recomendação</th>";
    $dadosXls .= "          <th>Latitude</th>";
    $dadosXls .= "          <th>Longitude</th>";
    $dadosXls .= "          <th>Amenity</th>";
    $dadosXls .= "          <th>Nome</th>";
    $dadosXls .= "      </tr>";
    //varremos o array com o foreach para pegar os dados
    foreach($recommendation as $key=>$result){
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>P[".$key."]</td>";
        $dadosXls .= "          <td>".number_format($result['ponto_recomendado'], 2,".", " ")."</td>";
        $dadosXls .= "          <td>".$result['latitude']."</td>";
        $dadosXls .= "          <td>".$result['longitude']."</td>";
        $dadosXls .= "          <td>".$result['amenity']."</td>";
        $dadosXls .= "          <td>".$result['local']."</td>";
        $dadosXls .= "      </tr>";
    }
    $dadosXls .= "  </table>";
 
    // Definimos o nome do arquivo que será exportado  
    $arquivo = "MinhaPlanilha.xls";  
    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
    echo $dadosXls;  
    exit;
    
    //print_r("<pre>".print_r($recommendation,true)."</pre>");


?>

/** Organizar mostrar  tudo organizado mostrar os pontos de interesses
como P1, p2... colocar a latitude e longitude
Colocar os usuarios com a distancia e sua preferencias
Além de multipliar  a distancia pela media das avaliações */