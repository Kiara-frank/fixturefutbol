CREATE DATABASE IF NOT EXISTS `futbol`;
USE `futbol`;

DROP DATABASE `futbol`;

CREATE DATABASE IF NOT EXISTS `futbol`;
USE `futbol`;

CREATE TABLE `cargos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `puesto` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `posiciones` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `puesto` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `equipos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `socios` int(10) UNSIGNED NOT NULL,
  `presidente` varchar(64) NOT NULL,
  `colores` varchar(64) NOT NULL,
  `historia` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `jugadores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `apellido` varchar(64) NOT NULL,
  `altura` int(10) UNSIGNED NOT NULL,
  `peso` int(10) UNSIGNED NOT NULL,
  `nacimiento` date NOT NULL,
  `dni` int(10) UNSIGNED NOT NULL,
  `equipo` int(10) UNSIGNED NOT NULL,
  `posicion` int(10) UNSIGNED NOT NULL,
  `numero` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK-Jugador-Equipo` FOREIGN KEY (`equipo`) REFERENCES `equipos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK-Jugador-Posicion` FOREIGN KEY (`posicion`) REFERENCES `posiciones` (`id`) ON UPDATE CASCADE
);

CREATE TABLE `personal` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `apellido` varchar(64) NOT NULL,
  `nacimiento` date NOT NULL,
  `dni` int(10) UNSIGNED NOT NULL,
  `equipo` int(10) UNSIGNED NOT NULL,
  `cargo` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE-Equipo-Cargo` (`equipo`,`cargo`),
  CONSTRAINT `FK-Personal-Equipo` FOREIGN KEY (`equipo`) REFERENCES `equipos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK-Personal-Cargo` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id`) ON UPDATE CASCADE
);

CREATE TABLE `partidos_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `equipo1` int(10) UNSIGNED NOT NULL,
  `equipo2` int(10) UNSIGNED NOT NULL,
  `goles1` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `goles2` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `fecha` int(10) UNSIGNED NOT NULL,
  `jugado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE-Equipos` (`equipo1`,`equipo2`),
  UNIQUE KEY `UNIQUE-Fecha1` (`equipo1`,`fecha`),
  UNIQUE KEY `UNIQUE-Fecha2` (`equipo2`,`fecha`),
  CONSTRAINT `FK-Partidos-Equipo1` FOREIGN KEY (`equipo1`) REFERENCES `equipos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK-Partidos-Equipo2` FOREIGN KEY (`equipo2`) REFERENCES `equipos` (`id`) ON UPDATE CASCADE
);

CREATE TABLE `goles_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `partido` int(10) UNSIGNED NOT NULL,
  `jugador` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `cargos` (`puesto`) VALUES
('Director técnico'),
('Preparador físico'),
('Cuerpo médico');

INSERT INTO `posiciones` (`puesto`) VALUES
('Arquero'),
('Defensor'),
('Centrocampista'),
('Delantero');

INSERT INTO `equipos` (`nombre`, `direccion`, `socios`, `presidente`, `colores`, `historia`) VALUES
('Boca Juniors', 'La Boca, Buenos Aires', 315879, 'Jorge Amor Ameal', 'Azul y Oro', 'Fundado en 1905, Boca Juniors es uno de los clubes más emblemáticos de Argentina. Conocido por su pasión y por el apodo de "Xeneizes", ha ganado numerosos títulos locales e internacionales, incluyendo la Copa Libertadores. Su estadio, La Bombonera, es un ícono del fútbol mundial.'),
('River Plate', 'Núñez, Buenos Aires', 335945, 'Jorge Brito', 'Blanco y Rojo', 'Fundado en 1901, River Plate es otro gigante del fútbol argentino. Apodado "Millonarios", ha cosechado múltiples campeonatos y es eterno rival de Boca Juniors en el "Superclásico". Su estadio, el Monumental, ha sido escenario de históricos partidos.'),
('Independiente', 'Avellaneda, Buenos Aires', 99733, 'Néstor Grindetti', 'Rojo', 'Con más de un siglo de historia desde su fundación en 1905, Independiente ha obtenido numerosos títulos locales e internacionales. Es reconocido por sus logros en la Copa Libertadores, donde ostenta varios títulos.'),
('Racing Club', 'Avellaneda, Buenos Aires', 93717, 'Víctor Blanco', 'Celeste y Blanco', 'Fundado en 1903, Racing Club es un equipo con una apasionante historia. Su triunfo en la Copa Libertadores 1967 dejó huella. Los fanáticos, conocidos como "Académicos", siguen vibrando en su estadio, el Cilindro.'),
('San Lorenzo', 'Boedo, Buenos Aires', 80410, 'Horacio Arreceygor', 'Azulgrana', 'Con raíces en 1908, San Lorenzo es el "Ciclón". Ganador de títulos nacionales e internacionales, destaca su victoria en la Copa Libertadores 2014. El equipo tiene una fuerte conexión con el barrio de Boedo.'),
('Rosario Central', 'Rosario, Santa Fe', 80215, 'Gonzalo Belloso', 'Amarillo y Azul', 'Fundado en 1889, Rosario Central es uno de los equipos más antiguos de Argentina. Si bien ha vivido altibajos, tiene una base de seguidores apasionados. Su clásico rivalidad con Newells Old Boys es famosa en Rosario.');

