<?php
class CommandeManager extends Commande {
    private $_db;
    private $_commandeArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

   
}