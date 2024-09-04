<?php

include_once '../DAO/Operaciones.php';
session_start();

try {
    $ArrayCaja = new Operaciones();
    $ArrayCaja->listaCajas();
    if (!empty($ArrayCaja->listaCajas())) {
        $_SESSION['$ArrayCaja'] = $ArrayCaja->listaCajas();
        header("Location:../Vistas/VistaListadoCajas.php");
    }
} catch (CajaException $CA) {
    header("Location:../Vistas/VistaErrores.php?error=$CA");
}