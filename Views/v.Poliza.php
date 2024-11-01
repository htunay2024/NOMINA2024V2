<?php

require_once '../Model/Poliza.php';
require_once '../Controller/Poliza_C.php';

$polizaContableODB = new Poliza_C ();
$idPoliza = $_GET['ID_Poliza'] ?? null; // Verifica que este valor sea correcto

// Obtener todas las pólizas para mostrar en la tabla
$polizas = $polizaContableODB->getAll();

$poliza = null;
$descripcion = '';


if ($idPoliza) {
    $poliza = $polizaContableODB->getById($idPoliza);

    if ($poliza) {
        $descripcion = $poliza->getDescripcion(); // Solo accede si la póliza no es null
    } else {
        // Manejo de error si la póliza no fue encontrada
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Póliza no encontrada.',
                    icon: 'error'
                }).then(() => {
                    window.location.href = 'v.polizas.php';
                });
              </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pólizas Contables</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Pólizas Contables</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
</header>

<aside id="sideMenu">
        <nav>
            <ul>
                <li><a href="index1.php">Inicio</a></li>
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
                        <li><a href="v.HistorialPagos.php">Historial de Pagos</a></li>
                        <li><a href="v.HistorialPagosPrestamos.php">Pagos de Préstamos</a></li>
                        <li><a href="v.IGSS.php">IGSS</a></li>
                        <li><a href="v.INTECAP.php">INTECAP</a></li>
                        <li><a href="v.IRTRA.php">IRTRA</a></li>
                        <li><a href="v.nomina.php">Nómina General</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Contabilidad</a>
                    <ul>
                        <li><a href="v.horasextras.php">Horas Extras</a></li>
                        <li><a href="v.produccion.php">Bonificaciones por Producción</a></li>
                        <li><a href="v.comisiones.php">Comisiones sobre Ventas</a></li>
                        <li><a href="v.Poliza.php">Pólizas Contables</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Compras y Almacén</a>
                    <ul>
                        <li><a href="v.compra.php">Registro de Compras</a></li>
                        <li><a href="v.HistorialCompras.php">Historial de Compras</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Prestamos</a>
                    <ul>
                        <li><a href="v.prestamo.php">Deuda de Préstamos</a></li>
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
    <section class="Polizas">
        <h2>Pólizas Registradas</h2>
        <table>
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Nombre del Empleado</th>
                <th>No. Cuenta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($polizas as $poliza) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($poliza->getFecha()); ?></td>
                    <td><?php echo htmlspecialchars($poliza->getDescripcion()); ?></td>
                    <td><?php echo number_format($poliza->getMonto(), 2); ?></td>
                    <td><?php echo htmlspecialchars($poliza->getNombreCompleto()); ?></td>
                    <td><?php echo htmlspecialchars($poliza->getCuentaContable()); ?></td>
                    <td>
                        <a href="<?php
                        if (strpos($poliza->getDescripcion(), 'Comisión Sobre Ventas') !== false) {
                            echo "v.editar.poliza.php?ID_Poliza=" . $poliza->getIdPoliza();
                        } elseif (strpos($poliza->getDescripcion(), 'Bonificación por Producción') !== false) {
                            echo "PolizaProduccion.php?ID_Poliza=" . $poliza->getIdPoliza();
                        }
                        ?>" class="btn btn-editar">Ver</a>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleMenu() {
        const sideMenu = document.querySelector('aside');
        const mainContent = document.querySelector('main');
        sideMenu.classList.toggle('active');
        mainContent.classList.toggle('shifted');
    }
</script>
</body>

</html>
