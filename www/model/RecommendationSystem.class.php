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
            $this->query_str = ' SELECT * FROM pessoas ';
            $this->result_set  =  $this->pdo->prepare($this->query_str);
            $this->result_set->execute();
            return $this->result_set->fetchAll();

        } catch (PDOException $e) { }
    }
}
