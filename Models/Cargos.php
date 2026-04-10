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
            die("Error al obtener los cargos: " . $e->getMessage());
        }
    }
}
