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
                        <li><a href="#">Pagos</a></li>
                        <li><a href="#">Deducciones</a></li>
                        <li><a href="#">Bonificaciones</a></li>
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
        <h2>Bienvenido al Portal de Gestion de Nomina</h2>
        <p>Accede a tus recursos y gestiona tus acciones desde aquí.</p>
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

