-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2025 a las 00:31:02
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
-- Base de datos: `carros`
CREATE DATABASE carros;
USE carros;
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'TIPO DE VEHÍCULO'),
(2, 'MARCA AUTOMOTRIZ'),
(3, 'LÍNEA DE VEHÍCULO'),
(4, 'AGENDA TU CITA'),
(6, 'BMW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `metodo_pago` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `pais`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`, `metodo_pago`, `total`) VALUES
(7, 7, 'colombia', 'pereria ', 'manzana11 pereira ', 150000000.00, 'pendiente', '2025-04-16', '22:16:57', 'Nequi', 99999999.99),
(8, 7, 'Colombia ', 'pereria ', 'manzana 20 pereira', 120000000.00, 'pendiente', '2025-04-16', '23:24:27', 'Davivienda', 99999999.99),
(9, 7, 'Colombia ', 'pereria ', 'manzana 20 pereira', 420000000.00, 'pendiente', '2025-04-16', '23:47:35', 'PayPal', 99999999.99),
(10, 7, 'brazil', 'sao paulo', 'alcolirykoz ', 40000000.00, 'pendiente', '2025-04-16', '23:53:03', 'Efectivo', 40000000.00),
(11, 7, 'china', 'cali', 'el ocho 12', 420000000.00, 'pendiente', '2025-04-17', '00:13:01', 'Bancolombia', 99999999.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(255) NOT NULL,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(1, 1, 'BMW Serie X', 'Motor 2.0 Turbo, automático, 5 puertas', 120000000.00, 10, NULL, '2025-04-13', 'bmw_PNG99543.png'),
(2, 1, 'Chevrolet Spark GT', 'Económico, compacto, ideal ciudad', 40000000.00, 15, NULL, '2025-04-13', 'chevrolet.png'),
(3, 1, 'Cadillac XT5', 'Lujo, espacio y tecnología', 150000000.00, 8, NULL, '2025-04-13', 'cadillac_PNG.png'),
(4, 1, 'Lamborghini Aventador', 'Deportivo extremo, motor V12', 1500000000.00, 5, NULL, '2025-04-13', 'lamborghini_.png'),
(12, 1, 'ford-raptor', 'ford modelo 2024 increíble camioneta 4x4', 420000000.00, 4, '', '2025-04-16', 'pngimg.com - ford_PNG102947.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `imagen`, `telefono`, `reset_token`, `token_expira`) VALUES
(6, 'sofia arango jaramillo ', 'sofia@admin.com', '$2y$10$zXiqDt4N0CarlaH3NDiNrOfba4e3iNzUXnCjx.XFYyVjdqnpyUigO', 'admin', '5888cd40-2ae2-11ee-ab60-d7d745a533c2.jpg', '3148723458', NULL, NULL),
(7, 'Carlos Andres Reyes Grajales ', 'brunoreyes150@gmail.com', '$2y$10$0dp2eItjZh/oMeCVkeJ8A./v8hfDS2Z9GOHVwAixvEF6slrYAMwIu', 'usuario', 'Imagen de WhatsApp 2025-03-31 a las 22.21.13_b23c8576.jpg', '3108635728', 'df07774614bb61b5a00d1da81c5b8bd88ec26de1bfedf6d973f3a6fd6a4049b63d11daf502add8f4634722da957866a5c7de', '2025-04-15 19:16:11'),
(8, 'Tralalero tralala', 'bombardirococodrilo14@gmail.com', '$2y$10$92CgFE1STxvVZfRGj.R6n.NymRoPrlmDpB0XEDtKACU4bHZiwdEte', 'usuario', 'Imagen de WhatsApp 2025-03-31 a las 22.21.13_b23c8576.jpg', '3245678193', NULL, NULL),
(9, 'Andres Reyes ', 'andres10@admin.com', '$2y$10$mFw26UvdYNrTzG9mBVN8YuuBFCybDOBIkZwJWjBGOk3rUEVxv5.XK', 'admin', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_pedido` (`pedido_id`),
  ADD KEY `fk_linea_producto` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_usuario` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
