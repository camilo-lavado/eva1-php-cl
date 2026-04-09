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
    default:
        echo json_encode(array('error' => 'Ruta no encontrada'));
}
