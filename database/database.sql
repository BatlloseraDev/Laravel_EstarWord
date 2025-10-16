
-- -- Tabla `planetas`

-- CREATE TABLE  `planetas` (
--   `id` INT  NOT NULL AUTO_INCREMENT,
--   `nombre` VARCHAR(100) NOT NULL,
--   `periodo_rotacion` VARCHAR(50) NULL,
--   `poblacion` BIGINT NULL,
--   `clima` VARCHAR(100) NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- );

-- INSERT INTO `planetas` (`nombre`, `periodo_rotacion`, `poblacion`, `clima`) VALUES
-- ('Tatooine',23, 200000,'Arido'),
-- ('Alderaan',24,2000000000,'Templado');
-- -- Tabla `naves`

-- CREATE TABLE  `naves` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `planeta_id` INT  NOT NULL,
--   `nombre` VARCHAR(100) NOT NULL,
--   `modelo` VARCHAR(100) NOT NULL,
--   `tripulacion` INT  NULL,
--   `pasajeros` INT  NULL,
--   `clase_nave` VARCHAR(100) NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`),
--   CONSTRAINT `fk_naves_planetas` FOREIGN KEY (`planeta_id`) REFERENCES `planetas` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
-- );


-- -- Tabla `pilotos`

-- CREATE TABLE `pilotos` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `nombre` VARCHAR(100) NOT NULL,
--   `altura` INT  NULL,
--   `anio_nacimiento` VARCHAR(20) NULL,
--   `genero` VARCHAR(20) NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- );


-- -- Tabla `mantenimientos`

-- CREATE TABLE `mantenimientos` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `idnave` INT NOT NULL,
--   `fecha` DATE NOT NULL,
--   `descripcion` TEXT NULL,
--   `coste` DECIMAL(10, 2) NULL,
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`),
--   CONSTRAINT `fk_mantenimientos_naves` FOREIGN KEY (`idnave`) REFERENCES `naves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
-- );


-- -- Tabla Pivote `nave_piloto`


-- CREATE TABLE `nave_piloto` (
--   `nave_id` INT  NOT NULL,
--   `piloto_id` INT  NOT NULL,
--   `fecha_asociacion` DATE NOT NULL,
--   `fecha_fin_asociacion` DATE NULL, -- Puede ser NULL si el piloto sigue asociado
--   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,


--   PRIMARY KEY (`nave_id`, `piloto_id`, `fecha_asociacion`),

--   CONSTRAINT `fk_np_naves` FOREIGN KEY (`nave_id`) REFERENCES `naves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
--   CONSTRAINT `fk_np_pilotos` FOREIGN KEY (`piloto_id`) REFERENCES `pilotos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
-- );



