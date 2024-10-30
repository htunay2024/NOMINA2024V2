<?php
require_once 'SQLSRVConnector.php';
require_once '../Model/Usuario.php';

class UsuarioODB {
    public static function autenticarUsuario($correo, $contrasena) {
        $db = SQLSRVConnector::getInstance()->getConnection();

        $query = "SELECT * FROM Usuarios WHERE Correo = :correo AND Contrasena = :contrasena";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData) {
            return new Usuario(
                $usuarioData['ID_Usuario'],
                $usuarioData['Correo'],
                $usuarioData['Contrasena'],
                $usuarioData['ID_Rol'],
                $usuarioData['Rol'],
                $usuarioData['Estado']
            );
        }
        return null;
    }
}
?>
