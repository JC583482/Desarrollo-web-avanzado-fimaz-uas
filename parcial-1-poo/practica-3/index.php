<?php
    require 'clases/Admin.php';
    require 'clases/Alumno.php';

    try{
        $admin=new Admin("yibran","abcd@gmail.com");
        echo "Nombre: " . $admin->getNombre() . "| Rol: " . $Admin->getRol() ."\n";
    } catch (Exception $e) {
        echo "Error: ". $e->getMessage();
    }

    try {
        $alumno=new Alumno("jesus", "jesus@gmail.com", "81287346");
    } catch (Exception $e) {
        echo "Error controlado: " . $e->getMessage();
    }