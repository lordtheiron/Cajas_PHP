<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once '../DAO/Operaciones.php';
        $idpasillo = $_REQUEST['pasillos'];
        try {
            $huecoslibres = Operaciones::huecosLibres($idpasillo);
        } catch (EstanteriaException $EE) {
            header("Location:VistaErrores.php?error=$EE");
        }
        include_once '../Modelo/Estanteria.php';
        foreach ($huecoslibres as $hueco) {
            ?>
        <option value="<?php echo $hueco; ?>" ><?php echo $hueco; ?> </option>
        <?php
    }
    ?>
</body>
</html>