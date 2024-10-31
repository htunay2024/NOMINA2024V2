<?php
require_once '../Model/Usuario.php';
require_once '../Controller/Usuario_C.php';

$usuarioDB = new Usuario_C ();
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
                <li><a href="usuarios.php">Nuevo</a></li>
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
                            <td><?php echo htmlspecialchars($usuario->getID_Usuario()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getCorreo()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getRol()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getEstado() == 1 ? 'Activo' : 'Inactivo'); ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?php echo $usuario->getID_Usuario(); ?>" class="btn btn-editar">Editar</a>
                                <a href="eliminar_usuario.php?id=<?php echo $usuario->getID_Usuario(); ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> T Consulting 2024</p>
    </footer>
</body>

</html>
