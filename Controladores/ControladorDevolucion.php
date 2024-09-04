<?php

include_once '../DAO/Operaciones.php';
include_once '../Modelo/EstanteriaOcupada.php';
session_start();
$caja = $_SESSION['$Caja'];
$idEstanteria = $_REQUEST['estanterias'];
$leja = $_REQUEST['lejas'];
$ocupacion = new EstanteriaOcupadda($idEstanteria, $leja);
try {
    $mensaje = Operaciones::devolverCaja($caja, $ocupacion);
    header("Location:../Vistas/vistaMensajes.php?mensaje=$mensaje");
} catch (CajaException $CE) {
    header("Location:../Vistas/VistaErrores.php?error=$CE");
}

