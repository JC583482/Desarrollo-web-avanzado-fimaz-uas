<?php
class Usuario {
    protected $pNombre;
    protected $pCorreo;

    public function __construct($nombre, $correo){

        if (!Filter_var($correo, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Correo invalido: " . $correo); 
        }
        $this->pNombre=$nombre;
        $this->pCorreo=$correo;

    }

    public function getNombre(){
        return $this->pNombre;
    }

    public function getCorreo(){
        return $this->pCorreo;
    }

}