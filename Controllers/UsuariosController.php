<?php
require_once './Models/Usuarios.php';

class UsuariosController
{
    public function listarUsuarios()
    {
        header('Content-Type: application/json');
        $usuarios = new Usuarios();
        $usuariosList = $usuarios->getUsers();
        return json_encode($usuariosList);
    }

    public function login()
    {
        header('Content-Type: application/json');
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            return json_encode([
                "status" => "error",
                "message" => "Faltan Credenciales"
            ]);
        }

        $usuariosModel = new Usuarios();
        $user = $usuariosModel->login($username, $password);

        if ($user) {
            $respuesta = [
                "status" => "success",
                "user" => [
                    "id" => $user['id'],
                    "nombre_usuario" => $user['nombre_usuario'],
                    "rol" => $user['rol'],
                    "entrevistador_id" => $user['entrevistador_id']
                ]
            ];
            return json_encode($respuesta);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Usuario o Password Incorrectas"
            ]);
        }
    }

    public function eliminarLogico()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'] ?? '';

        $usuariosModel = new Usuarios();
        if ($usuariosModel->softDelete($id)) {
            return json_encode(["status" => "success", "message" => "Usuario desactivado"]);
        }
        return json_encode(["status" => "error", "message" => "No se pudo desactivar"]);
    }


    public function eliminarFisico()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            return json_encode([
                "status" => "error",
                "message" => "ID no proporcionado"
            ]);
        }

        $usuariosModel = new Usuarios();

        if ($usuariosModel->deleteUser($id)) {
            return json_encode([
                "status" => "success",
                "message" => "Usuario eliminado permanentemente"
            ]);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "No se pudo eliminar: El usuario no existe o tiene registros asociados (entrevistas, etc)"
            ]);
        }
    }
    public function obtenerUsuario()
    {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? '';

        if (empty($id)) {
            return json_encode([
                "status" => "error",
                "message" => "ID de usuario no proporcionado"
            ]);
        }

        $usuariosModel = new Usuarios();
        $user = $usuariosModel->getUserById($id);
        if ($user) {
            return json_encode([
                "status" => "success",
                "user" => $user
            ]);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Usuario no encontrado"
            ]);
        }
    }
}
