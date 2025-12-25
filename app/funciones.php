<?php
//Métodos auxiliares si fueran necesarios para       simplificar el index.php
require_once "/Dinobots/app/config.php";

function validar_usuario($usuario,$clave){

    $usuarioBD = getUsuario($usuario);

    if($usuarioBD->nombre === $usuario && password_verify($clave,$usuario->hash_contrasena)){
        return true;
    }

    return false;

}




?>