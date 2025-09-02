-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2025 a las 05:05:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peoplepro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'cajas', 'bodega'),
(2, 'torres', 'fdadsfd'),
(3, 'seguridad', 'hrtyutyhth');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficios`
--

CREATE TABLE `beneficios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficios`
--

INSERT INTO `beneficios` (`id`, `nombre`, `descripcion`, `imagen`, `fecha_inicio`, `fecha_fin`) VALUES
(1, '30% en opticas', 'gafas', 'https://res.cloudinary.com/dacuzzwlc/image/upload/v1756678701/tzk2nismwlgyoadgxbu7.png', '2025-08-29', '2025-09-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones`
--

CREATE TABLE `capacitaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_capacitacion` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_subida` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` varchar(50) DEFAULT 'Activo',
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `tipo`, `usuario_id`, `estado`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Permiso por calamidad doméstica', 4, 'pendiente', '2025-08-14', '2025-08-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL,
  `direccion` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Admin','Empleado','Seguridad') NOT NULL DEFAULT 'Empleado',
  `area_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `token_expiracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `telefono`, `direccion`, `password`, `rol`, `area_id`, `created_at`, `updated_at`, `token`, `token_expiracion`) VALUES
(1, 'laura', 'laura@gmail.com', 0, '', '$2y$10$ZXBSzMa1BC66TPeJow6R7OVvj8hFgOmmL4/jiVSWSCaIw2N.lylxu', 'Admin', 1, '2025-08-12 18:12:46', '2025-09-02 01:45:06', 'fd3b9661fd59182725690bd0bfcc8c57690b7be3aa5c1369f3d1f5ad4058e71e', '2025-09-02 04:45:06'),
(4, 'daniela', 'daniela@gmail.com', 2147483647, 'ddjhshdushdus', '$2y$10$bwDpMomBmmWgwHxeENUSseTK8v/zpo.oCOnfe5v5mCQ5FuM8M2brW', 'Empleado', 2, '2025-08-26 18:44:00', '2025-08-31 18:02:28', NULL, NULL),
(5, 'rodrigo', 'rodrigo@gmail.com', 2147483647, 'tu maldito amor', '$2y$10$d6ZI2HMRc0PWzVHhM94Ccemh3LFnClBF0zN68jrOfx1a6Y.mgmm8K', 'Seguridad', 1, '2025-08-27 21:52:08', '2025-08-27 21:52:08', NULL, NULL),
(6, 'santiago', 'walterossanti35@gmail.com', 2147483647, 'tu maldito amor', '$2y$10$tSp7J9PiKUSDGbDmXooZVeGxF7qUMDUPKmxjj4skDmTM0dciUeaoK', 'Empleado', 3, '2025-09-02 01:49:18', '2025-09-02 02:03:10', 'f2e2314ad6f1c882e9bd8950b2796dcc7215dfa25cc913646ae4c6a60cc6a5e2', '2025-09-02 05:03:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `motivo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`id`, `nombre`, `documento`, `empresa`, `fecha_ingreso`, `fecha_salida`, `motivo`) VALUES
(2, 'saul', '123456789', 'claro', '2025-08-23 15:20:00', '2025-08-29 15:20:00', 'dasdsadsad');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
