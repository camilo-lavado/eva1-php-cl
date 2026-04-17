INSERT INTO `Cargos` (`titulo`, `departamento`, `estado`) VALUES
('Desarrollador Fullstack', 'Tecnología', 'ABIERTO'),
('Analista Contable', 'Finanzas', 'ABIERTO'),
('Ingeniero de Proyectos', 'Operaciones', 'CERRADO'),
('Ejecutivo Comercial', 'Ventas', 'ABIERTO');

INSERT INTO `Candidatos` (`nombres`, `apellidos`, `email`, `telefono`) VALUES
('Javier', 'Pavez Muñoz', 'javier.munoz@email.cl', '+56987554321'),
('Gonzalo', 'Tapia Rojo', 'g.tapia.r@gmail.com', '+56922345678'),
('Valeria', 'Soto Valdés', 'vale.soto@outlook.cl', '+56956544433'),
('Mauricio', 'Lagos Contreras', 'mlagos@vtr.net', '+56999687766');

INSERT INTO `Experiencias` (`candidato_id`, `empresa`, `cargo_ejercido`, `meses_duracion`) VALUES
(1, 'Banco Estado', 'Desarrollador Junior', 24),
(1, 'Cornershop', 'Software Engineer', 12),
(2, 'Codelco', 'Asistente Administrativo', 36),
(3, 'Falabella', 'Analista de Riesgo', 18),
(4, 'Sonda', 'Soporte Técnico', 48);

INSERT INTO `Entrevistadores` (`nombres`, `apellidos`, `email`, `especialidad`) VALUES
('Cristian', 'Fuenzalida', 'cfuenzalida@empresa.cl', 'Recursos Humanos'),
('Loreto', 'Aravena', 'laravena@empresa.cl', 'Tecnología'),
('Sebastián', 'Errázuriz', 'serrazuriz@empresa.cl', 'Finanzas');

INSERT INTO `Usuarios` (`nombre_usuario`, `password`, `rol`, `entrevistador_id`) VALUES
('admin_sistema', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ADMIN', NULL),
('l_aravena', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ENTREVISTADOR', 2),
('s_errazuriz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ENTREVISTADOR', 3);


INSERT INTO `Entrevistas` (`cargo_id`, `candidato_id`, `entrevistador_id`, `fecha_hora`, `estado`, `observaciones`) VALUES
(1, 1, 2, '2026-04-10 10:30:00', 'PROGRAMADA', 'Primera entrevista técnica via Meet'),
(2, 3, 3, '2026-04-11 15:00:00', 'PROGRAMADA', 'Revisión de casos contables'),
(1, 2, 2, '2026-04-05 09:00:00', 'REALIZADA', 'Candidato con buen perfil, pero falta manejo de Node.js');