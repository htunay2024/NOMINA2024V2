<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Bienvenida</title>
    <style>
        /* Estilos simples para centrar el mensaje en la pantalla */
        body, html {
            height: 100%;
            display: flex;
            flex-direction: column; /* Para apilar el texto y el botón verticalmente */
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('Imagenes/nominailustracion.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fafcfd; /* Color de texto personalizado */
        }

        /* Estilo del botón */
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fafcfd;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>¡Hola!</h1>
    <button onclick="window.location.href='Views/v.prestamo.php'">Ir al Formulario de Préstamo</button>

    <script>
        // Redirige a la página de inicio de sesión después de 3 segundos (3000 ms)
        setTimeout(function() {
            window.location.href = "login.php"; // Cambia "login.php" a la URL de tu página de inicio de sesión
        }, 3000);
    </script>
</body>
</html>

