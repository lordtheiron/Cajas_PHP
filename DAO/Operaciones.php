<?php

include_once 'Conexion.php';
include_once '../Modelo/Estanteria.php';
include_once '../Modelo/EstanteriaException.php';
include_once '../Modelo/Caja.php';
include_once '../Modelo/CajaException.php';
include_once '../Modelo/CajaBackup.php';

class Operaciones {

    public function usuarioExiste() {
        global $conexion;

        $orden = "SELECT * FROM usuario";
        $resultado = $conexion->query($orden);

        return $resultado->num_rows;
    }

    public function estanteriaExiste($id) {
        global $conexion;

        $orden = "SELECT * FROM estanteria WHERE codigo_estanteria='$id'";
        $resultado = $conexion->query($orden);

        return $resultado->num_rows;
    }

    public function cajaExiste($id) {
        global $conexion;

        $orden = "SELECT * FROM caja WHERE codigo_caja='$id'";
        $resultado = $conexion->query($orden);

        return $resultado->num_rows;
    }

    public function registroUsuario($usuario, $clave) {
        global $conexion;

        $clavehash = password_hash($clave, PASSWORD_BCRYPT);
        $orden = "INSERT INTO usuario VALUES(null,?,?);";
        $sentencia = $conexion->prepare($orden);
        $sentencia->bind_param("ss", $usuario, $clavehash);
        $resultado = $sentencia->execute();

        if ($conexion->affected_rows == 1) {
            
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido realizar el registro en registroUsuario()";
            throw new UsuarioException($mensaje, $codigo, $lugar);
        }
    }

