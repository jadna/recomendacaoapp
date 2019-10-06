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
            $this->query_str = ' SELECT AVG(avaliacao) as rating, local_id FROM avaliacao GROUP BY local_id ';
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll(PDO::FETCH_OBJ);
           
        } catch (PDOException $e) { }
    }

}
