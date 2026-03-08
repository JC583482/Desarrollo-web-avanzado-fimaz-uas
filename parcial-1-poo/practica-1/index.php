<?php
Require 'Usuario.php';

$iUsuario = new $usuario ("Yibran", "abcd@gmail.com");

echo "Nombre: ". $user->getNombre() . "<br>";
echo "Correo: ". $user->getCorreo();
?>