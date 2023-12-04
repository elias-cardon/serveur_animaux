<?php
require_once "./models/Model.php";

class APIManager extends Model{
    public function getDBAnimaux(){
        $req = "SELECT *
                FROM animal a INNER JOIN famille f on f.famille_id = a.famille_id
                INNER JOIN animal_continent ac on ac.animal_id = a.animal_id
                INNER JOIN continent c on c.continent_id = ac.continent_id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
    }

    public function getDBAnimal($idAnimal){
        $req = "SELECT *
                FROM animal a INNER JOIN famille f on f.famille_id = a.famille_id
                INNER JOIN animal_continent ac on ac.animal_id = a.animal_id
                INNER JOIN continent c on c.continent_id = ac.continent_id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
    }
}