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
    <main id="fixture">
        <h1 class="titulo">Fixture</h1>
        <?php
        $todosPartidos = mysqli_query($conexion, "SELECT * FROM `partidos_logs`");
        $cantPartidos = mysqli_num_rows($todosPartidos);
        $ultimaFecha = mysqli_query($conexion, "SELECT `fecha` FROM `partidos_logs` WHERE `id`=$cantPartidos")->fetch_array()[0];

        for($x = 1; $x <= $ultimaFecha; $x++) {
            ?>
            <section class="carta">
                <div class="carta__header">
                    <h2>Fecha <?=$x?></h2>
                </div>
                <div class="carta__main carta__main--fixture">
                    <?php
                    $partidos = mysqli_query($conexion, "SELECT * FROM `partidos_logs` WHERE `fecha`=$x");
                    for($y = 1; $y <= mysqli_num_rows($partidos); $y++) {
                        $partido = $partidos->fetch_array();
                                
                        $idPartido = $partido['id'];
                        $equipo1 = $partido['equipo1'];
                        $equipo2 = $partido['equipo2'];
                        $nombreEquipo1 = mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo1")->fetch_array()[0];
                        $nombreEquipo2 = mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$equipo2")->fetch_array()[0];
                        $goles1 = $partido['goles1'];
                        $goles2 = $partido['goles2'];
                        $jugado = $partido['jugado'];

                        $jugar = "<a href='jugar.php?primero=$equipo1&segundo=$equipo2'><button class='boton boton--alt'>Jugar</button></a>";

                        echo "<div class='carta__main--partido'><div><h2>$nombreEquipo1</h2></div>";
                        
                        if($jugado) echo "<a href='resultado.php?partido=$idPartido'><button class='boton boton--alt'>$goles1 - $goles2</button></a>";
                        else if($x == 1 && $y == 1) echo $jugar;
                        else if(mysqli_query($conexion, "SELECT `jugado` FROM `partidos_logs` WHERE `id`=" . $idPartido - 1)->fetch_array()[0]) echo $jugar;
                        else echo "<button class='boton boton--alt boton--disabled' disabled>Jugar</button>";
                        
                        echo "<div><h2>$nombreEquipo2</h2></div></div>";
                    }
                    ?>
                </div>
            </section>
            <?php
        }
        ?>
        <div>
            <a href="index.php"><button class="boton">Volver</button></a>
        </div>
    </main>
</body>
</html>