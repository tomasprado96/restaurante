<?php
include '../db/database.php';
include '../src/Inventario.php';

$inventario = new Inventario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $inventario->agregarIngrediente($nombre, $stock);
}

$ingredientes = $inventario->obtenerIngredientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Inventario</title>
</head>
<body>
    <div class="container">
    <h1>Inventario</h1>
    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre del ingrediente" required>
        <input type="number" name="stock" placeholder="Stock" required>
        <button type="submit">Agregar Ingrediente</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($ingredientes as $i): ?>
        <tr>
            <td><?php echo $i['id']; ?></td>
            <td><?php echo $i['nombre']; ?></td>
            <td><?php echo $i['stock']; ?></td>
            <td>
            <form method="post" action="../src/actualizar_stock.php">
                    <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
                    <input type="number" name="stock" placeholder="Nuevo stock" required>
                    <button type="submit">Actualizar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a class="textito" href="index.php">Volver al menú</a>
    </div>
</body>
</html>
