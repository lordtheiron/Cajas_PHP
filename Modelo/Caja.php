<?php

class Caja {

    private $id;
    private $codigo;
    private $material;
    private $color;
    private $alto;
    private $ancho;
    private $profundidad;
    private $contenido;
    private $fechaAlta;

    function __construct($codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fechaAlta) {
        $this->codigo = $codigo;
        $this->material = $material;
        $this->color = $color;
        $this->alto = $alto;
        $this->ancho = $ancho;
        $this->profundidad = $profundidad;
        $this->contenido = $contenido;
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

    function getColor() {
        return $this->color;
    }

    function getAlto() {
        return $this->alto;
    }

    function getAncho() {
        return $this->ancho;
    }

    function getProfundidad() {
        return $this->profundidad;
    }

    function getContenido() {
        return $this->contenido;
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

    function setColor($color) {
        $this->color = $color;
    }

    function setAlto($alto) {
        $this->alto = $alto;
    }

    function setAncho($ancho) {
        $this->ancho = $ancho;
    }

    function setProfundidad($profundidad) {
        $this->profundidad = $profundidad;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    public function __toString() {
        
    }

}
