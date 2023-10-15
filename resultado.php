<?php require('etc/conexion.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="etc/estilos.css">
    <link rel="icon" href="img/icon.png">
    <title>Torneo Futbol</title>
</head>
<body>
    <main id="resultado">
        <?php
        if(!isset($_GET['partido'])) echo "<button class='boton'>No hay partido seleccionado</button>";
        else {
            $idPartido = $_GET['partido'];

            $equipo1 = mysqli_query($conexion, "SELECT `equipo1` FROM `partidos_logs` WHERE `id`=$idPartido")->fetch_array()[0];
            $equipo2 = mysqli_query($conexion, "SELECT `equipo2` FROM `partidos_logs` WHERE `id`=$idPartido")->fetch_array()[0];

            $equipos = mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo1")->fetch_array()[0] . " vs " . mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo2")->fetch_array()[0];

            echo "<h1 class='titulo'>$equipos</h1><section class='carta'>";

            $goles = mysqli_query($conexion, "SELECT * FROM `goles_logs` WHERE `partido`=$idPartido");
            $anteriorJugador = 0;
            $anteriorEquipo = 0;

            for($i = 1; $i <= mysqli_num_rows($goles); $i++) {
                $gol = $goles->fetch_array();

                $idJugador = $gol['jugador'];
                $nombre = mysqli_query($conexion, "SELECT `nombre` FROM `jugadores` WHERE `id`=$idJugador")->fetch_array()[0];
                $apellido = mysqli_query($conexion, "SELECT `apellido` FROM `jugadores` WHERE `id`=$idJugador")->fetch_array()[0];
                $numero = mysqli_query($conexion, "SELECT `numero` FROM `jugadores` WHERE `id`=$idJugador")->fetch_array()[0];
                $equipo = mysqli_query($conexion, "SELECT `equipo` FROM `jugadores` WHERE `id`=$idJugador")->fetch_array()[0];
                $nombreEquipo = mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo")->fetch_array()[0];
                $golesTotales = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM `goles_logs` WHERE `partido`=$idPartido AND `jugador`=$idJugador"));

                if($i == 1) $anteriorEquipo = $equipo;

                if($equipo != $anteriorEquipo) {
                    echo "<hr class='separarEquipos'>";
                    $anteriorEquipo = $equipo;
                }

                if($idJugador != $anteriorJugador) {
                    echo "<h3>$nombre $apellido # $numero ($nombreEquipo) marcó $golesTotales gol(es)</h3>";
                    $anteriorJugador = $idJugador;
                }
            }
            echo "</section>";
        }
        ?>
        <a href='fixture.php'><button class='boton'>Volver</button></a>
    </main>
</body>
</html>