<?php

class Livrer {

    private $_attributs = array();

    public function __construct($data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __get($key) {
        if (isset($this->_attributs[$key])) {
            return $this->_attributs[$key];
        }
    }

    public function __set($key, $value) {
        $this->_attributs[$key] = $value;
    }

}
