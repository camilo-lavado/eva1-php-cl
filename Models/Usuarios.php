<?php
require_once './Config/Db.php';
class Usuarios
{
    private $db;
    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function getUsers()
    {
        try {
            $query = "SELECT id, nombre_usuario, rol, entrevistador_id, ultimo_login, estado FROM Usuarios WHERE estado=1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener los usuarios: " . $e->getMessage());
        }
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM Usuarios WHERE nombre_usuario = :username AND estado = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $this->updateLastLogin($user['id']);

            unset($user['password']);
            return $user;
        }

        return false;
    }

    private function updateLastLogin($id)
    {
        $query = "UPDATE Usuarios SET ultimo_login = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteUser($id)
    {
        try {
            $query = "DELETE FROM Usuarios WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Error al eliminar al usuario: " . $e->getMessage());
        }
    }

    public function softDelete($id)
    {
        try {
            $query = "UPDATE Usuarios SET estado = 0 WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Error al desactivar al usuario: " . $e->getMessage());
        }
    }

    public function getUserById($id)
    {
        try {
            $query = "SELECT id, nombre_usuario, rol, entrevistador_id, ultimo_login, estado FROM Usuarios WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener el usuario: " . $e->getMessage());
        }
    }
}
