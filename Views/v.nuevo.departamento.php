<?php
require_once '../Controller/Departamento_C.php';

$departamentoController = new Departamento_C();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreDepartamento = isset($_POST['Nombre']) ? trim($_POST['Nombre']) : null;

    if ($nombreDepartamento) {
        $nuevoDepartamento = new Departamento(null, $nombreDepartamento);
        $departamentoController->insert($nuevoDepartamento);
        
        // Redirige de nuevo a la página de creación de empleados
        header("Location: v.nuevo.empleado.php?action=departamento_added");
        exit();
    } else {
        echo "El nombre del departamento no puede estar vacío.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Departamento</title>
</head>
<body>
    <h2>Registrar Departamento</h2>
    <form action="v.nuevo.departamento.php" method="POST">
        <div>
            <label for="Nombre">Nombre del Departamento:</label>
            <input type="text" id="nombre" name="Nombre" required maxlength="50">
        </div>
        <button type="submit">Guardar Departamento</button>
    </form>
</body>
</html>
