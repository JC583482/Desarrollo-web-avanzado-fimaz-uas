<?php
class Usuario {
    protected $pCorreo;
    protected $pNombre;

    public function __construct($nombre,$correo){
        if (!Filter_var($correo, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Error: " . $correo ." no valido");
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