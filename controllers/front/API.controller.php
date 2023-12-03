<?php

class APIController{
    public function getAnimaux(){
        echo "Envoi des infos sur les animaux";
    }

    public function getAnimal($idAnimal){
        echo "Données JSON de l'animal ".$idAnimal." demandées.";
    }

    public function getContinents(){
        echo "Données JSON des continents demandées.";
    }

    public function getFamilles(){
        echo "Données JSON des familles demandées.";
    }
}