<?php
require_once './Config/Db.php';

class Candidatos
{
    private $db;
    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function getCandidates()
    {
        try {
            $query = "SELECT * FROM Candidatos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getCandidateById($id)
    {
        try {
            $query = "SELECT * FROM Candidatos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function createCandidate($nombres, $apellidos, $email, $telefono)
    {
        try {
            $query = "INSERT INTO Candidatos (nombres, apellidos, email, telefono) VALUES (:nombres, :apellidos, :email, :telefono)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function updateCandidate($id, $nombres, $apellidos, $email, $telefono)
    {
        try {
            $query = "UPDATE Candidatos SET nombres = :nombres, apellidos = :apellidos, email = :email, telefono = :telefono WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function deleteCandidate($id)
    {
        try {
            $query = "DELETE FROM Candidatos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function emailExiste($email, $excludeId = null)
    {
        try {
            $query = "SELECT id FROM Candidatos WHERE email = :email";
            if ($excludeId) {
                $query .= " AND id != :excludeId";
            }
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            if ($excludeId) {
                $stmt->bindParam(':excludeId', $excludeId, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
