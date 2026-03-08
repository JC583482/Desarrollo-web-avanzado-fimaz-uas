<?php
require 'Admin.php';

$iAdmin = new Admin ("", "" ,"") ;

echo "Nombre: " . $iAdmin->getNombre() . "<br>";
echo "Correo: " . $iAdmin->getCorreo() . "<br>";
echo "ROL: " . $iAdmin->getRol();

?>