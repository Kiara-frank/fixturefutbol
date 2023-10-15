<?php
$conexion = mysqli_connect("localhost", "id21402023_admin", "Admin_12", "id21402023_fixturefutbol") or die ("No hay conexion");
mysqli_query($conexion, "SET NAMES 'utf8'");
mysqli_select_db($conexion, "id21402023_fixturefutbol") or die ("No hay base");