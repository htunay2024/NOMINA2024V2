<?php
require_once 'UsuarioODB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['Correo'];
    $contrasena = $_POST['Contrasena'];

    $usuario = UsuarioODB::autenticarUsuario($correo, $contrasena);

    if ($usuario) {
        session_start();
        $_SESSION['usuario'] = $usuario;

        if ($usuario->getRol() === 'Administrador') {
            header('Location: ../Views/index1.php');
        } else {
            header('Location: ../Views/index2.php');
        }
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>
