<?php
// Variables para el formulario
$nombre = $email = $plan = "";
$nombreErr = $emailErr = $planErr = "";
$formularioEnviado = false;

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación del nombre
    if (empty($_POST["nombre"])) {
        $nombreErr = "El nombre es obligatorio.";
    } else {
        $nombre = test_input($_POST["nombre"]);
    }

    // Validación del correo
    if (empty($_POST["email"])) {
        $emailErr = "El correo electrónico es obligatorio.";
    } else {
        $email = test_input($_POST["email"]);
        // Verificar que el correo tiene un formato válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de correo inválido.";
        }
    }

    // Validación del plan
    if (empty($_POST["plan"])) {
        $planErr = "Debes seleccionar un plan.";
    } else {
        $plan = test_input($_POST["plan"]);
    }

    // Si no hay errores, procesar el formulario y guardar los datos en un archivo
    if (empty($nombreErr) && empty($emailErr) && empty($planErr)) {
        // Guardar los datos en un archivo
        $archivo = fopen("datos.txt", "a"); // "a" es para agregar al final del archivo
        $datos = "Nombre: $nombre\nCorreo: $email\nPlan: $plan\n\n";
        fwrite($archivo, $datos);
        fclose($archivo);
        
        $formularioEnviado = true;
    }
}

// Función para limpiar los datos ingresados
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- HTML para mostrar el formulario -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Inscripción</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Agrega aquí los estilos que consideres necesarios */
    </style>
</head>
<body>
    <!-- Formulario de Inscripción -->
    <h3>Formulario de Inscripción</h3>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
        <span><?php echo $nombreErr; ?></span>
        <br><br>
        
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span><?php echo $emailErr; ?></span>
        <br><br>
        
        <label for="plan">Plan de pago:</label>
        <select id="plan" name="plan">
            <option value="">Selecciona un plan</option>
            <option value="Mensual" <?php echo ($plan == "Mensual") ? "selected" : ""; ?>>Mensual</option>
            <option value="Anual" <?php echo ($plan == "Anual") ? "selected" : ""; ?>>Anual</option>
        </select>
        <span><?php echo $planErr; ?></span>
        <br><br>
        
        <button type="submit">Enviar</button>
    </form>

    <!-- Mensaje de éxito o error -->
    <?php if ($formularioEnviado): ?>
        <h4>Inscripción realizada correctamente. ¡Gracias por registrarte!</h4>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h4>Por favor, corrige los errores y vuelve a intentarlo.</h4>
    <?php endif; ?>
</body>
</html>


