<?php
$peticion = $_GET['api'] ?? '';
switch ($peticion) {
    case 'listar_usuarios':
        require_once './Controllers/UsuariosController.php';
        $usuariosController = new UsuariosController();
        echo $usuariosController->listarUsuarios();
        break;
    case 'login':
        require_once './Controllers/UsuariosController.php';
        $usuariosController = new UsuariosController();
        echo $usuariosController->login();
        break;
    case 'obtener_usuario':
        require_once './Controllers/UsuariosController.php';
        $usuariosController = new UsuariosController();
        echo $usuariosController->obtenerUsuario();
        break;
    case 'eliminar_usuario_permanente':
        require_once './Controllers/UsuariosController.php';
        $usuariosController = new UsuariosController();
        echo $usuariosController->eliminarFisico();
        break;
    case 'eliminar_usuario':
        require_once './Controllers/UsuariosController.php';
        $usuariosController = new UsuariosController();
        echo $usuariosController->eliminarLogico();
        break;
    default:
        echo json_encode(array('error' => 'Ruta no encontrada'));
}
