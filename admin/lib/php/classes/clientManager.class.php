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
    public function addClient($idville,array $data) {
        $query="select add_client(:nom_maitre,:email_maitre,:date_debut,:nombre_jours,:type_animal,:nom_animal,:id_jouet_pet,:regime) as retour" ;
        try {
            $id=null;
            $statement = $this->_db->prepare($query);		
            $statement->bindValue(1, $idville, PDO::PARAM_INT);
            $statement->bindValue(2, $data['nom'], PDO::PARAM_STR);
            $statement->bindValue(3, $data['prenom'], PDO::PARAM_STR);
            $statement->bindValue(4, $data['rue'], PDO::PARAM_STR);
            $statement->bindValue(5, $data['num'], PDO::PARAM_INT);
            $statement->bindValue(6, $data['tel'], PDO::PARAM_STR);
            $statement->bindValue(7, $data['email'], PDO::PARAM_STR);
            $statement->bindValue(8, $data['pass'], PDO::PARAM_STR);
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


