<?php
session_start();  // Iniciar la sesión para manejar los datos del usuario

require_once '../Model/Expediente.php';
require_once '../Controller/C_Expediente.php';
require_once '../Model/Empleado.php';

$expedienteODB = new C_Expediente();

// Verifica si ya se ha recibido el nombre del empleado desde una solicitud GET o una sesión
if (isset($_GET['nombreCompleto'])) {
    // Si se proporciona un nombre a través de GET, lo guardamos en la sesión
    $_SESSION['nombreCompleto'] = $_GET['nombreCompleto'];
}

$nombreCompleto = isset($_SESSION['nombreCompleto']) ? $_SESSION['nombreCompleto'] : null;
$idEmpleado = isset($_SESSION['ID_Empleado']) ? $_SESSION['ID_Empleado'] : null;

if ($nombreCompleto) {
    // Buscar expedientes por el nombre almacenado en la sesión
    $expedientes = $expedienteODB->buscarPorNombre($nombreCompleto);
} else {
    // Si no hay nombre aún, no buscamos ningún expediente
    $expedientes = [];
}

if (count($expedientes) > 0) {
    $expediente = $expedientes[0]; // Obtener el primer expediente, si existe
} else {
    $expediente = null; // No se encontraron expedientes
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['ID_Expediente'])) {
    $idExpediente = $_GET['ID_Expediente'];
    $expedienteODB->delete($idExpediente); // Llama a tu método de eliminación
    header("Location: v.Expediente.php?nombreCompleto=" . urlencode($nombreCompleto)); // Redirige a la lista de expedientes
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Expedientes</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Expedientes</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
</header>
<aside id="sideMenu">
        <nav>
            <ul>
                <li>
                    <a href="#">Recursos Humanos</a>
                    <ul>
                        <li><a href="v.empleados.php">Empleado</a></li>
                        <li><a href="v.usuarios.php">Usuario</a></li>
                        <li><a href="v.Expediente.php">Expediente</a></li>
                        <li><a href="v.ausencias.php">Permiso</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Pago de Nómina</a>
                    <ul>
                        <li><a href="v.nomina.php">Pagos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Contabilidad</a>
                    <ul>
                        <li><a href="v.horasextras.php">Horas Extras</a></li>
                        <li><a href="v.produccion.php">Bonificaciones por producción</a></li>
                        <li><a href="v.comisiones.php">Comisiones sobre ventas</a></li>
                        <li><a href="v.Poliza.php">Polizas Contables</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Prestamos</a>
                    <ul>
                        <li><a href="v.prestamo.php">Deuda de Prestamos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Tienda Solidaria</a>
                    <ul>
                        <li><a href="v.tienda.php">Registros de Tienda</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
<main>
    <div class="header-right">
        <button class="btn-buscar" onclick="buscarEmpleado()">Buscar</button>
    </div>
    <section class="Expedientes">
        <!-- Mostrar expedientes si se ha proporcionado el nombre del empleado -->
        <?php if ($nombreCompleto && count($expedientes) > 0): ?>
                <h2>Expedientes Registrados para: <?php echo htmlspecialchars($nombreCompleto); ?></h2>
                <h3>Visualización de Documentos</h3>
                <ul id="listaArchivos">
                    <?php foreach ($expedientes as $expediente) : ?>
                        <?php if ($expediente->getArchivo()) : ?>
                            <li>
                                <h4><?php echo htmlspecialchars($expediente->getTipoDocumento()); ?></h4>
                                <iframe src="<?php echo $expediente->getArchivo(); ?>" width="100%" height="600px"></iframe>

                                <!-- Botones Editar y Eliminar debajo del iframe -->
                                <div class="acciones-expediente">
                                    <a href="v.editar.expediente.php?ID_Expediente=<?php echo $expediente->getIdExpediente(); ?>" class="btn btn-editar">Editar</a>
                                    <button class="btn btn-eliminar" data-id="<?php echo $expediente->getIdExpediente(); ?>">Eliminar</button>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php elseif ($nombreCompleto): ?>
                <p>No se encontraron expedientes para el empleado <?php echo htmlspecialchars($nombreCompleto); ?>.</p>
            <?php endif; ?>
        </section>
</main>
<footer>
    <p>© 2024 TConsulting. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (!$nombreCompleto): ?>
        Swal.fire({
            title: 'Buscar Expedientes',
            text: 'Por favor, ingresa el nombre del empleado:',
            input: 'text',
            inputPlaceholder: 'Nombre Completo',
            showCancelButton: true,
            confirmButtonText: 'Buscar',
            cancelButtonText: 'Cancelar',
            preConfirm: (nombreCompleto) => {
                if (!nombreCompleto) {
                    Swal.showValidationMessage('Debes ingresar el nombre del empleado');
                }
                return nombreCompleto;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirige a la misma página con el nombre del empleado como parámetro GET
                window.location.href = `v.Expediente.php?nombreCompleto=${encodeURIComponent(result.value)}`;
            }
        });
        <?php endif; ?>
    });

    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const expedienteId = this.getAttribute('data-id');

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
                    window.location.href = `?ID_Expediente=${expedienteId}&action=delete`;
                }
            });
        });
    });

    function buscarEmpleado() {
        Swal.fire({
            title: 'Buscar Expedientes',
            text: 'Por favor, ingresa el nombre del empleado:',
            input: 'text',
            inputPlaceholder: 'Nombre Completo',
            showCancelButton: true,
            confirmButtonText: 'Buscar',
            cancelButtonText: 'Cancelar',
            preConfirm: (nombreCompleto) => {
                if (!nombreCompleto) {
                    Swal.showValidationMessage('Debes ingresar el nombre del empleado');
                }
                return nombreCompleto;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirige a la misma página con el nombre del empleado como parámetro GET
                window.location.href = `v.Expediente.php?nombreCompleto=${encodeURIComponent(result.value)}`;
            }
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
