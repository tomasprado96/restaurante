<?php
include '../db/database.php';
include '../src/Plato.php';

$plato = new Plato($pdo);
$platos = $plato->obtenerPlatos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Menú</title>
</head>
<body>
    <div class="container">
    <h1>Menú del Restaurante</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($platos as $p): ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['nombre']; ?></td>
            <td><?php echo $p['descripcion']; ?></td>
            <td><?php echo $p['precio']; ?></td>
            <td>
                <form method="post" action="registrar_pedido_cliente.php">
                    <input type="hidden" name="plato_id" value="<?php echo $p['id']; ?>">
                    <button type="submit">Agregar al Pedido</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a class="textito" href="index_clientes.php">Volver al menú</a>
    </div>
</body>
</html>
