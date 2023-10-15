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
    <main id="equipos">
        <h1 class="titulo">Equipos</h1>
        <?php
        $equipos = mysqli_query($conexion, "SELECT * FROM `equipos`");

        for($i = 1; $i <= mysqli_num_rows($equipos); $i++) {
            $equipo = $equipos->fetch_array();
                    
            $nombre = $equipo['nombre'];
            $direccion = $equipo['direccion'];
            $socios = $equipo['socios'];
            $presidente = $equipo['presidente'];
            $colores = $equipo['colores'];
            $historia = $equipo['historia'];
            ?>
            <section class="carta">
                <div class="carta__header">
                    <h2><?=$nombre?></h2>
                    <h3><?=$presidente?></h3>
                    <h6><?=$direccion?></h6>
                </div>
                <div class="carta__main">
                    <div class="carta__main--1">
                        <h5>Socios: <?=$socios?></h5>
                    </div>
                    <div class="carta__main--2">
                        <a href="jugadores.php?pagina=equipos&equipo=<?=$i?>"><button class="boton boton--alt">Jugadores</button></a>
                    </div>
                    <div class="carta__main--3">
                        <h5>Colores: <?=$colores?></h5>
                    </div>
                </div>
                <div class="carta__footer">
                    <p><?=$historia?></p>
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