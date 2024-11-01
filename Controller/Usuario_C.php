<?php

require_once 'SQLSRVConnector.php';
require_once 'Model/Usuario.php';

class Usuario_C {
    private $connection;

    public function __construct() {
        $this->connection = SQLSRVConnector::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT
                    U.ID_Usuario, U.Correo, U.ID_Rol, U.Estado, R.Nombre AS Rol
                FROM Usuario U INNER JOIN Rol R ON U.ID_Rol = R.ID_Rol";
        $result = $this->connection->query($query);
        $usuarios = [];
        while ($row = $result->fetch()) {
            $usuario = new Usuario($row['ID_Usuario'], null, $row['Correo'], null, null, null, $row['ID_Rol']);
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    public function getById($id) {
        $query = "SELECT
                    U.ID_Usuario, U.Correo, U.Contrasena, U.ID_Rol, U.Estado, R.Nombre AS Rol
                FROM Usuario U INNER JOIN Rol R ON U.ID_Rol = R.ID_Rol
                WHERE U.ID_Usuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch();
        return new Usuario($row['ID_Usuario'], null, $row['Correo'], $row['Contrasena'], null, null, $row['ID_Rol']);
    }

    public function insert($usuario) {
        $query = "INSERT INTO Usuario (Correo, Contrasena, ID_Rol, Estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $usuario->getCorreo());
        $stmt->bindParam(2, $usuario->getPassword());
        $stmt->bindParam(3, $usuario->getIdRol());
        $stmt->bindParam(4, $usuario->getEstado());
        $stmt->execute();
    }

    public function update($usuario) {
        $query = "UPDATE Usuario SET Correo = ?, Contrasena = ?, ID_Rol = ?, Estado = ? WHERE ID_Usuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $usuario->getCorreo());
        $stmt->bindParam(2, $usuario->getPassword());
        $stmt->bindParam(3, $usuario->getIdRol());
        $stmt->bindParam(4, $usuario->getEstado());
        $stmt->bindParam(5, $usuario->getIdUsuario());
        $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM Usuario WHERE ID_Usuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

    public function login($usuario, $password) {
        $query = "EXEC ValidarUsuario :usuario, :password";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Usuario(
                $row['ID_Usuario'],
                $row['Usuario'],
                null,
                $row['Empresa'],
                $row['ID_Rol'],
                $row['ID_Empleado']
            );
        } else {
            return null;
        }
    }
}
?>
