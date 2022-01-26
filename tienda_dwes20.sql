-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2021 a las 16:21:07
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_dwes20`
--
CREATE DATABASE IF NOT EXISTS `tienda_dwes20` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tienda_dwes20`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `codcat` varchar(5) NOT NULL,
  `nomcat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codcat`, `nomcat`) VALUES
('CAM', 'CAMISAS'),
('CAMT', 'CAMISETAS'),
('CHA', 'CHAQUETAS'),
('DEP', 'DEPORTIVOS'),
('TRAJ', 'TRAJES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `codpro` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `nompro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descpro` varchar(255) NOT NULL,
  `precio` decimal(3,2) NOT NULL,
  `codcat` varchar(5) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `stock` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codpro`, `nompro`, `descpro`, `precio`, `codcat`, `foto`, `stock`) VALUES
('1BLS', 'BLAZER', 'Chaqueta de vestir, se diferencia de esta por tener un corte más casual y algunos accesorios diferenciales como los botones', '9.50', 'CHA', 'chaquetas-blazer.jpg', 10),
('1CHA', 'CHAQUÉ', 'Traje de máxima etiqueta para el hombre. Se utiliza en eventos formales y ceremonias de día (para las noches se utiliza el frac).', '7.00', 'TRAJ', 'trajes-chaque.jpg', 15),
('1DAS', 'Prueba2', 'das', '3.00', 'CAMT', '', 0),
('1LEG', 'LEGGINGS', 'Prendas elásticas ajustadas que se usan sobre las piernas. A veces son complementadas con calentadores.', '8.90', 'DEP', 'deportivas-legging.jpg', 3),
('1PRU', '', 'sakñladks purbea', '4.00', 'CAMT', '', 0),
('1SDE', '', '', '4.00', 'DEP', 'skd.jpg', 0),
('1TAI', 'TAILORED', 'Imagina que compras una camisa de corte recto y la llevas a arreglar para que se adapte ligeramente a tu torso, pero sin marcarlo, entonces obtienes un tailored fit.', '9.99', 'CAM', 'camisas-tailoret.png', 9),
('1WEB', 'WEDDING', 'En Juego de Tronos, en Invernalia (capital del norte de los Siete Reinos y asentamiento de la casa Stark), ya no es el invierno el que llega (\"Winter is Coming\") sino la boda.', '2.00', 'CAMT', 'camisetas-wedding.jpeg', 17),
('2BIS', 'BISOUNOUR', 'Sol\'s 190 gr/m2: 100% algodón semipeinado, 24/S hilo Ring Spun de calidad superior. Algodón preencogido. Tapacosturas reforzado en el cuello. Diseño tubular', '4.80', 'CAMT', 'camisetas-bisounours.jpeg', 13),
('2CAZ', 'CAZADORA', 'Prenda cómoda y ligera que se cierra al frente generalmente con cremallera y lleva dos bolsillos frontales o laterales.', '9.90', 'CHA', 'chaquetas-cazadora.jpg', 14),
('2CUS', 'CUSTOM', 'Aquí, la cosa se sigue estrechando. Mantiene el largo de la camisa, pero todo se reduce: sisa, ancho de manga, contorno de pecho y tronco con el fin de resaltar la figura masculina.', '5.90', 'CAM', 'camisas-custom.jpg', 15),
('2QIP', 'QIPAO', 'Traje recto de una sola pieza. Antes llegaba hasta los pies, las mangas eran largas y no era ajustado. Se fabricaba de seda natural y llevaba unos cortes a los lados. Otro elemento distintivo era el cuello.', '9.99', 'TRAJ', 'trajes-qipao.jpg', 8),
('2SUD', 'SUDADERA', 'Es una prenda gruesa de algodón que se utiliza para hacer deporte.', '9.00', 'DEP', 'deportivas-sudadera.jpg', 11),
('3CAL', 'CALENTADOR', 'Prenda de lana que se introducen por las extremidades inferiores o superiores.', '8.50', 'DEP', 'deportivas-calentador.jpg', 15),
('3DIN', 'DINNER JACKET', 'Prenda cómoda y ligera de usar. Se cierra con uno o dos botones y siempre cuenta con solapas que pueden ser redondas o en punta para un aspecto más tradicional', '9.99', 'TRAJ', 'trajes-dinnerjacket.jpg', 3),
('3MAE', 'MAEL VINTAGE', 'Sol\'s 190 gr/m2: 100% algodón semipeinado, 24/S hilo Ring Spun de calidad superior. Algodón preencogido. Tapacosturas reforzado en el cuello. Diseño tubular.', '3.00', 'CAMT', 'camisetas-maelvintage.jpeg', 10),
('3PAR', 'PARKA', 'Prenda de abrigo impermeable con capucha, recubierta a menudo de piel natural o de imitación, para protegerse de las bajas temperaturas, de la lluvia y del viento', '8.60', 'CHA', 'chaquetas-parka.jpg', 4),
('3SLI', 'SLIM', 'Con el slim fit, el pecho se estrecha y el tronco se acorta. Además, la sisa y el ancho de mangas seguirán siendo ceñidos.', '8.50', 'CAM', 'camisas-slim.png', 3),
('4ABR', 'ABRIGO', 'Prenda de vestir que baja por debajo de las caderas, se abrocha al frente con botones y a veces también con cinturón', '9.99', 'CHA', 'chaquetas-abrigo.jpg', 12),
('4CHA', 'CHANDAL', 'Consiste en dos piezas: unos pantalones y una chaqueta o sudadera. La chaqueta se cierra con una cremallera frontal, lleva elásticos en los puños y dos bolsillos. También puede incorporar capucha.', '9.99', 'DEP', 'deportivas-chandal.jpg', 6),
('4CIN', 'CINQUANTA', 'Sol\'s 190 gr/m2: 100 cotó semi pentinat, 24/S fil Ring Spun de qualitat superior. Cotó pre-encongit. Tapacostures reforçat en el coll. Disseny tubular', '2.90', 'CAMT', 'camisetas-cinquanta.jpeg', 18),
('4CUE', 'CUELLO MAO', 'Formado por una tirilla recta cortada a contrahilo para que no ceda– y abotonado delante.', '6.70', 'TRAJ', 'trajes-cuellomao.jpeg', 18),
('4SUP', 'SUPERSLIM', 'La gente encontrará en este corte a su mayor aliado. Encaja en los hombros y recorre el cuerpo pegado a él como si se tratase de una segunda piel. Visualmente, los hombros se multiplican por 10 y las caderas se estrechan.', '9.20', 'CAM', 'camisas-superslim.jpg', 16),
('5DOB', 'DOBLE BOTON', 'Traje de doble botonadura se caracteriza por superponer sobre pecho y el vientre los dos extremos frontales de la chaqueta, abotonando la prenda con dos filas paralelas de botones.', '9.00', 'TRAJ', 'trajes-dobleboton.jpeg', 8),
('5GAB', 'GABARDINA', 'Tejido de algodón, lana o fibra sintética de consistencia trabajada y muy apretada, caracterizada por tener una cara lisa y una acanalada en diagonal.', '9.99', 'CHA', 'chaquetas-gabardina.jpg', 8),
('5LEO', 'LEO(LEGO)', 'Sol\'s 190 gr/m2: 100% algodón semipeinado, 24/S hilo Ring Spun de calidad superior. Algodón preencogido. Tapacosturas reforzado en el cuello. Diseño tubular.', '2.50', 'CAMT', 'camisetas-lego.jpeg', 17),
('5REG', 'REGULAR', 'Son quizá las más cómodas, la sisa es amplia y el ancho de la manga estándar (cubre el brazo sin ceñirlo), al igual que el del pecho', '4.70', 'CAM', 'camisas-regular.jpg', 8),
('5SHO', 'SHORTS', 'Una prenda de vestir usada tanto por hombres como por mujeres que cubre las piernas parcialmente, a partir de la cintura', '3.99', 'DEP', 'deportivas-shorts.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `USUARIO` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`USUARIO`, `PASSWORD`) VALUES
('admin', '$2y$10$wnM8PPr4TJRBopnjXOzoG.JRXdWf2PqxTr6LHO6QLhB3TvrgK5pbu'),
('cliente', '$2y$10$C9wMZx1NXMRo4ahhLadU5.pfq0ziv2behUHifxlcsDeL0PHf8EfgW'),
('jake', '$2y$10$JdIKtab5DE7BorqwCBcnbeLiQJ4brm3CbpZWevgNe8OGo37/3p4Ry');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codcat`),
  ADD UNIQUE KEY `nomcat` (`nomcat`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codpro`),
  ADD KEY `codcat` (`codcat`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`USUARIO`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`codcat`) REFERENCES `categorias` (`codcat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
