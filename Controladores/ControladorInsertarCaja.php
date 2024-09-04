<?php

session_start();
$codigo = $_REQUEST['codigo'];
$material = $_REQUEST['material'];
$color = $_REQUEST['color'];
$alto = $_REQUEST['alto'];
$ancho = $_REQUEST['ancho'];
$profundidad = $_REQUEST['profundidad'];
$contenido = $_REQUEST['contenido'];
$idEstanteria = $_REQUEST['estanterias'];
$leja = $_REQUEST['lejas'];
$fAlta = $_REQUEST['fAlta'];

include_once '../Modelo/Caja.php';
include_once '../Modelo/EstanteriaOcupada.php';
$Caja = new Caja($codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fAlta);
$Ocupacion = new EstanteriaOcupadda($idEstanteria, $leja);
include_once '../DAO/Operaciones.php';
$conexion->autocommit(false);

try {
    $Operacion = new Operaciones();
    if ($Operacion->cajaExiste($codigo)) {
        header("Location:../Vistas/VistaErrores.php?error=La Caja ya existe.");
    } else {
        $Operacion->insertarCaja($Caja, $Ocupacion);
        $conexion->commit();
        $conexion->autocommit(true);
        header("Location:../Vistas/vistaMensajes.php?mensaje=Caja insertada");
    }

    exit;
} catch (CajaException $CE) {
    $conexion->rollback();
    $conexion->autocommit(true);
    header("Location:../Vistas/VistaErrores.php?error=$CE");
    exit();
} catch (EstanteriaException $EE) {
    $conexion->rollback();
    $conexion->autocommit(true);
    header("Location:../Vistas/VistaErrores.php?error=$EE");
    exit();
}