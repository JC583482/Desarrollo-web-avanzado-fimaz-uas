<?php
require_once 'Usuario.php';

class Alumno extends Usuario{
    private $nMatricula;

    public function __construct($nombre,$correo,$matricula){
        parent::__construct($nombre,$correo);

        $this->nMatricula=$matricula;
    
    }

    public function getMatricula(){
        return $this->nMatricula;
    }

    public function getRol(){
        return " Alumno ";
    }
}