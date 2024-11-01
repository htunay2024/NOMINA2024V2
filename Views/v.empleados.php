<?php

require_once '../Model/Empleado.php';
require_once '../Controller/C_Empleado.php';

$empleadoODB = new C_Empleado();

// Verificar si se ha enviado un ID_Empleado para eliminar
if (isset($_GET['ID_Empleado'])) {
    $idEmpleado = $_GET['ID_Empleado'];

    // Llamar al método para eliminar el empleado en el objeto de acceso a datos
    $empleadoODB->delete($idEmpleado);

    // Redirigir con un parámetro de éxito
    header('Location: ' . $_SERVER['PHP_SELF'] . '?action=deleted');
    exit();
}

// Obtener todos los empleados para mostrar en la tabla
$empleados = $empleadoODB->getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empleados Existentes</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="../Imagenes/T%20Consulting.jpg" alt="Logo de T Consulting" style="height: 50px; vertical-align: middle;">
    <h1>GESTIÓN DE EMPLEADOS</h1>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button> <!-- Botón hamburguesa -->
</header>
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
                        <li><a href="v.nomina.php">Pagos</a></li>
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
    <section class="Empleados">
        <h2>EMPLEADOS:</h2>
        <div class="table-container">
            <table>
                <colgroup>
                    <col style="width: auto;">
                    <col style="width: auto;">
                    <col style="width: 150px;">
                    <col style="width: 150px;">
                    <col style="width: 150px;">
                    <col style="width: 150px;">
                    <col style="width: 100px;">
                    <col style="width: 275px;">
                </colgroup>
                <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th class="text-wrap">FECHA DE NACIMIENTO</th>
                    <th class="text-wrap">FECHA DE CONTRATACIÓN</th>
                    <th>SALARIO BASE</th>
                    <th>DEPARTAMENTO</th>
                    <th class="text-wrap">NO. CUENTA</th>
                    <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($empleados as $empleado) : ?>
                    <tr>
                        <td class="nombre"><?php echo htmlspecialchars($empleado->getNombre()); ?></td>
                        <td class="apellido"><?php echo htmlspecialchars($empleado->getApellido()); ?></td>
                        <td><?php echo htmlspecialchars($empleado->getFechaNacimiento()); ?></td>
                        <td><?php echo htmlspecialchars($empleado->getFechaContratacion()); ?></td>
                        <td><?php echo htmlspecialchars($empleado->getSalarioBase()); ?></td>
                        <td><?php echo htmlspecialchars($empleado->getDepartamento()->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($empleado->getCuentaContable()); ?></td>

                        <td>
                            <a href="v.editar.empleado.php?ID_Empleado=<?php echo $empleado->getIdEmpleado(); ?>" class="btn btn-editar">Editar</a>
                            <button class="btn btn-eliminar" data-id="<?php echo $empleado->getIdEmpleado(); ?>">Eliminar</button>
                            <button class="employee-button" onclick="showEmployeePhoto('<?php echo $empleado->getFoto(); ?>')">Foto</button>
                            <a href="v.familiar.php?ID_Empleado=<?php echo $empleado->getIdEmpleado(); ?>" class="btn btn-Familiar">Familiares</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div id="photoModal" class="photo-modal" style="display: none;">
            <span class="close" onclick="hideEmployeePhoto()">×</span>
            <div class="modal-content">
                <img id="employeePhoto" src="" alt="Foto del Empleado">
            </div>
        </div>
    </section>
</main>

<footer>
    <p>© 2024 TConsulting. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const deleteButtons = document.querySelectorAll('.btn-eliminar');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const empleadoId = this.getAttribute('data-id');

            Swal.fire({
                text: "Seguro que quieres eliminar el registro, no podrás revertir esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `?ID_Empleado=${empleadoId}`;
                }
            });
        });
    });

    const nuevoEmpleadoButton = document.querySelector('.btn-nuevo');

    if (nuevoEmpleadoButton) {
        nuevoEmpleadoButton.addEventListener('click', function() {
            window.location.href = 'v.nuevo.empleado.php';
        });
    }

    function showEmployeePhoto(photoUrl) {
        const modal = document.getElementById("photoModal");
        const img = document.getElementById("employeePhoto");
        const hamburgerButton = document.querySelector('.menu-toggle');

        // Oculta el botón hamburguesa cuando se muestra la foto
        hamburgerButton.classList.add('hidden');

        if (photoUrl && photoUrl !== '../Imagenes/Sin Foto.jpeg') {
            img.src = photoUrl;
        } else {
            img.src = '../Imagenes/Sin Foto.jpeg';
        }

        img.onload = function() {
            modal.style.display = "flex"; // Mostrar modal después de que cargue la imagen
        }

        img.addEventListener('click', function() {
            if (img.classList.contains('large')) {
                img.classList.remove('large'); // Vuelve al tamaño pequeño
            } else {
                img.classList.add('large'); // Agranda la imagen
            }
        });
    }

    function hideEmployeePhoto() {
        const modal = document.getElementById("photoModal");
        const hamburgerButton = document.querySelector('.menu-toggle');
        modal.style.display = "none";
        const img = document.getElementById("employeePhoto");
        img.src = "";

        img.classList.remove('large');

        // Muestra el botón hamburguesa cuando se oculta la foto
        hamburgerButton.classList.remove('hidden');
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

