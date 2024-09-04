<?php

include_once '../DAO/Operaciones.php';

$OpAlmacen = new Operaciones();

if ($OpAlmacen->usuarioExiste() == 0) {
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];
    $OpAlmacen->registroUsuario($usuario, $clave);
    header("Location:../Vistas/VistaMensajes.php?mensaje=Usted ha sido registrado como el actual administrador del programa.");
} else {
    header("Location:../Vistas/VistaInicio.html");
}