-- Base de datos: peoplepro
CREATE DATABASE IF NOT EXISTS peoplepro DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE peoplepro;

-- Tabla: areas
CREATE TABLE IF NOT EXISTS areas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: users
CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  rol ENUM('usuario','admin') NOT NULL DEFAULT 'usuario',
  area_id INT(11) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (area_id) REFERENCES areas(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: documentos
CREATE TABLE IF NOT EXISTS documentos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  archivo VARCHAR(255) NOT NULL,
  usuario_id INT(11) NOT NULL,
  fecha_subida DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: beneficios
CREATE TABLE IF NOT EXISTS beneficios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  fecha_inicio DATE,
  fecha_fin DATE,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: capacitaciones
CREATE TABLE IF NOT EXISTS capacitaciones (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  fecha DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: permisos
CREATE TABLE IF NOT EXISTS permisos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  tipo VARCHAR(50) NOT NULL,
  usuario_id INT(11) NOT NULL,
  estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente',
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: horarios
CREATE TABLE IF NOT EXISTS horarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  usuario_id INT(11) NOT NULL,
  fecha DATE NOT NULL,
  fecha_fin DATE DEFAULT NULL,
  hora_inicio TIME NOT NULL,
  hora_fin TIME NOT NULL,
  estado VARCHAR(50) DEFAULT 'Activo',
  observaciones TEXT DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: visitantes
CREATE TABLE IF NOT EXISTS visitantes (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100),
  documento VARCHAR(20),
  empresa VARCHAR(100),
  fecha_ingreso DATETIME,
  motivo TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: evaluaciones
CREATE TABLE IF NOT EXISTS evaluaciones (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  fecha DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
