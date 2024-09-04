<?php

$codigo = $_REQUEST['codigo'];
$material = $_REQUEST['material'];
$nLejas = $_REQUEST['nLejas'];
$pasillo = $_REQUEST['pasillo'];
$hueco = $_REQUEST['hueco'];
$fAlta = $_REQUEST['fAlta'];

include_once '../Modelo/Estanteria.php';
$estanteria = new Estanteria($codigo, $material, $nLejas, $pasillo, $hueco, $fAlta);

include_once '../DAO/Operaciones.php';
$conexion->autocommit(false);
try {
    $Operacion = new Operaciones();
    if ($Operacion->estanteriaExiste($codigo)) {
        header("Location:../Vistas/VistaErrores.php?error=La estantería ya existe");
    } else {
        $Operacion->insertarEstanteria($estanteria);
        $conexion->commit();
        $conexion->autocommit(true);
        header("Location:../Vistas/vistaMensajes.php?mensaje=Estanteria Insertada");
    }
} catch (EstanteriaException $EE) {
    $conexion->commit();
    $conexion->autocommit(true);
    header("Location:../Vistas/VistaErrores.php?error=$EE");
}

