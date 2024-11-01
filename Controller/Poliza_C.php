<?php
require_once 'SQLSRVConnector.php';
require_once '../Model/Poliza.php';
require_once '../Model/Comisiones.php';
require_once '../Model/Produccion.php';

class Poliza_C {
    private $connection;
    public function __construct() {
        $this->connection = SQLSRVConnector::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    public function getAll(): array {
        $query = "EXEC MostrarPoliza";
        $result = $this->connection->query($query);

        $polizas = [];
        while ($row = $result->fetch()) {
            $poliza = new Poliza(
                $row['ID_Poliza'],
                $row['Fecha'],
                $row['Descripción'],
                $row['Monto'],
                $row['ID_Empleado'],
                $row['NombreCompleto'],
                $row['Cuenta_Contable']
            );
            array_push($polizas, $poliza);
        }
        return $polizas;
    }

    public function getById($idPoliza) {
        $query = "EXEC BuscarPolizaPorID @ID_Poliza = :ID_Poliza";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':ID_Poliza', $idPoliza, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Poliza(
                    $row['ID_Poliza'],
                    $row['Fecha'],
                    $row['Descripción'],
                    $row['Monto'],
                    $row['ID_Empleado'],
                    $row['NombreCompleto'],
                    $row['Cuenta_Contable']
                );
            }
        } catch (PDOException $e) {
            error_log("Failed to execute query: " . $e->getMessage());
            return null;
        }
        return null;
    }

    public function getComisionesByPoliza(int $idPoliza): array {
        $query = "EXEC BuscarComisionesPorPoliza @ID_Poliza = :idPoliza";
        $stmt = $this->connection->prepare($query);

        $stmt->bindValue(':idPoliza', $idPoliza, PDO::PARAM_INT);
        
        $stmt->execute();

        $comisiones = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Crear instancia de Comisiones
            $comision = new Comisiones(
                $row['ID_Comision'],
                $row['Mes'],
                $row['Anio'],
                $row['Monto_Ventas'],
                $row['Porcentaje'],
                $row['Comision'],
                $row['ID_Empleado'],
                $row['NombreCompleto'],
                $row['Cuenta_Contable']
            );
            array_push($comisiones, $comision);
        }
        return $comisiones;
    }
}
?>
