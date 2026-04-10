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
            die("Error al obtener los Experiencias: " . $e->getMessage());
        }
    }
}
