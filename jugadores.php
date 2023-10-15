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
    <main id="jugadores">
        <h1 class="titulo">Jugadores</h1>
        <?php
        if(isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
            $volver = $pagina . ".php";
        } else $volver = "index.php";

        if(isset($_GET['equipo'])) {
            $idEquipo = $_GET['equipo'];
            $equipo = mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$idEquipo")->fetch_array()[0];
            ?>
            <table class="puntajes">
                <thead>
                    <tr><th><?=$equipo?></th><th>Altura</th><th>Peso</th><th>Nacimiento</th><th>DNI</th><th>Posicion</th><th>Partidos</th><th>Goles</th></tr>
                </thead>
                <tbody>
                    <?php
                    $jugadores = mysqli_query($conexion, "SELECT * FROM `jugadores` WHERE `equipo`=$idEquipo");

                    for($i = 1; $i <= mysqli_num_rows($jugadores); $i++) {
                        $jugador = $jugadores->fetch_array();
                        
                        $idJugador = $jugador['id'];
                        $nombre = $jugador['nombre'];
                        $apellido = $jugador['apellido'];
                        $numero = $jugador['numero'];
                        $completo = "$nombre $apellido # $numero";
                        $altura = $jugador['altura'];
                        $peso = $jugador['peso'];
                        $nacimiento = $jugador['nacimiento'];
                        $dni = $jugador['dni'];
                        $posicion = $jugador['posicion'];
                        $posicion = mysqli_query($conexion, "SELECT `puesto` FROM `posiciones` WHERE `id`=$posicion")->fetch_array()[0];
                        $partidos = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM `partidos_logs` WHERE (`equipo1`=$idEquipo OR `equipo2`=$idEquipo) AND `jugado`=1"));
                        $goles = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM `goles_logs` WHERE `jugador`=$idJugador"));

                        echo "<tr><td>$completo</td><td>$altura cm</td><td>$peso kg</td><td>$nacimiento</td><td>$dni</td><td>$posicion</td><td>$partidos</td><td>$goles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="cuerpotecnico.php?pagina=<?=$pagina?>&equipo=<?=$idEquipo?>"><button class="boton">Cuerpo Técnico</button></a>
            <?php
        } else {
            ?>
            <button class="boton">No hay equipo seleccionado</button>
            <?php
        }
        ?>
        <a href="<?=$volver?>"><button class="boton">Volver</button></a>
    </main>
</body>
</html>