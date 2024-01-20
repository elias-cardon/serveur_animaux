<?php
require_once "./models/front/API.manager.php";
require_once "./models/Model.php";

class APIController{
    private $apiManager;

    public function __construct(){
        $this->apiManager = new APIManager();
    }
    public function getAnimaux(){
        $animaux = $this ->apiManager->getDBAnimaux();
        $tabResultat = $this->formatDataLignesAnimaux($animaux);
        //Les trois lignes suivantes servent à débugger
        //echo "<pre>";
        //print_r($tabResultat);
        //echo "</pre>";
        Model::sendJSON($tabResultat);
    }

    public function getAnimal($idAnimal){
        $lignesAnimal = $this->apiManager->getDBAnimal($idAnimal);
        $tabResultat = $this->formatDataLignesAnimaux($lignesAnimal);
        //Les trois lignes suivantes servent à débugger
        //echo "<pre>";
        //print_r($tabResultat);
        //echo "</pre>";
        Model::sendJSON($tabResultat);
    }

    private function formatDataLignesAnimaux($lignes){
        $tab = [];
        foreach ($lignes as $ligne){
            if (!array_key_exists($ligne['animal_id'],$tab)){
                $tab[$ligne['animal_id']] = [
                    "id" => $ligne['animal_id'],
                    "nom" => $ligne['animal_nom'],
                    "description" => $ligne['animal_description'],
                    "image" => $ligne['animal_image'],
                    "famille" => [
                        "idFamille" => $ligne['famille_id'],
                        "libelleFamille" => $ligne['famille_libelle'],
                        "descriptionFamille" => $ligne['famille_description']
                    ]
                ];
            }

            $tab[$ligne['animal_id']]['continents'][] = [
                "idContinent" => $ligne['continent_id'],
                "libelleContinent" => $ligne['continent_libelle']
            ];
        }
        return $tab;
    }

    public function getContinents(){
        $continents = $this->apiManager->getDBContinents();
        Model::sendJSON($continents);
    }

    public function getFamilles(){
        $familles = $this->apiManager->getDBFamilles();
        Model::sendJSON($familles);
    }
}