<?php
include '../db/database.php';
include '../src/Plato.php';

$plato = new Plato($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $plato->agregarPlato($nombre, $descripcion, $precio);
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $plato->eliminarPlato($id);
    }
}

$platos = $plato->obtenerPlatos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Platos</title>
</head>
<body>
    <div class="container">
        <h1>Platos</h1>
        <form method="post">
            <input type="text" name="nombre" placeholder="Nombre del plato" required>
            <input type="text" name="descripcion" placeholder="Descripción" required>
            <input type="number" name="precio" placeholder="Precio" required step="0.01">
            <button type="submit" name="agregar">Agregar Plato</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($platos as $p): ?>
            <tr>
                <td><?php echo $p['id']; ?></td>
                <td><?php echo $p['nombre']; ?></td>
                <td><?php echo $p['descripcion']; ?></td>
                <td><?php echo $p['precio']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
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
