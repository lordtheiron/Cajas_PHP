<?php

include_once '../DAO/Operaciones.php';
session_start();
$codcaja = $_REQUEST['codigo'];
$opcion = $_SESSION['$opcion'];
if ($opcion == "borrar") {
    try {
        $Caja = Operaciones::listarDatosCaja($codcaja);
        if (!empty($Caja)) {
            $_SESSION['$Caja'] = $Caja;
            header("Location:../Vistas/VistaDatosCaja.php");
        }
    } catch (CajaException $CE) {
        header("Location:../Vistas/VistaErrores.php?error=$CE");
    }
} else if ($opcion == "restaurar") {
    try {
        $Caja = Operaciones::listarCajaDevolucion($codcaja);
        $estanteriasdisponibles = Operaciones::estanteriasLibres();
        if (!empty($Caja) && !empty($estanteriasdisponibles)) {
            $_SESSION['$Caja'] = $Caja;
            $_SESSION['EstanteriasLibres'] = $estanteriasdisponibles;
            header("Location:../Vistas/VistaDatosCajaDev.php");
        }
    } catch (CajaException $CE) {
        header("Location:../Vistas/VistaErrores.php?error=$CE");
    }
}
