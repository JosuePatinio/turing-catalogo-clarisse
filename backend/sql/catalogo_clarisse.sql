-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2026 a las 22:05:43
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
-- Base de datos: `catalogo_clarisse`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `rango_edad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `rango_edad`) VALUES
(1, '1-3 meses'),
(2, '3-6 meses'),
(3, '6-9 meses'),
(4, '9-12 meses'),
(5, '12-18 meses'),
(6, 'Recién nacido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen_url` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen_url`, `id_categoria`) VALUES
(1, 'Pañalero Blanco', 'Pañalero 100% de algodon', 150.00, 20, 'https://plash.mx/cdn/shop/products/Manga_Corta_BASE_BLANCA_2bbaae0d-5fc3-46c4-8b5b-3c8bb96b7f7e_700x700.jpg?v=1590857711', 1),
(2, 'Mameluco de Osito', 'Mameluco calientito para invierno', 300.00, 15, 'https://m.media-amazon.com/images/I/71S3n8p361L.jpg', 2),
(3, 'Conjunto Azul \"Little brother\" ', 'Conjunto de ropa de verano para bebé 100% algodón, color azul', 450.00, 5, 'https://m.media-amazon.com/images/I/71sX52kD0rL._AC_UY1000_.jpg', 1),
(4, 'Bata pijama de hospital', 'Pijama De Hospital Ropa para Bebés de algodón', 200.00, 15, 'https://m.media-amazon.com/images/I/61HFKQkbukL._AC_UL320_.jpg', 2),
(5, 'Traje de bebé elegante', 'Ropa de trabajo para bebé, Esmoquin de algodón bordado.', 650.00, 3, 'https://m.media-amazon.com/images/I/61K8o5pkKUL._AC_SX679_.jpg', 3),
(6, 'Traje de dinosaurio', 'Traje de dinosaurio para recién nacido, mameluco de manga larga y overol de pantalones largos.', 750.00, 10, 'https://m.media-amazon.com/images/I/71RHgZdmMdL._AC_SX569_.jpg', 1),
(7, 'Mameluco con tirantes florales   ', 'Mameluco con tirantes florales, vestido de tirantes y manga con volantes.', 350.00, 5, 'https://m.media-amazon.com/images/I/81a3qELxyYL._AC_SX679_.jpg', 6),
(8, 'Conjunto de Primavera y otoño', 'Conjunto de algodón aireado aislante de triple capa para recién nacidos', 200.00, 45, 'https://http2.mlstatic.com/D_NQ_NP_2X_904307-CBT107484747324_032026-F-conjuntos-de-primavera-y-otono-para-recien-nacidos.webp', 6),
(9, 'Conjunto de sudadera y pantalón', 'Conjunto de 2 piezas de sudadera con capucha de manga\nlarga y pantalón de cintura elástica.', 400.00, 12, 'https://img.ltwebstatic.com/v4/j/pi/2025/09/22/52/17585370690544ac00f5a280591008178ef3a0d59e_thumbnail_405x.webp', 5),
(10, 'Conjunto de camisa y pantalones cortos', 'Conjunto informal de bebé niño de camisa polo de manga\ncorta con rayas y pantalones cortos, con parche bordado.', 400.00, 16, 'https://img.ltwebstatic.com/v4/j/pi/2025/05/08/82/17466934222386cff88c21a296c9358ece904269c3_thumbnail_405x.webp', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `password`, `rol`) VALUES
(1, 'admin_turing', '$2a$12$5S3Ap468ssFrFsJtCY8Tguh6ocNW7dgOXrNNOcycTgCL7ICdH3HPq', 'admin'),
(2, 'Cesar Franco', '$2a$12$rrmfsSsyWgTOL8fvJT2w/eP2uj5p7OGupOt0M1/w3pdAJkcyTmM7y', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
