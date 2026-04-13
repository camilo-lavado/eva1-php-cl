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
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function obtenerCandidato()
    {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $candidatos = new Candidatos();
            $candidato = $candidatos->getCandidateById($id);
            if ($candidato) {
                return json_encode(["status" => "success", "data" => $candidato]);
            }
            return json_encode(["status" => "error", "message" => "Candidato no encontrado"]);
        } catch (Exception $e) {
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
                return json_encode(["status" => "error", "message" => "Nombres y Email son obligatorios"]);
            }

            $candidatos = new Candidatos();
            if ($candidatos->emailExiste($email)) {
                return json_encode(["status" => "error", "message" => "El email ya está registrado"]);
            }

            $id = $candidatos->createCandidate($nombres, $apellidos, $email, $telefono);
            if ($id) {
                return json_encode(["status" => "success", "message" => "Candidato creado", "id" => $id]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo crear el candidato"]);
        } catch (Exception $e) {
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
                return json_encode(["status" => "error", "message" => "ID, nombres y email son obligatorios"]);
            }

            $candidatos = new Candidatos();
            if ($candidatos->emailExiste($email, $id)) {
                return json_encode(["status" => "error", "message" => "El email ya está registrado por otro candidato"]);
            }

            if ($candidatos->updateCandidate($id, $nombres, $apellidos, $email, $telefono)) {
                return json_encode(["status" => "success", "message" => "Candidato actualizado"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function eliminarCandidato()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $candidatos = new Candidatos();
            if ($candidatos->deleteCandidate($id)) {
                return json_encode(["status" => "success", "message" => "Candidato eliminado"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo eliminar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
