<?php
// Définition d'une classe abstraite Model
abstract class Model {
    // Propriété statique pour stocker la connexion PDO
    private static $pdo;

    // Méthode privée pour initialiser la connexion à la base de données
    private static function setBdd() {
        // Création d'une nouvelle instance de PDO (connexion à la base de données MySQL)
        self::$pdo = new PDO("mysql:host=localhost;dbname=dbanimaux;charset=utf8", "root", "");

        // Configuration du mode d'erreur de PDO en mode avertissement (ERRMODE_WARNING)
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Méthode protégée pour récupérer la connexion PDO (Singleton Pattern)
    protected function getBdd() {
        // Vérifie si la connexion PDO est nulle, et l'initialise si nécessaire
        if (self::$pdo === null) {
            self::setBdd();
        }

        // Retourne la connexion PDO
        return self::$pdo;
    }

    // Méthode statique pour envoyer des données au format JSON en tant que réponse
    public static function sendJSON($info) {
        // Autorise les requêtes depuis n'importe quelle origine (CORS)
        header("Access-Control-Allow-Origin: *");

        // Définit le type de contenu comme JSON
        header("Content-Type: application/json");

        // Convertit les données en format JSON et les affiche
        echo json_encode($info);
    }
}