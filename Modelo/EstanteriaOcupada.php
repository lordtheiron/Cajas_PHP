<?php

class EstanteriaOcupadda {

    private $idestanteria;
    private $leja;

    function __construct($idestanteria, $leja) {
        $this->idestanteria = $idestanteria;
        $this->leja = $leja;
    }

    function getIdestanteria() {
        return $this->idestanteria;
    }

    function getLeja() {
        return $this->leja;
    }

    function setIdestanteria($idestanteria) {
        $this->idestanteria = $idestanteria;
    }

    function setLeja($leja) {
        $this->leja = $leja;
    }

    public function __toString() {
        
    }

}
