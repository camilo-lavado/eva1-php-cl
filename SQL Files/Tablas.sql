CREATE TABLE `Cargos`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(255) NOT NULL,
    `departamento` VARCHAR(255) NOT NULL,
    `estado` VARCHAR(255) NOT NULL COMMENT 'ABIERTO / CERRADO'
);
CREATE TABLE `Candidatos`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombres` VARCHAR(255) NOT NULL,
    `apellidos` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `telefono` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Candidatos` ADD UNIQUE `candidatos_email_unique`(`email`);
CREATE TABLE `Experiencias`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `candidato_id` BIGINT NOT NULL,
    `empresa` VARCHAR(255) NOT NULL,
    `cargo_ejercido` VARCHAR(255) NOT NULL,
    `meses_duracion` INT NOT NULL
);
CREATE TABLE `Entrevistadores`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombres` VARCHAR(255) NOT NULL,
    `apellidos` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `especialidad` VARCHAR(255) NOT NULL
);
CREATE TABLE `Entrevistas`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `cargo_id` BIGINT NOT NULL,
    `candidato_id` BIGINT NOT NULL,
    `entrevistador_id` BIGINT NOT NULL,
    `fecha_hora` DATETIME NOT NULL,
    `estado` VARCHAR(255) NOT NULL COMMENT 'PROGRAMADA / REALIZADA / CANCELADA',
    `observaciones` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Experiencias` ADD CONSTRAINT `experiencias_candidato_id_foreign` FOREIGN KEY(`candidato_id`) REFERENCES `Candidatos`(`id`);
ALTER TABLE
    `Entrevistas` ADD CONSTRAINT `entrevistas_candidato_id_foreign` FOREIGN KEY(`candidato_id`) REFERENCES `Candidatos`(`id`);
ALTER TABLE
    `Entrevistas` ADD CONSTRAINT `entrevistas_cargo_id_foreign` FOREIGN KEY(`cargo_id`) REFERENCES `Cargos`(`id`);
ALTER TABLE
    `Entrevistas` ADD CONSTRAINT `entrevistas_entrevistador_id_foreign` FOREIGN KEY(`entrevistador_id`) REFERENCES `Entrevistadores`(`id`);

CREATE TABLE `Usuarios` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre_usuario` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `rol` ENUM('ADMIN', 'RECLUTADOR', 'ENTREVISTADOR') NOT NULL DEFAULT 'ENTREVISTADOR',
    `entrevistador_id` BIGINT UNSIGNED NULL,
    `ultimo_login` DATETIME NULL,
    `estado` TINYINT(1) NOT NULL DEFAULT 1,
    UNIQUE `usuarios_nombre_usuario_unique`(`nombre_usuario`),
    CONSTRAINT `usuarios_entrevistador_id_foreign` FOREIGN KEY(`entrevistador_id`) REFERENCES `Entrevistadores`(`id`) ON DELETE SET NULL
);