<?php
include_once './model/RecommendationSystem.class.php';

class RecommendationSystemService
{

    private  $model;

    function __construct()
    {
        try {
            $this->model = new RecommendationSystem();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public  function showAllPlaces()
    {
        try {
            return $this->model->showAllPlaces();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function showAllGroups(){

        try{
            return $this->model->showAllGroups();
        }catch (\Throwable $th){
            throw $th;
        }
    } 

    public function showPreferencias($pessoa_id){
    
        try{
            return $this->model->showPreferencias($pessoa_id);
        }catch (\Throwable $th){
            throw $th;
        }
    } 

    public function showAvg(){

        try{
            return $this->model->showAvg();
        }catch (\Throwable $th){
            throw $th;
        }
    }

    public function addAvaliacao(){

        try{
            return $this->model->addAvaliacao();
        }catch (\Throwable $th){
            throw $th;
        }
    }
}
