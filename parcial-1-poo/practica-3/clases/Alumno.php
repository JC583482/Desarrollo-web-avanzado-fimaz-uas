<?php
class Alumno extends Usuario{
    private $nMatricula;

    public function __construct($pNombre, $pCorreo, $matricula){
        parent::__construct($pNombre, $pCorreo);
        $this->nMatricula=$matricula;
    }

    public function getMatricula(){return $this->nMatricula;}
    public function getRol(){return "Alumno";}

}