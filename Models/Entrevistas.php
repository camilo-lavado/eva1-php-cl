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
            die("Error al obtener los Entrevistas: " . $e->getMessage());
        }
    }
}
