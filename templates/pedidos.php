<?php
include '../db/database.php';
include '../src/Pedido.php';

$pedido = new Pedido($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteId = $_POST['cliente_id']; // Asegúrate de tener este campo
    $total = $_POST['total'];
    $pedido->agregarPedido($clienteId, $total);
}

$pedidos = $pedido->obtenerPedidos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Pedidos</title>
</head>
<body>
    <div class="container">
    <h1>Pedidos</h1>
    <form method="post">
        <input type="number" name="cliente_id" placeholder="ID del cliente" required>
        <input type="number" name="total" placeholder="Total del pedido" required step="0.01">
        <button type="submit">Agregar Pedido</button>
    </form>
    <table>
        <tr>
            <th>Numero de Pedido</th>
            <th>Cliente ID</th>
            <th>Total</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($pedidos as $p): ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['cliente_id']; ?></td>
            <td><?php echo $p['total']; ?></td>
            <td><?php echo $p['fecha']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a class="textito" href="index.php">Volver al menú</a>
    </div>
</body>
</html>
