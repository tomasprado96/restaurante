<?php
class Inventario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para agregar un ingrediente
    public function agregarIngrediente($nombre, $stock) {
        $sql = "INSERT INTO ingredientes (nombre, stock) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre, $stock]);
    }

    // Método para obtener todos los ingredientes
    public function obtenerIngredientes() {
        $sql = "SELECT * FROM ingredientes"; // Asegúrate de que el nombre de la tabla sea correcto
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para actualizar el stock de un ingrediente
    public function actualizarStock($id, $nuevoStock) {
        $sql = "UPDATE ingredientes SET stock = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nuevoStock, $id]);
    }
}
?>
