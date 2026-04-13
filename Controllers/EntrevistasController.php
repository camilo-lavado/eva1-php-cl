<?php
require_once './Models/Entrevistas.php';

class EntrevistasController
{
    public function listarEntrevistas()
    {
        header('Content-Type: application/json');
        try {
            $entrevistas = new Entrevistas();
            $entrevistasList = $entrevistas->getInterviews();
            return json_encode($entrevistasList);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function obtenerEntrevista()
    {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $entrevistas = new Entrevistas();
            $entrevista = $entrevistas->getInterviewById($id);
            if ($entrevista) {
                return json_encode(["status" => "success", "data" => $entrevista]);
            }
            return json_encode(["status" => "error", "message" => "Entrevista no encontrada"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function crearEntrevista()
    {
        header('Content-Type: application/json');
        try {
            $cargo_id = $_POST['cargo_id'] ?? '';
            $candidato_id = $_POST['candidato_id'] ?? '';
            $entrevistador_id = $_POST['entrevistador_id'] ?? '';
            $fecha_hora = $_POST['fecha_hora'] ?? '';
            $estado = $_POST['estado'] ?? 'PROGRAMADA';
            $observaciones = $_POST['observaciones'] ?? '';
            if ($cargo_id === "") $cargo_id = null;
            if ($candidato_id === "") $candidato_id = null;
            if ($entrevistador_id === "") $entrevistador_id = null;

            if (empty($cargo_id) || empty($candidato_id) || empty($entrevistador_id) || empty($fecha_hora)) {
                return json_encode(["status" => "error", "message" => "Faltan campos obligatorios"]);
            }

            $entrevistas = new Entrevistas();
            $id = $entrevistas->createInterview($cargo_id, $candidato_id, $entrevistador_id, $fecha_hora, $estado, $observaciones);
            if ($id) {
                return json_encode(["status" => "success", "message" => "Entrevista creada", "id" => $id]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo crear la entrevista"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function actualizarEntrevista()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            $cargo_id = $_POST['cargo_id'] ?? '';
            $candidato_id = $_POST['candidato_id'] ?? '';
            $entrevistador_id = $_POST['entrevistador_id'] ?? '';
            $fecha_hora = $_POST['fecha_hora'] ?? '';
            $estado = $_POST['estado'] ?? '';
            $observaciones = $_POST['observaciones'] ?? '';

            if ($cargo_id === "") $cargo_id = null;
            if ($candidato_id === "") $candidato_id = null;
            if ($entrevistador_id === "") $entrevistador_id = null;

            if (empty($id) || empty($cargo_id) || empty($candidato_id) || empty($entrevistador_id) || empty($fecha_hora) || empty($estado)) {
                return json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            }

            $entrevistas = new Entrevistas();
            if ($entrevistas->updateInterview($id, $cargo_id, $candidato_id, $entrevistador_id, $fecha_hora, $estado, $observaciones)) {
                return json_encode(["status" => "success", "message" => "Entrevista actualizada"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function eliminarEntrevista()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $entrevistas = new Entrevistas();
            if ($entrevistas->deleteInterview($id)) {
                return json_encode(["status" => "success", "message" => "Entrevista eliminada"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo eliminar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
