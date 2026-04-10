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
            die("Error al obtener los candidatos: " . $e->getMessage());
        }
    }
}
