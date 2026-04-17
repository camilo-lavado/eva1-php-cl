<?php
require_once './Models/Candidatos.php';

class CandidatosController
{
    public function listarCandidatos()
    {
        header('Content-Type: application/json');
        try {
            $candidatos = new Candidatos();
            $candidatosList = $candidatos->getCandidates();
            return json_encode($candidatosList);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function obtenerCandidato()
    {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $candidatos = new Candidatos();
            $candidato = $candidatos->getCandidateById($id);
            if ($candidato) {
                return json_encode(["status" => "success", "data" => $candidato]);
            }
            http_response_code(404);
            return json_encode(["status" => "error", "message" => "Candidato no encontrado"]);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function crearCandidato()
    {
        header('Content-Type: application/json');
        try {
            $nombres = $_POST['nombres'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            $telefono = $_POST['telefono'] ?? '';

            if (empty($nombres) || empty($email)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "Nombres y Email son obligatorios"]);
            }

            $candidatos = new Candidatos();
            if ($candidatos->emailExiste($email)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "El email ya está registrado"]);
            }

            $id = $candidatos->createCandidate($nombres, $apellidos, $email, $telefono);
            if ($id) {
                http_response_code(201);
                return json_encode(["status" => "success", "message" => "Candidato creado", "id" => $id]);
            }
            http_response_code(400);
            return json_encode(["status" => "error", "message" => "No se pudo crear el candidato"]);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function actualizarCandidato()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            $nombres = $_POST['nombres'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            $telefono = $_POST['telefono'] ?? '';

            if (empty($id) || empty($nombres) || empty($email)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "ID, nombres y email son obligatorios"]);
            }

            $candidatos = new Candidatos();
            if ($candidatos->emailExiste($email, $id)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "El email ya está registrado por otro candidato"]);
            }

            if ($candidatos->updateCandidate($id, $nombres, $apellidos, $email, $telefono)) {
                return json_encode(["status" => "success", "message" => "Candidato actualizado"]);
            }
            http_response_code(400);
            return json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function eliminarCandidato()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            if (empty($id)) {
                http_response_code(400);
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $candidatos = new Candidatos();
            if ($candidatos->deleteCandidate($id)) {
                return json_encode(["status" => "success", "message" => "Candidato eliminado"]);
            }
            http_response_code(400);
            return json_encode(["status" => "error", "message" => "No se pudo eliminar"]);
        } catch (Exception $e) {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
