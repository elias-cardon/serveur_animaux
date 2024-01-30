<?php
// Pointe automatiquement vers l'URL du chemin, que ce soit en local ou en ligne
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// Inclut le fichier du contrôleur API
require_once "./controllers/front/API.controller.php";

// Crée une instance du contrôleur API
$apiController = new APIController();

try {
    // Vérifie si la variable GET 'page' est vide
    if (empty($_GET['page'])) {
        throw new Exception("Cette page n'existe pas");
    } else {
        // Récupère et filtre la valeur de 'page' de l'URL
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);

        // Vérifie si les parties essentielles de l'URL existent
        if (empty($url[0]) || empty($url[1])) throw new Exception("La page n'existe pas");

        // Traite les différentes pages en fonction de la première partie de l'URL
        switch ($url[0]) {
            case "front":
                // Traite les différentes sous-pages de la section 'front'
                switch ($url[1]) {
                    case "animaux":
                        if(!isset($url[2]) || !isset($url[3])){
                            $apiController -> getAnimaux(-1,-1);
                        } else {
                            $apiController -> getAnimaux((int)$url[2],(int)$url[3]);
                        }
                        break;
                    case "animal":
                        // Vérifie si l'identifiant de l'animal est présent dans l'URL
                        if (empty($url[2])) throw new Exception("L'identifiant de l'animal est manquant.");
                        $apiController->getAnimal($url[2]);
                        break;
                    case "continents":
                        $apiController->getContinents();
                        break;
                    case "familles":
                        $apiController->getFamilles();
                        break;
                    default:
                        throw new Exception("La page n'existe pas.");
                }
                break;
            case "back":
                // Traite la section 'back'
                echo "Page back end demandée.";
                break;
            default:
                throw new Exception("La page n'existe pas.");
        }
    }
} catch (Exception $e) {
    // Capture et affiche les exceptions
    $msg = $e->getMessage();
    echo $msg;
}