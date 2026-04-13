<?php
require_once './Models/Entrevistadores.php';

class EntrevistadoresController
{
    public function listarEntrevistadores()
    {
        header('Content-Type: application/json');
        try {
            $entrevistadores = new Entrevistadores();
            $entrevistadoresList = $entrevistadores->getInterviewers();
            return json_encode($entrevistadoresList);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function obtenerEntrevistador()
    {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $entrevistadores = new Entrevistadores();
            $entrevistador = $entrevistadores->getInterviewerById($id);
            if ($entrevistador) {
                return json_encode(["status" => "success", "data" => $entrevistador]);
            }
            return json_encode(["status" => "error", "message" => "Entrevistador no encontrado"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function crearEntrevistador()
    {
        header('Content-Type: application/json');
        try {
            $nombres = $_POST['nombres'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            $especialidad = $_POST['especialidad'] ?? '';

            if (empty($nombres) || empty($email)) {
                return json_encode(["status" => "error", "message" => "Nombres y Email son obligatorios"]);
            }

            $entrevistadores = new Entrevistadores();
            if ($entrevistadores->emailExiste($email)) {
                return json_encode(["status" => "error", "message" => "El email ya está registrado"]);
            }

            $id = $entrevistadores->createInterviewer($nombres, $apellidos, $email, $especialidad);
            if ($id) {
                return json_encode(["status" => "success", "message" => "Entrevistador creado", "id" => $id]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo crear el entrevistador"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function actualizarEntrevistador()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            $nombres = $_POST['nombres'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            $especialidad = $_POST['especialidad'] ?? '';

            if (empty($id) || empty($nombres) || empty($email)) {
                return json_encode(["status" => "error", "message" => "ID, nombres y email son obligatorios"]);
            }

            $entrevistadores = new Entrevistadores();
            if ($entrevistadores->emailExiste($email, $id)) {
                return json_encode(["status" => "error", "message" => "El email ya está registrado por otro entrevistador"]);
            }

            if ($entrevistadores->updateInterviewer($id, $nombres, $apellidos, $email, $especialidad)) {
                return json_encode(["status" => "success", "message" => "Entrevistador actualizado"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function eliminarEntrevistador()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $entrevistadores = new Entrevistadores();
            if ($entrevistadores->deleteInterviewer($id)) {
                return json_encode(["status" => "success", "message" => "Entrevistador eliminado"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo eliminar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
