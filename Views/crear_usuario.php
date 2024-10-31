<?php
require_once '../Controller/Usuario_C.php';
require_once '../Model/Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioDB = new Usuario_C();
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $idRol = $_POST["id_rol"];
    $estado = $_POST["estado"];

    $nuevoUsuario = new Usuario(null, null, $correo, $contrasena, '', null, $idRol);
    $usuarioDB->insert($nuevoUsuario);
    header("Location: v.usuarios.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>
<body>
    <header>
        <h1>Crear Nuevo Usuario</h1>
    </header>
    <main>
        <form action="crear_usuario.php" method="POST">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            
            <label for="id_rol">Rol:</label>
            <select id="id_rol" name="id_rol" required>
                <option value="1">Administrador</option>
                <option value="2">Empleado</option>
                <!-- Agregar opciones adicionales según los roles disponibles en la base de datos -->
            </select>
            
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
            
            <button type="submit">Crear Usuario</button>
        </form>
    </main>
</body>
</html>
