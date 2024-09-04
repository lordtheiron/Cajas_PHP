<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once '../DAO/Operaciones.php';
        $idEstanteria = $_REQUEST['estanterias'];

        try {
            $lejaslibres = Operaciones::lejasDisponibles($idEstanteria);
        } catch (EstanteriaException $EE) {
            header("Location:VistaErrores.php?error=$EE");
        }

        foreach ($lejaslibres as $leja) {
            ?>
        <option value="<?php echo $leja; ?>" ><?php echo ($leja + 1); ?> </option>
        <?php
    }
    ?>
</body>
</html>
