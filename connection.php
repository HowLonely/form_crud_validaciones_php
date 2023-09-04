<?php
$host = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
$username = "root"; // Cambia esto al nombre de usuario de tu base de datos
$password = ""; // Cambia esto a tu contraseña de base de datos
$database = "proyecto_php"; // Cambia esto al nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
