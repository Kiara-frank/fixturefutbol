<?php require('etc/validardb.php') ?>
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
    <main id="index">
        <h1 class="titulo">Torneo Fútbol</h1>
        <a href="equipos.php"><button class="boton">Equipos</button></a>
        <a href="fixture.php"><button class="boton">Fixture</button></a>
        <a href="puntajes.php"><button class="boton">Puntajes</button></a>
        <form method="post"><button class="boton" type="submit" name="reiniciardb">Reiniciar DB (3 seg.)</button></form>
    </main>
</body>
</html>