<?php
class Pedido {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para agregar un pedido
    public function agregarPedido($clienteId, $total) {
        $sql = "INSERT INTO pedidos (cliente_id, total, fecha) VALUES (?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$clienteId, $total]);
    }

    // Método para obtener todos los pedidos de un cliente específico
    public function obtenerPedidosPorCliente($clienteId) {
        $sql = "SELECT * FROM pedidos WHERE cliente_id = :cliente_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener los platos de un pedido específico
    public function obtenerPlatosPorPedido($pedidoId) {
        $sql = "SELECT platos.* FROM platos
                JOIN pedido_plato ON platos.id = pedido_plato.plato_id
                WHERE pedido_plato.pedido_id = :pedido_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedidoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para eliminar un pedido
    public function eliminarPedido($pedidoId) {
        $sql = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $pedidoId, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function obtenerPedidos() {
        $sql = "SELECT * FROM pedidos"; // Asegúrate de que el nombre de la tabla sea correcto
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>

