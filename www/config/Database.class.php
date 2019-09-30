<?php

class Database extends PDO
{
    private $user;
    private $pass;


    function __construct()
    {
        try {
            $this->user = 'devuser';
            $this->pass = 'devpass';
            parent::__construct("mysql:host=db;dbname=sistema_recomendacao", $this->user, $this->pass);

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
