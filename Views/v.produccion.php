<?php

require_once '../Model/Produccion.php';
require_once '../Controller/C_Produccion.php';

$produccionODB = new C_Produccion();

// Verificar si se ha enviado un ID_Produccion para eliminar
if (isset($_GET['ID_Produccion'])) {
    $idProduccion = $_GET['ID_Produccion'];

    // Llamar al método para eliminar la producción
    $produccionODB->borrarProduccion($idProduccion);

    // Redirigir con un parámetro de éxito
    header('Location: ' . $_SERVER['PHP_SELF'] . '?action=deleted');
    exit();
}

// Obtener todas las producciones para mostrar en la tabla
$producciones = $produccionODB->mostrarProduccion();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Producción</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Producción</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
</header>
    <aside id="sideMenu">
        <nav>
            <ul>
                <li><a href="index1.php">INICIO</a></li>
                
                <!-- Sección de Recursos Humanos -->
                <li>
                    <a href="#">RECURSOS HUMANOS</a>
                    <ul>
                        <li><a href="v.empleados.php">EMPLEADO</a>
                            <ul>
                                <li><a href="v.nuevo.empleado.php">CREAR EMPLEADO</a></li>
                                <li><a href="v.editar.empleado.php">EDITAR EMPLEADO</a></li>
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
                                <li><a href="v.editar.expediente.php">EDITAR DOCUMENTO</a></li>
                            </ul>
                        </li>
                        <li><a href="v.ausencias.php">PERMISOS</a>
                            <ul>
                                <li><a href="v.nueva.ausencia.php">NUEVO PERMISO</a></li>
                                <li><a href="v.editar.ausencia.empleado.php">EDITAR PERMISO</a></li>
                                <li><a href="V_AusenciaAutorizacion.php">AUTORIZAR PERMISO</a></li>
                            </ul>
                        </li>
                        <li><a href="v.familiar.php">FAMILIAR</a>
                            <ul>
                                <li><a href="v.nuevo.familiar.php">NUEVO FAMILIAR</a></li>
                                <li><a href="v.editar.familiar.php">EDITAR FAMILIAR</a></li>
                            </ul>
                        </li>
                        <li><a href="v.HistorialPagos.php">HISTORIAL DE PAGOS</a></li>
                        <li><a href="v.IGSS.php">IGSS</a></li>
                        <li><a href="v.INTECAP.php">INTECAP</a></li>
                        <li><a href="v.IRTRA.php">IRTRA</a></li>
                    </ul>
                </li>
                
                <!-- Sección de Nómina -->
                <li>
                    <a href="#">NOMINA</a>
                    <ul>
                        <li><a href="v.nomina.php">PAGOS</a>
                            <ul>
                                <li><a href="v.RealizarPago.php">REALIZAR PAGO</a></li>
                                <li><a href="v.nuevo.pago.php">NUEVO PAGO</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <!-- Sección de Contabilidad -->
                <li>
                    <a href="#">CONTABILIDAD</a>
                    <ul>
                        <li><a href="v.horasextras.php">HORAS EXTRAS</a>
                            <ul>
                                <li><a href="v.nueva.horasextras.php">NUEVO REGISTRO</a></li>
                                <li><a href="v.editar.horasextras.php">EDITAR REGISTRO</a></li>
                            </ul>
                        </li>
                        <li><a href="v.produccion.php">BONIFICACIONES POR PRODUCCIÓN</a>
                            <ul>
                                <li><a href="v.nueva.produccion.php">NUEVA BONIFICACIÓN</a></li>
                                <li><a href="v.editar.produccion.php">EDITAR BONIFICACIÓN</a></li>
                            </ul>
                        </li>
                        <li><a href="v.comisiones.php">COMISIONES SOBRE VENTAS</a>
                            <ul>
                                <li><a href="v.nueva.comision.php">NUEVA COMISIÓN</a></li>
                                <li><a href="v.editar.comisiones.php">EDITAR COMISIÓN</a></li>
                            </ul>
                        </li>
                        <li><a href="v.Poliza.php">PÓLIZAS CONTABLES</a>
                            <ul>
                                <li><a href="PolizaProduccion.php">PÓLIZA PRODUCCIÓN</a></li>
                                <li><a href="v.editar.poliza.php">EDITAR PÓLIZA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <!-- Sección de Préstamos -->
                <li>
                    <a href="#">PRÉSTAMOS</a>
                    <ul>
                        <li><a href="v.prestamo.php">DEUDAS DE PRÉSTAMOS</a>
                            <ul>
                                <li><a href="v.nuevo.prestamo.php">NUEVO PRÉSTAMO</a></li>
                                <li><a href="v.editar.prestamo.php">EDITAR PRÉSTAMO</a></li>
                                <li><a href="v.HistorialPagosPrestamos.php">HISTORIAL DE PAGOS</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <!-- Sección de Tienda Solidaria -->
                <li>
                    <a href="#">TIENDA SOLIDARIA</a>
                    <ul>
                        <li><a href="v.tienda.php">REGISTROS DE TIENDA</a>
                            <ul>
                                <li><a href="v.compra.php">COMPRA</a></li>
                                <li><a href="v.editar.compra.php">EDITAR COMPRA</a></li>
                                <li><a href="v.HistorialCompras.php">HISTORIAL DE COMPRAS</a></li>
                                <li><a href="v.PagoTienda.php">PAGO DE TIENDA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
<main>
    <section class="Produccion">
        <h2>Producción Registrada</h2>
        <table>
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Piezas Elaboradas</th>
                <th>Bonificación</th>
                <th>Nombre del Empleado</th>
                <th>No. Cuenta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($producciones as $produccion) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($produccion->getFecha()); ?></td>
                    <td><?php echo htmlspecialchars($produccion->getPiezasElaboradas()); ?></td>
                    <td><?php echo number_format($produccion->getBonificacion(), 2); ?></td>
                    <td><?php echo htmlspecialchars($produccion->getNombreCompleto()); ?></td>
                    <td><?php echo htmlspecialchars($produccion->getCuentaContable()); ?></td>
                    <td>
                        <a href="v.editar.produccion.php?ID_Produccion=<?php echo $produccion->getIDProduccion(); ?>" class="btn btn-editar">Editar</a>
                        <button class="btn btn-eliminar" data-id="<?php echo $produccion->getIDProduccion(); ?>">Eliminar</button>
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
            const produccionId = this.getAttribute('data-id');

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
                    window.location.href = `?ID_Produccion=${produccionId}`;
                }
            });
        });
    });

    const nuevoProduccionButton = document.querySelector('.btn-nuevo');

    if (nuevoProduccionButton) {
        nuevoProduccionButton.addEventListener('click', function() {
            window.location.href = 'v.nueva.produccion.php';
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

