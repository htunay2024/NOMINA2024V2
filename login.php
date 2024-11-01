<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validación en PHP para restringir caracteres especiales
    if (!preg_match('/^[a-zA-Z0-9]*$/', $usuario) || !preg_match('/^[a-zA-Z0-9]*$/', $password)) {
        $error = "Usuario o contraseña contienen caracteres no permitidos.";
    } else {
        // Validar los usuarios "administrador" y "empleado" con sus contraseñas
        if ($usuario === 'administrador' && $password === '1234') {
            // Configurar la sesión y redirigir al index1.php para Administrador
            $_SESSION['usuario_nombre'] = $usuario;
            $_SESSION['rol'] = 'administrador';
            header("Location: Views/index1.php");
            exit();
        } elseif ($usuario === 'empleado' && $password === '5678') {
            // Configurar la sesión y redirigir al index2.php para Empleado
            $_SESSION['usuario_nombre'] = $usuario;
            $_SESSION['rol'] = 'empleado';
            header("Location: Views/index2.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="Styles/login.css">
</head>
<body>
<div class="square"></div>
<div class="content">

</div>

<!-- Aside para el formulario de inicio de sesión -->
<aside class="login-aside active"> <!-- Clase "active" añadida para mostrar el formulario de inmediato -->
    <h2>Iniciar Sesión</h2>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required pattern="[a-zA-Z0-9]*">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required pattern="[a-zA-Z0-9]*">
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
</aside>
</body>
</html>
