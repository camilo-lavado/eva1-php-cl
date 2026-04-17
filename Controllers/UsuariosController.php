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
            http_response_code(400);
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
            http_response_code(401);
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
        http_response_code(400);
        return json_encode(["status" => "error", "message" => "No se pudo desactivar"]);
    }


    public function eliminarFisico()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            http_response_code(400);
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
            http_response_code(400);
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
            http_response_code(400);
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
            http_response_code(404);
            return json_encode([
                "status" => "error",
                "message" => "Usuario no encontrado"
            ]);
        }
    }

    public function crearUsuario()
    {
        header('Content-Type: application/json');
        try {
            $nombre = $_POST['nombre_usuario'] ?? '';
            $password = $_POST['password'] ?? '';
            $rol = $_POST['rol'] ?? 'ENTREVISTADOR';
            $entrevistador_id = $_POST['entrevistador_id'] ?? null;
            if ($entrevistador_id === "") $entrevistador_id = null;

            if (empty($nombre) || empty($password)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "Nombre de usuario y contraseña son obligatorios"]);
            }

            $usuariosModel = new Usuarios();
            if ($usuariosModel->nombreUsuarioExiste($nombre)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "El nombre de usuario ya está en uso"]);
            }

            $nuevoId = $usuariosModel->createUsuario($nombre, $password, $rol, $entrevistador_id);
            if ($nuevoId) {
                http_response_code(201);
                return json_encode(["status" => "success", "message" => "Usuario creado correctamente", "id" => $nuevoId]);
            }
            http_response_code(400);
            return json_encode(["status" => "error", "message" => "No se pudo crear el usuario"]);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function actualizarUsuario()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            $nombre = $_POST['nombre_usuario'] ?? '';
            $rol = $_POST['rol'] ?? '';
            $entrevistador_id = $_POST['entrevistador_id'] ?? null;

            if ($entrevistador_id === "") $entrevistador_id = null;

            if (empty($id) || empty($nombre) || empty($rol)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "ID, nombre y rol son obligatorios"]);
            }

            $usuariosModel = new Usuarios();
            if ($usuariosModel->nombreUsuarioExiste($nombre, $id)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "El nombre de usuario ya está en uso por otro registro"]);
            }

            if ($usuariosModel->updateUsuario($id, $nombre, $rol, $entrevistador_id)) {
                return json_encode(["status" => "success", "message" => "Usuario actualizado correctamente"]);
            }
            http_response_code(400);
            return json_encode(["status" => "error", "message" => "No se pudo actualizar el usuario"]);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
