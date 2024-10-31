<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - T Consulting</title>
    <link rel="stylesheet" href="../Styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>T Consulting S.A</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button> <!-- Botón hamburguesa -->
</header>

<div id="container">
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
    <h2>Políticas de la Empresa</h2>
    <p>
        Nuestra visión es ofrecer un sistema de nómina integral y de alto rendimiento, <br><br>
        diseñado para ser eficiente, transparente y seguro. Aspiramos a simplificar y <br><br>
        optimizar todos los procesos relacionados con la gestión de nómina y la administración <br><br>
        de recursos humanos, permitiendo a nuestros clientes centrarse en su desarrollo <br><br>
        organizacional mientras el sistema asegura el cumplimiento de todas las obligaciones salariales y legales. 
    </p>
</main>
</div>

<footer>
    <p>&copy; 2024-2024 T Consulting S.A. Todos los derechos reservados.</p>
</footer>

<script>
    function toggleMenu() {
        var menu = document.getElementById("sideMenu");
        var mainContent = document.querySelector("main");

        // Cambia la clase active del aside para mostrarlo u ocultarlo
        menu.classList.toggle("active");

        // Cambia la clase shifted del main para mover el contenido
        mainContent.classList.toggle("shifted");
    }
</script>
</body>
</html>
