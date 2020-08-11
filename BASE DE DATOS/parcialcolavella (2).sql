-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2020 a las 19:36:24
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcialcolavella`
--
CREATE DATABASE IF NOT EXISTS `parcialcolavella` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `parcialcolavella`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `numero_documento` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `mail` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `id_tipo_documento`, `numero_documento`, `nombre`, `apellido`, `domicilio`, `fecha_nacimiento`, `mail`) VALUES
(42, 1, 22424, '2424', '24242', 'eqeqeqe', '2020-08-14', 'uihdud@hus.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`) VALUES
(1, 'ADMINISTRADOR'),
(10, 'ESPECTADOR'),
(14, 'gdgdg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_permisos`
--

DROP TABLE IF EXISTS `grupos_permisos`;
CREATE TABLE `grupos_permisos` (
  `id_grupo` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos_permisos`
--

INSERT INTO `grupos_permisos` (`id_grupo`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(14, 5),
(14, 6),
(14, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_usuarios`
--

DROP TABLE IF EXISTS `grupos_usuarios`;
CREATE TABLE `grupos_usuarios` (
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`id_grupo`, `id_usuario`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `legajos`
--

DROP TABLE IF EXISTS `legajos`;
CREATE TABLE `legajos` (
  `legajo` varchar(100) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
  `id_pelicula` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `genero` varchar(250) NOT NULL,
  `duracion` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `puntaje` float NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `anio` int(5) DEFAULT NULL,
  `pelicula` varchar(250) DEFAULT NULL,
  `trailer` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`id_pelicula`, `titulo`, `genero`, `duracion`, `descripcion`, `puntaje`, `imagen`, `anio`, `pelicula`, `trailer`) VALUES
(2, 'Harry Potter y la Piedra Filosofal', ' Fantasia Drama Aventura', '152', 'Un niÃ±o huÃ©rfano se matricula en una escuela de hechicerÃ­a, donde descubre la verdad sobre sÃ­ mismo, su familia y el terrible mal que atormenta al mundo mÃ¡gico', 7.6, 'https://m.media-amazon.com/images/M/MV5BNjQ3NWNlNmQtMTE5ZS00MDdmLTlkZjUtZTBlM2UxMGFiMTU3XkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_UX182_CR0,0,182,268_AL_.jpg', 2001, 'https://gounlimited.to/embed-2mz1n954sate.html', 'WE4AJuIvG1Y'),
(16, 'Harry Potter y la cÃ¡mara secreta', ' Fantasia Drama Aventura', '161', 'Una antigua profecÃ­a parece hacerse realidad cuando una presencia misteriosa comienza a acechar los pasillos de una escuela de magia y deja a sus vÃ­ctimas paralizadas', 7.4, 'https://m.media-amazon.com/images/M/MV5BMTcxODgwMDkxNV5BMl5BanBnXkFtZTYwMDk2MDg3._V1_UX182_CR0,0,182,268_AL_.jpg', 2002, 'https://gounlimited.to/embed-tj1j7m2i7d8s.html', 'C8CL5TbiFwY'),
(17, 'Harry Potter y el prisionero de Azkaban', ' Fantasia Drama Aventura', '142', 'Harry Potter, Ron y Hermione regresan a la Escuela de BrujerÃ­a y HechicerÃ­a de Hogwarts para su tercer aÃ±o de estudio, donde profundizan en el misterio que rodea a un prisionero fugitivo que representa una amenaza peligrosa para el joven mago', 7.9, 'https://m.media-amazon.com/images/M/MV5BMTY4NTIwODg0N15BMl5BanBnXkFtZTcwOTc0MjEzMw@@._V1_UX182_CR0,0,182,268_AL_.jpg', 2004, 'https://gounlimited.to/embed-bjyi0c1kgkvu.html', 'Iv3gTEE3NMY'),
(19, 'Harry Potter y la orden del FÃ©nix', ' Fantasia Drama Aventura', '138', 'Con su advertencia sobre el regreso de Lord Voldemort (Ralph Fiennes) burlado, Harry (Daniel Radcliffe) y Dumbledore (Sir Michael Gambon) son atacados por las autoridades del Mago mientras un burÃ³crata autoritario toma lentamente el poder en Hogwart', 7.5, 'https://m.media-amazon.com/images/M/MV5BMTM0NTczMTUzOV5BMl5BanBnXkFtZTYwMzIxNTg3._V1_UX182_CR0,0,182,268_AL_.jpg', 2007, 'Harry Potter y la orden del FÃ©nix', 'gh8eOzf_fos'),
(20, 'Harry Potter y el misterio del prÃ­ncipe', ' Fantasia Drama Aventura', '153', 'Cuando Harry Potter (Daniel Radcliffe) comienza su sexto aÃ±o en Hogwarts, descubre un viejo libro marcado como \"propiedad del PrÃ­ncipe Mestizo\" y comienza a aprender mÃ¡s sobre el oscuro pasado de Lord Voldemort (Ralph Fiennes)', 7.6, 'https://m.media-amazon.com/images/M/MV5BNzU3NDg4NTAyNV5BMl5BanBnXkFtZTcwOTg2ODg1Mg@@._V1_UX182_CR0,0,182,268_AL_.jpg', 2009, 'https://gounlimited.to/embed-cwfl7x2zcpyw.html', 'ST_FLbmyrlY'),
(21, 'Harry Potter y las reliquias de la muerte - Parte 1', ' Fantasia Drama Aventura', '146', 'Mientras Harry (Daniel Radcliffe), Ron (Rupert Grint) y Hermione (Emma Watson) compiten contra el tiempo y el mal para destruir los Horrocruxes, descubren la existencia de los tres objetos mÃ¡s poderosos del mundo mÃ¡gico: las Reliquias de la Muerte', 7.7, 'https://m.media-amazon.com/images/M/MV5BMTQ2OTE1Mjk0N15BMl5BanBnXkFtZTcwODE3MDAwNA@@._V1_UX182_CR0,0,182,268_AL_.jpg', 2010, 'https://gounlimited.to/embed-78w4ioeto5lh.html', '5T0xco4iM5E'),
(22, 'Harry Potter y las reliquias de la muerte - Parte 2', ' Fantasia Drama Aventura', '130', 'Harry, Ron y Hermione buscan los Horrocruxes restantes de Voldemort en su esfuerzo por destruir al SeÃ±or Oscuro mientras la batalla final continÃºa en Hogwarts.', 8.1, 'https://m.media-amazon.com/images/M/MV5BMjIyZGU4YzUtNDkzYi00ZDRhLTljYzctYTMxMDQ4M2E0Y2YxXkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_UX182_CR0,0,182,268_AL_.jpg', 2011, 'https://gounlimited.to/embed-d0ul657jmcmu.html', 'I8KCaGH780w'),
(23, 'Animales fantÃ¡sticos y dÃ³nde encontrarlos', ' Fantasia Aventura', '132', 'Las aventuras del escritor Newt Scamander en la comunidad secreta de brujas y magos de Nueva York setenta aÃ±os antes de que Harry Potter lea su libro en la escuela', 7.3, 'https://m.media-amazon.com/images/M/MV5BMjMxOTM1OTI4MV5BMl5BanBnXkFtZTgwODE5OTYxMDI@._V1_UX182_CR0,0,182,268_AL_.jpg', 2016, 'https://gounlimited.to/embed-8qfxon8ix7et.html', 'US2LnWrrCq4'),
(24, 'Animales fantÃ¡sticos: los crÃ­menes de Grindelwald', ' Fantasia Drama Aventura', '134', 'La segunda entrega de la serie ', 6.6, 'https://m.media-amazon.com/images/M/MV5BYWVlMDI5N2UtZTIyMC00NjZkLWI5Y2QtODM5NGE5MzA0NmVjXkEyXkFqcGdeQXVyNzU3NjUxMzE@._V1_UX182_CR0,0,182,268_AL_.jpg', 2018, 'https://gounlimited.to/embed-s9s9399q6a61.html', 'lqy4ZUTsJBk'),
(28, 'El hoyo', ' Terror SCI-FI', '94', 'Una prisiÃ³n vertical con una celda por nivel. Dos personas por celda. Una sola plataforma de alimentos y dos minutos por dÃ­a para alimentar de arriba a abajo. Una pesadilla interminable atrapada en The Hole', 7, 'https://m.media-amazon.com/images/M/MV5BOTMyYTIyM2MtNjQ2ZC00MWFkLThhYjQtMjhjMGZiMjgwYjM2XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_UX182_CR0,0,182,268_AL_.jpg', 2019, 'https://gounlimited.to/embed-jviacmazermy.html', 'Oyuomep8Ac4'),
(29, 'IT CÃ¡pitulo 2', ' Terror Crimen', '169', 'Veintisiete aÃ±os despuÃ©s de su primer encuentro con el aterrador Pennywise, el Club de Perdedores creciÃ³ y se alejÃ³, hasta que una llamada telefÃ³nica devastadora los trajo de vuelta', 6.6, 'https://m.media-amazon.com/images/M/MV5BYTJlNjlkZTktNjEwOS00NzI5LTlkNDAtZmEwZDFmYmM2MjU2XkEyXkFqcGdeQXVyNjg2NjQwMDQ@._V1_UX182_CR0,0,182,268_AL_.jpg', 2019, 'https://gounlimited.to/embed-e3fdddthk4yk.html', 'o1sQbtZpsic'),
(37, 'Capitan America: Civil War', ' accion SCI-FI Aventura', '147', 'La participaciÃ³n polÃ­tica en los asuntos de los Vengadores causa una brecha entre el CapitÃ¡n AmÃ©rica y Iron Man', 7.8, 'https://m.media-amazon.com/images/M/MV5BMjQ0MTgyNjAxMV5BMl5BanBnXkFtZTgwNjUzMDkyODE@._V1_UY190_CR0,0,128,190_AL_.jpg', 2016, 'https://gounlimited.to/embed-fd6jcen3tu2s.html', '-ByYxIjmLsI'),
(38, 'Los Vengadores: La era de Ultron', ' Fantasia accion SCI-FI Aventura', '141', 'Cuando Tony Stark y Bruce Banner intentan poner en marcha un programa inactivo de mantenimiento de la paz llamado Ultron, las cosas van terriblemente mal y depende de los hÃ©roes mÃ¡s poderosos de la Tierra evitar que el villano Ultron ejecute su ter', 7.3, 'https://m.media-amazon.com/images/M/MV5BMTM4OGJmNWMtOTM4Ni00NTE3LTg3MDItZmQxYjc4N2JhNmUxXkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_UX182_CR0,0,182,268_AL_.jpg', 2015, 'https://gounlimited.to/embed-h96ylczc9qnz.html', 'DMFBm_lp4rU'),
(40, 'CapitÃ¡n AmÃ©rica: El Soldado del Invierno', ' Fantasia accion SCI-FI Aventura', '136', 'Mientras Steve Rogers lucha por asumir su papel en el mundo moderno, se une a un compaÃ±ero de Avenger y agente de S.H.I.E.L.D, Black Widow, para luchar contra una nueva amenaza de la historia: un asesino conocido como el Soldado de Invierno', 7.7, 'https://m.media-amazon.com/images/M/MV5BMzA2NDkwODAwM15BMl5BanBnXkFtZTgwODk5MTgzMTE@._V1_UY268_CR1,0,182,268_AL_.jpg', 2014, 'https://gounlimited.to/embed-92b6yvuu55fu.html', 'jrOPZNAsQfI'),
(41, 'CapitÃ¡n AmÃ©rica: El primer vengador', ' Fantasia accion SCI-FI Aventura', '124', 'Steve Rogers, un soldado militar rechazado, se transforma en el CapitÃ¡n AmÃ©rica despuÃ©s de tomar una dosis de un ', 6.9, 'https://m.media-amazon.com/images/M/MV5BMTYzOTc2NzU3N15BMl5BanBnXkFtZTcwNjY3MDE3NQ@@._V1_UX182_CR0,0,182,268_AL_.jpg', 2011, 'https://gounlimited.to/embed-o6i723vztf6u.html', '8-gP9CkRpCA'),
(77, 'Yummy', ' Terror accion Comedia', '88', 'Una joven pareja viaja al Europa del Este para realizar una cirugÃ­a plÃ¡stica. La mujer desea una reducciÃ³n de pecho, mientras que su madre, que acompaÃ±a a ambos jÃ³venes, anhela un estiramiento facial. En un momento del viaje, mientras el novio estÃ¡ dando un paseo por una zona abandonada del hospital, descubre accidentalmente a una mujer atada y amordazada a una mesa de operaciones.\r\n\r\nAl parecer, ha sido vÃ­ctima de un tratamiento experimental de rejuvenecimiento. El chico la salva, liberando inconscientemente un virus que convertirÃ¡ a doctores, pacientes y a su suegra en zombies sedientos de sangre.', 6, 'https://m.media-amazon.com/images/M/MV5BYjZkMjE3NjgtZGRjOS00YzIxLTkyZmMtNGZhNThlOTZiODc5XkEyXkFqcGdeQXVyMTIyNDQxMTE@._V1_UY268_CR3,0,182,268_AL_.jpg', 2019, 'https://gounlimited.to/embed-pp9wf61kxjxd.html', 'HU1ZZLCytQE'),
(79, 'DeberÃ­as haberte ido', ' Terror Drama', '93', 'David Kehlman es un escritor que espera poder redactar el guion de una pelÃ­cula para volver a lanzar su carrera. Para ello, David se traslada, junto a su mujer y su hija, a una casa que la familia alquila en las montaÃ±as de Alemania.\r\n\r\nSin embargo, algo en el inmueble no parece ir del todo bien. La estancia promete cambiar para siempre a una familia que debe enfrentarse a unos eventos inexplicables y, sobre todo, al aparente cambio que estÃ¡ sufriendo David.', 5.3, 'https://m.media-amazon.com/images/M/MV5BYTMxMTJhNWQtYzQwMC00MThhLTkzNjMtMDljMGE1MmE1NWM2XkEyXkFqcGdeQXVyODkxMzcxOTY@._V1_UX182_CR0,0,182,268_AL_.jpg', 2020, 'https://gounlimited.to/embed-lv00t3bi0xyv.html', 'Rf58fKNRyIA'),
(81, 'fsfsf', ' Drama SCI-FI', '2332', 'etete', 2, 'ettet', 232, 'etet', 'etet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre_permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre_permiso`) VALUES
(1, 'alta usuario'),
(2, 'baja usuario'),
(3, 'modificar usuario'),
(4, 'buscar usuario'),
(5, 'alta pelicula'),
(6, 'baja pelicula'),
(7, 'modificar pelicula'),
(8, 'asignar permisos'),
(9, 'solicitudes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

DROP TABLE IF EXISTS `tipos_documentos`;
CREATE TABLE `tipos_documentos` (
  `id_tipo_documento` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`id_tipo_documento`, `descripcion`) VALUES
(1, 'DNI'),
(2, 'PASAPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `mail` varchar(100) NOT NULL,
  `contr` varchar(100) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `mail`, `contr`, `token`) VALUES
(1, 'tuspeliscf', 'tuspelisfc@gmail.com', 'fa813a90024da3dd40d7b47309a8ff3ab11bf652', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_movies`
--

DROP TABLE IF EXISTS `usuarios_movies`;
CREATE TABLE `usuarios_movies` (
  `id_usuario` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_movies`
--

INSERT INTO `usuarios_movies` (`id_usuario`, `id_pelicula`) VALUES
(1, 23),
(1, 21),
(1, 79),
(1, 38),
(1, 29);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_permisos`
--
ALTER TABLE `grupos_permisos`
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `legajos`
--
ALTER TABLE `legajos`
  ADD PRIMARY KEY (`legajo`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarios_movies`
--
ALTER TABLE `usuarios_movies`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `movies`
--
ALTER TABLE `movies`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documentos` (`id_tipo_documento`);

--
-- Filtros para la tabla `grupos_permisos`
--
ALTER TABLE `grupos_permisos`
  ADD CONSTRAINT `grupos_permisos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `grupos_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);

--
-- Filtros para la tabla `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  ADD CONSTRAINT `grupos_usuarios_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `grupos_usuarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `legajos`
--
ALTER TABLE `legajos`
  ADD CONSTRAINT `legajos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `usuarios_movies`
--
ALTER TABLE `usuarios_movies`
  ADD CONSTRAINT `usuarios_movies_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuarios_movies_ibfk_2` FOREIGN KEY (`id_pelicula`) REFERENCES `movies` (`id_pelicula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
