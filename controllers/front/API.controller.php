<?php
// Inclut les classes nécessaires
require_once "./models/front/API.manager.php";
require_once "./models/Model.php";

// Définition de la classe APIController
class APIController {
    // Propriété privée pour stocker une instance de APIManager
    private $apiManager;

    // Constructeur de la classe
    public function __construct() {
        // Initialise l'instance de APIManager dans le constructeur
        $this->apiManager = new APIManager();
    }

    // Méthode pour récupérer toutes les informations sur les animaux
    public function getAnimaux() {
        // Appelle la méthode de APIManager pour obtenir les données des animaux depuis la base de données
        $animaux = $this->apiManager->getDBAnimaux();

        // Formate les données des animaux
        $tabResultat = $this->formatDataLignesAnimaux($animaux);

        // Envoie les données au format JSON
        Model::sendJSON($tabResultat);
    }

    // Méthode pour récupérer les informations sur un animal spécifique
    public function getAnimal($idAnimal) {
        // Appelle la méthode de APIManager pour obtenir les données d'un animal spécifique depuis la base de données
        $lignesAnimal = $this->apiManager->getDBAnimal($idAnimal);

        // Formate les données de l'animal spécifique
        $tabResultat = $this->formatDataLignesAnimaux($lignesAnimal);

        // Envoie les données au format JSON
        Model::sendJSON($tabResultat);
    }

    // Méthode privée pour formater les données des lignes d'animaux
    private function formatDataLignesAnimaux($lignes) {
        $tab = [];
        foreach ($lignes as $ligne) {
            if (!array_key_exists($ligne['animal_id'], $tab)) {
                $tab[$ligne['animal_id']] = [
                    "id" => $ligne['animal_id'],
                    "nom" => $ligne['animal_nom'],
                    "description" => $ligne['animal_description'],
                    "image" => URL."public/images/".$ligne['animal_image'],
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

    // Méthode pour récupérer toutes les informations sur les continents
    public function getContinents() {
        // Appelle la méthode de APIManager pour obtenir les données des continents depuis la base de données
        $continents = $this->apiManager->getDBContinents();

        // Envoie les données au format JSON
        Model::sendJSON($continents);
    }

    // Méthode pour récupérer toutes les informations sur les familles
    public function getFamilles() {
        // Appelle la méthode de APIManager pour obtenir les données des familles depuis la base de données
        $familles = $this->apiManager->getDBFamilles();

        // Envoie les données au format JSON
        Model::sendJSON($familles);
    }
}