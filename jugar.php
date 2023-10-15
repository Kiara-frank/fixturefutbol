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
    <main id="jugar">
        <?php
        if(!isset($_GET['primero']) || !isset($_GET['segundo'])) echo "<button class='boton'>No hay equipos seleccionados</button><a href='fixture.php'><button class='boton'>Volver</button></a>";
        else {
            $equipo1 = $_GET['primero'];
            $equipo2 = $_GET['segundo'];

            $nombreEquipo = [mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo1")->fetch_array()[0], mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo2")->fetch_array()[0]];
            $idPartido = mysqli_query($conexion, "SELECT `id` FROM `partidos_logs` WHERE `equipo1`=$equipo1 AND `equipo2`=$equipo2")->fetch_array()[0];
            $incremento = 0;

            if($idPartido == 1 || mysqli_query($conexion, "SELECT `jugado` FROM `partidos_logs` WHERE `id`=" . $idPartido - 1)->fetch_array()[0]) {
                if(!mysqli_query($conexion, "SELECT `jugado` FROM `partidos_logs` WHERE `id`=$idPartido")->fetch_array()[0]) {
                    $jugadores = mysqli_query($conexion, "SELECT * FROM `jugadores` WHERE `equipo`=$equipo1 OR `equipo`=$equipo2");
                    echo "<form class='jugarForm' action='jugarPost.php' method='POST'>";
                        for($x = 1; $x <= 2; $x++) {
                            ?>
                            <section class="jugarEquipo jugarEquipo<?=$x?>">
                                <h2><?=$nombreEquipo[$x-1]?></h2>
                                <p>(Goles)</p>
                                <?php
                                for($y = 1; $y <= 11; $y++) {
                                    $jugador = $jugadores->fetch_array();
                                    
                                    $idJugador = $jugador['id'];
                                    $nombre = $jugador['nombre'];
                                    $apellido = $jugador['apellido'];
                                    $numero = $jugador['numero'];
                                    $completo = "$nombre $apellido # $numero";

                                    $incremento++;
                                    ?>
                                    <div>
                                        <label for='jugador<?=$incremento?>'><?=$completo?></label>
                                        <input type='number' id='jugador<?=$incremento?>' name='jugador<?=$incremento?>' value='0' min='0' required>
                                    </div>
                                    <?php
                                }
                            echo "</section>";
                        }
                        ?>
                        <div class="boton--jugar">
                            <button class="boton boton--alt" type="submit">JUGAR</button>
                            <button class="boton boton--alt" type="reset">Borrar</button>
                            <a href="fixture.php"><button class="boton boton--alt" type="button">Volver</button></a>
                            <input type='number' name='equipo1' value='<?=$equipo1?>' hidden>
                            <input type='number' name='equipo2' value='<?=$equipo2?>' hidden>
                            <input type='number' name='partido' value='<?=$idPartido?>' hidden>
                        </div>
                    </form>
                    <?php
                } else echo "<button class='boton'>Este partido no se puede jugar</button><a href='fixture.php'><button class='boton'>Volver</button></a>";
            } else echo "<button class='boton'>Este partido no se puede jugar</button><a href='fixture.php'><button class='boton'>Volver</button></a>";
        }
        ?>
    </main>
</body>
</html>