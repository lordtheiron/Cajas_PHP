<?php

include_once '../DAO/Operaciones.php';
session_start();
$Caja = $_SESSION['$Caja'];

try {
    $mensaje = Operaciones::BackupCaja($Caja);
    header("Location:../Vistas/vistaMensajes.php?mensaje=$mensaje");
} catch (CajaException $CE) {
    header("Location:../Vistas/VistaErrores.php?error=$CE");
}