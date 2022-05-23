-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2022 a las 07:42:52
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productbacklog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_actividad`
--

CREATE TABLE `t_actividad` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `horas` double NOT NULL,
  `id_usu` int(11) NOT NULL,
  `id_pbi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_actividad`
--

INSERT INTO `t_actividad` (`codigo`, `descripcion`, `fecha`, `horas`, `id_usu`, `id_pbi`) VALUES
(1, 'asdasd asda sdasd hfdkln', '2022-05-25', 1.5, 9, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_historia`
--

CREATE TABLE `t_historia` (
  `codigo` int(11) NOT NULL,
  `identificador` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_historia`
--

INSERT INTO `t_historia` (`codigo`, `identificador`, `descripcion`) VALUES
(1, 'HU-1', 'Prueba historia'),
(31, 'HU-2', 'Como cliente quiero tener un sistema de logueo para poder tener mayor seguridad con mi informaciÃ³n.'),
(32, 'HU-3', 'Historia usuario prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_opcion`
--

CREATE TABLE `t_opcion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `menu` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `href` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `visible` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `orden` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_opcion`
--

INSERT INTO `t_opcion` (`codigo`, `nombre`, `descripcion`, `menu`, `href`, `visible`, `orden`) VALUES
(1, 'Iniciar sesión', '', 'S', '#', 'N', 1),
(2, 'Cerrar sesión', '', 'S', '/ProductBacklog/Main/logout', 'S', 10),
(3, 'Mi perfil', '', 'S', '/ProductBacklog/Profile/', 'S', 2),
(4, 'Crear usuario', '', 'N', '/ProductBacklog/Signin/', 'S', 3),
(5, 'Actualizar contraseña', '', 'S', '/ProductBacklog/Password/', 'S', 4),
(6, 'Crear historia de usuario', '', 'N', '/ProductBacklog/UserHistory/', 'S', 1),
(7, 'Crear PBI (Product Backlog Item)', '', 'N', '/ProductBacklog/Pbi/', 'S', 2),
(8, 'Crear Sprint', '', 'N', '/ProductBacklog/Sprint/', 'S', 3),
(9, 'Consultar product backlog', '', 'N', '/ProductBacklog/Consult/ConsultPBI', 'S', 5),
(10, 'Consultar historias de usuario', '', 'N', '/ProductBacklog/Consult/ConsultHU', 'S', 4),
(11, 'Consultar Sprints', '', 'N', '/ProductBacklog/Consult/ConsultSPR', 'S', 6),
(12, 'Registrar Actividad', '', 'N', '/ProductBacklog/Activity/', 'S', 7),
(13, 'Consultar Actividad', '', 'N', '/ProductBacklog/Consult/ConsultActivity', 'S', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_opcion_tipo_usu`
--

CREATE TABLE `t_opcion_tipo_usu` (
  `codigo` int(11) NOT NULL,
  `tiu_codigo` int(11) NOT NULL,
  `opc_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_opcion_tipo_usu`
--

INSERT INTO `t_opcion_tipo_usu` (`codigo`, `tiu_codigo`, `opc_codigo`) VALUES
(13, 1, 2),
(14, 1, 4),
(15, 1, 5),
(16, 1, 3),
(17, 2, 5),
(18, 2, 2),
(19, 2, 3),
(20, 2, 6),
(21, 2, 7),
(22, 2, 8),
(23, 2, 9),
(25, 2, 10),
(26, 2, 11),
(27, 3, 2),
(28, 3, 10),
(29, 3, 9),
(30, 3, 11),
(31, 3, 3),
(32, 3, 5),
(33, 3, 12),
(34, 3, 13),
(35, 2, 12),
(36, 2, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pbi`
--

CREATE TABLE `t_pbi` (
  `codigo` int(11) NOT NULL,
  `identificador` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `valor_negocio` int(3) NOT NULL,
  `esfuerzo` int(11) NOT NULL,
  `spr_codigo` int(11) NOT NULL,
  `hiu_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_pbi`
--

INSERT INTO `t_pbi` (`codigo`, `identificador`, `estado`, `descripcion`, `valor_negocio`, `esfuerzo`, `spr_codigo`, `hiu_codigo`) VALUES
(6, 'PBI-1', 'Nuevo', 'Prueba PBI', 100, 30, 1, 1),
(16, 'PBI-2', 'En Proceso', 'Desarrollar una pantalla de registro de usuario.', 150, 10, 2, 31),
(17, 'PBI-3', 'En Proceso', 'Desarrollar una pantalla de inicio de sesiÃ³n.', 90, 20, 9, 31),
(19, 'PBI-4', 'En Proceso', 'Product Backlog item Prueba asdasd', 350, 20, 9, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_sprint`
--

CREATE TABLE `t_sprint` (
  `codigo` int(11) NOT NULL,
  `identificador` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `duracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_sprint`
--

INSERT INTO `t_sprint` (`codigo`, `identificador`, `descripcion`, `duracion`) VALUES
(1, '0', '0', 0),
(2, 'SPR-1', 'Prueba Sprint', 110),
(9, 'SPR-2', 'Primer Commit a desarrollo', 200),
(10, 'SPR-3', 'CreaciÃ³n sprint prueba', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_usuario`
--

CREATE TABLE `t_tipo_usuario` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_tipo_usuario`
--

INSERT INTO `t_tipo_usuario` (`codigo`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Encargado de las generalidades del sistema'),
(2, 'Product Owner', 'Encargado del Product Backlog'),
(3, 'Desarrollador', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuario`
--

CREATE TABLE `t_usuario` (
  `codigo` int(11) NOT NULL,
  `tipo_identificacion` varchar(2) COLLATE utf8_spanish2_ci NOT NULL,
  `identificacion` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_1` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_2` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_celular` int(10) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tiu_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `t_usuario`
--

INSERT INTO `t_usuario` (`codigo`, `tipo_identificacion`, `identificacion`, `nombre`, `apellido_1`, `apellido_2`, `email`, `password`, `sexo`, `telefono_celular`, `fecha_nacimiento`, `tiu_codigo`) VALUES
(1, 'CC', 0, 'ADMINISTRADOR', '', '', 'admin@gmail.com', '$2y$10$eGgsmXR2kiTpfBRd9FYnY.fiGUOi96SdMtWo6DB3tTFPCxJUPKqa6', 'M', 0, '0000-00-00', 1),
(9, 'CC', 1003810932, 'Pedro', 'Vargas', '', 'pjvargas1296@gmail.com', '$2y$10$Cx.EjwjhlnTrRUUTfJseReGTml0ZlOY2fESUX6zxgq46.QfrcKBTe', 'M', 2147483647, '1996-08-21', 2),
(10, 'CC', 12312312, 'JuliÃ¡n', 'Vargas', '', 'julian@gmail.com', '$2y$10$y1jqEdLNBb9.Y.6LtbPClem5JmEuX.NEx0/Amq1xViem31lhmriTS', 'M', 31231231, '2000-11-21', 3),
(12, 'CC', 11111111, 'Usuario', 'Product', 'Owner', 'usuario_po@gmail.com', '$2y$10$0FohHEnc09DXYwQJ2O4Wq.iKfSPfjSH7KhzQ51Ybhhe6hhlnh4svy', 'M', 12123123, '1997-09-21', 2),
(13, 'CC', 222222, 'Usuario', 'Desarrollador', '', 'usuario_de@gmail.com', '$2y$10$PW5/PEbb8CjHi7G2io/dMu5k8IOZ5Ve/eICgCmyAp.JRLOyAnQkjO', 'M', 123123123, '1996-09-21', 3),
(14, 'CC', 123456, 'Duvan', 'Quin', 'Vargas', 'dquina@gmail.com', '$2y$10$YF.1MqM4AaBYRszcPxXV2OxIZKiuFfHxbrXFGueLILen5SnJZVCXq', 'M', 32154654, '1999-01-21', 3),
(15, 'CC', 132165, 'Samanda ', 'Quintana', '', 'samquin@gmial.com', '$2y$10$5iyZZ1kq1q4FqencrIRuR.YAI1E8Jzt7geUBATff51p4eKm4zmVbS', 'F', 6516516, '1989-05-12', 2),
(16, 'CC', 12356565, 'Carlos', 'GarcÃ­a', '', 'cargarcia@gmail.com', '$2y$10$8Qz12/U6ApyjAfqbRT8i2u3gvLM1QUy5xVjILtaNqVXn/QbZZ9cCu', 'M', 2147483647, '1996-09-21', 3),
(17, 'TI', 23131, 'Juan', 'Peraasd', '', 'juan@gmail.com', '$2y$10$jjsJsQEn8Z24LuunNQnbzeGgKyzwRJX7DqW.lLJX/naMsFxXOfUJO', 'M', 123131, '1999-03-12', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_actividad`
--
ALTER TABLE `t_actividad`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_per` (`id_usu`),
  ADD KEY `id_sol` (`id_pbi`);

--
-- Indices de la tabla `t_historia`
--
ALTER TABLE `t_historia`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `t_opcion`
--
ALTER TABLE `t_opcion`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `t_opcion_tipo_usu`
--
ALTER TABLE `t_opcion_tipo_usu`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `tiu_codigo` (`tiu_codigo`) USING BTREE,
  ADD KEY `opc_codigo` (`opc_codigo`) USING BTREE;

--
-- Indices de la tabla `t_pbi`
--
ALTER TABLE `t_pbi`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `hiu_codigo` (`hiu_codigo`) USING BTREE,
  ADD KEY `spr_codigo` (`spr_codigo`);

--
-- Indices de la tabla `t_sprint`
--
ALTER TABLE `t_sprint`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `t_tipo_usuario`
--
ALTER TABLE `t_tipo_usuario`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `tiu_codigo` (`tiu_codigo`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_actividad`
--
ALTER TABLE `t_actividad`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `t_historia`
--
ALTER TABLE `t_historia`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `t_opcion`
--
ALTER TABLE `t_opcion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `t_opcion_tipo_usu`
--
ALTER TABLE `t_opcion_tipo_usu`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `t_pbi`
--
ALTER TABLE `t_pbi`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `t_sprint`
--
ALTER TABLE `t_sprint`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `t_tipo_usuario`
--
ALTER TABLE `t_tipo_usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_actividad`
--
ALTER TABLE `t_actividad`
  ADD CONSTRAINT `t_actividad_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `t_usuario` (`codigo`),
  ADD CONSTRAINT `t_actividad_ibfk_2` FOREIGN KEY (`id_pbi`) REFERENCES `t_pbi` (`codigo`);

--
-- Filtros para la tabla `t_opcion_tipo_usu`
--
ALTER TABLE `t_opcion_tipo_usu`
  ADD CONSTRAINT `t_opcion_tipo_usu_ibfk_1` FOREIGN KEY (`tiu_codigo`) REFERENCES `t_tipo_usuario` (`codigo`),
  ADD CONSTRAINT `t_opcion_tipo_usu_ibfk_2` FOREIGN KEY (`opc_codigo`) REFERENCES `t_opcion` (`codigo`);

--
-- Filtros para la tabla `t_pbi`
--
ALTER TABLE `t_pbi`
  ADD CONSTRAINT `t_pbi_ibfk_2` FOREIGN KEY (`hiu_codigo`) REFERENCES `t_historia` (`codigo`),
  ADD CONSTRAINT `t_pbi_ibfk_3` FOREIGN KEY (`spr_codigo`) REFERENCES `t_sprint` (`codigo`);

--
-- Filtros para la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD CONSTRAINT `t_usuario_ibfk_1` FOREIGN KEY (`tiu_codigo`) REFERENCES `t_tipo_usuario` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
