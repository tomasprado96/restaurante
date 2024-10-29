<?php
include '../db/database.php';
include '../src/Pedido.php';

$pedido = new Pedido($pdo);
$clienteId = 1; // Cambia esto según la lógica de tu aplicación

$pedidos = $pedido->obtenerPedidosPorCliente($clienteId);
$totalAcumulado = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_id'])) {
    $pedidoId = $_POST['eliminar_id'];
    $pedido->eliminarPedido($pedidoId);
    header("Location: ver_pedidos_cliente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Mis Pedidos</title>
</head>
<body>
<div class="container">
    <h1>Mis Pedidos</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Platos</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($pedidos as $p): ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td>
                <?php
                $platos = $pedido->obtenerPlatosPorPedido($p['id']);
                $nombresPlatos = array_map(fn($plato) => $plato['nombre'], $platos);
                echo implode(', ', $nombresPlatos);
                ?>
            </td>
            <td><?php echo $p['total']; ?></td>
            <td><?php echo $p['created_at']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="eliminar_id" value="<?php echo $p['id']; ?>">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?');">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php 
            $totalAcumulado += $p['total']; 
        endforeach; ?>
    </table>

    <?php if (empty($pedidos)): ?>
        <p>No tienes pedidos registrados.</p>
    <?php else: ?>
        <h2>Total Acumulado: <?php echo $totalAcumulado; ?></h2>
    <?php endif; ?>

    <a class="textito" href="index_clientes.php">Volver al menú</a>
</div>
</body>
</html>
