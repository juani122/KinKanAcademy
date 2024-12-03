<?php
$host = 'localhost'; // Cambiar si no es local
$dbname = 'KinKanAcademy';
$username = 'root'; // Cambiar según tu configuración
$password = ''; // Contraseña por defecto en XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
