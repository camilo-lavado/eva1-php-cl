<?php
require_once './Config/Db.php';

class Experiencias
{
    private $db;
    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function getExperiences()
    {
        try {
            $query = "SELECT * FROM Experiencias";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getExperienceById($id)
    {
        try {
            $query = "SELECT * FROM Experiencias WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function createExperience($candidato_id, $empresa, $cargo_ejercido, $meses_duracion)
    {
        try {
            $query = "INSERT INTO Experiencias (candidato_id, empresa, cargo_ejercido, meses_duracion) VALUES (:candidato_id, :empresa, :cargo_ejercido, :meses_duracion)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':candidato_id', $candidato_id);
            $stmt->bindParam(':empresa', $empresa);
            $stmt->bindParam(':cargo_ejercido', $cargo_ejercido);
            $stmt->bindParam(':meses_duracion', $meses_duracion);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function updateExperience($id, $candidato_id, $empresa, $cargo_ejercido, $meses_duracion)
    {
        try {
            $query = "UPDATE Experiencias SET candidato_id = :candidato_id, empresa = :empresa, cargo_ejercido = :cargo_ejercido, meses_duracion = :meses_duracion WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':candidato_id', $candidato_id);
            $stmt->bindParam(':empresa', $empresa);
            $stmt->bindParam(':cargo_ejercido', $cargo_ejercido);
            $stmt->bindParam(':meses_duracion', $meses_duracion);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function deleteExperience($id)
    {
        try {
            $query = "DELETE FROM Experiencias WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
