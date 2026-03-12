<?php
require_once 'Usuario.php';
require_once 'Admin.php';
require_once 'Alumno.php';

$usuarios = []; 
$error = "";    

try {
    $usuarios[] = new Admin("Jesus", "jesus@gmail.com");
    $usuarios[] = new Alumno("Yibran", "yibran@gmail.com", "2026100");
    
    $usuarios[] = new Alumno("Jesus", "jesusgmail.com", "743942");

} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<html>
<body>
    
    <?php if ($error != "") { ?>
        <b style="color:red;"><?php echo $error; ?></b>
    <?php } ?>

    <table border="1">
        <tr>
            <td>Nombre</td>
            <td>Correo</td>
            <td>Rol</td>
            <td>Matricula</td>
        </tr>

        <?php foreach ($usuarios as $user) { ?>
            <tr>
                <td><?php echo $user->getNombre(); ?></td>
                <td><?php echo $user->getCorreo(); ?></td>
                <td><?php echo $user->getRol(); ?></td>
                <td>
                    <?php 
                    if ($user instanceof Alumno) {
                        echo $user->getMatricula();
                    } else {
                        echo "Ninguno";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>