INSERT INTO `jugadores` (`nombre`, `apellido`, `altura`, `peso`, `nacimiento`, `dni`, `equipo`, `posicion`, `numero`) VALUES
('Sergio', 'Romero', 192, 88, '1987-02-22', 32886822, 1, 1, 1),
('Frank', 'Fabra', 174, 73, '1991-02-22', 35139858, 1, 2, 18),
('Nicolas', 'Figal', 180, 75, '1994-04-03', 37265622, 1, 2, 4),
('Bruno', 'Valdez', 181, 78, '1992-08-06', 36830587, 1, 2, 25),
('Marcelo', 'Weigandt', 175, 75, '2000-01-11', 42933871, 1, 2, 57),
('Juan', 'Ramirez', 174, 72, '1993-05-25', 36993616, 1, 3, 20),
('Alan', 'Varela', 177, 73, '2001-07-04', 42227286, 1, 3, 22),
('Guillermo', 'Fernandez', 176, 74, '1991-08-11', 35754969, 1, 3, 8),
('Sebastian', 'Villa', 179, 71, '1996-05-19', 39899800, 1, 4, 22),
('Dario', 'Benedetto', 175, 75, '1990-05-17', 33774154, 1, 4, 9),
('Oscar', 'Romero', 176, 73, '1992-07-04', 36400103, 1, 4, 10),
('Franco', 'Armani', 189, 88, '1986-10-16', 31277676, 2, 1, 1),
('Enzo', 'Diaz', 167, 78, '1995-12-07', 38648626, 2, 2, 13),
('Paulo', 'Diaz', 178, 76, '1994-08-25', 37702724, 2, 2, 17),
('Leandro', 'Gonzalez', 185, 89, '1992-02-26', 36451574, 2, 2, 14),
('Milton', 'Casco', 170, 69, '1988-04-11', 33286570, 2, 2, 20),
('Enzo', 'Perez', 178, 77, '1986-02-22', 31292092, 2, 3, 24),
('Rodrigo', 'Aliendro', 173, 72, '1991-02-16', 35421891, 2, 3, 29),
('Esequiel', 'Barco', 167, 66, '1999-03-29', 41360404, 2, 3, 21),
('Ignacio', 'Fernandez', 182, 67, '1990-01-12', 33274064, 2, 3, 26),
('Pablo', 'Solari', 178, 78, '2001-03-22', 42279145, 2, 4, 36),
('Miguel', 'Borja', 184, 89, '1993-01-26', 36827422, 2, 4, 9),
('Rodrigo', 'Rey', 190, 78, '1991-03-08', 35593098, 3, 1, 33),
('Ayrton', 'Costa', 179, 74, '1999-07-12', 41586845, 3, 2, 79),
('Cristian', 'Baez', 180, 84, '1990-04-09', 33810915, 3, 2, 13),
('Sergio', 'Barreto', 184, 74, '1999-04-20', 41290834, 3, 2, 2),
('Luciano', 'Gomez', 164, 66, '1996-03-22', 39298807, 3, 2, 19),
('Sergio', 'Ortiz', 173, 77, '2001-02-23', 42506093, 3, 3, 28),
('Ivan', 'Marcone', 183, 90, '1990-06-03', 33115415, 3, 3, 23),
('Nicolas', 'Vallejo', 170, 69, '2004-01-03', 45619573, 3, 4, 21),
('Braian', 'Martinez', 160, 75, '1999-08-18', 41571927, 3, 4, 29),
('Martin', 'Cauteruccio', 179, 76, '1987-04-14', 32787349, 3, 4, 7),
('Matias', 'Gimenez', 185, 76, '1999-03-06', 41911813, 3, 4, 34),
('Gabriel', 'Arias', 189, 84, '1987-09-13', 32737870, 4, 1, 21),
('Gabriel', 'Rojas', 173, 70, '1997-06-22', 39827512, 4, 2, 3),
('Gonzalo', 'Piovi', 180, 72, '1994-09-08', 37769631, 4, 2, 33),
('Leonardo', 'Sigali', 181, 72, '1987-05-29', 32275943, 4, 2, 30),
('Facundo', 'Mura', 170, 71, '1999-03-24', 41971526, 4, 2, 34),
('Jonathan', 'Gomez', 171, 71, '1989-12-21', 33760744, 4, 3, 11),
('Anibal', 'Moreno', 177, 73, '1999-05-13', 41881357, 4, 3, 29),
('Juan', 'Nardoni', 180, 82, '2002-07-14', 43170554, 4, 3, 5),
('Matias', 'Rojas', 180, 78, '1995-11-03', 38928516, 4, 3, 18),
('Gabriel', 'Hauche', 169, 71, '1986-11-27', 31860686, 4, 4, 7),
('Maximiliano', 'Romero', 180, 76, '1999-01-09', 41264909, 4, 4, 15),
('Augusto', 'Batalla', 185, 87, '1996-04-30', 39632166, 5, 1, 13),
('Gaston', 'Hernandez', 185, 83, '1998-01-19', 40291052, 5, 2, 23),
('Federico', 'Gattoni', 183, 79, '1999-02-16', 41642030, 5, 2, 6),
('Rafael', 'Perez', 186, 82, '1990-01-09', 33657905, 5, 2, 2),
('Carlos', 'Sanchez', 182, 80, '1986-02-06', 31871680, 5, 3, 6),
('Jalil', 'Elias', 175, 70, '1996-04-25', 39156671, 5, 3, 5),
('Agustin', 'Giay', 180, 73, '2004-01-16', 45710292, 5, 3, 47),
('Malcom', 'Braida', 175, 77, '1997-05-17', 39947765, 5, 4, 21),
('Nahuel', 'Barrios', 156, 61, '1998-05-07', 40193319, 5, 4, 10),
('Ivan', 'Leguizamon', 175, 73, '2002-07-03', 43120050, 5, 4, 41),
('Adam', 'Bareiro', 184, 84, '1996-07-26', 39616645, 5, 4, 11),
('Jorge', 'Broun', 190, 90, '1986-05-26', 31019172, 6, 1, 1),
('Carlos', 'Quintana', 191, 88, '1988-02-11', 33874901, 6, 2, 2),
('Facundo', 'Mallo', 186, 81, '1995-01-16', 38651565, 6, 2, 15),
('Damian', 'Martinez', 177, 65, '1990-01-31', 33184670, 6, 2, 4),
('Alan', 'Rodriguez', 172, 72, '2000-08-15', 42914858, 6, 3, 16),
('Kevin', 'Ortiz', 170, 70, '2000-09-18', 42660575, 6, 3, 45),
('Francis', 'Mac Allister', 176, 71, '1995-11-30', 38709355, 6, 3, 5),
('Jaminton', 'Campaz', 165, 69, '2000-05-24', 42504015, 6, 3, 13),
('Ignacio', 'Malcorra', 170, 70, '1987-07-24', 32808765, 6, 3, 10),
('Lautaro', 'Giaccone', 172, 70, '2001-02-01', 42326464, 6, 3, 22),
('Alejo', 'Veliz', 187, 77, '2003-09-19', 44532200, 6, 4, 24);

