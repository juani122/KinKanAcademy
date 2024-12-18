<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usualmente 'root' en hostlocal
$password = ""; // Contraseña por defecto suele ser vacía
$dbname = "kinkan_academy";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_curso = $_POST['nombre_curso'];
    $duracion = $_POST['duracion'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Preparar la consulta para insertar
    $sql = "INSERT INTO cursos (nombre_curso, duracion, descripcion, precio) 
            VALUES ('$nombre_curso', '$duracion', '$descripcion', '$precio')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo curso agregado exitosamente";
    } else {
        echo "Error al agregar el curso: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>



<?php
// Definir una variable para saber si el formulario debe mostrarse
$showForm = isset($_POST['startNow']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - KinKan Academy</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body { font-family: 'Roboto', sans-serif; margin: 0; padding: 0; box-sizing: border-box; background-color: #0F2449; color: white; }
        header { background-color: #344C64; padding: 30px; text-align: center; color: white; }
        header h1 { margin: 0; font-size: 2.5em; }
        header p { font-size: 1.2em; margin-top: 10px; }
        nav { background-color: #344C64; display: flex; justify-content: space-around; padding: 10px 0; position: sticky; top: 0; z-index: 1000; }
        nav a { color: white; text-decoration: none; padding: 10px 20px; font-weight: bold; transition: 0.3s; }
        nav a:hover { background-color: white; color: #344C64; border-radius: 5px; }
        .hero { text-align: center; padding: 60px 20px; color: white; background-image: url('https://img.redestelecom.es/wp-content/uploads/2024/04/22124120/Conexiones-con-perifericos--1024x683.jpg.webp'); background-size: cover; background-position: center; }
        .hero h2 { font-size: 2.5em; margin-bottom: 10px; font-weight: 700; }
        .hero p { font-size: 1.5em; margin-bottom: 20px; font-weight: 400; }
        .cta-btn { background-color: #FF4500; color: white; padding: 15px 30px; border: none; border-radius: 5px; font-size: 1.2em; cursor: pointer; transition: 0.3s; }
        .cta-btn:hover { background-color: #0F2449; color: #FF4500; }
        .courses-section { display: flex; justify-content: center; flex-wrap: wrap; padding: 20px; }
        .course-box { background-color: #D4EBF8; width: 30%; margin: 15px; padding: 20px; text-align: center; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: 0.3s; }
        .course-box:hover { transform: translateY(-5px); box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); }
        .course-box img { width: 100%; max-height: 200px; object-fit: cover; border-radius: 10px; }
        .course-box h3 { color: #226666; margin: 10px 0; font-size: 1.5em; }
        .course-box p { color: #444; font-size: 14px; }
        .start-btn { background-color: #FF7F00; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: 0.3s; }
        .start-btn:hover { background-color: #0F2449; }
        .highlighted { font-weight: bold; background-color: #FF4500; }
        .testimonials, .special-offers { padding: 40px 20px; text-align: center; }
        .testimonials p, .special-offers p { margin: 10px 0; font-size: 1.2em; }
        .testimonials .testimonial { margin-bottom: 20px; background-color: #1B3C71; padding: 15px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .special-offers { background-color: #FF4500; border-radius: 10px; padding: 20px; }
        .special-offers a { text-decoration: none; color: #344C64; font-weight: bold; }
        footer { background-color: #344C64; color: white; text-align: center; padding: 20px; }
        .social-media { margin: 20px 0; }
        .social-media a { margin: 0 10px; }
        .social-media img { width: 30px; }
        
        /* Form Styles */
        .payment-form { background-color: #D4EBF8; padding: 20px; border-radius: 10px; margin-top: 20px; }
        .payment-form input[type="text"], .payment-form input[type="email"], .payment-form select {
            padding: 12px;
            width: 100%;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            color: #333; /* Cambié el color del texto */
        }
        .payment-form input[type="text"]::placeholder, .payment-form input[type="email"]::placeholder {
            color: #666; /* Cambié el color de los placeholders */
        }
        .payment-form label {
            font-weight: bold;
            color: #333; /* Cambié el color de las etiquetas */
        }
        .payment-form button {
            background-color: #FF4500;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        .payment-form button:hover {
            background-color: #0F2449;
            color: #FF4500;
        }
    </style>
</head>
<body>
  
    <!-- Hero Section -->
    <section class="hero">
        <h2>Aprende hoy, lidera mañana</h2>
        <p>Explora nuestros cursos de Programación, Redes y Ciberseguridad.</p>
        <form method="POST">
            <!-- Agrega el botón de inicio aquí si es necesario -->
        </form>
    </section>

    <!-- Navigation -->
    <nav>
        <a href="index.php">Home</a>
        <a href="servicios.php">Servicios</a>
        <a href="equipo.php">Equipo</a>
        <a href="contacto.php">Contacto</a>
    </nav>

    <!-- Courses Section -->
    <section class="courses-section">
        <!-- Curso de Programación -->
        <div class="course-box">
            <img src="https://www.avenuglobal.com/img/article/cuales-son-las-caracteristicas-de-los-lenguajes-de-programacion.webp" alt="Programación">
            <h3>Curso de Programación</h3>
            <p>Domina lenguajes como Python, Java y C++, desde lo básico hasta proyectos avanzados.</p>
        </div>
        <!-- Curso de Redes -->
        <div class="course-box">
            <img src="https://1783176.fs1.hubspotusercontent-na1.net/hubfs/1783176/Hombre%20trabajando%20con%20distintos%20tipos%20de%20redes%20inform%C3%A1ticas.jpg" alt="Redes">
            <h3>Curso de Redes</h3>
            <p>Aprende a configurar y administrar redes, manejar protocolos y solucionar problemas.</p>
        </div>
        <!-- Curso de Ciberseguridad -->
        <div class="course-box">
            <img src="https://img.redestelecom.es/wp-content/uploads/2024/04/22123543/Seguridad-redes-1080x1080.jpg.webp" alt="Ciberseguridad">
            <h3>Curso de Ciberseguridad</h3>
            <p>Protege sistemas, redes y datos de amenazas cibernéticas, aprende a prevenir ataques.</p>
        </div>
    </section>

    <!-- Formulario de Inscripción (solo visible si se hace clic en el botón) -->
    <?php if ($showForm): ?>
    <section>
        <form class="payment-form" method="POST" action="procesar_inscripcion.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Introduce tu nombre">
        
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required placeholder="Introduce tu correo electrónico">
        
            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>
                <option value="programacion">Programación</option>
                <option value="redes">Redes</option>
                <option value="ciberseguridad">Ciberseguridad</option>
            </select>

            <button type="submit">Inscribirse</button>
        </form>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 KinKan Academy | Todos los derechos reservados</p>
        <div class="social-media">
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a>
        </div>
    </footer>
</body>
</html>