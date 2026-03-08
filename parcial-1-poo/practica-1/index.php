<?php
Require 'Usuario.php';

$iUsuario = new Usuario ("Yibran", "abcd@gmail.com");

echo "Nombre: ". $user->getNombre() . "<br>";
echo "Correo: ". $user->getCorreo();
?>