<?php

include_once 'Caja.php';

class CajaBackup extends Caja {

    private $idestanteria;
    private $lejaocupada;

    function __construct($codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fechaAlta, $idestanteria, $lejaocupada) {
        parent::__construct($codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fechaAlta);
        $this->idestanteria = $idestanteria;
        $this->lejaocupada = $lejaocupada;
    }

    function getIdestanteria() {
        return $this->idestanteria;
    }

    function getLejaocupada() {
        return $this->lejaocupada;
    }

    function setIdestanteria($idestanteria) {
        $this->idestanteria = $idestanteria;
    }

    function setLejaocupada($lejaocupada) {
        $this->lejaocupada = $lejaocupada;
    }

    public function __toString() {
        
    }

}
