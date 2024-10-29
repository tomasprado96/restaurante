<?php
class Reporte {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerReportesVentas() {
        $stmt = $this->pdo->query("SELECT * FROM ventas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Métodos adicionales para otros reportes pueden ser agregados
}
?>
