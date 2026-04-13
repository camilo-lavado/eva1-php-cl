<?php
require_once './Config/Db.php';

class Entrevistas
{
    private $db;
    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function getInterviews()
    {
        try {
            $query = "SELECT * FROM Entrevistas";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getInterviewById($id)
    {
        try {
            $query = "SELECT * FROM Entrevistas WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function createInterview($cargo_id, $candidato_id, $entrevistador_id, $fecha_hora, $estado, $observaciones)
    {
        try {
            $query = "INSERT INTO Entrevistas (cargo_id, candidato_id, entrevistador_id, fecha_hora, estado, observaciones) 
                      VALUES (:cargo_id, :candidato_id, :entrevistador_id, :fecha_hora, :estado, :observaciones)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':cargo_id', $cargo_id);
            $stmt->bindParam(':candidato_id', $candidato_id);
            $stmt->bindParam(':entrevistador_id', $entrevistador_id);
            $stmt->bindParam(':fecha_hora', $fecha_hora);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function updateInterview($id, $cargo_id, $candidato_id, $entrevistador_id, $fecha_hora, $estado, $observaciones)
    {
        try {
            $query = "UPDATE Entrevistas SET cargo_id = :cargo_id, candidato_id = :candidato_id, 
                      entrevistador_id = :entrevistador_id, fecha_hora = :fecha_hora, 
                      estado = :estado, observaciones = :observaciones WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':cargo_id', $cargo_id);
            $stmt->bindParam(':candidato_id', $candidato_id);
            $stmt->bindParam(':entrevistador_id', $entrevistador_id);
            $stmt->bindParam(':fecha_hora', $fecha_hora);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function deleteInterview($id)
    {
        try {
            $query = "DELETE FROM Entrevistas WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
