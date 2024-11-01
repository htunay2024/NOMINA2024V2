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
                <li><a href="index2.php">Inicio</a></li>
                <li>
                    <a href="#">Expediente</a>
                    <ul>
                        <li><a href="v.Expediente.php">Ver Expediente</a></li>
                        <li><a href="v.nuevo.expediente.php">Actualizar Expediente</a></li>
                        <li><a href="v.nuevo.familiar.php">Registrar Familiar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Pago de Nómina</a>
                    <ul>
                        <li><a href="v.PagoTienda.php">Pagos en Tienda</a></li>
                        <li><a href="v.RealizarPago.php">Realizar Pago</a></li>
                        <li><a href="v.nuevo.pago.php">Solicitar Nuevo Pago</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Solicitudes</a>
                    <ul>
                        <li><a href="v.nueva.ausencia.php">Nueva Ausencia</a></li>
                        <li><a href="v.nueva.comision.php">Solicitar Comisión</a></li>
                        <li><a href="v.nueva.horasextras.php">Solicitar Horas Extras</a></li>
                        <li><a href="v.nueva.produccion.php">Registrar Producción</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Préstamos</a>
                    <ul>
                        <li><a href="v.prestamo.php">Historial de Préstamos</a></li>
                        <li><a href="v.nuevo.prestamo.php">Solicitar Préstamo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Producción</a>
                    <ul>
                        <li><a href="v.produccion.php">Ver Producción</a></li>
                        <li><a href="v.nuevo.empleado.php">Registrar Nuevo Empleado</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <main>
        <h2>Bienvenido al Portal del Empleado</h2>
        <p>Accede a tus recursos y gestiona tus solicitudes desde aquí.</p>
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
