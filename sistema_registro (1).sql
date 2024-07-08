-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2024 a las 02:52:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `costo`, `fecha`, `hora_inicio`, `hora_fin`) VALUES
(1, 'NODE JS', 20.00, '2024-06-24', '10:00:00', '12:00:00'),
(2, 'Python', 20.00, '2024-06-24', '14:00:00', '16:00:00'),
(3, 'Flutter', 20.00, '2024-06-22', '10:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `fecha_inscripcion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `usuario_id`, `actividad_id`, `fecha_inscripcion`) VALUES
(1, 4, 1, '2024-06-23 18:43:09'),
(3, 6, 2, '2024-06-23 19:21:23'),
(4, 6, 2, '2024-06-23 19:22:18'),
(5, 6, 2, '2024-06-23 19:22:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`, `usuario`, `contraseña`, `telefono`) VALUES
(1, 'bbbbbb', 'bbbbbb', 'bbbbbb', 'aasdfdf@asdf.com', 'bbbbbb.bbbbbb', '$2y$10$28qWl16StH6FDWQFQhEGMeWZn8Lz/8hbkj2BEar/6.GRbNejsseYC', '123123123'),
(2, 'werwe', 'werwe', 'werwer', 'wer@werw.com', 'werwe.werwe', '$2y$10$7RqacoX3SlEbtXl.53O.F.iM3k7UxmngHvHBUI3kupM8r7KMD9ry6', '1232332'),
(3, 'aaaaaa', 'aaaaaa', 'aaaaaa', 'aaaaaa@aaaaaa.com', 'aaaaaa.aaaaaa', '$2y$10$ZWO.lkN8H31E3lzUWkdJx.Az.S2mbn8u8YfRQIwq3NjiRlwHsKCli', '000000000'),
(4, 'a', 'a', 'a', 'aaaaaaa@aaaaaa.com', 'a.a', '$2y$10$Kpf9v9KZqCo3GcYEJkzEqOEQf6xhBqicjf.nuudEEAc2zm42rZrWS', '000000'),
(5, 'luis miguel', 'apaza ', 'flores', 'luismiguel@gmail.com', 'luis miguel.apaza ', '$2y$10$RwyYrzPcmHJyq8flC25kquwmFOs3cEynxRN0m8lqg4JBzeD4MdDDG', '22200022'),
(6, 'luis miguel', 'apaza', 'quispe', 'wera@werw.com', 'luis.apaza', '$2y$10$8Io7kfiMMNWVFPPr/7yumOyNYRYs6FIbVcOkzK/UImT7orODPZvz2', '22200002'),
(7, 'leonel', 'ramos', 'huayhua', 'hola@gmial.com', 'leonel.ramos', '$2y$10$XdaFFi0kmZ1xPQwDkNAjWu/SCUSX2yBpTxOLwKRENKvb88lPU5LoG', '22222222');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `actividad_id` (`actividad_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`actividad_id`) REFERENCES `actividades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
