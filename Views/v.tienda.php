<?php

require_once '../Model/Tienda.php';
require_once '../Controller/C_Tienda.php';

$tiendaODB = new C_Tienda();

// Obtener todas las compras para mostrar en la tabla
$compras = $tiendaODB->getAllTiendas();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Tienda</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>Gestión de Compras y Pagos</h1>
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
    <section class="Compras">
        <h2>Compras Registradas</h2>
        <table>
            <thead>
            <tr>
                <th  class="text-wrap">Cuotas Máximas</th>
                <th  class="text-wrap">Saldo Pendiente</th>
                <th  class="text-wrap">Crédito Disponible</th>
                <th  class="text-wrap">Nombre del Empleado</th>
                <th>No. Cuenta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($compras as $compra) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($compra->getCuotas()); ?></td>
                    <td><?php echo number_format($compra->getSaldoPendiente(), 2); ?></td>
                    <td><?php echo number_format($compra->getCreditoDisponible(), 2); ?></td>
                    <td><?php echo htmlspecialchars($compra->getNombreCompleto()); ?></td>
                    <td><?php echo htmlspecialchars($compra->getCuentaContable()); ?></td>
                    <td>
                        <a href="v.compra.php?ID_Empleado=<?php echo $compra->getIdEmpleado(); ?>&ID_Compra=<?php echo $compra->getIdCompra(); ?>" class="btn btn-editar">Nueva Compra</a>
                        <a href="v.PagoTienda.php?ID_Compra=<?php echo $compra->getIdCompra(); ?>" class="btn btn-buscar">Nuevo Pago</a>
                        <a href="v.HistorialCompras.php?ID_Empleado=<?php echo $compra->getIdEmpleado(); ?>" class="btn btn-editar">Historial Compras</a>
                        <a href="v.HistorialPagos.php?ID_Empleado=<?php echo $compra->getIdEmpleado(); ?>" class="btn btn-buscar">Historial Pagos</a>
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

    function toggleMenu() {
        const sideMenu = document.querySelector('aside');
        const mainContent = document.querySelector('main');
        sideMenu.classList.toggle('active');
        mainContent.classList.toggle('shifted');
    }

</script>

</body>
</html>

