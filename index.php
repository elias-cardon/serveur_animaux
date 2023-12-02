<?php
//Pointe automatiquement vers l'URL du chemin, que ce soit en local ou en ligne
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

try {
    if(empty($_GET['page'])){
        throw new Exception("Cette page n'existe pas");
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        if (empty($url[0]) || empty($url[1])) throw new Exception("La page n'existe pas");
        switch ($url[0]){
            case "front" :
                switch ($url[1]){
                    case "animaux" : echo "Données JSON des animaux demandées.";
                    break;
                    case "animal" : echo "Données JSON de l'animal ".$url[2]." demandées.";
                    break;
                    case "continents" : echo "Données JSON des continents demandées.";
                    break;
                    case "familles" : echo "Données JSON des familles demandées.";
                    break;
                    default : throw new Exception("La page n'existe pas.");
                }
            break;
            case "back" : echo "Page back end demandée.";
            break;
            default : throw new Exception("La page n'existe pas.");
        }
    }
} catch (Exception $e){
    $msg = $e->getMessage();
    echo $msg;
}