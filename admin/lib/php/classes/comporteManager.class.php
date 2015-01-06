<?php
class ComporteManager extends Comporte {
    private $_db;
    private $_comporteArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

   
}
