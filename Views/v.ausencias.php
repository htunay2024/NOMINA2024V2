<?php

require_once '../Model/Ausencia.php';
require_once '../Controller/C_Ausencia.php';

$ausenciaODB = new C_Ausencia();
$message = '';

// Verificar si se ha enviado un ID_Solicitud para eliminar
if (isset($_GET['ID_Solicitud'])) {
    $idSolicitud = $_GET['ID_Solicitud'];

    // Verificar si el ID_Solicitud es válido
    if (is_numeric($idSolicitud)) {
        // Llamar al método para eliminar la ausencia en el objeto de acceso a datos
        $ausenciaODB->delete($idSolicitud);
        // Redirigir con un parámetro de éxito
        header('Location: ' . $_SERVER['PHP_SELF'] . '?action=deleted');
        exit();
    } else {
        $message = 'ID de solicitud inválido.';
    }
}

// Obtener todas las ausencias para mostrar en la tabla
$ausencias = $ausenciaODB->getAll();

// Manejo de mensajes de éxito
if (isset($_GET['action']) && $_GET['action'] === 'deleted') {
    $message = 'La ausencia fue eliminada correctamente.';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Ausencias</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Ausencias</h1>
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
    <section class="Ausencias">
        <h2>Ausencias Registradas</h2>
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <table>
            <thead>
            <tr>
                <th class="text-wrap">Fecha Solicitud</>
                <th> Fecha Inicio </th>
                <th> Fecha Fin</>
                <th>Motivo</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th class="text-wrap">¿Hay Decuento?</th>
                <th>Descuento</th>
                <th>Empleado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ausencias as $ausencia) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($ausencia->getFechaSolicitud()); ?></td>
                    <td><?php echo htmlspecialchars($ausencia->getFechaInicio()); ?></td>
                    <td><?php echo htmlspecialchars($ausencia->getFechaFin()); ?></td>
                    <td class="text-wrap"><?php echo htmlspecialchars($ausencia->getMotivo()); ?></td>
                    <td class="text-wrap"><?php echo htmlspecialchars($ausencia->getDescripcion()); ?></td>
                    <td><?php echo htmlspecialchars($ausencia->getEstado()); ?></td>
                    <td><?php echo htmlspecialchars($ausencia->getCuentaSalario() ? 'Sí' : 'No'); ?></td>
                    <td><?php echo number_format($ausencia->getDescuento(), 2); ?></td>
                    <td <td class="text-wrap"><?php echo htmlspecialchars($ausencia->getNombreCompleto()); ?></td>
                    <td>
                        <div class="botones-acciones">
                            <a href="v.editar.ausencia.empleado.php?ID_Solicitud=<?php echo $ausencia->getIdSolicitud(); ?>" class="btn btn-editar">Editar</a>
                            <button class="btn btn-eliminar" data-id="<?php echo $ausencia->getIdSolicitud(); ?>">Eliminar</button>
                        </div>
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
    // Código para manejar los botones de eliminación
    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const ausenciaId = this.getAttribute('data-id');

            Swal.fire({
                text: "Seguro que quieres eliminar el registro, no podrás revertir esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `?ID_Solicitud=${ausenciaId}`;
                }
            });
        });
    });

    // Código para manejar el botón "Agregar Nueva Ausencia"
    const nuevaAusenciaButton = document.querySelector('.btn-nuevo');

    if (nuevaAusenciaButton) {
        nuevaAusenciaButton.addEventListener('click', function() {
            window.location.href = 'v.nueva.ausencia.php';
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
