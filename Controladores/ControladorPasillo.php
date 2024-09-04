<?php
include '../DAO/Operaciones.php';
session_start();

try{
    $pasillo= Operaciones::pasillosLibres();
    if(!empty($pasillo)){
        $_SESSION['$pasillo']=$pasillo;
        header("Location:../Vistas/VistaFormEstanteria.php");
    }
} catch (EstanteriaException $EE) {
    header("Location:../Vistas/VistaErrores.php?error=$EE");
}
