<?php
class ComporteManager extends Comporte {
    private $_db;
    private $_comporteArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

     public function addLigneComp($idcom, $idmodele, $qte, $prixu) {
        $query = "select add_comporte(:id_com,:id_modele,:quantite,:prixu) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcom, PDO::PARAM_INT);
            $statement->bindValue(2, $idmodele, PDO::PARAM_INT);
            $statement->bindValue(3, $qte, PDO::PARAM_INT);
            $statement->bindValue(4, $prixu, PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }
}
