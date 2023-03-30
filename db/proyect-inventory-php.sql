-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2022 a las 13:44:35
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u640246404_inventary`
--
CREATE DATABASE IF NOT EXISTS `u640246404_inventary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `u640246404_inventary`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db004dm_domains`
--

DROP TABLE IF EXISTS `db004dm_domains`;
CREATE TABLE `db004dm_domains` (
  `domain_name` varchar(20) NOT NULL,
  `n_code` varchar(20) NOT NULL,
  `n_descri` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `db004dm_domains`
--

INSERT INTO `db004dm_domains` (`domain_name`, `n_code`, `n_descri`) VALUES
('DM_PREFIX', 'PAT', 'Producto Antiguo en tienda'),
('DM_PREFIX', 'PNT', 'Producto nuevo en tienda'),
('DM_ROL', 'ADM', 'Rol de administración del sistema'),
('DM_ROL', 'CLIENTE', 'Rol uso para compras exclusivamente'),
('DM_ROL', 'PROV', 'Proveedor de productos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gr001m_user_db`
--

DROP TABLE IF EXISTS `gr001m_user_db`;
CREATE TABLE `gr001m_user_db` (
  `k_identi` varchar(15) NOT NULL,
  `k_serie` int(10) NOT NULL,
  `n_user` varchar(50) NOT NULL,
  `n_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gr001m_user_db`
--

INSERT INTO `gr001m_user_db` (`k_identi`, `k_serie`, `n_user`, `n_password`) VALUES
('9999911111', 1, 'ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gr002det_user`
--

DROP TABLE IF EXISTS `gr002det_user`;
CREATE TABLE `gr002det_user` (
  `k_identi` varchar(15) NOT NULL,
  `k_serie` int(10) NOT NULL,
  `n_name` varchar(100) NOT NULL,
  `n_lastname` varchar(100) DEFAULT NULL,
  `v_phone` varchar(20) NOT NULL,
  `n_address` varchar(100) NOT NULL,
  `n_mail` varchar(100) NOT NULL,
  `k_rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gr002det_user`
--

INSERT INTO `gr002det_user` (`k_identi`, `k_serie`, `n_name`, `n_lastname`, `v_phone`, `n_address`, `n_mail`, `k_rol`) VALUES
('9999911111', 2, 'ADMIN', 'ADMIN', '7777', 'ADMIN', 'ADMIN', 'ADM'),
('1006450322', 3, 'Especial', 'PROVEEDOR', '3333', 'fffff', 'dadadad@gmail.com', 'PROV'),
('100645025', 7, 'Davith', 'Fernandez', '3232323232', 'dadadadad', 'dadadad@gmail.com', 'ADM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gr003m_rol`
--

DROP TABLE IF EXISTS `gr003m_rol`;
CREATE TABLE `gr003m_rol` (
  `k_rol` varchar(10) NOT NULL,
  `n_rol` varchar(20) NOT NULL,
  `n_param_cap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gr003m_rol`
--

INSERT INTO `gr003m_rol` (`k_rol`, `n_rol`, `n_param_cap`) VALUES
('ADM', 'Administrador', '1,2,3,4'),
('PROV', 'Proveedor', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pr005m_prod`
--

DROP TABLE IF EXISTS `pr005m_prod`;
CREATE TABLE `pr005m_prod` (
  `relative` int(11) NOT NULL,
  `k_refprod` varchar(20) DEFAULT NULL,
  `prefijo` varchar(20) NOT NULL,
  `n_name_prod` varchar(100) NOT NULL,
  `n_desc_prod` varchar(100) NOT NULL,
  `n_brand` varchar(50) NOT NULL,
  `v_cant` int(3) NOT NULL,
  `v_valor_prod` float(18,2) NOT NULL,
  `k_prov_prod` varchar(15) NOT NULL,
  `k_identi_add` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pr005m_prod`
--

INSERT INTO `pr005m_prod` (`relative`, `k_refprod`, `prefijo`, `n_name_prod`, `n_desc_prod`, `n_brand`, `v_cant`, `v_valor_prod`, `k_prov_prod`, `k_identi_add`) VALUES
(23, 'PNT023', 'PAT', 'PROD-TEST-2', 'PROD-TEST-2', 'PROD-TEST-2', 2, 30000.00, '1006450322', '9999911111');

--
-- Disparadores `pr005m_prod`
--
DROP TRIGGER IF EXISTS `pr005m_prod_REF`;
DELIMITER $$
CREATE TRIGGER `pr005m_prod_REF` BEFORE INSERT ON `pr005m_prod` FOR EACH ROW BEGIN
    SET NEW.k_refprod = CONCAT((SELECT prefijo FROM `pr005m_prod` ORDER BY 1 DESC LIMIT 1), LPAD((SELECT relative FROM `pr005m_prod` ORDER BY 1 DESC LIMIT 1)+1, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vt006m_sale`
--

DROP TABLE IF EXISTS `vt006m_sale`;
CREATE TABLE `vt006m_sale` (
  `k_idsale` int(20) NOT NULL,
  `v_sale_total` float(18,2) NOT NULL,
  `k_identi_vent` varchar(15) NOT NULL,
  `f_sale` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vt006m_sale`
--

INSERT INTO `vt006m_sale` (`k_idsale`, `v_sale_total`, `k_identi_vent`, `f_sale`) VALUES
(1, 1200.00, '9999911111', '2022-10-05'),
(2, 2400.00, '9999911111', '2022-10-05'),
(3, 30000.00, '9999911111', '2022-10-05'),
(4, 243600.00, '9999911111', '2022-10-05'),
(5, 30000.00, '9999911111', '2022-10-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vt007d_sale`
--

DROP TABLE IF EXISTS `vt007d_sale`;
CREATE TABLE `vt007d_sale` (
  `k_serie` int(10) NOT NULL,
  `k_idsale` int(20) NOT NULL,
  `k_refprod` varchar(20) NOT NULL,
  `v_cant_prod` int(3) NOT NULL,
  `v_total_prod_cant` float(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vt007d_sale`
--

INSERT INTO `vt007d_sale` (`k_serie`, `k_idsale`, `k_refprod`, `v_cant_prod`, `v_total_prod_cant`) VALUES
(1, 1, 'PNT001', 1, 1200.00),
(2, 2, 'PNT001', 1, 1200.00),
(3, 2, 'BCB001', 1, 1200.00),
(4, 3, 'PNT018', 1, 30000.00),
(5, 4, 'BCB001', 1, 1200.00),
(6, 4, 'PNT016', 2, 2400.00),
(7, 4, 'PNT017', 3, 90000.00),
(8, 4, 'PNT018', 2, 60000.00),
(9, 4, 'PNT019', 3, 90000.00),
(10, 5, 'PNT023', 1, 30000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vt008fac_sale`
--

DROP TABLE IF EXISTS `vt008fac_sale`;
CREATE TABLE `vt008fac_sale` (
  `k_numdoc` varchar(20) NOT NULL,
  `k_idsale` varchar(20) NOT NULL,
  `n_name_fac` varchar(100) NOT NULL,
  `f_date_fac` date NOT NULL,
  `v_total_fac` float(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `db004dm_domains`
--
ALTER TABLE `db004dm_domains`
  ADD PRIMARY KEY (`domain_name`,`n_code`) USING BTREE,
  ADD UNIQUE KEY `db004dm_domains_key` (`n_code`);

--
-- Indices de la tabla `gr001m_user_db`
--
ALTER TABLE `gr001m_user_db`
  ADD PRIMARY KEY (`k_serie`),
  ADD KEY `gr002det_user_fk_gr001m_user_db` (`k_identi`);

--
-- Indices de la tabla `gr002det_user`
--
ALTER TABLE `gr002det_user`
  ADD PRIMARY KEY (`k_serie`),
  ADD UNIQUE KEY `gr002det_k_identi_UNIQUE` (`k_identi`),
  ADD KEY `gr003m_rol_fk_gr002det_user` (`k_rol`);

--
-- Indices de la tabla `gr003m_rol`
--
ALTER TABLE `gr003m_rol`
  ADD PRIMARY KEY (`k_rol`);

--
-- Indices de la tabla `pr005m_prod`
--
ALTER TABLE `pr005m_prod`
  ADD PRIMARY KEY (`relative`) USING BTREE,
  ADD UNIQUE KEY `REFPROD_UNIQUE` (`k_refprod`),
  ADD KEY `gr002det_user_fk_pr005m_prod1` (`k_prov_prod`),
  ADD KEY `gr002det_user_fk_pr005m_prod2` (`k_identi_add`),
  ADD KEY `db004dm_domains_name_fk_pr005m_prod2` (`prefijo`);

--
-- Indices de la tabla `vt006m_sale`
--
ALTER TABLE `vt006m_sale`
  ADD PRIMARY KEY (`k_idsale`),
  ADD KEY `gr002det_user_fk_vt006m_sale1` (`k_identi_vent`);

--
-- Indices de la tabla `vt007d_sale`
--
ALTER TABLE `vt007d_sale`
  ADD PRIMARY KEY (`k_serie`),
  ADD KEY `vt_006m_sale_fk_vt_007d_sale` (`k_idsale`);

--
-- Indices de la tabla `vt008fac_sale`
--
ALTER TABLE `vt008fac_sale`
  ADD PRIMARY KEY (`k_numdoc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gr001m_user_db`
--
ALTER TABLE `gr001m_user_db`
  MODIFY `k_serie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gr002det_user`
--
ALTER TABLE `gr002det_user`
  MODIFY `k_serie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pr005m_prod`
--
ALTER TABLE `pr005m_prod`
  MODIFY `relative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `vt006m_sale`
--
ALTER TABLE `vt006m_sale`
  MODIFY `k_idsale` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vt007d_sale`
--
ALTER TABLE `vt007d_sale`
  MODIFY `k_serie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gr001m_user_db`
--
ALTER TABLE `gr001m_user_db`
  ADD CONSTRAINT `gr002det_user_fk_gr001m_user_db` FOREIGN KEY (`k_identi`) REFERENCES `gr002det_user` (`k_identi`);

--
-- Filtros para la tabla `gr002det_user`
--
ALTER TABLE `gr002det_user`
  ADD CONSTRAINT `gr003m_rol_fk_gr002det_user` FOREIGN KEY (`k_rol`) REFERENCES `gr003m_rol` (`k_rol`);

--
-- Filtros para la tabla `gr003m_rol`
--
ALTER TABLE `gr003m_rol`
  ADD CONSTRAINT `gr003m_rol_db004dm_domains` FOREIGN KEY (`k_rol`) REFERENCES `db004dm_domains` (`n_code`);

--
-- Filtros para la tabla `pr005m_prod`
--
ALTER TABLE `pr005m_prod`
  ADD CONSTRAINT `db004dm_domains_name_fk_pr005m_prod2` FOREIGN KEY (`prefijo`) REFERENCES `db004dm_domains` (`n_code`),
  ADD CONSTRAINT `gr002det_user_fk_pr005m_prod1` FOREIGN KEY (`k_prov_prod`) REFERENCES `gr002det_user` (`k_identi`),
  ADD CONSTRAINT `gr002det_user_fk_pr005m_prod2` FOREIGN KEY (`k_identi_add`) REFERENCES `gr002det_user` (`k_identi`);

--
-- Filtros para la tabla `vt006m_sale`
--
ALTER TABLE `vt006m_sale`
  ADD CONSTRAINT `gr002det_user_fk_vt006m_sale1` FOREIGN KEY (`k_identi_vent`) REFERENCES `gr002det_user` (`k_identi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
