<?php
require 'Admin.php';

$iAdmin = new Admin ("Yibran", "abcd@gmail.com") ;

echo "Nombre: " . $iAdmin->getNombre() . "<br>";
echo "Correo: " . $iAdmin->getCorreo() . "<br>";
echo "ROL: " . $iAdmin->getRol();

?>