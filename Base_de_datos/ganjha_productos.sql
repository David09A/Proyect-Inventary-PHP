-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2021 a las 19:00:55
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ganjha_productos`
--
CREATE DATABASE IF NOT EXISTS `ganjha_productos` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `ganjha_productos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cedula` int(11) NOT NULL,
  `nomb_compl_cli` varchar(100) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_ventas`
--

CREATE TABLE `det_ventas` (
  `relativo` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cod_producto` int(11) DEFAULT NULL,
  `cant_prod` int(11) NOT NULL,
  `total_prod_cant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directivo`
--

CREATE TABLE `directivo` (
  `num_cedula` int(10) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `areas_a_supervisar` varchar(50) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `RH` varchar(50) NOT NULL,
  `quien_registra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `directivo`
--

INSERT INTO `directivo` (`num_cedula`, `nombres`, `apellidos`, `telefono`, `correo`, `contraseña`, `direccion`, `areas_a_supervisar`, `estado_civil`, `RH`, `quien_registra`) VALUES
(1234567890, 'Admin', 'Admin', '1234567890', 'admin@admin', '0987654321', 'ganjha', 'General', 'Admin', 'Admin', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `num_cedula` int(10) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `horario` varchar(50) NOT NULL,
  `asignacion_salarial` varchar(50) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `RH` varchar(50) NOT NULL,
  `observaciones` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_para_empacar`
--

CREATE TABLE `insumos_para_empacar` (
  `id_empa` int(11) NOT NULL,
  `nom_empaque` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `nit_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_para_produccion`
--

CREATE TABLE `insumos_para_produccion` (
  `id_produc` int(11) NOT NULL,
  `nom_produccion` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `nit_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `id_mat` int(11) NOT NULL,
  `nom_materia_prima` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `nit_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `presentacion` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `precio_venta` int(15) NOT NULL,
  `precio_produccion` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `nom_empaque` int(11) DEFAULT NULL,
  `nom_produccion` int(11) DEFAULT NULL,
  `nom_materia_prima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `restarstock_ins_empa` AFTER INSERT ON `productos` FOR EACH ROW Update insumos_para_empacar INNER JOIN productos
set insumos_para_empacar.cantidad = insumos_para_empacar.cantidad - productos.cantidad
where insumos_para_empacar.id_empa = productos.nom_empaque
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restarstock_ins_materia` AFTER INSERT ON `productos` FOR EACH ROW Update materia_prima INNER JOIN productos set materia_prima.cantidad = materia_prima.cantidad - productos.cantidad where materia_prima.id_mat = productos.nom_materia_prima
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restarstock_ins_prod` AFTER INSERT ON `productos` FOR EACH ROW Update insumos_para_produccion INNER JOIN productos set insumos_para_produccion.cantidad = insumos_para_produccion.cantidad - productos.cantidad where insumos_para_produccion.id_produc = productos.nom_produccion
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `nit` int(11) NOT NULL,
  `nom_empresa` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `valor_total` int(11) DEFAULT NULL,
  `usuario_venta` int(11) DEFAULT NULL,
  `client_venta` int(11) DEFAULT NULL,
  `fecha_venta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  ADD PRIMARY KEY (`relativo`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `directivo`
--
ALTER TABLE `directivo`
  ADD PRIMARY KEY (`num_cedula`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`num_cedula`);

--
-- Indices de la tabla `insumos_para_empacar`
--
ALTER TABLE `insumos_para_empacar`
  ADD PRIMARY KEY (`id_empa`) USING BTREE,
  ADD KEY `nit_proveedor` (`nit_proveedor`);

--
-- Indices de la tabla `insumos_para_produccion`
--
ALTER TABLE `insumos_para_produccion`
  ADD PRIMARY KEY (`id_produc`),
  ADD KEY `nit_proveedor` (`nit_proveedor`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`id_mat`),
  ADD KEY `nit_proveedor` (`nit_proveedor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom_empaque` (`nom_empaque`),
  ADD KEY `nom_produccion` (`nom_produccion`),
  ADD KEY `nom_materia_prima` (`nom_materia_prima`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `usuario_venta` (`usuario_venta`),
  ADD KEY `ventas_ibfk_2` (`client_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  MODIFY `relativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos_para_empacar`
--
ALTER TABLE `insumos_para_empacar`
  MODIFY `id_empa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `insumos_para_produccion`
--
ALTER TABLE `insumos_para_produccion`
  MODIFY `id_produc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  ADD CONSTRAINT `det_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `det_ventas_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `insumos_para_empacar`
--
ALTER TABLE `insumos_para_empacar`
  ADD CONSTRAINT `insumos_para_empacar_ibfk_1` FOREIGN KEY (`nit_proveedor`) REFERENCES `proveedor` (`nit`);

--
-- Filtros para la tabla `insumos_para_produccion`
--
ALTER TABLE `insumos_para_produccion`
  ADD CONSTRAINT `insumos_para_produccion_ibfk_1` FOREIGN KEY (`nit_proveedor`) REFERENCES `proveedor` (`nit`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD CONSTRAINT `materia_prima_ibfk_1` FOREIGN KEY (`nit_proveedor`) REFERENCES `proveedor` (`nit`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`nom_produccion`) REFERENCES `insumos_para_produccion` (`id_produc`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`nom_materia_prima`) REFERENCES `materia_prima` (`id_mat`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`client_venta`) REFERENCES `cliente` (`cedula`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
