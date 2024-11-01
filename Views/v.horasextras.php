<?php
require_once '../Model/HorasExtras.php';
require_once '../Controller/C_HorasExtras.php';

$horasExtrasODB = new C_HorasExtras();

// Inicializar variables para mensajes
$message = '';

if (isset($_GET['ID_HoraExtra'])) {
    $idHoraExtra = $_GET['ID_HoraExtra'];

    // Verificar si el ID_HoraExtra es válido
    if (is_numeric($idHoraExtra)) {
        // Llamar al método para eliminar la hora extra en el objeto de acceso a datos
        $horasExtrasODB->delete($idHoraExtra);
        // Redirigir con un parámetro de éxito
        header('Location: ' . $_SERVER['PHP_SELF'] . '?action=deleted');
        exit();
    } else {
        $message = 'ID de hora extra inválido.';
    }
}

// Obtener todas las horas extras para mostrar en la tabla
$horasExtras = $horasExtrasODB->getAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Horas Extras</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Horas Extras</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
</header>
<aside id="sideMenu">
    <nav>
        <ul>
            <li><a href="index.php">INICIO</a></li>
            <li>
                <a href="#">RECURSOS HUMANOS</a>
                <ul>
                    <li><a href="v.empleados.php">EMPLEADO</a>
                        <ul>
                            <li><a href="v.nuevo.empleado.php">CREAR EMPLEADO</a></li>
                        </ul>
                    </li>
                    <li><a href="v.usuarios.php">USUARIOS</a>
                        <ul>
                            <li><a href="v.nuevo.usuario.php">CREAR USUARIO</a></li>
                        </ul>
                    </li>
                    <li><a href="v.Expediente.php">EXPEDIENTES</a>
                        <ul>
                            <li><a href="v.nuevo.expediente.php">AGREGAR DOCUMENTO</a></li>
                        </ul>
                    </li>
                    <li><a href="v.ausencias.php">PERMISOS</a>
                        <ul>
                            <li><a href="v.nueva.ausencia.php">NUEVO PERMISO</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">NOMINA</a>
                <ul>
                    <li><a href="#">PAGOS</a></li>
                    <li><a href="#">DEDUCCIONES</a></li>
                    <li><a href="#">BONIFICACIONES</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Contabilidad</a>
                <ul>
                    <li><a href="v.horasextras.php">HORAS EXTRAS</a>
                        <ul>
                            <li><a href="v.nueva.horasextras.php">NUEVO REGISTRO</a></li>
                        </ul>
                    </li>
                    <li><a href="v.produccion.php">BONIFICACIONES POR PRODUCCIÓN</a>
                        <ul>
                            <li><a href="v.nueva.produccion.php">NUEVA BONIFICACIÓN</a></li>
                        </ul>
                    </li>
                    <li><a href="v.comisiones.php">COMISIONES SOBRE VENTAS</a>
                        <ul>
                            <li><a href="v.nueva.comision.php">NUEVA COMISION</a></li>
                        </ul>
                    </li>
                    <li><a href="v.Poliza.php">POLIZAS CONTABLES</a></li>
                </ul>
            </li>
            <li>
                <a href="#">PRESTAMOS</a>
                <ul>
                    <li><a href="v.prestamo.php">DEUDAS DE PRESTAMOS</a></li>
                </ul>
            </li>
            <li>
                <a href="#">TIENDA SOLIDARIA</a>
                <ul>
                    <li><a href="v.tienda.php">REGISTROS DE TIENDA</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
<main>
    <section class="HorasExtras">
        <h2>Horas Extras Registradas</h2>
        <?php if ($message): ?>
            <div class="error-message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['action']) && $_GET['action'] === 'deleted'): ?>
            <div class="success-message">La hora extra ha sido eliminada correctamente.</div>
        <?php endif; ?>
        <table>
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora Normal</th>
                <th>Hora Doble</th>
                <th>Total Normal</th>
                <th>Total Doble</th>
                <th>Nombre Completo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($horasExtras as $horaExtra) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($horaExtra->getFecha()); ?></td>
                    <td><?php echo htmlspecialchars($horaExtra->getHoraNormal()); ?></td>
                    <td><?php echo htmlspecialchars($horaExtra->getHoraDoble()); ?></td>
                    <td><?php echo number_format($horaExtra->getTotalNormal(), 2); ?></td>
                    <td><?php echo number_format($horaExtra->getTotalDoble(), 2); ?></td>
                    <td><?php echo htmlspecialchars($horaExtra->getNombreCompleto()); ?></td>
                    <td>
                        <a href="v.editar.horasextras.php?ID_HoraExtra=<?php echo $horaExtra->getIDHoraExtra(); ?>" class="btn btn-editar">Editar</a>
                        <button class="btn btn-eliminar" data-id="<?php echo $horaExtra->getIDHoraExtra(); ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>&copy; 2024 TConsulting. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const horaExtraId = this.getAttribute('data-id');

            Swal.fire({
                text: "¿Seguro que quieres eliminar el registro? No podrás revertir esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `?ID_HoraExtra=${horaExtraId}`;
                }
            });
        });
    });

    const nuevaAusenciaButton = document.querySelector('.btn-nuevo');

    if (nuevaAusenciaButton) {
        nuevaAusenciaButton.addEventListener('click', function() {
            window.location.href = 'v.nueva.horasextras.php';
        });
    }

    function toggleMenu() {
        const sideMenu = document.querySelector('aside');
        const mainContent = document.querySelector('main');
        sideMenu.classList.toggle('active');
        mainContent.classList.toggle('shifted');
    }
</script>
</body>

</html>

