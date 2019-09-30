<?php

class DbConection
{
    private  $user;
    private $pass;


    function __construct()
    {
        print "In BaseClass constructor\n";
    }

    public function getConection()
    {

        try {

            $user = 'devuser';
            $pass = 'devpass';

            $dbh = new PDO('mysql:host=db;dbname=sistema_recomendacao', $user, $pass);
            // esqueci o que ia fazer, b eijar minha boca sem parar pra respirar rs, como eu quero
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