    public static function pasillosLibres() {
        global $conexion;
        $pasillos = array();
        $orden = "SELECT P.* FROM pasillo P, almacen A WHERE P.huecos_ocupados <= A.num_huecos_pasillo";
        $resultado = $conexion->query($orden);

        if ($resultado->num_rows > 0) {
            $Obj = $resultado->fetch_object();
            while ($Obj) {
                $pasillos[] = $Obj;
                $Obj = $resultado->fetch_object();
            }
            return $pasillos;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se han podido sacar los pasillos en pasillosLibres()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public static function huecosLibres($idpasillo) {
        global $conexion;
        $arrayDisponibles = array();
        $ocupado = array();
        $orden = "SELECT numero FROM estanteria WHERE id_pasillo=$idpasillo";
        $orden2 = "SELECT num_huecos_pasillo FROM almacen";
        $resultado = $conexion->query($orden);
        $resultado2 = $conexion->query($orden2);

        if ($resultado->num_rows > 0 || $resultado2->num_rows == 1) {
            $fila = $resultado2->fetch_assoc();
            $numhuecos = $fila['num_huecos_pasillo'];
            $Obj = $resultado->fetch_assoc();
            while ($Obj) {
                $ocupado[] = $Obj['numero'];
                $Obj = $resultado->fetch_assoc();
            }
            for ($i = 1; $i <= $numhuecos; $i++) {
                if (!in_array($i, $ocupado)) {
                    $arrayDisponibles[] = $i;
                }
            }
            return $arrayDisponibles;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se han podido sacar los huecos disponibles en huecosLibres()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public function insertarEstanteria($Estanteria) {
        global $conexion;

        $codigo = $Estanteria->getCodigo();
        $material = $Estanteria->getMaterial();
        $nLejas = $Estanteria->getNumLejas();
        $pasillo = $Estanteria->getPasillo();
        $numero = $Estanteria->getHueco();
        $fAlta = $Estanteria->getFechaAlta();

        $ordenSQL = "INSERT INTO estanteria VALUES(null,?,?,?,0,?,?,?)";
        $sentencia = $conexion->prepare($ordenSQL);
        $sentencia->bind_param("ssissi", $codigo, $material, $nLejas, $fAlta, $pasillo, $numero);
        $resultado = $sentencia->execute();

        if ($conexion->affected_rows == 1) {
            
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido dar de alta la estanteria en insertarEstanteria()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
        $orden = "UPDATE pasillo SET huecos_ocupados=huecos_ocupados+1 WHERE id_pasillo=$pasillo;";
        $resultado2 = $conexion->query($orden);
        if ($conexion->affected_rows == 1) {
            return;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido actualizar la tabla pasillo en insertarEstanteria()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public static function listarEstanteria() {
        global $conexion;
        $ArrayObjects = array();
        $ordenSQL = "SELECT E.*,P.letra FROM estanteria E, pasillo P WHERE E.id_pasillo=P.id_pasillo ORDER BY codigo_estanteria";
        $resultado = $conexion->query($ordenSQL);

        if ($resultado->num_rows > 0) {
            $Obj = $resultado->fetch_object();

            while ($Obj) {
                $ArrayObjects[] = $Obj;
                $Obj = $resultado->fetch_object();
            }
            return $ArrayObjects;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido realizar el listado en listarEstanteria()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public static function estanteriasLibres() {
        global $conexion;
        $Estanterias = Array();
        $orden = "SELECT * FROM estanteria";
        $resultado = $conexion->query($orden);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            while ($fila) {
                if ($fila['nlejas'] > $fila['lejas_ocupadas']) {
                    $id = $fila['id_estanteria'];
                    $codigo = $fila['codigo_estanteria'];
                    $material = $fila['material_estanteria'];
                    $nlejas = $fila['nlejas'];
                    $lejasOcupadas = $fila['lejas_ocupadas'];
                    $fecha_alta = $fila['fecha_alta_estanteria'];
                    $idpasillo = $fila['id_pasillo'];
                    $numero = $fila['numero'];
                    $Estanteria = new Estanteria($codigo, $material, $nlejas, $idpasillo, $numero, $fecha_alta);
                    $Estanteria->setId($id);
                    $Estanteria->setLejasOcupadas($lejasOcupadas);
                    $Estanterias[] = $Estanteria;
                }
                $fila = $resultado->fetch_assoc();
            }
            return $Estanterias;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se han encontrado estanterias en estanteriasLibres()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public static function lejasDisponibles($idEstanteria) {
        global $conexion;
        $arrayLejas = array();
        $arrayDisponibles = array();
        $ordenSQL = "SELECT nlejas FROM estanteria WHERE id_estanteria=$idEstanteria";
        $sql = "SELECT leja_ocupada FROM ocupacion WHERE idestanteria=$idEstanteria";
        $resultado = $conexion->query($ordenSQL);
        $resultado2 = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $NumeroLejas = $fila['nlejas'];
            $fila2 = $resultado2->fetch_assoc();
            while ($fila2) {
                $arrayLejas[] = $fila2['leja_ocupada'];
                $fila2 = $resultado2->fetch_assoc();
            }
            for ($i = 0; $i < $NumeroLejas; $i++) {
                if (!in_array($i, $arrayLejas)) {
                    $arrayDisponibles[] = $i;
                }
            }
            return $arrayDisponibles;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se han encontrado lejas en lejasDisponibles()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public function insertarCaja($Caja, $Ocupacion) {
        global $conexion;
        $codigo = $Caja->getCodigo();
        $material = $Caja->getMaterial();
        $color = $Caja->getColor();
        $alto = $Caja->getAlto();
        $ancho = $Caja->getAncho();
        $profundidad = $Caja->getProfundidad();
        $contenido = $Caja->getContenido();
        $fecha_alta = $Caja->getFechaAlta();
        $idEstanteria = $Ocupacion->getIdestanteria();
        $leja = $Ocupacion->getLeja();

        $ordenCajabackup = "SELECT codigo_cajabackup FROM cajabackup";
        $result = $conexion->query($ordenCajabackup);
        $objeto = $result->fetch_assoc();
        while ($objeto) {
            if ($codigo == $objeto['codigo_cajabackup']) {
                $mensaje = $conexion->error;
                $codigo = $conexion->errno;
                $lugar = "No se puede proseguir porque ese codigo ya existe en insertarCaja()";
                throw new CajaException($mensaje, $codigo, $lugar);
            }
            $objeto = $result->fetch_assoc();
        }

        $ordenSQL = "INSERT INTO caja VALUES(null,?,?,?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($ordenSQL);
        $sentencia->bind_param("sssiiiss", $codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fecha_alta);
        $resultado = $sentencia->execute();

        if ($conexion->affected_rows == 1) {
            $idcajainsertada = $conexion->insert_id;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido insertar la caja en la base de datos en insertarCaja()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }

        $orden = "INSERT INTO ocupacion VALUES(null,?,?,?)";
        $sentencia1 = $conexion->prepare($orden);
        $sentencia1->bind_param("iii", $idEstanteria, $leja, $idcajainsertada);
        $resultado1 = $sentencia1->execute();

        if ($conexion->affected_rows != 1) {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido insertar la fila en Ocupacion en insertarCaja()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }

        $sql = "UPDATE estanteria SET lejas_ocupadas=lejas_ocupadas+1 WHERE id_estanteria=$idEstanteria;";
        $resultado2 = $conexion->query($sql);

        if ($conexion->affected_rows == 1) {
            return;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido realizar el Update en Estanteria en insertarCaja()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public function listaCajas() {
        global $conexion;
        $ArrayObjects = array();
        $ordenSQL = "SELECT C.*,E.codigo_estanteria,O.leja_ocupada FROM caja C, ocupacion O, estanteria E WHERE O.idcaja=C.id_caja AND O.idestanteria=E.id_estanteria ORDER BY codigo_caja";
        $resultado = $conexion->query($ordenSQL);

        if ($resultado->num_rows > 0) {
            $Obj = $resultado->fetch_object();

            while ($Obj) {
                $ArrayObjects[] = $Obj;
                $Obj = $resultado->fetch_object();
            }
            return $ArrayObjects;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido realizar el listado en listaCajas()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }
    }

    public function listarTodo() {
        global $conexion;
        $inventario = array();
        $ordenSQL = "SELECT E.*,C.*,P.letra FROM estanteria E 
            LEFT JOIN ocupacion o
            ON o.idestanteria = E.id_estanteria
            LEFT JOIN caja C
            ON C.id_caja = o.idcaja
            LEFT JOIN pasillo P
            ON E.id_pasillo=P.id_pasillo
            ORDER BY E.id_pasillo,E.numero";
        $resultado = $conexion->query($ordenSQL);

        if ($resultado->num_rows > 0) {
            $Obj = $resultado->fetch_object();

            while ($Obj) {
                $inventario[] = $Obj;
                $Obj = $resultado->fetch_object();
            }
            return $inventario;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido realizar el listado en listarTodo()";
            throw new EstanteriaException($mensaje, $codigo, $lugar);
        }
    }

    public static function listarDatosCaja($codcaja) {
        global $conexion;
        $orden = "SELECT C.*,O.idestanteria,O.leja_ocupada FROM caja C,ocupacion O WHERE C.codigo_caja=? AND C.id_caja=O.idcaja";
        $sentencia = $conexion->prepare($orden);
        $sentencia->bind_param("s", $codcaja);
        $resultado = $sentencia->execute();
        $resultado = $sentencia->get_result();

        if ($resultado->num_rows == 1) {
            $Obj = $resultado->fetch_assoc();
            $id = $Obj['id_caja'];
            $codigo = $Obj['codigo_caja'];
            $material = $Obj['material_caja'];
            $color = $Obj['color'];
            $alto = $Obj['alto'];
            $ancho = $Obj['ancho'];
            $profundidad = $Obj['profundidad'];
            $contenido = $Obj['contenido'];
            $fecha_alta = $Obj['fecha_alta_caja'];
            $idestanteria = $Obj['idestanteria'];
            $leja = $Obj['leja_ocupada'];
            $cajabackup = new CajaBackup($codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fecha_alta, $idestanteria, $leja);
            $cajabackup->setId($id);
            return $cajabackup;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido listar la caja en listarDatosCaja()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }
    }

    public static function BackupCaja($caja) {
        global $conexion;
        $id = $caja->getId();
        $orden = "DELETE FROM caja WHERE id_caja=$id";
        $resultado = $conexion->query($orden);

        if ($conexion->affected_rows == 1) {
            return "Caja vendida";
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido eliminar la caja en BackupCaja()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }
    }

    public static function listarCajaDevolucion($codcaja) {
        global $conexion;
        $orden = "SELECT * FROM cajabackup WHERE codigo_cajabackup=?";
        $sentencia = $conexion->prepare($orden);
        $sentencia->bind_param("s", $codcaja);
        $resultado = $sentencia->execute();
        $resultado = $sentencia->get_result();

        if ($resultado->num_rows == 1) {
            $Obj = $resultado->fetch_assoc();
            $id = $Obj['id_cajabackup'];
            $codigo = $Obj['codigo_cajabackup'];
            $material = $Obj['material_cajabackup'];
            $color = $Obj['color_cajabackup'];
            $alto = $Obj['alto_cajabackup'];
            $ancho = $Obj['ancho_cajabackup'];
            $profundidad = $Obj['profuncidad_cajabackup'];
            $contenido = $Obj['contenido_cajabackup'];
            $fecha_alta = $Obj['fecha_alta_cajabackup'];
            $idestanteria = $Obj['idestanteria_cajabackup'];
            $leja = $Obj['leja_ocupada_cajabackup'];
            $cajabackup = new CajaBackup($codigo, $material, $color, $alto, $ancho, $profundidad, $contenido, $fecha_alta, $idestanteria, $leja);
            $cajabackup->setId($id);
            return $cajabackup;
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido listar la caja en listarCajaDevolucion()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }
    }

    public static function devolverCaja($caja, $ocupacion) {
        global $conexion;
        $id = $caja->getId();
        include_once '../Modelo/triggerDevolucion.php';
        //Aqui crea el trigger
        $sql = "DELETE FROM cajabackup WHERE id_cajabackup=$id";
        $resultado = $conexion->query($sql);
        if ($conexion->affected_rows == 1 && $resultado3) {
            return "Caja devuelta";
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido devolver la caja en devolverCaja()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }
    }

    public static function borrarEstanteria($codEstanteria) {
        global $conexion;

        $orden = "SELECT * FROM estanteria WHERE codigo_estanteria='$codEstanteria' AND lejas_ocupadas=0";
        $resultado = $conexion->query($orden);
        if ($conexion->affected_rows == 1) {
            $orden2 = "DELETE FROM estanteria WHERE codigo_estanteria='$codEstanteria'";
            $resultado2 = $conexion->query($orden2);
            return "Estantería Retirada";
        } else {
            $mensaje = $conexion->error;
            $codigo = $conexion->errno;
            $lugar = "No se ha podido eliminar la estanteria, ya contiene cajas en borrarEstanteria()";
            throw new CajaException($mensaje, $codigo, $lugar);
        }
    }

}
