<?php
    require 'clases/Admin.php';
    require 'clases/Alumno.php';

    try{
        $Admin=new Admin("yibran","abcd@gmail.com");
        echo "Nombre: " . $Admin->getNombre() . "<br> Rol: " . $Admin->getRol() ."\n";
    } catch (Exception $e) {
        echo "Error: ". $e->getMessage();
    }

    try {
        $Alumno=new Alumno("jesus", "jesugmail.com", "81287346");
    } catch (Exception $e) {
        echo "<br> Error controlado: " . $e->getMessage();
    }
    ?>