<?php
class Dinosaurio {
    private $id;
    private $nombre;
    private $id_periodo;
    private $tiempo_vida;
    private $ubicacion;
    private $alimentacion;
    private $agresividad;
    private $familia;
    private $especie;

    function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    function __set($atributo, $valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
}
?>