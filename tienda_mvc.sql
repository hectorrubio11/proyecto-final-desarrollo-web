CREATE DATABASE IF NOT EXISTS `tienda_mvc`;
USE `tienda_mvc`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2026 a las 08:08:39
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
-- Base de datos: `tienda_mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `accion` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `usuario`, `accion`, `fecha`) VALUES
(1, 'Invitado', 'Producto con ID 5 eliminado', '2026-06-03 04:59:20'),
(2, 'Invitado', 'Producto con ID 6 eliminado', '2026-06-03 05:03:04'),
(3, 'Invitado', 'Producto con ID 7 eliminado', '2026-06-03 05:06:44'),
(4, 'admin', 'Producto con ID 8 eliminado', '2026-06-03 05:09:19'),
(5, 'admin', 'Producto Reloj Casioagregado', '2026-06-03 05:18:26'),
(6, 'admin', 'Producto con ID 9 actualizado', '2026-06-03 19:00:21'),
(7, 'admin', 'Producto iPhone 13 Mini agregado', '2026-06-03 19:56:49'),
(8, 'admin', 'Producto con ID 9 actualizado', '2026-06-03 19:57:52'),
(9, 'admin', 'Producto Carro HotWheels agregado', '2026-06-03 19:58:40'),
(10, 'admin', 'Producto con ID 9 eliminado', '2026-06-03 20:26:56'),
(11, 'admin', 'Producto con ID 11 eliminado', '2026-06-04 04:10:35'),
(12, 'admin', 'Producto Boing agregado', '2026-06-04 04:36:59'),
(13, 'admin', 'Producto Boing agregado', '2026-06-04 04:38:13'),
(14, 'admin', 'Producto Boing agregado', '2026-06-04 04:39:05'),
(15, 'admin', 'Producto con ID 12 actualizado', '2026-06-04 04:39:38'),
(16, 'admin', 'Producto Boing agregado', '2026-06-04 04:40:34'),
(17, 'admin', 'Producto Boing agregado', '2026-06-04 04:45:15'),
(18, 'admin', 'Producto Boing agregado', '2026-06-04 05:34:42'),
(19, 'admin', 'Producto con ID 1 eliminado', '2026-06-04 06:05:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `sku`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `existencia`, `created_at`, `updated_at`, `imagen`) VALUES
(10, '67', 'iPhone 13 Mini', 'iphone pequeño', 3000.00, 4999.00, 7, '2026-06-03 19:56:49', '2026-06-03 19:56:49', NULL),
(12, '111', 'Boing', 'sabor mango', 7.00, 15.00, 70, '2026-06-04 04:36:59', '2026-06-04 04:39:38', '1780547978_6a21018a95262.png'),
(13, '112', 'Boing', 'sabor uva', 7.00, 15.03, 70, '2026-06-04 04:38:13', '2026-06-04 04:38:13', '1780547893_6a2101355ed2f.jpg'),
(14, '113', 'Boing', 'sabor guayaba', 7.00, 15.00, 70, '2026-06-04 04:39:05', '2026-06-04 04:39:05', '1780547945_6a2101692c7e0.jpeg'),
(15, '114', 'Boing', 'de Manzana', 7.00, 15.00, 70, '2026-06-04 04:40:34', '2026-06-04 04:40:34', '1780548034_6a2101c20fc3e.png'),
(16, '115', 'Boing', 'sabor piña', 7.00, 15.00, 70, '2026-06-04 04:45:15', '2026-06-04 04:45:15', '1780548315_6a2102db333d1.png'),
(17, '116', 'Boing', 'sabor fresa', 7.00, 15.00, 70, '2026-06-04 05:34:42', '2026-06-04 05:34:42', '1780551282_6a210e72612c5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre_completo`) VALUES
(1, 'admin', '$2y$10$YoZ.pTpuQMe4qf1676s3HesDGcVzhCabJKVAXHGV.qYoJ4XOxQSsy', 'Administrador General');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
