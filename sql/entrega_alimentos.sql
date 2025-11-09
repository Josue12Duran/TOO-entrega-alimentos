DROP DATABASE IF EXISTS entrega_alimentos;
CREATE DATABASE entrega_alimentos CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE entrega_alimentos;

-- =============================================
-- TABLAS DE CATÁLOGO
-- =============================================

-- TABLA Departamentos
CREATE TABLE ctl_departamentos (
id_departamento INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- TABLA Tipos de Alimentos
CREATE TABLE ctl_tipos_alimentos (
id_alimento INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- =============================================
-- TABLAS DE MANTENIMIENTO
-- =============================================

-- TABLA Centros Educativos
CREATE TABLE mnt_centros_educativos (
id_centro INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(200) NOT NULL,
id_departamento INT NOT NULL,
cantidad_estudiantes INT NOT NULL,
direccion VARCHAR(255) DEFAULT NULL,
UNIQUE(nombre, id_departamento),
FOREIGN KEY (id_departamento) REFERENCES ctl_departamentos(id_departamento) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA Responsables
CREATE TABLE mnt_responsables (
id_responsable INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(150) NOT NULL,
cargo VARCHAR(100) DEFAULT NULL,
telefono VARCHAR(30) DEFAULT NULL
) ENGINE=InnoDB;

-- TABLA Usuarios
CREATE TABLE mnt_usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
usuario VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
nombre_completo VARCHAR(150) DEFAULT NULL,
rol ENUM('admin','supervisor') DEFAULT 'supervisor'
) ENGINE=InnoDB;

-- TABLA Cronogramas
CREATE TABLE mnt_cronogramas (
id_cronograma INT AUTO_INCREMENT PRIMARY KEY,
id_centro INT NOT NULL,
id_alimento INT NOT NULL,
fecha_programada DATE NOT NULL,
cantidad_planificada INT NOT NULL,
observaciones VARCHAR(255) DEFAULT NULL,
FOREIGN KEY (id_centro) REFERENCES mnt_centros_educativos(id_centro) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (id_alimento) REFERENCES ctl_tipos_alimentos(id_alimento) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA Entregas
CREATE TABLE mnt_entregas (
id_entrega INT AUTO_INCREMENT PRIMARY KEY,
id_centro INT NOT NULL,
id_alimento INT NOT NULL,
id_responsable INT DEFAULT NULL,
fecha_entrega DATE NOT NULL,
cantidad_entregada INT NOT NULL,
observaciones VARCHAR(255) DEFAULT NULL,
FOREIGN KEY (id_centro) REFERENCES mnt_centros_educativos(id_centro) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (id_alimento) REFERENCES ctl_tipos_alimentos(id_alimento) ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (id_responsable) REFERENCES mnt_responsables(id_responsable) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;


-- =============================================
-- INSERCIÓN DE DATOS DE EJEMPLO
-- =============================================

-- DATOS: Departamentos
INSERT INTO ctl_departamentos (nombre) VALUES
('Ahuachapán'),('Santa Ana'),('Sonsonate'),('Chalatenango'),('La Libertad'),('San Salvador'),('Cuscatlán'),('La Paz'),('Cabañas'),('San Vicente'),('Usulután'),('San Miguel'),('Morazán'),('La Unión');

-- DATOS: Tipos de Alimentos
INSERT INTO ctl_tipos_alimentos (nombre) VALUES ('Leche'),('Arroz'),('Frijoles'),('Aceite');

-- DATOS: Centros Educativos
INSERT INTO mnt_centros_educativos (nombre, id_departamento, cantidad_estudiantes, direccion) VALUES
('Centro Escolar San José', 6, 320, 'Av. Principal #123'),
('Escuela Básica Libertad', 5, 210, 'Col. Reforma'),
('Instituto Nacional Chalatenango', 4, 450, 'Calle Central #5'),
('Escuela San Miguelito', 6, 120, 'Barrio El Mirador'),
('Centro Escolar La Esperanza', 5, 85, 'Cantón El Paraíso');

-- DATOS: Responsables
INSERT INTO mnt_responsables (nombre, cargo, telefono) VALUES
('María López','Directora','+503-7000-1111'),
('Juan Pérez','Encargado de Almacén','+503-7000-2222'),
('Ana Gómez','Auxiliar Logística','+503-7000-3333');

-- DATOS: Cronogramas
INSERT INTO mnt_cronogramas (id_centro, id_alimento, fecha_programada, cantidad_planificada, observaciones) VALUES
(1, 1, '2025-09-05', 320, 'Entrega mensual - septiembre'),
(1, 2, '2025-09-05', 320, 'Arroz para desayuno'),
(2, 3, '2025-09-07', 210, 'Frijoles racionados'),
(3, 1, '2025-09-10', 450, 'Leche especial'),
(4, 4, '2025-09-05', 120, 'Aceite para cocina'),
(5, 2, '2025-09-12', 85, 'Entrega quincenal');

-- DATOS: Entregas
INSERT INTO mnt_entregas (id_centro, id_alimento, id_responsable, fecha_entrega, cantidad_entregada, observaciones) VALUES
(1, 1, 1, '2025-09-05', 320, 'Entregado a tiempo'),
(1, 2, 2, '2025-09-06', 320, '1 día de retraso'),
(2, 3, 3, '2025-09-07', 200, 'Faltaron 10 raciones'),
(3, 1, 2, '2025-09-11', 450, '1 día de retraso'),
(4, 4, 1, '2025-09-05', 120, 'Ok'),
(1, 3, 3, '2025-09-20', 50, 'Entrega adicional');

-- DATOS: Usuarios
INSERT INTO mnt_usuarios (id, usuario, password, nombre_completo, rol) VALUES 
(1, 'admin', '$2y$10$3yRWW6IuHr0YvvnpdjuLxeBeLXpJTB0T6ZMs4nKgJfjO25eCYs7OO', 'Administrador', 'admin');

-- =============================================
-- VISTAS
-- =============================================

-- VISTA REPORTE ENTREGAS
CREATE OR REPLACE VIEW vista_reporte_entregas AS
SELECT e.id_entrega, ce.nombre AS centro_educativo, d.nombre AS departamento, ta.nombre AS tipo_alimento,
r.nombre AS responsable, e.fecha_entrega, e.cantidad_entregada, e.observaciones
FROM mnt_entregas e
JOIN mnt_centros_educativos ce ON e.id_centro = ce.id_centro
JOIN ctl_departamentos d ON ce.id_departamento = d.id_departamento
JOIN ctl_tipos_alimentos ta ON e.id_alimento = ta.id_alimento
LEFT JOIN mnt_responsables r ON e.id_responsable = r.id_responsable
ORDER BY e.fecha_entrega DESC;
