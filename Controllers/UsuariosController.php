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
}
