<?php
class DimensionManager extends Dimension{
    private $_db;
    private $_dimensionArray = array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function getDimension($id){
        $query="select * from dimension where id_dim = :id_dim";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$id,PDO::PARAM_INT);
        $resultset->execute();
       
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_dimensionArray[] = new Dimension($data);
        }
        return $_dimensionArray;
    }   
}
