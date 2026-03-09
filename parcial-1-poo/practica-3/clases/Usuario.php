<?php 

class Usuario {

    protected $pNombre ;
    protected $pCorreo ;

    public function __construct ($nombre, $correo){

        $this->pNombre=$nombre;
        $this->setCorreo($correo);

    }    

    public function getNombre(){
        return $this->pNombre; 
    }

    public function getCorreo(){
        return $this->pCorreo;
    }
    
    public function setNombre($nombre){
        $this->pNombre=$nombre ;
    }

    public function setCorreo($correo){

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            throw new Exception("<br> Error de ". $correo ." no valido " );
        }

        $this->pCorreo=$correo;

    }

}