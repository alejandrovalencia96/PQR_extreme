-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2020 a las 10:35:14
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `extreme`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqr`
--

CREATE TABLE `pqr` (
  `id` int(11) NOT NULL,
  `tipo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `asunto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `estado` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `creado_por` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_limite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pqr`
--

INSERT INTO `pqr` (`id`, `tipo`, `asunto`, `usuario`, `estado`, `creado_por`, `fecha_creacion`, `fecha_limite`) VALUES
(80, 'peticion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2, 'nuevo', 1, '2020-10-02', '2020-10-08'),
(81, 'queja', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 6, 'ejecucion', 1, '2020-10-02', '2020-10-04'),
(82, 'reclamo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 8, 'cerrado', 1, '2020-10-02', '2020-10-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `lastname` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `role` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `username` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `role`, `username`, `password`, `created_at`) VALUES
(1, 'Alejandro', 'Valencia', 'ADMIN_ROLE', 'alejandro1996', '$2y$10$Vgw5C1fmsFnnjELO0/nkC.oM4tsD1AmOmWQz/E2tfQJf6wJRlZLBq', '2020-10-01 20:26:23'),
(2, 'William', 'Valencia', 'USER_ROLE', 'william10', '$2y$10$nxNELbDZVhkEcv6Wn6qvC.4lCwpxTD7mpLlUUYy6vmrvxkllDGtB2', '2020-10-01 23:22:10'),
(6, 'carolina', 'valencia', 'USER_ROLE', 'caroval', '$2y$10$Q6rzAIfSFT3RwzFNKQX3rOKOGRkaeoApbd/2mUG4VuyJ9rSCQpoTu', '2020-10-02 07:25:32'),
(8, 'marcos', 'amin', 'USER_ROLE', 'marcosamin', '$2y$10$0LtuTN1CdNJAdtdcIErJ..mW4Xd2jW6xLvxbPa54dQtOPhtxXhRW2', '2020-10-02 07:27:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pqr`
--
ALTER TABLE `pqr`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pqr`
--
ALTER TABLE `pqr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
