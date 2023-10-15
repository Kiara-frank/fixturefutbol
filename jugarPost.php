<?php require('etc/conexion.php');

if(!isset($_POST['equipo1']) || !isset($_POST['equipo2']) || !isset($_POST['partido'])) die ("Faltan datos");
for($i = 1; $i <= 22; $i++) if(!isset($_POST['jugador'.$i])) die ("Faltan datos");

else {
    $idPartido = $_POST['partido'];

    $idEquipo1 = $_POST['equipo1'];
    $idEquipo2 = $_POST['equipo2'];

    $golesEquipo1 = 0;
    $golesEquipo2 = 0;

    $jugadores = mysqli_query($conexion, "SELECT * FROM `jugadores` WHERE `equipo`=$idEquipo1 OR `equipo`=$idEquipo2");

    for($i = 1; $i <= 22; $i++) {
        $jugador = $jugadores->fetch_array();

        $idJugador = $jugador['id'];
        $cantGoles = (int) $_POST['jugador'.$i];

        if($cantGoles && $i >= 1 && $i <= 11) $golesEquipo1 += $cantGoles;
        else if($cantGoles && $i >= 12 && $i <= 22) $golesEquipo2 += $cantGoles;

        if($cantGoles) for($g = 1; $g <= $cantGoles; $g++) mysqli_query($conexion, "INSERT INTO `goles_logs` (`partido`, `jugador`) VALUES ('$idPartido', '$idJugador')");
    }
    mysqli_query($conexion, "UPDATE `partidos_logs` SET `goles1`='$golesEquipo1', `goles2`='$golesEquipo2', `jugado`='1' WHERE `id`=$idPartido");

    header("Location: fixture.php");
    exit;
}