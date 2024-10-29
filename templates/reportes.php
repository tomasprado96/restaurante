<?php
include '../db/database.php';
include '../src/Reporte.php';

$reporte = new Reporte($pdo);
$ventas = $reporte->obtenerReportesVentas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <title>Reportes</title>
</head>
<body>
    <div class="container">
    <h1>Reportes de Ventas</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Pedido ID</th>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
        <?php foreach ($ventas as $v): ?>
        <tr>
            <td><?php echo $v['id']; ?></td>
            <td><?php echo $v['pedido_id']; ?></td>
            <td><?php echo $v['fecha']; ?></td>
            <td><?php echo $v['total']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a class="textito" href="index.php">Volver al menú</a>
    </div>
</body>
</html>
