<?php
class ClientManager extends Client {
    private $_db;
    private $_clientArray=array();
    //private $_clientArray2=array();
    
    public function __construct($db) {
        $this->_db = $db;      
    }
    
    public function getClient($email){
        $query="select * from client where email = :email";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$email,PDO::PARAM_INT);
        $resultset->execute();
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_clientArray[] = new Client($data);
        }
        return $_clientArray;
    }
    
     public function getClientId($id){
        $query="select * from client where id_client = :id_client";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$id,PDO::PARAM_INT);
        $resultset->execute();
        $data=$resultset->fetch();
        $_clientArray[] = new Client($data);
        return $_clientArray;
    }
    public function isClient($login,$password) {
        $retour=array();
        try {
            //as retour c'est ce qui etait retourné par la fonction
            //verifier_admin
            $query="select verif_client(:email,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':email',$_POST['login']);
            $sql->bindValue(':password',md5($_POST['password']));  
            $sql->execute();
            $retour = $sql->fetchColumn(0);                     
        } catch(PDOException $e) {
            print "Echec de la requ&ecirc;te.".$e;
        }
        return $retour;
    }
}


