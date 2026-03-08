<?php
    class Usuario{
        private $pNombre; 
        private $pCorreo;

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

    }