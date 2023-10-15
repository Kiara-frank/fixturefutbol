<?php
require('etc/conexion.php');

$tablas = ["goles_logs", "partidos_logs"];

foreach ($tablas as $tabla) {
    $sql = "TRUNCATE TABLE $tabla";
    if ($conexion->query($sql) === TRUE) {
        echo "Tabla $tabla vaciada correctamente.<br>";
    } else {
        echo "Error al vaciar la tabla $tabla: " . $conexion->error;
        exit;
    }
}

header("Location: index.php");