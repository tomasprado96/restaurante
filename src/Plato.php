<?php
class Plato {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function agregarPlato($nombre, $descripcion, $precio) {
        $stmt = $this->pdo->prepare("INSERT INTO platos (nombre, descripcion, precio) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $descripcion, $precio]);
    }

    public function obtenerPlatos() {
        $stmt = $this->pdo->query("SELECT * FROM platos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarPlato($id) {
        $stmt = $this->pdo->prepare("DELETE FROM platos WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
