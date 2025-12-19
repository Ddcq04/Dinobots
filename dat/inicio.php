<?php

require_once "/Dinobots/app/funciones.php";

$msg = "";

if(!isset($_POST["nombre"]) && !isset($_POST["clave"])){

    header("Location: /Dinobots/layouts/inicio.html");
    exit;

}

$nombre = $_POST["nombre"];

$clave = $_POST["clave"];


if(validar_usuario($nombre,$clave)){

    header("Location: /Dinobots/layouts/home.html");
    exit;


}else{

    header("Location: /login.php?error=Usuario o contraseña incorrectos");
    exit;

}







?>