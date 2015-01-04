<?php

class AdminManager extends Admin{

    private $_db;
    private $_adminArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getAdmin($login) {
        $query = "select * from admin where login = :login";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $login, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_adminArray[] = new Admin($data);
        }
        return $_adminArray;
    }

    public function isAdmin($login, $password) {
        $retour = array();
        try {
            $query = "select verif_admin(:login,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':login', $_POST['login']);
            $sql->bindValue(':password', md5($_POST['password']));
            //$sql->bindValue(1,$_POST['login'],PDO::PARAM_STR);
            //$sql->bindValue(2,$_POST['password'],PDO::PARAM_STR);
            //$sql->bindValue(3,$status,PDO::PARAM_STR);  
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

}
