<?php

require __DIR__ . '/Usuario.php' ;

class Admin extends Usuario {
    function getRol () {
        return "Administrador";
    } 
}
