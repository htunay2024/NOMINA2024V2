<?php

require_once '../Model/Poliza.php';
require_once '../Controller/C_Poliza.php';

$polizaContableODB = new C_Poliza();
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
