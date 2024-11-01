<?php
session_start();

// Verificar si el usuario es empleado
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'empleado') {
    // Redirigir a una página de acceso denegado o de inicio si el usuario no es empleado
    header("Location: ../acceso_denegado.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - Empleado T Consulting</title>
    <link rel="stylesheet" href="../Styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>T Consulting S.A</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
</header>

<div id="container">
    <aside id="sideMenu">
        <nav>
            <ul>
                <li><a href="index2.php">INICIO</a></li>
                
                <!-- Sección de Recursos Humanos -->
                <li>
                    <a href="#">RECURSOS HUMANOS</a>
                    <ul>
                        <li><a href="v.empleados.php">EMPLEADO</a>
                            <ul>
                                <li><a href="v.editar.empleado.php">EDITAR PERFIL</a></li>
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
                                <li><a href="v.editar.ausencia.empleado.php">EDITAR PERMISO</a></li>
                            </ul>
                        </li>
                        <li><a href="v.familiar.php">FAMILIAR</a>
                            <ul>
                                <li><a href="v.nuevo.familiar.php">NUEVO FAMILIAR</a></li>
                                <li><a href="v.editar.familiar.php">EDITAR FAMILIAR</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <!-- Sección de Historial -->
                <li>
                    <a href="#">HISTORIAL</a>
                    <ul>
                        <li><a href="v.HistorialPagos.php">HISTORIAL DE PAGOS</a></li>
                        <li><a href="v.HistorialCompras.php">HISTORIAL DE COMPRAS</a></li>
                        <li><a href="v.HistorialPagosPrestamos.php">HISTORIAL DE PRÉSTAMOS</a></li>
                    </ul>
                </li>
                
                <!-- Sección de Nómina -->
                <li>
                    <a href="#">NÓMINA</a>
                    <ul>
                        <li><a href="v.nomina.php">CONSULTAR NÓMINA</a></li>
                    </ul>
                </li>

                <!-- Sección de Tienda Solidaria -->
                <li>
                    <a href="#">TIENDA SOLIDARIA</a>
                    <ul>
                        <li><a href="v.tienda.php">TIENDA</a>
                            <ul>
                                <li><a href="v.compra.php">REALIZAR COMPRA</a></li>
                                <li><a href="v.PagoTienda.php">PAGO DE TIENDA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <main>
        <h2>Bienvenido al Portal de Empleados</h2>
        <p>Desde aquí puedes acceder a tus recursos y gestionar tus datos.</p>
    </main>
</div>

<footer>
    <p>&copy; 2024-2024 T Consulting S.A. Todos los derechos reservados.</p>
</footer>

<script>
    function toggleMenu() {
        var menu = document.getElementById("sideMenu");
        var mainContent = document.querySelector("main");

        menu.classList.toggle("active");
        mainContent.classList.toggle("shifted");
    }
</script>
</body>
</html>

