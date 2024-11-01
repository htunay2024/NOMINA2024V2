<?php

require_once '../Model/IGSS.php';
require_once '../Controller/IGSS_C.php';

$igssODB = new IGSS_C();

// Obtener todos los registros de IGSS para mostrar en la tabla
$registrosIGSS = $igssODB->getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Aportes IGSS</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>

<body>
<header>
    <h1>Gestión de Aportes IGSS</h1>
</header>

<main>
    <section class="IGSS">
        <h2>Aportes IGSS Registrados</h2>
        <table>
            <thead>
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>Monto Patronal</th>
                <th>Monto Laboral</th>
                <th>Nombre del Empleado</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($registrosIGSS as $igss) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($igss->getMes()); ?></td>
                    <td><?php echo htmlspecialchars($igss->getAnio()); ?></td>
                    <td><?php echo number_format($igss->getMontoPatronal(), 2); ?></td>
                    <td><?php echo number_format($igss->getMontoLaboral(), 2); ?></td>
                    <td><?php echo htmlspecialchars($igss->getNombreCompleto()); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>© 2024 TConsulting. Todos los derechos reservados.</p>
</footer>

</body>
</html>
