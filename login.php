<?php
session_start();
require_once 'Control/Usuario_C.php';
require_once 'Modelos/Usuario.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validación en PHP para restringir caracteres especiales
    if (!preg_match('/^[a-zA-Z0-9]*$/', $usuario) || !preg_match('/^[a-zA-Z0-9]*$/', $password)) {
        $error = "Usuario o contraseña contienen caracteres no permitidos.";
    } else {
        $usuarioODB = new Usuario_C();
        $usuarioAutenticado = $Usuario_C->login($usuario, $password);

        if ($usuarioAutenticado) {
            $_SESSION['usuario_id'] = $usuarioAutenticado->getidUsuario();
            $_SESSION['usuario_nombre'] = $usuarioAutenticado->getCorreo();
            $_SESSION['rol'] = $usuarioAutenticado->getIdRol();
            header("Location: Views/index1.php");
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
    <script>
        // Función para mostrar u ocultar el aside de inicio de sesión
        function toggleLoginAside() {
            const loginAside = document.querySelector('.login-aside');
            loginAside.classList.toggle('active');
        }
    </script>
</head>
<body>
<div class="square"></div>
<div class="content">
    <h1>Bienvenido a TConsulting</h1>
</div>

<!-- Botón para redirigir a indexAdmon.php -->
<div style="text-align: center; margin-top: 20px;">
    <button onclick="window.location.href='/Views/index1.php'" style="padding: 10px 20px; font-size: 16px;">
        Ir a Página de Administración
    </button>
</div>

<!-- Aside para el formulario de inicio de sesión -->
<aside class="login-aside">
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
