<?php
require_once '../Model/Usuario.php';
require_once '../Controller/Usuario_C.php';

$usuarioDB = new Usuario_C();
$usuarios = $usuarioDB->getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>

<body>
    <header>
        <h1>Gestión de Usuarios</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#" class="active">Usuarios</a></li>
                <li><a href="crear_usuario.php">Nuevo Usuario</a></li> <!-- Enlace para crear un nuevo usuario -->
                <li><a href="roles.php">Roles</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="usuarios">
            <h2>Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario->getIdUsuario()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getCorreo()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getIdRol()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getEmpresa()); ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?php echo $usuario->getIdUsuario(); ?>">Editar</a>
                                <a href="eliminar_usuario.php?id=<?php echo $usuario->getIdUsuario(); ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
