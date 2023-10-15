<?php
require('etc/conexion.php');

$sql = "TRUNCATE TABLE `goles_logs`";
if ($conexion->query($sql) === TRUE) echo "Tabla vaciada correctamente.<br>";
else echo "Error al vaciar la tabla: " . $conexion->error;

$sql = "UPDATE `partidos_logs` SET goles1 = 0, goles2 = 0, jugado = 0";
if ($conexion->query($sql) === TRUE) echo "Valores actualizados correctamente.";
else echo "Error al actualizar los valores: " . $conexion->error;

echo "<div><a href='index.php'>Volver</a></div>";