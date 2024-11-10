<?php
require_once '../Data/PolizaODB.php';
require_once '../Data/PrestamoODB.php';
require_once '../Model/HistorialPagosPrestamos.php';
require_once '../Data/HistorialPagosPrestamosODB.php';
require_once '../Data/EmpleadoODB.php';

$idPrestamo = $_GET['ID_Prestamo'] ?? null;
$monto = $noCuota = $saldoPendiente = $nombreEmpleado = $idPoliza = $idEmpleado = $cuentaContable = null;

if ($idPrestamo) {
    $prestamo = (new PrestamoODB())->getPagoPorPrestamoId($idPrestamo);
    if ($prestamo) {
        [$monto, $noCuota, $saldoPendiente, $idEmpleado, $idPoliza, $cuentaContable, $nombreEmpleado] = [
            $prestamo->getMonto(), $prestamo->getCuotasRestantes(), $prestamo->getSaldoPendiente(),
            $prestamo->getIdEmpleado(), $prestamo->getIdPoliza(), $prestamo->getCuentaContable(),
            $prestamo->getNombreCompleto()
        ];
    }
}

$nuevoSaldo = $saldoPendiente - $monto;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Registrar_Pago'])) {
    $fecha = date('Y-m-d');
    $nuevoPago = new HistorialPagosPrestamos(
        null, $fecha, $monto, $noCuota, $nuevoSaldo, $idEmpleado, $idPoliza, $idPrestamo, null, $cuentaContable
    );

    if ($nuevoPago && (new HistorialPagosPrestamosODB())->insert($nuevoPago)) {
        header("Location: v.prestamo.php?action=created");
    } else {
        header("Location: v.prestamo.php?action=error");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pago</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>
<body>
<header>
    <h1>Realizar Pago</h1>
    <nav>
        <ul>
            <li><a href="v.prestamo.php">REGRESAR</a></li>
        </ul>
    </nav>
</header>
<main>
    <form method="POST" action="v.RealizarPago.php?ID_Prestamo=<?php echo $idPrestamo; ?>">
        <div class="form-group">
            <label for="No_Cuota">Cuotas Restantes:</label>
            <input type="text" id="No_Cuota" name="No_Cuota" value="<?php echo $noCuota; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="Nombre_Empleado">Nombre Empleado:</label>
            <input type="text" id="Nombre_Empleado" name="Nombre_Empleado" value="<?php echo $nombreEmpleado; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="Monto">Monto:</label>
            <input type="text" id="Monto" name="Monto" value="<?php echo $monto; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="Saldo_Pendiente">Saldo Pendiente:</label>
            <input type="text" id="Saldo_Pendiente" name="Saldo_Pendiente" value="<?php echo $saldoPendiente; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="Nuevo_Saldo">Nuevo Saldo Pendiente:</label>
            <input type="text" id="Nuevo_Saldo" name="Nuevo_Saldo" value="<?php echo $nuevoSaldo; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="Cuenta_Contable">Cuenta Contable:</label>
            <input type="text" id="Cuenta_Contable" name="Cuenta_Contable" value="<?php echo htmlspecialchars($cuentaContable); ?>" readonly>
        </div>
        <div class="form-group">
            <button type="submit" name="Registrar_Pago" class="btn-submit">Registrar Pago</button>
        </div>
    </form>
</main>
<footer>
    <p>© 2024 TConsulting. Todos los derechos reservados.</p>
</footer>
</body>
</html>
