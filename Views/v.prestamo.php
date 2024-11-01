<?php

require_once '../Model/Prestamo.php';
require_once '../Controller/C_Prestamo.php';

$prestamoODB = new PrestamoODB();

// Verificar si se ha enviado un ID_Prestamo para eliminar
if (isset($_GET['ID_Prestamo'])) {
    $idPrestamo = $_GET['ID_Prestamo'];

    // Redirigir con un parámetro de éxito
    header('Location: ' . $_SERVER['PHP_SELF'] . '?action=deleted');
    exit();
}

// Obtener todos los préstamos para mostrar en la tabla
$prestamos = $prestamoODB->getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Préstamos</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Préstamos</h1>
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
    <section class="Prestamos">
        <h2>Préstamos Registrados</h2>
        <table>
            <thead>
            <tr>
                <th>Monto</th>
                <th>Cuotas</th>
                <th  class="text-wrap">Fecha de Inicio</th>
                <th  class="text-wrap">Cuotas Restantes</th>
                <th  class="text-wrap">Saldo Pendiente</th>
                <th>Nombre del Empleado</th>
                <th>No. Cuenta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($prestamos as $prestamo) : ?>
                <tr>
                    <td><?php echo number_format($prestamo->getMonto(), 2); ?></td>
                    <td><?php echo htmlspecialchars($prestamo->getCuotas()); ?></td>
                    <td><?php echo htmlspecialchars($prestamo->getFechaInicio()); ?></td>
                    <td><?php echo htmlspecialchars($prestamo->getCuotasRestantes()); ?></td>
                    <td><?php echo number_format($prestamo->getSaldoPendiente(), 2); ?></td>
                    <td><?php echo htmlspecialchars($prestamo->getNombreCompleto()); ?></td>
                    <td><?php echo htmlspecialchars($prestamo->getCuentaContable()); ?></td>
                    <td>
                        <a href="v.editar.prestamo.php?ID_Prestamo=<?php echo $prestamo->getIdPrestamo(); ?>" class="btn btn-editar">Editar</a>
                        <a href="v.RealizarPago.php?ID_Prestamo=<?php echo $prestamo->getIdPrestamo(); ?>" class="btn btn-editar">Realizar Pago</a>
                        <a href="v.HistorialPagosPrestamos.php?ID_Prestamo=<?php echo $prestamo->getIdPrestamo(); ?>" class="btn btn-buscar">Historial</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>© 2024 TConsulting. Todos los derechos reservados.</p>
</footer>

<script>
    const nuevoPrestamoButton = document.querySelector('.btn-nuevo');

    if (nuevoPrestamoButton) {
        nuevoPrestamoButton.addEventListener('click', function() {
            window.location.href = 'v.nuevo.prestamo.php';
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
