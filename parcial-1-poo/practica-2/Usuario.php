<?php
    class Usuario{
        protected $pNombre; 
        protected $pCorreo;

        function __construct($nombre, $correo) {
            $this->pNombre=$nombre;
            $this->pCorreo=$correo;
        }
        
        function getNombre()
        {
            return $this->pNombre;
        }

        function getCorreo()
        {
            return $this->pCorreo;
        }

        function setNombre($nombre)
        {
            $this->pNombre=$nombre;
        }

        function setCorreo($correo)
        {
            $this->pCorreo=$correo;
        }
        
    }