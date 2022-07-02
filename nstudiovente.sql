create database IF NOT EXISTS nstudioveinte; 
use nstudioveinte;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2021 a las 01:55:20
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `beisbolplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE `atributos` (
  `id_atributo` int(11) NOT NULL,
  `nombre_atributo` varchar(120) DEFAULT NULL,
  `desc_atributo` varchar(500) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `atributos`
--

INSERT INTO `atributos` (`id_atributo`, `nombre_atributo`, `desc_atributo`, `activo`, `fecha_creacion`) VALUES
(1, 'XL', 'Tamaño de gorra', 1, '2021-03-02 16:41:01'),
(2, 'L', 'Tamaño S', 1, '2021-03-02 16:43:03'),
(3, 'M', 'Talla Medina', 1, '2021-03-02 16:45:46'),
(4, 'S', 'Talla chica', 1, '2021-03-02 16:45:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro_compras`
--

CREATE TABLE `carro_compras` (
  `id_carro_compras` int(11) NOT NULL,
  `nombre_carro_compras` varchar(120) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carro_compras`
--

INSERT INTO `carro_compras` (`id_carro_compras`, `nombre_carro_compras`, `id_producto`, `precio`, `cantidad`) VALUES
(1, NULL, 1, 400, 5),
(2, 'P', 1, 400, 5),
(3, 'Pelota de beisbol', 1, 400, 5),
(4, 'Pelota de beisbol', 1, 400, 5),
(5, 'Pelota de beisbol', 1, 400, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(120) DEFAULT NULL,
  `desc_categoria` varchar(1200) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `desc_categoria`, `activo`, `fecha_creacion`) VALUES
(1, 'BLUSAS', 'BLUSAS', 1, '2021-03-02 16:41:01'),
(2, 'FALDAS', 'FALDAS', 1, '2021-03-02 16:41:01'),
(3, 'PANTALONES', 'PANTALONES', 1, '2021-03-07 06:42:29'),
(4, 'JUMPERS', 'JUMPERS', 1, '2021-03-07 06:42:29'),
(5, 'SHORTS', 'SHORTS', 1, '2021-03-07 06:42:29'),
(6, 'VESTIDOS', 'VESTIDOS', 1, '2021-03-07 06:42:29'),
(7, 'ZAPATOS', 'ZAPATOS', 1, '2021-03-07 06:42:29'),
(8, 'TRAJES DE BAÑO', 'TRAJES DE BAÑO', 1, '2021-03-07 06:42:29'),
(9, 'SOMBREROS', 'SOMBREROS', 1, '2021-03-07 06:42:29'),
(10, 'ACCESORIOS', 'ACCESORIOS', 1, '2021-03-07 06:42:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cardholder` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_brand` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `charges`
--

INSERT INTO `charges` (`id`, `cardholder`, `stripe_id`, `card_brand`, `card_last_four`, `total`, `created_at`, `updated_at`) VALUES
(3, 'Daniel Eduardo Solis Can', 'tok_1IT8ezKGjcpz85FFakCoG9ib', 'Visa', '4242', NULL, '2021-03-09 22:44:00', '2021-03-09 22:44:00'),
(4, 'Eduardo', 'tok_1ITTjZKGjcpz85FFr67t3FsH', 'MasterCard', '4444', NULL, '2021-03-10 21:14:08', '2021-03-10 21:14:08'),
(5, 'Otro', 'tok_1ITTodKGjcpz85FFSWaIAwUh', 'Visa', '4242', 1900, '2021-03-10 21:19:22', '2021-03-10 21:19:22'),
(6, 'Iruharu', 'tok_1ITTpeKGjcpz85FFAG9rrdnQ', 'Visa', '4242', 1900, '2021-03-10 21:20:26', '2021-03-10 21:20:26'),
(7, 'Daniel Prueba', 'tok_1ITTrNKGjcpz85FFIPvTsCLu', 'MasterCard', '3222', 1900, '2021-03-10 21:22:13', '2021-03-10 21:22:13'),
(8, 'Prueba daniel', 'ch_1ITTyyKGjcpz85FFRNOIGdt5', 'Visa', '4242', 400, '2021-03-10 21:30:03', '2021-03-10 21:30:03'),
(9, 'Daniel prueba', 'ch_1ITUSzKGjcpz85FFBBYaUAkT', 'MasterCard', '4444', 1500, '2021-03-10 22:01:04', '2021-03-10 22:01:04'),
(10, 'Marine', 'ch_1ITUVMKGjcpz85FF6hUHqvRm', 'MasterCard', '8210', 350, '2021-03-10 22:03:31', '2021-03-10 22:03:31'),
(11, 'Manuel', 'ch_1ITWDCKGjcpz85FFbyLuQ9z1', 'Visa', '5556', 1500, '2021-03-10 23:52:52', '2021-03-10 23:52:52'),
(12, 'Marine Burgos', 'ch_1ITWQGKGjcpz85FFJhDinl1B', 'Visa', '4242', 2650, '2021-03-11 00:06:22', '2021-03-11 00:06:22'),
(13, 'Carla Serrano', 'ch_1ITWm9KGjcpz85FFm8ymeL1r', 'MasterCard', '8210', 350, '2021-03-11 00:28:59', '2021-03-11 00:28:59'),
(14, 'Carla serrano madrid', 'ch_1ITWniKGjcpz85FFsvkIJ6jw', 'MasterCard', '8210', 350, '2021-03-11 00:30:36', '2021-03-11 00:30:36'),
(15, 'Mariana vazquez', 'ch_1ITX62KGjcpz85FF0ecEgmNY', 'Visa', '4242', 1900, '2021-03-11 00:49:33', '2021-03-11 00:49:33'),
(16, 'Mariana Vazquez', 'ch_1ITX6zKGjcpz85FFX84Vt4je', 'Visa', '4242', 750, '2021-03-11 00:50:31', '2021-03-11 00:50:31'),
(17, 'Mariano', 'ch_1ITXb5KGjcpz85FFeTsdsmyG', 'Visa', '5556', 1500, '2021-03-11 01:21:37', '2021-03-11 01:21:37'),
(18, 'Daniel solis', 'ch_1ITXeAKGjcpz85FF2zn2g2II', 'Visa', '4242', 350, '2021-03-11 01:24:48', '2021-03-11 01:24:48'),
(19, 'Natalia', 'ch_1ITXfyKGjcpz85FFp3nKuAEV', 'Visa', '4242', 350, '2021-03-11 01:26:40', '2021-03-11 01:26:40'),
(20, 'Monserrat Escalante', 'ch_1ITXhEKGjcpz85FFYNZHjOMb', 'Visa', '4242', 400, '2021-03-11 01:27:58', '2021-03-11 01:27:58'),
(21, 'Monse', 'ch_1ITXpwKGjcpz85FFnVHRdyiB', 'Visa', '4242', 350, '2021-03-11 01:36:58', '2021-03-11 01:36:58'),
(22, 'Daniel', 'ch_1J9CFEJlKfVI7APfdfhOvoX8', 'Visa', '4242', 850, '2021-07-03 22:03:11', '2021-07-03 22:03:11'),
(23, 'Daniel', 'ch_1J9CFqJlKfVI7APfO4KqB8bm', 'Visa', '4242', 850, '2021-07-03 22:03:49', '2021-07-03 22:03:49'),
(24, 'daniel solis', 'ch_1J9CqcJlKfVI7APfpFTEs9rJ', 'Visa', '4242', 400, '2021-07-03 22:41:49', '2021-07-03 22:41:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle_venta`, `id_venta`, `id_producto`, `precio`, `cantidad`, `fecha_creacion`) VALUES
(1, 4, 1, 400, 2, '2021-03-10 18:06:21'),
(2, 4, 2, 1500, 1, '2021-03-10 18:06:21'),
(3, 4, 3, 350, 1, '2021-03-10 18:06:21'),
(5, 6, 3, 350, 1, '2021-03-10 18:28:58'),
(6, 8, 3, 350, 1, '2021-03-10 18:30:35'),
(9, 10, 1, 400, 1, '2021-03-10 18:49:32'),
(10, 10, 2, 1500, 1, '2021-03-10 18:49:32'),
(11, 12, 1, 400, 1, '2021-03-10 18:50:30'),
(12, 12, 3, 350, 1, '2021-03-10 18:50:30'),
(13, 13, 2, 1500, 1, '2021-03-10 19:21:36'),
(14, 14, 3, 350, 1, '2021-03-10 19:24:47'),
(15, 15, 3, 350, 1, '2021-03-10 19:26:39'),
(16, 17, 1, 400, 1, '2021-03-10 19:27:57'),
(17, 19, 3, 350, 1, '2021-03-10 19:36:57'),
(18, 21, 1, 400, 1, '2021-07-03 17:03:10'),
(19, 21, 2, 450, 1, '2021-07-03 17:03:10'),
(20, 22, 1, 400, 1, '2021-07-03 17:03:48'),
(21, 22, 2, 450, 1, '2021-07-03 17:03:48'),
(22, 23, 1, 400, 1, '2021-07-03 17:41:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `domicilio` varchar(140) DEFAULT NULL,
  `pais` varchar(80) DEFAULT NULL,
  `estado` varchar(80) DEFAULT NULL,
  `codigo_postal` varchar(7) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(200) DEFAULT NULL,
  `desc_marca` varchar(1200) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_producto` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desc_producto` varchar(1200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_imagen` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `nombre_producto`, `desc_producto`, `url_imagen`, `precio`, `cantidad`, `id_marca`, `activo`, `fecha_creacion`) VALUES
(1, 1, 'Jumper floreado', 'Jumper floreado verde', '01.jpeg', 400, 5, NULL, 1, '2021-03-02 16:43:03'),
(2, 1, 'Jumper short floreado', 'Jumper short floreado', '02.jpeg', 450, 4, NULL, 1, '2021-03-07 06:25:10'),
(3, 2, 'Conjunto neon', 'Conjunto neon', '03.jpeg', 350, 8, NULL, 1, '2021-03-02 16:47:15'),
(4, 2, 'Falsa short roja', 'Falda short roja', '04.jpeg', 300, 3, NULL, 1, '2021-06-17 22:38:54'),
(5, 3, 'Pantalon naranja', 'Pantalon de vestir', '05.jpeg', 450, 6, NULL, 1, '2021-06-17 22:39:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_atributos`
--

CREATE TABLE `productos_atributos` (
  `id_producto_detalle` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_atributo` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_atributos`
--

INSERT INTO `productos_atributos` (`id_producto_detalle`, `id_producto`, `id_atributo`, `fecha_creacion`) VALUES
(1, 3, 1, '2021-03-02 16:49:36'),
(2, 3, 2, '2021-03-02 16:49:36'),
(3, 3, 4, '2021-03-02 16:49:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `total_productos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `fecha_venta`, `total_productos`) VALUES
(1, '2021-03-10', 1),
(2, '2021-03-10', 1),
(3, '2021-03-10', 1),
(4, '2021-03-10', 4),
(6, '2021-03-10', 1),
(8, '2021-03-10', 1),
(10, '2021-03-10', 2),
(12, '2021-03-10', 2),
(13, '2021-03-10', 1),
(14, '2021-03-10', 1),
(15, '2021-03-10', 1),
(17, '2021-03-10', 1),
(19, '2021-03-10', 1),
(21, '2021-07-03', 2),
(22, '2021-07-03', 2),
(23, '2021-07-03', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id_atributo`);

--
-- Indices de la tabla `carro_compras`
--
ALTER TABLE `carro_compras`
  ADD PRIMARY KEY (`id_carro_compras`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_venta`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_productos__categorias__id_categoria_idx` (`id_categoria`),
  ADD KEY `fk_productos__marcas_id_marca_idx` (`id_marca`);

--
-- Indices de la tabla `productos_atributos`
--
ALTER TABLE `productos_atributos`
  ADD PRIMARY KEY (`id_producto_detalle`),
  ADD KEY `fk_Productos_detalle__Atributos__id_atributo_idx` (`id_atributo`),
  ADD KEY `fk_Productos_detalle__Atriubots__fk_id_producto_idx` (`id_producto`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atributos`
--
ALTER TABLE `atributos`
  MODIFY `id_atributo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carro_compras`
--
ALTER TABLE `carro_compras`
  MODIFY `id_carro_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos_atributos`
--
ALTER TABLE `productos_atributos`
  MODIFY `id_producto_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos__categorias__id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos__marcas_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_atributos`
--
ALTER TABLE `productos_atributos`
  ADD CONSTRAINT `fk_Productos_detalle__Atributos__id_atributo` FOREIGN KEY (`id_atributo`) REFERENCES `atributos` (`id_atributo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_detalle__Atriubots__id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
