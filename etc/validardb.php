<?php
$conexion = new mysqli("localhost", "root", "") or die ("No hay conexion");
mysqli_query($conexion, "SET NAMES 'utf8'");

function creardb($conexion) {
    $sql = file_get_contents("etc/db.sql");
    
    if ($conexion->multi_query($sql) === TRUE) {
        $conexion->close();
        header("Location: index.php");
        exit;
    } else {
        echo $conexion->error;
        $conexion->close();
    }
}

$validar = $conexion->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'futbol'");

if ($validar->num_rows > 0) mysqli_select_db($conexion, "futbol") or die ("No hay base");
else creardb($conexion);

if (isset($_POST['reiniciardb'])) creardb($conexion);