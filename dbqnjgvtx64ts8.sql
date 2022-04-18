-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2022 a las 03:15:28
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jurassic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posters`
--

CREATE TABLE `posters` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url_img` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `posters`
--

INSERT INTO `posters` (`id`, `user_id`, `url_img`, `votes`, `enabled`) VALUES
(1, 1, 'https://static.posters.cz/image/750webp/100966.webp', 3, 1),
(2, 2, 'https://static.posters.cz/image/750webp/101934.webp', 2, 1),
(3, 3, 'https://static.posters.cz/image/750webp/81807.webp', 2, 1),
(4, 4, 'https://static.posters.cz/image/1300/posters/star-wars-the-mandalorian-group-i93766.jpg', 2, 1),
(5, 5, 'https://static.posters.cz/image/750webp/122136.webp', 2, 1),
(6, 6, 'https://static.posters.cz/image/750webp/103406.webp', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `document`, `city`, `phone`, `enabled`) VALUES
(1, 'jean', 'jean@gmail.com', '80827198', 'Bogota', '3133533507', 1),
(2, 'juan', 'juan@gmail.com', '12345678', 'cali', '4330098371', 1),
(3, 'pedro', 'pedro@gmail.com', '23123234', 'medellin', '3001234122', 1),
(4, 'Maria', 'qew@qwe.com', '123123', '123', '123', 1),
(5, 'Ana', 'qew@qwe.com', '123123', 'Cali', '123', 1),
(6, 'Tatiana', 'tatiana@emai.com', NULL, 'San Andres', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_votes_ip`
--

CREATE TABLE `users_votes_ip` (
  `id` int(11) NOT NULL,
  `poster_id` int(11) DEFAULT NULL,
  `user_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users_votes_ip`
--

INSERT INTO `users_votes_ip` (`id`, `poster_id`, `user_ip`) VALUES
(80, 2, '::1'),
(81, 6, '::1'),
(82, 3, '::1'),
(83, 4, '::1'),
(84, 5, '::1'),
(85, 1, '::1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_votes_ip`
--
ALTER TABLE `users_votes_ip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posters`
--
ALTER TABLE `posters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users_votes_ip`
--
ALTER TABLE `users_votes_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
