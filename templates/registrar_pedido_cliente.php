<?php
include '../db/database.php';
include '../src/Pedido.php';

$pedido = new Pedido($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $platoId = $_POST['plato_id'];
    // Aquí deberías tener algún mecanismo para asociar un cliente a un pedido
    $clienteId = 1; // Cambia esto según la lógica de tu aplicación

    // Suponiendo que cada plato tiene un precio y lo obtienes de otra consulta
    $stmt = $pdo->prepare("SELECT precio FROM platos WHERE id = ?");
    $stmt->execute([$platoId]);
    $plato = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $plato['precio']; // Solo para un plato, puedes extender esto para múltiples

    $pedido->agregarPedido($clienteId, $total);
    echo "<p>Pedido registrado con éxito.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Registrar Pedido</title>
</head>
<body>
    <div class="container">
    <h1>Registrar Pedido</h1>
    <p>Has agregado un plato a tu pedido.</p>
    <a class="textito" href="index_clientes.php">Volver al menú</a>
</div>
</body>
</html>
