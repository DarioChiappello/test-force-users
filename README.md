# Force Users
## Darío Chiappello

## Comandos a ejecutar
### Clonar repositorio
git clone https://github.com/DarioChiappello/test-force-users.git


### Dentro del directorio del proyecto
composer install

-En el archivo .env se deben agregar credenciales (entre ellas el nombre de la base de datos)

## URL del API
https://agile-earth-51586.herokuapp.com/

## Ejecutar servicios por Postman

### Ejecutar servicio force-users por medio de una peticion post y dentro del body el string a validar
#### Ejemplo: 
https://agile-earth-51586.herokuapp.com/force-user


string={
"dna":["ATGCGA","CAGTGC","TTATGT","AGAAGG","CCCCTA","TCACTG"]
}

### Ejecutar servicio stats por medio de una peticion get
#### Ejemplo:
https://agile-earth-51586.herokuapp.com/stats



### En la base de datos que se quiera probar usar la siguiente con sulta para generar la siguiente tabla
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-07-2021 a las 22:26:10
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `force-users`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `json` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `forceUser` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
