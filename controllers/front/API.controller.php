<?php
require_once "./models/front/API.manager.php";

class APIController{
    private $apiManager;

    public function __construct(){
        $this->apiManager = new APIManager();
    }
    public function getAnimaux(){
        $animaux = $this ->apiManager->getDBAnimaux();
        echo "<pre>";
        print_r($animaux);
        echo "</pre>";
    }

    public function getAnimal($idAnimal){
        $lignesAnimal = $this->apiManager->getDBAnimaux($idAnimal);
        echo "Données JSON de l'animal ".$idAnimal." demandées.";
    }

    public function getContinents(){
        echo "Données JSON des continents demandées.";
    }

    public function getFamilles(){
        echo "Données JSON des familles demandées.";
    }
}