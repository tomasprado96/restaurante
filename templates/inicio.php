<?php
// inicio.php
include '../db/database.php'; // Incluye tu archivo de conexión

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe y obtener su rol
    $sql = "SELECT password, rol FROM usuarios WHERE nombre = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre]);
    
    // Obtén el resultado
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Contraseña correcta, iniciar sesión
        session_start(); // Inicia la sesión
        $_SESSION['usuario'] = $nombre; // Guarda el nombre del usuario en la sesión
        $_SESSION['rol'] = $user['rol']; // Guarda el rol del usuario en la sesión

        // Redirigir según el rol
        if ($user['rol'] === 'admin') {
            header("Location: index.php"); // Redirige al panel de control
        } elseif ($user['rol'] === 'camarero' || $user['rol'] === 'cocinero') {
            header("Location: index2.php"); // Redirige a la página para camareros y cocineros
        } else {
            header("Location: index_clientes.php"); // Redirige a la página principal
        }
        
        exit();
    } else {
        $message = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <a class="textito" href="registro.php">Registrate</a>
    </div>
</body>
</html>
