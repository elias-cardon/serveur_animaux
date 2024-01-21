<?php
// Inclut la classe parente Model
require_once "./models/Model.php";

// Définition de la classe APIManager qui hérite de Model
class APIManager extends Model {

    // Méthode pour récupérer toutes les informations sur les animaux depuis la base de données
    public function getDBAnimaux() {
        // Requête SQL pour récupérer toutes les informations sur les animaux, leurs familles et continents associés
        $req = "SELECT *
                FROM animal a INNER JOIN famille f on f.famille_id = a.famille_id
                INNER JOIN animal_continent ac on ac.animal_id = a.animal_id
                INNER JOIN continent c on c.continent_id = ac.continent_id";

        // Prépare la requête SQL avec la connexion PDO
        $stmt = $this->getBdd()->prepare($req);

        // Exécute la requête
        $stmt->execute();

        // Récupère toutes les lignes résultantes sous forme de tableau associatif
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ferme le curseur
        $stmt->closeCursor();

        // Retourne le tableau d'animaux
        return $animaux;
    }

    // Méthode pour récupérer les informations d'un animal spécifique depuis la base de données
    public function getDBAnimal($idAnimal) {
        // Requête SQL pour récupérer les informations d'un animal spécifique, sa famille et ses continents associés
        $req = "SELECT *
                FROM animal a INNER JOIN famille f on f.famille_id = a.famille_id
                INNER JOIN animal_continent ac on ac.animal_id = a.animal_id
                INNER JOIN continent c on c.continent_id = ac.continent_id
                WHERE a.animal_id = :idAnimal";

        // Prépare la requête SQL avec la connexion PDO
        $stmt = $this->getBdd()->prepare($req);

        // Lie la valeur de l'identifiant de l'animal à la requête
        $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);

        // Exécute la requête
        $stmt->execute();

        // Récupère toutes les lignes résultantes sous forme de tableau associatif
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ferme le curseur
        $stmt->closeCursor();

        // Retourne le tableau d'informations sur l'animal spécifique
        return $lignesAnimal;
    }

    // Méthode pour récupérer toutes les informations sur les familles depuis la base de données
    public function getDBFamilles() {
        // Requête SQL pour récupérer toutes les informations sur les familles
        $req = "SELECT *
                FROM famille";

        // Prépare la requête SQL avec la connexion PDO
        $stmt = $this->getBdd()->prepare($req);

        // Exécute la requête
        $stmt->execute();

        // Récupère toutes les lignes résultantes sous forme de tableau associatif
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ferme le curseur
        $stmt->closeCursor();

        // Retourne le tableau de familles
        return $familles;
    }

    // Méthode pour récupérer toutes les informations sur les continents depuis la base de données
    public function getDBContinents() {
        // Requête SQL pour récupérer toutes les informations sur les continents
        $req = "SELECT *
                FROM continent";

        // Prépare la requête SQL avec la connexion PDO
        $stmt = $this->getBdd()->prepare($req);

        // Exécute la requête
        $stmt->execute();

        // Récupère toutes les lignes résultantes sous forme de tableau associatif
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ferme le curseur
        $stmt->closeCursor();

        // Retourne le tableau de continents
        return $continents;
    }
}