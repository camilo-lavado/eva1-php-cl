<?php
header('Content-Type: application/json');

$modelo = $_GET['modelo'] ?? '';
$accion = $_GET['accion'] ?? '';

switch ($modelo) {
    case 'usuarios':
        require_once './Controllers/UsuariosController.php';
        $controller = new UsuariosController();

        switch ($accion) {
            case 'listar':
                echo $controller->listarUsuarios();
                break;
            case 'login':
                echo $controller->login();
                break;
            case 'obtener':
                echo $controller->obtenerUsuario();
                break;
            case 'eliminar_fisico':
                echo $controller->eliminarFisico();
                break;
            case 'eliminar':
                echo $controller->eliminarLogico();
                break;
            default:
                echo json_encode(['error' => 'Acción de usuario no válida']);
        }
        break;

    case 'candidatos':
        require_once './Controllers/CandidatosController.php';
        $controller = new CandidatosController();
        switch ($accion) {
            case 'listar':
                echo $controller->listarCandidatos();
                break;
        }
        break;

    case 'cargos':
        require_once './Controllers/CargosController.php';
        $controller = new CargosController();
        switch ($accion) {
            case 'listar':
                echo $controller->listarCargos();
                break;
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Modelo no encontrado']);
}
