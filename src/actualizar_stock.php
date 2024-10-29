<?php
include '../db/database.php';
include '../src/Inventario.php';

$inventario = new Inventario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nuevoStock = $_POST['stock'];

    // Llama al método para actualizar el stock
    $inventario->actualizarStock($id, $nuevoStock);
    
    // Redirigir de vuelta a la página de inventario después de la actualización
    header("Location: inventario.php");
    exit();
}
?>
