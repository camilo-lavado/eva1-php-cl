<?php
require_once './Config/Db.php';

class Entrevistadores
{
    private $db;
    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function getInterviewers()
    {
        try {
            $query = "SELECT * FROM Entrevistadores";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getInterviewerById($id)
    {
        try {
            $query = "SELECT * FROM Entrevistadores WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener el entrevistador: " . $e->getMessage());
        }
    }

    public function createInterviewer($nombres, $apellidos, $email, $especialidad)
    {
        try {
            $query = "INSERT INTO Entrevistadores (nombres, apellidos, email, especialidad) VALUES (:nombres, :apellidos, :email, :especialidad)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die("Error al crear el entrevistador: " . $e->getMessage());
        }
    }

    public function updateInterviewer($id, $nombres, $apellidos, $email, $especialidad)
    {
        try {
            $query = "UPDATE Entrevistadores SET nombres = :nombres, apellidos = :apellidos, email = :email, especialidad = :especialidad WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Error al actualizar el entrevistador: " . $e->getMessage());
        }
    }

    public function deleteInterviewer($id)
    {
        try {
            $query = "DELETE FROM Entrevistadores WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Error al eliminar el entrevistador: " . $e->getMessage());
        }
    }

    public function emailExiste($email, $excludeId = null)
    {
        try {
            $query = "SELECT id FROM Entrevistadores WHERE email = :email";
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
            die("Error al verificar el email: " . $e->getMessage());
        }
    }
}
