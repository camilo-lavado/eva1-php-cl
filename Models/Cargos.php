<?php
require_once './Config/Db.php';

class Cargos
{
    private $db;
    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function getCharges()
    {
        try {
            $query = "SELECT * FROM Cargos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getCargoById($id)
    {
        try {
            $query = "SELECT * FROM Cargos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el cargo: " . $e->getMessage());
        }
    }

    public function createCargo($titulo, $departamento, $estado)
    {
        try {
            $query = "INSERT INTO Cargos (titulo, departamento, estado) VALUES (:titulo, :departamento, :estado)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':departamento', $departamento);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error al crear el cargo: " . $e->getMessage());
        }
    }

    public function updateCargo($id, $titulo, $departamento, $estado)
    {
        try {
            $query = "UPDATE Cargos SET titulo = :titulo, departamento = :departamento, estado = :estado WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':departamento', $departamento);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el cargo: " . $e->getMessage());
        }
    }

    public function deleteCargo($id)
    {
        try {
            $query = "DELETE FROM Cargos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Tenía un problema con la eliminación de cargos, ya que tenía entrevistas asociadas.
            if ($e->getCode() == 23000) {
                throw new Exception("No se puede eliminar: el cargo tiene entrevistas asociadas.");
            }
            throw new Exception("Error al eliminar el cargo: " . $e->getMessage());
        }
    }
}
