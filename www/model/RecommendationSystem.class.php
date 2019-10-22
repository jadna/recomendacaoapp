<?php

include_once './config/Database.class.php';

class RecommendationSystem
{

    private $pdo;
    private $query_str;
    private $result_set;



    function __construct()
    {

        $this->pdo = new Database();
    }

    public  function showAllPlaces()
    {

        try {
            $this->query_str = ' SELECT * FROM locais ';
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) { }
    }

    public  function showAllGroups()
    {

        try {
            $this->query_str = ' SELECT * FROM pessoas where grupo = 2';
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll();

        } catch (PDOException $e) { }
    }

    public  function showPreferencias($pessoa_id)
    {

        try {
            $this->query_str = ' SELECT pre.preferencia
            FROM pessoas p
            INNER JOIN pessoas_preferecias pp ON (pp.pessoa_id = p.id)
            INNER JOIN preferencias pre ON (pre.id = pp.preferencia_id)
            where p.id ='.$pessoa_id;

            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) { }
    }

    public function showAvg()
    {

        try {
            $this->query_str = ' SELECT AVG(avaliacao) as rating, local_id FROM avaliacao GROUP BY local_id ';
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll(PDO::FETCH_OBJ);
           
        } catch (PDOException $e) { }
    }

    public function addAvaliacao()
    {

        try {
            $this->query_str = ' SELECT AVG(a.avaliacao) as rating, a.local_id as local_id
                                    FROM avaliacao a
                                    INNER JOIN pessoas p ON (p.id = a.pessoa_id)
                                    WHERE p.grupo = 1
                                    GROUP BY local_id';
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll(PDO::FETCH_OBJ);
           
        } catch (PDOException $e) { }
    }

    public function getLocaisAmenity($amenity)
    { 

        try {
            $this->query_str = " SELECT * FROM sistema_recomendacao.locais
                                where amenity ='". $amenity."'";
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll(PDO::FETCH_OBJ);
           
        } catch (PDOException $e) { }
    }

    public function getAvaliacoes($local_id, $pessoa_id)
    { 

        try {
            $this->query_str = " SELECT * FROM sistema_recomendacao.avaliacao
             where local_id = $local_id and pessoa_id = $pessoa_id";
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            //echo   $this->query_str .'<br>';
            //return $this->result_set->fetchAll(PDO::FETCH_OBJ);
            return $this->result_set->fetchAll();
           
        } catch (PDOException $e) { }
    }

}
