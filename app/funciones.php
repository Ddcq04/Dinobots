<?php


require_once __DIR__ . '/config.php';

function validar_usuario($usuario, $clave) {
    $modelo = AccesoDatos::getModelo();
    $usuarioBD = $modelo->getUsuario($usuario);

    if ($usuarioBD && $usuarioBD->nombre === $usuario && password_verify($clave, $usuarioBD->hash_contrasena)) {
        return true;
    }

    return false;
}

function existe_usuario($usuario){
    
    $modelo = AccesoDatos::getModelo();
    $usuarioBD = $modelo->getUsuario($usuario);

    if($usuarioBD && $usuarioBD->nombre === $usuario){
        return true;
    }
    return false;

}



?>