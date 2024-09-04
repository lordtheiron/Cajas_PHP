<?php

include_once '../DAO/Operaciones.php';
session_start();
try {
    $esDisponibles = Operaciones::estanteriasLibres();
    if (!empty($esDisponibles)) {
        $_SESSION['EstanteriasLibres'] = $esDisponibles;
        header("Location:../Vistas/VistaFormCaja.php");
    }
} catch (EstanteriaException $EE) {
    header("Location:../Vistas/VistaErrores.php?error=$EE");
}