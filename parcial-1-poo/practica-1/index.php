<?php
Require 'Usuario.php';

$iUsuario = new Usuario ("Yibran", "abcd@gmail.com");

echo "Nombre: ". $iUsuario->getNombre() . "<br>";
echo "Correo: ". $iUsuario->getCorreo();
?>