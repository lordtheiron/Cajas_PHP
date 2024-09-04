<?php

include_once '../DAO/Conexion.php';
include_once './CajaBackup.php';

$borrar = "DROP TRIGGER IF EXISTS trigger_devolucion_caja ";
$resultado2 = $conexion->query($borrar)or die("Trigger no encontrado");

$codigo = $caja->getCodigo();
$material = $caja->getMaterial();
$color = $caja->getColor();
$alto = $caja->getAlto();
$ancho = $caja->getAncho();
$profundidad = $caja->getProfundidad();
$contenido = $caja->getContenido();
$idestanteria = $ocupacion->getIdestanteria();
$leja = $ocupacion->getLeja();


$trigger = "CREATE TRIGGER trigger_devolucion_caja
AFTER DELETE ON cajabackup
FOR EACH ROW
BEGIN
INSERT INTO caja VALUES(null,'" . $codigo . "','" . $material . "','" . $color . "','" . $alto . "','" . $ancho . "','" . $profundidad . "','" . $contenido . "',CURRENT_DATE());
INSERT INTO ocupacion VALUES(null,'" . $idestanteria . "','" . $leja . "',(SELECT MAX(id_caja) FROM caja));
UPDATE estanteria SET lejas_ocupadas=lejas_ocupadas+1 WHERE id_estanteria='" . $idestanteria . "';
END";
$resultado3 = $conexion->query($trigger);


