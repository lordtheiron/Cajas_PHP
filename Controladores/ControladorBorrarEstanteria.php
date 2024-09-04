<?php

include_once '../DAO/Operaciones.php';
session_start();
$Estanteria= $_REQUEST['codigo'];

try {
    $mensaje = Operaciones::borrarEstanteria($Estanteria);
    header("Location:../Vistas/vistaMensajes.php?mensaje=$mensaje");
} catch (CajaException $CE) {
    header("Location:../Vistas/VistaErrores.php?error=$CE");
}
