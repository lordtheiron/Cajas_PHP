<?php

$conexion = new mysqli("localhost", "root", "");

$conexion->set_charset("utf8");
//Para evitar que se interpreten mal las tildes y ñ
if (!$conexion->connect_error) {
    echo "<h2>Conexion establecida con el servidor</h2><br>";
    $conexion->select_db("php_cajas_atc") or die("Base de datos no encontrada");
    echo "<h2>Conexion establecida con la base de datos</h2><br>";
} else {
    echo "<h2>No ha sido posible crear la conexion con el servidor</h2><br>";
}
    

