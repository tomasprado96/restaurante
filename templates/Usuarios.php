<?php
include '../db/database.php';
include '../src/Usuario.php';

$usuario = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $rol = $_POST['rol'];
        $password = $_POST['password'];
        $usuario->agregarUsuario($nombre, $rol, $password);
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $usuario->eliminarUsuario($id);
    }
}

$usuarios = $usuario->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Usuarios</title>
</head>
<body>
    <div class="container">
    <h1>Gestión de Usuarios</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?php echo $u['id']; ?></td>
            <td><?php echo $u['nombre']; ?></td>
            <td><?php echo $u['rol']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                    <button type="submit" name="eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a class="textito" href="index.php">Volver al menú</a>
    </div>
</body>
</html>
