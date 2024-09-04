<?php

include_once '../DAO/Operaciones.php';
session_start();

try {
    $Almacen = new Operaciones();
    $Almacen->listarTodo();
    if (!empty($Almacen->listarTodo())) {
        $_SESSION['$inventario'] = $Almacen->listarTodo();
        header("Location:../Vistas/VistaListadoCompleto.php");
    }
} catch (EstanteriaException $EE) {
    header("Location:../Vistas/VistaErrores.php?error=$EE");
}