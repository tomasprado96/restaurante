<?php
// registro.php
include '../db/database.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, rol, password, created_at) VALUES (?, ?, ?, NOW())";
    
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nombre, $rol, $password_hash])) {
        $message = "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        $message = "Error: No se pudo registrar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style3.css">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="rol" placeholder="Rol (admin, camarero, cocinero)" required>
            <button type="submit">Registrarse</button>
        </form>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <a class="textito" href="inicio.php">Inicia Sesión</a>
    </div>
</body>
</html>
