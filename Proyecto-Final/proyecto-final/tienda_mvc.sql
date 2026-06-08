-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2026 a las 01:23:50
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
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `detalle` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `usuario`, `accion`, `detalle`, `fecha`, `ip`) VALUES
(1, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 22:17:37', '::1'),
(2, 'admin', 'CREAR', 'Producto creado: Computadora SKU: 12324567', '2026-06-07 22:17:52', '::1'),
(3, 'admin', 'LOGOUT', 'Sesión cerrada', '2026-06-07 22:17:57', '::1'),
(4, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 22:18:03', '::1'),
(5, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 22:32:47', '::1'),
(6, 'admin', 'CREAR', 'Producto creado: Computadora SKU: 12324567', '2026-06-07 22:33:09', '::1'),
(7, 'admin', 'CREAR', 'Producto creado: cheetos SKU: 23456', '2026-06-07 22:39:42', '::1'),
(8, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 22:44:35', '::1'),
(9, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 22:48:11', '::1'),
(10, 'admin', 'CREAR', 'Producto creado: pollo asado/nuggets SKU: 868686868', '2026-06-07 23:06:58', '::1'),
(11, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 23:08:08', '::1'),
(12, 'admin', 'LOGIN', 'Inicio de sesión exitoso', '2026-06-07 23:21:53', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `sku`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `existencia`, `imagen`) VALUES
(10, '48585858', 'Computadora', 'laptop asus', 20.00, 30.00, 3, NULL),
(15, '23456', 'cheetos', 'cheetos amrillos', 20.00, 30.00, 3, NULL),
(16, '868686868', 'pollo asado/nuggets', 'pollo rico', 20.00, 30.00, 2, 'img_6a25f99275804.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `username`, `password`) VALUES
(1, 'Administrador', 'admin', '$2y$10$FxmBeTb7XCREhs8KFiXPfO6oeBaEzSFeW0pqw9P7jHJ8grpjjPaVq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
