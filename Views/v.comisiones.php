<?php

require_once '../Model/Comisiones.php';
require_once '../Controller/Comisiones_C.php';

$comisionODB = new Comisiones_C ();

// Verificar si se ha enviado un ID_Comision para eliminar
if (isset($_GET['ID_Comision'])) {
    $idComision = $_GET['ID_Comision'];

    // Llamar al método para eliminar la comisión en el objeto de acceso a datos
    $comisionODB->delete($idComision);

    // Redirigir con un parámetro de éxito
    header('Location: ' . $_SERVER['PHP_SELF'] . '?action=deleted');
    exit();
}

// Obtener todas las comisiones para mostrar en la tabla
$comisiones = $comisionODB->getAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Comisiones</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Comisiones</h1>
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
    <section class="Comisiones">
        <h2>Comisiones Registradas</h2>
        <table>
            <thead>
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>Monto Ventas</th>
                <th>Porcentaje</th>
                <th>Comisión</th>
                <th>Nombre del Empleado</th>
                <th>No. Cuenta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($comisiones as $comision) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($comision->getMes()); ?></td>
                    <td><?php echo htmlspecialchars($comision->getAnio()); ?></td>
                    <td><?php echo htmlspecialchars($comision->getMontoVentas()); ?></td>
                    <td><?php echo htmlspecialchars($comision->getPorcentaje()); ?>%</td>
                    <td><?php echo htmlspecialchars($comision->getComision()); ?></td>
                    <td><?php echo htmlspecialchars($comision->getNombreCompleto()); ?></td>
                    <td><?php echo htmlspecialchars($comision->getCuentaContable()); ?></td>
                    <td>
                        <a href="v.editar.comisiones.php?ID_Comision=<?php echo $comision->getIDComision(); ?>" class="btn btn-editar">Editar</a>
                        <button class="btn btn-eliminar" data-id="<?php echo $comision->getIDComision(); ?>">Eliminar</button>
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
            const comisionId = this.getAttribute('data-id');

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
                    window.location.href = `?ID_Comision=${comisionId}`;
                }
            });
        });
    });

    const nuevoEmpleadoButton = document.querySelector('.btn-nuevo');

    if (nuevoEmpleadoButton) {
        nuevoEmpleadoButton.addEventListener('click', function() {
            window.location.href = 'v.nueva.comision.php';
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
