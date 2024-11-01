<?php
require_once '../Model/Intecap.php';
require_once '../Controller/Intecap_C.php';

$intecapODB = new Intecap_C();
$intecapList = $intecapODB->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de INTECAP</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>
<body>
<header>
    <h1>Gestión de INTECAP</h1>
</header>

<main>
    <section class="INTECAP">
        <h2>Registros de INTECAP</h2>
        <table>
            <thead>
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>Monto Patronal</th>
                <th>Nombre del Empleado</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($intecapList as $intecap) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($intecap->getMes()); ?></td>
                    <td><?php echo htmlspecialchars($intecap->getAnio()); ?></td>
                    <td><?php echo number_format($intecap->getMontoPatronal(), 2); ?></td>
                    <td><?php echo htmlspecialchars($intecap->getNombreCompleto()); ?></td>
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
