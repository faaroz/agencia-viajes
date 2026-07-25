<?php

/* =========================================
   CONEXIÓN A LA BASE DE DATOS
========================================= */

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "agencia";

/* Crear conexión */

$conn = new mysqli(
    $servidor,
    $usuario,
    $contrasena,
    $baseDatos
);

/* Verificar conexión */

if ($conn->connect_error) {

    die("Error de conexión: " . $conn->connect_error);

}

/* Configurar caracteres UTF-8 */

$conn->set_charset("utf8");

?>