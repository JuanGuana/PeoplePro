CREATE DATABASE IF NOT EXISTS peoplepro CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE peoplepro;

CREATE TABLE `areas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `foto_perfil` varchar(255) DEFAULT 'public/img/foto_perfil/default.png',
  `password` VARCHAR(255) NOT NULL,
  `rol` ENUM('usuario', 'admin') NOT NULL DEFAULT 'usuario',
  `area_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`area_id`) REFERENCES `areas`(`id`) ON DELETE SET NULL
);

CREATE TABLE `beneficios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_inicio` DATE DEFAULT NULL,
  `fecha_fin` DATE DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `capacitaciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `imagen_capacitacion` varchar(255) DEFAULT NULL,
  `fecha` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- CREATE TABLE `evaluaciones` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `nombre` VARCHAR(100) NOT NULL,
--   `descripcion` TEXT DEFAULT NULL,
--   `fecha` DATE NOT NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- );

CREATE TABLE `visitantes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) DEFAULT NULL,
  `documento` VARCHAR(20) DEFAULT NULL,
  `empresa` VARCHAR(100) DEFAULT NULL,
  `fecha_ingreso` DATETIME DEFAULT NULL,
  `fecha_salida` DATETIME DEFAULT NULL,
  `motivo` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `documentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `archivo` VARCHAR(255) NOT NULL,
  `usuario_id` INT NOT NULL,
  `fecha_subida` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `horarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `fecha_fin` DATE DEFAULT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `estado` VARCHAR(50) DEFAULT 'Activo',
  `observaciones` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `permisos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(50) NOT NULL,
  `usuario_id` INT NOT NULL,
  `estado` ENUM('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
  `fecha_inicio` DATE DEFAULT NULL,
  `fecha_fin` DATE DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);
