<?php
$host = 'localhost';
$db = 'restaurantee'; // Asegúrate de que el nombre de la base de datos sea correcto
$user = 'root'; // Tu usuario de la base de datos
$pass = ''; // Tu contraseña de la base de datos

try {
    // Corrige aquí: usa 'dbname' en lugar de 'restaurantee'
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
