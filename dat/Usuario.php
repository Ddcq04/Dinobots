<?php
class Usuario {

    private $id;
    private $nombre;
    private $hash_contrasena;
    private $correo;


    function __get($name){

        if(property_exists($this,$name)){
            return $this->$name;
        }

    }

    function __set($name, $value){

        if(property_exists($this,$name)){
            $this->$name = $value;
        }
    }
}
?>