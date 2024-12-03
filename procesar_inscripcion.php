<?php
// Configuración de conexión a la base de datos
$servername = "localhost";  // En XAMPP, usualmente es 'localhost'
$username = "root";         // Usuario predeterminado en XAMPP
$password = "";             // Contraseña vacía por defecto en XAMPP
$dbname = "kinkan_academy"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $curso = $_POST['curso'] ?? '';

    // Validar que no lleguen datos vacíos
    if (!empty($nombre) && !empty($correo) && !empty($curso)) {
        // Insertar datos en la tabla
        $sql = "INSERT INTO inscripciones (nombre, correo, curso) 
                VALUES ('$nombre', '$correo', '$curso')";

        if ($conn->query($sql) === TRUE) {
            echo "Inscripción realizada con éxito.";
        } else {
            echo "Error al insertar los datos: " . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}

// Cerrar conexión
$conn->close();
?>