INSERT INTO `personal` (`nombre`, `apellido`, `nacimiento`, `dni`, `equipo`, `cargo`) VALUES
('Jorge', 'Almiron', '1971-06-19', 27804298, 1, 1),
('Alejandro', 'Blasco', '1981-02-21', 29447600, 1, 2),
('Ruben', 'Argemi', '1976-05-25', 28990609, 1, 3),
('Martin', 'Demichelis', '1980-12-20', 28360622, 2, 1),
('Flavio', 'Perez', '1964-12-14', 26454508, 2, 2),
('Pedro', 'Hansing', '1984-05-03', 29572968, 2, 3),
('Carlos', 'Tevez', '1984-02-05', 29366228, 3, 1),
('Martin', 'Traversi', '1985-02-08', 29738223, 3, 2),
('Daniel', 'Martins', '1988-07-08', 30245921, 3, 3),
('Fernando', 'Gago', '1986-04-10', 29820048, 4, 1),
('Roberto', 'Luzzi', '1974-11-27', 28265213, 4, 2),
('Alejandro', 'Dardano', '1967-04-25', 26298406, 4, 3),
('Ruben', 'Insua', '1961-04-17', 25829699, 5, 1),
('Bruno', 'Militano', '1975-08-29', 28893597, 5, 2),
('Fernando', 'de Alzaa', '1977-09-17', 28621076, 5, 3),
('Miguel', 'Russo', '1956-04-09', 25925835, 6, 1),
('Miguel', 'Quiroga', '1966-05-25', 26601203, 6, 2),
('Hernán', 'Giuria', '1983-06-18', 29678009, 6, 3);

INSERT INTO `partidos_logs` (`equipo1`, `equipo2`, `fecha`) VALUES
(1, 2, 1),
(3, 4, 1),
(5, 6, 1),
(4, 1, 2),
(2, 5, 2),
(6, 3, 2),
(2, 6, 3),
(1, 3, 3),
(4, 5, 3),
(6, 4, 4),
(5, 1, 4),
(3, 2, 4),
(3, 5, 5),
(4, 2, 5),
(1, 6, 5);