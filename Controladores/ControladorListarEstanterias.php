<?php

include_once '../DAO/Operaciones.php';
session_start();

try {
    $Estanterias = Operaciones::listarEstanteria();
    if (!empty($Estanterias)) {
        $_SESSION['$Estanterias'] = $Estanterias;
        header("Location:../Vistas/VistaListadoEstanterias.php");
    }
} catch (EstanteriaException $EE) {
    header("Location:../Vistas/VistaErrores.php?error=$EE");
}