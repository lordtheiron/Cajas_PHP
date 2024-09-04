<?php

class Estanteria {

    private $id;
    private $codigo;
    private $material;
    private $numLejas;
    private $lejasOcupadas;
    private $pasillo;
    private $hueco;
    private $fechaAlta;

    function __construct($codigo, $material, $numLejas, $pasillo, $hueco, $fechaAlta) {
        $this->codigo = $codigo;
        $this->material = $material;
        $this->numLejas = $numLejas;
        $this->pasillo = $pasillo;
        $this->hueco = $hueco;
        $this->fechaAlta = $fechaAlta;
    }

    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getMaterial() {
        return $this->material;
    }

    function getNumLejas() {
        return $this->numLejas;
    }

    function getLejasOcupadas() {
        return $this->lejasOcupadas;
    }

    function getPasillo() {
        return $this->pasillo;
    }

    function getHueco() {
        return $this->hueco;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setMaterial($material) {
        $this->material = $material;
    }

    function setNumLejas($numLejas) {
        $this->numLejas = $numLejas;
    }

    function setLejasOcupadas($lejasOcupadas) {
        $this->lejasOcupadas = $lejasOcupadas;
    }

    function setPasillo($pasillo) {
        $this->pasillo = $pasillo;
    }

    function setHueco($hueco) {
        $this->hueco = $hueco;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    
    public function __toString() {
        
    }

}
