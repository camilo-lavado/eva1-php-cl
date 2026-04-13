<?php
require_once './Models/Cargos.php';

class CargosController
{
    public function listarCargos()
    {
        header('Content-Type: application/json');
        try {
            $cargos = new Cargos();
            $cargosList = $cargos->getCharges();
            return json_encode($cargosList);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function obtenerCargo()
    {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $cargos = new Cargos();
            $cargo = $cargos->getCargoById($id);
            if ($cargo) {
                return json_encode(["status" => "success", "data" => $cargo]);
            }
            return json_encode(["status" => "error", "message" => "Cargo no encontrado"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function crearCargo()
    {
        header('Content-Type: application/json');
        try {
            $titulo = $_POST['titulo'] ?? '';
            $departamento = $_POST['departamento'] ?? '';
            $estado = $_POST['estado'] ?? 'ABIERTO';

            if (empty($titulo) || empty($departamento)) {
                return json_encode(["status" => "error", "message" => "Título y Departamento son obligatorios"]);
            }

            $cargos = new Cargos();
            $id = $cargos->createCargo($titulo, $departamento, $estado);
            if ($id) {
                return json_encode(["status" => "success", "message" => "Cargo creado", "id" => $id]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo crear el cargo"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function actualizarCargo()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            $titulo = $_POST['titulo'] ?? '';
            $departamento = $_POST['departamento'] ?? '';
            $estado = $_POST['estado'] ?? '';

            if (empty($id) || empty($titulo) || empty($departamento) || empty($estado)) {
                return json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            }

            $cargos = new Cargos();
            if ($cargos->updateCargo($id, $titulo, $departamento, $estado)) {
                return json_encode(["status" => "success", "message" => "Cargo actualizado"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function eliminarCargo()
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? '';
            if (empty($id)) {
                return json_encode(["status" => "error", "message" => "ID no proporcionado"]);
            }
            $cargos = new Cargos();
            if ($cargos->deleteCargo($id)) {
                return json_encode(["status" => "success", "message" => "Cargo eliminado"]);
            }
            return json_encode(["status" => "error", "message" => "No se pudo eliminar"]);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}
