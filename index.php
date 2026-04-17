<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Allow: GET, POST, DELETE");


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
            case 'crear':
                echo $controller->crearUsuario();
                break;
            case 'actualizar':
                echo $controller->actualizarUsuario();
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

    case 'entrevistadores':
        require_once './Controllers/EntrevistadoresController.php';
        $controller = new EntrevistadoresController();
        switch ($accion) {
            case 'listar':
                echo $controller->listarEntrevistadores();
                break;
            case 'obtener':
                echo $controller->obtenerEntrevistador();
                break;
            case 'crear':
                echo $controller->crearEntrevistador();
                break;
            case 'actualizar':
                echo $controller->actualizarEntrevistador();
                break;
            case 'eliminar':
                echo $controller->eliminarEntrevistador();
                break;
        }
        break;

    case 'candidatos':
        require_once './Controllers/CandidatosController.php';
        $controller = new CandidatosController();
        switch ($accion) {
            case 'listar':
                echo $controller->listarCandidatos();
                break;
            case 'obtener':
                echo $controller->obtenerCandidato();
                break;
            case 'crear':
                echo $controller->crearCandidato();
                break;
            case 'actualizar':
                echo $controller->actualizarCandidato();
                break;
            case 'eliminar':
                echo $controller->eliminarCandidato();
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
            case 'obtener':
                echo $controller->obtenerCargo();
                break;
            case 'crear':
                echo $controller->crearCargo();
                break;
            case 'actualizar':
                echo $controller->actualizarCargo();
                break;
            case 'eliminar':
                echo $controller->eliminarCargo();
                break;
        }
        break;

    case 'entrevistas':
        require_once './Controllers/EntrevistasController.php';
        $controller = new EntrevistasController();
        switch ($accion) {
            case 'listar':
                echo $controller->listarEntrevistas();
                break;
            case 'obtener':
                echo $controller->obtenerEntrevista();
                break;
            case 'crear':
                echo $controller->crearEntrevista();
                break;
            case 'actualizar':
                echo $controller->actualizarEntrevista();
                break;
            case 'eliminar':
                echo $controller->eliminarEntrevista();
                break;
        }
        break;

    case 'experiencias':
        require_once './Controllers/ExperienciasController.php';
        $controller = new ExperienciasController();
        switch ($accion) {
            case 'listar':
                echo $controller->listarExperiencias();
                break;
            case 'obtener':
                echo $controller->obtenerExperiencia();
                break;
            case 'crear':
                echo $controller->crearExperiencia();
                break;
            case 'actualizar':
                echo $controller->actualizarExperiencia();
                break;
            case 'eliminar':
                echo $controller->eliminarExperiencia();
                break;
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Modelo no encontrado']);
}
