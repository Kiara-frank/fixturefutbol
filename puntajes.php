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
    <main id="puntajes">
        <h1 class="titulo">Puntajes</h1>
        <table class="puntajes">
            <thead>
                <tr><th>EQUIPO</th><th>PTS</th><th>PJ</th><th>PG</th><th>PP</th><th>PE</th><th>GM</th><th>GC</th></tr>
            </thead>
            <tbody>
            <?php
                $equipos = mysqli_query($conexion, "SELECT * FROM `equipos`");

                for($i = 1; $i <= mysqli_num_rows($equipos); $i++) {
                    $equipo = $equipos->fetch_array();
                    
                    $id = $equipo['id'];
                    $nombre = $equipo['nombre'];

                    $partidos = mysqli_query($conexion, "SELECT * FROM `partidos_logs` WHERE (`equipo1`=$id OR `equipo2`=$id) AND `jugado`='1'");

                    $pj = mysqli_num_rows($partidos);
                    $pg = 0;
                    $pp = 0;
                    $pe = 0;
                    $gm = 0;
                    $gc = 0;

                    for($x = 1; $x <= mysqli_num_rows($partidos); $x++) {
                        $partido = $partidos->fetch_array();

                        $goles1 = $partido['goles1'];
                        $goles2 = $partido['goles2'];

                        if($partido['equipo1'] == $id) {
                            if($goles1 > $goles2) $pg++;
                            else if($goles1 < $goles2) $pp++;
                            else $pe++;
                            $gm += $goles1;
                            $gc += $goles2;
                        } else {
                            if($goles1 < $goles2) $pg++;
                            else if($goles1 > $goles2) $pp++;
                            else $pe++;
                            $gm += $goles2;
                            $gc += $goles1;
                        }
                    }
                    $pts = ($pg * 3) + ($pe * 1) - ($pp * 0);

                    echo "<tr><td><a class='link' href='jugadores.php?pagina=puntajes&equipo=$i'>$nombre</a></td><td>$pts</td><td>$pj</td><td>$pg</td><td>$pp</td><td>$pe</td><td>$gm</td><td>$gc</td></tr>";
                }
            ?>
            </tbody>
        </table>
        <a href="index.php"><button class="boton">Volver</button></a>
    </main>
</body>
</html>