<?php
$conexion = mysqli_connect("localhost", "root", "", "futbol") or die ("No hay conexion");
mysqli_query($conexion, "SET NAMES 'utf8'");
mysqli_select_db($conexion, "futbol") or die ("No hay base");