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
    <main id="cuerpotecnico">
        <h1 class="titulo">Cuerpo Técnico</h1>
        <?php
        if(isset($_GET['equipo'])) {
            $idEquipo = $_GET['equipo'];
            $equipo = mysqli_query($conexion, "SELECT `nombre` FROM `equipos` WHERE `id`=$idEquipo")->fetch_array()[0];

            if(isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
                $volver = "jugadores.php?pagina=$pagina&equipo=$idEquipo";
            } else $volver = "index.php";

            ?>
            <table class="puntajes">
                <thead>
                    <tr><th><?=$equipo?></th><th>Nacimiento</th><th>DNI</th><th>Cargo</th></tr>
                </thead>
                <tbody>
                    <?php
                    $tecnicos = mysqli_query($conexion, "SELECT * FROM `personal` WHERE `equipo`=$idEquipo");

                    for($i = 1; $i <= mysqli_num_rows($tecnicos); $i++) {
                        $tecnico = $tecnicos->fetch_array();
                                
                        $nombre = $tecnico['nombre'];
                        $apellido = $tecnico['apellido'];
                        $completo = "$nombre $apellido";
                        $nacimiento = $tecnico['nacimiento'];
                        $dni = $tecnico['dni'];
                        $cargo = $tecnico['cargo'];
                        $cargo = mysqli_query($conexion, "SELECT `puesto` FROM `cargos` WHERE `id`=$cargo")->fetch_array()[0];

                        echo "<tr><td>$completo</td><td>$nacimiento</td><td>$dni</td><td>$cargo</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            $volver = "index.php";
            echo "<button class='boton'>No hay equipo seleccionado</button>";
        }
        ?>
        <a href="<?=$volver?>"><button class="boton">Volver</button></a>
    </main>
</body>
</html>