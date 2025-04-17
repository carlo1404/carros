-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2025 a las 21:34:13
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
(6, 'SPORT'),
(7, 'CAMIONETAS'),
(8, 'COMODIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

CREATE TABLE `lineas_pedidos` (
  `id` int(255) NOT NULL,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  `coste` float(200,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `metodo_pago` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `pais`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`, `metodo_pago`, `total`, `cantidad`) VALUES
(42, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 150000000.00, 'entregado', '2025-04-17', '06:15:04', 'Efectivo', 99999999.99, 0),
(43, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 300000000.00, 'confirmado', '2025-04-17', '17:26:51', 'PayPal', 99999999.99, 2),
(44, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 300000000.00, 'confirmado', '2025-04-17', '17:28:50', 'Davivienda', 99999999.99, 2),
(45, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 300000000.00, 'confirmado', '2025-04-17', '17:34:51', 'PayPal', 99999999.99, 2),
(46, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 3840000000.00, 'entregado', '2025-04-17', '17:35:17', 'Bancolombia', 99999999.99, 4),
(47, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 240000000.00, 'confirmado', '2025-04-17', '17:37:25', 'Bancolombia', 99999999.99, 4),
(48, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 400000000.00, 'confirmado', '2025-04-17', '17:39:33', 'Bancolombia', 99999999.99, 6),
(49, 7, 'Colombia', 'Bogota-suba', 'm13 fontibon', 2906044928.00, 'confirmado', '2025-04-17', '21:28:03', 'Bancolombia', 99999999.99, 8);

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
  `fecha` datetime NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `vendidos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`, `vendidos`) VALUES
(19, 6, 'lamborgini', 'carro de lujo perfecto para pistas de carrera con increible motor ', 123000000.00, 3, 'SI', '2025-04-17 00:00:00', 'lamborghini_.png', 0),
(20, 7, 'Ford-raptor', 'increible camioneta 4x4 con tecnologia de ultima generacion perfecto para brindarte la comodidad que necesitas ', 100000000.00, 2, 'SI', '2025-04-17 00:00:00', 'pngimg.com - ford_PNG102947.png', 0),
(21, 7, ' Cadillac Escalade 2025', 'El Cadillac Escalade 2025 es un SUV de lujo de tres filas con diseño renovado y tecnología avanzada. Ofrece opciones de motorización como un motor V8 de 6.2L con 420 hp y 624 Nm de torque, o un V8 sobrealimentado de 6.2L con 682 hp y 885 Nm en la versión Escalade-V', 371055008.00, 1, 'SI', '2025-04-17 00:00:00', 'cadillac_PNG.png', 0),
(22, 6, 'BMW i4 (2025)', 'El BMW i4 es un sedán eléctrico de cuatro puertas que ofrece una experiencia de conducción deportiva y una autonomía destacada. Está disponible en varias versiones, incluyendo la eDrive40 y la M50, cada una con características y prestaciones únicas.', 350000000.00, 2, 'SI', '2025-04-17 00:00:00', 'bmw_PNG99543.png', 0),
(23, 8, 'Renault Logan Life', ' Sedán con motor 1.6L, 111 hp, y 156 Nm de torque. Equipado con 4 airbags, pantalla táctil de 7\", y conectividad Android Auto y Apple CarPlay.', 64990000.00, 1, 'SI', '2025-04-17 00:00:00', 'RENOL.png', 0),
(24, 8, ' Kia Soluto', 'Sedán compacto con motor 1.4L, 94 hp. Incluye pantalla multimedia de 9\", CarPlay y Android Auto inalámbricos, y aire acondicionado', 64990000.00, 2, 'NO', '2025-04-17 00:00:00', 'KIA.png', 0),
(26, 8, 'Chevrolet Joy Sedán', 'Sedán con motor 1.4L, 97 hp. Equipado con alarma antirrobo, control electrónico de estabilidad, y frenos ABS. ​', 55.50, 3, 'NO', '2025-04-17 00:00:00', 'CHEVROLET.png', 0),
(27, 8, ' Peugeot 208', 'Hatchback con estilo europeo y eficiencia en combustible.', 35000000.00, 4, 'SI', '2025-04-17 00:00:00', 'Peugeot-208.png', 0),
(28, 6, ' Ford Mustang GT Premium Performance 2024', 'Icono estadounidense con diseño clásico y tecnología avanzadaMotor: V8 de 5.0L, 460 hp\r\n\r\nAceleración (0-100 km/h): 3.9 segundos\r\n\r\nVelocidad máxima: 265 km/h\r\n\r\nTransmisión: Automática de 10 velocidades', 269.99, 3, 'SI', '2025-04-17 00:00:00', 'img_6801532c2e1ab.png', 0),
(29, 6, ' BMW Z4 M40i Roadster 2024', 'Roadster deportivo con diseño elegante y alto rendimiento. Motor: 3.0L 6 cilindros, 482 hp\r\n\r\nAceleración (0-100 km/h): Aproximadamente 4 segundos\r\n\r\nCaracterísticas destacadas:\r\n\r\nDiseño aerodinámico y convertible\r\n\r\nPantalla táctil de 10,25\" con iDrive 8\r\n\r\nCompatibilidad con Apple CarPlay y Android Auto\r\n\r\nFaros LED y sistema de escape deportivo', 289550848.00, 5, 'SI', '2025-04-17 00:00:00', '57517da9dcc6ab78668609895bf45a80.png', 0),
(30, 6, 'Subaru WRX 2025 ', 'Sedán deportivo con enfoque en rendimiento y seguridad Motor: 2.4L turboalimentado, 271 hp\r\n\r\nCaracterísticas destacadas:\r\n\r\nSuspensión mejorada y chasis más rígido\r\n\r\nAsientos delanteros Recaro en versiones STI\r\n\r\nSistema de infoentretenimiento con proyección inalámbrica\r\n\r\nDiseño agresivo y aerodinámico', 199990000.00, 6, 'SI', '2025-04-17 00:00:00', 'Magnetite+Gray+Metallic.png', 0),
(31, 6, 'Porsche Taycan', 'Deportivo eléctrico de alto rendimiento con tecnología de punta. Motor: Eléctrico, hasta 938 hp (Turbo S)\r\n\r\nAceleración (0-100 km/h): Aproximadamente 2,4 segundos (Turbo S)\r\n\r\nCaracterísticas destacadas:\r\n\r\nDiseño futurista y aerodinámico\r\n\r\nTecnología avanzada en el tablero y sistema de infoentretenimiento\r\n\r\nAutonomía de hasta 500 km (según versión)\r\n\r\nCarga rápida y sistema de recuperación de energía\r\n', 578000000.00, 7, 'SI', '2025-04-17 00:00:00', 'Porsche-Taycan-PNG-Picture.png', 0);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
