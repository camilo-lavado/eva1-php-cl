<?php
require_once './Models/Experiencias.php';

class ExperienciasController
{
    public function listarExperiencias()
    {
        header('Content-Type: application/json');
        try {
            $experiencias = new Experiencias();
            $experienciasList = $experiencias->getExperiences();
            return json_encode($experienciasList);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function obtenerExperiencia()
    {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $experiencias = new Experiencias();
            $experiencia = $experiencias->getExperienceById($id);
            if ($experiencia) {
                return json_encode(["status" => "success", "data" => $experiencia]);
            }
            return json_encode(["status" => "error", "message" => "Experiencia no encontrada"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function crearExperiencia()
    {
        header('Content-Type: application/json');
        try {
            $candidato_id = $_POST['candidato_id'] ?? '';
            $empresa = $_POST['empresa'] ?? '';
            $cargo_ejercido = $_POST['cargo_ejercido'] ?? '';
            $meses_duracion = $_POST['meses_duracion'] ?? '';

            if ($candidato_id === "") $candidato_id = null;

            if (empty($candidato_id) || empty($empresa) || empty($cargo_ejercido)) {
                return json_encode(["status" => "error", "message" => "Faltan campos obligatorios"]);
            }

            $experiencias = new Experiencias();
            $id = $experiencias->createExperience($candidato_id, $empresa, $cargo_ejercido, $meses_duracion);
            if ($id) {
                return json_encode(["status" => "success", "message" => "Experiencia creada", "id" => $id]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo crear la experiencia"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function actualizarExperiencia()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            $candidato_id = $_POST['candidato_id'] ?? '';
            $empresa = $_POST['empresa'] ?? '';
            $cargo_ejercido = $_POST['cargo_ejercido'] ?? '';
            $meses_duracion = $_POST['meses_duracion'] ?? '';

            if ($candidato_id === "") $candidato_id = null;

            if (empty($id) || empty($candidato_id) || empty($empresa) || empty($cargo_ejercido)) {
                return json_encode(["status" => "error", "message" => "Todos los campos obligatorios deben estar presentes"]);
            }

            $experiencias = new Experiencias();
            if ($experiencias->updateExperience($id, $candidato_id, $empresa, $cargo_ejercido, $meses_duracion)) {
                return json_encode(["status" => "success", "message" => "Experiencia actualizada"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function eliminarExperiencia()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $experiencias = new Experiencias();
            if ($experiencias->deleteExperience($id)) {
                return json_encode(["status" => "success", "message" => "Experiencia eliminada"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo eliminar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
