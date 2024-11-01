<?php
require_once 'SQLSRVConnector.php';
require_once '../Model/Tienda.php';

class Tienda_C {
    private $connection;
    public function __construct() {
        $this->connection = SQLSRVConnector::getInstance()->getConnection(); // Obtener la conexión
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    // Obtener todas las tiendas
    public function getAllTiendas() : array {
        $query = "EXEC MostrarTodasLasTiendas";
        $result = $this->connection->query($query);
        $tiendas = [];
        while ($row = $result->fetch()) {
            $tienda = new Tienda(
                $row['ID_Compra'],
                $row['Cuotas'],
                $row['Max_Credit'],
                $row['Saldo_Pendiente'],
                $row['Credito_Disponible'],
                $row['ID_Empleado'],
                $row['NombreCompleto'],
                $row['Cuenta_Contable']
            );
            $tiendas[] = $tienda;
        }
        return $tiendas;
    }

    public function getDatosCompra($idCompra) {
        $query = "EXEC ObtenerDatosCompra @ID_Compra = :idCompra";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':idCompra', $idCompra, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Tienda(
                $row['ID_Compra'],
                $row['Cuotas'],
                $row['Max_Credit'],
                $row['Saldo_Pendiente'],
                $row['Credito_Disponible'],
                $row['ID_Empleado'],
                $row['NombreCompleto'],
                $row['Cuenta_Contable']
            );
        }
        return null;
    }
    
    public function getCompraPorID($Compra) {
        try {
            $query = "EXEC MostrarComprasPorID @Compra = :Compra";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':Compra', $Compra, PDO::PARAM_INT);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return [
                    'Compra' => $row['Compra'],
                    'Fecha' => $row['Fecha'],
                    'Total' => $row['Total'],
                    'ID_Empleado' => $row['ID_Empleado'],
                    'NombreCompleto' => $row['NombreCompleto'],
                    'Cuenta_Contable' => $row['Cuenta_Contable']
                ];
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener la compra: " . $e->getMessage());
            return null;
        }
    }

    public function updatePagoTienda($idPagoTienda, $pago, $idCompra, $idEmpleado) {
        $query = "EXEC ModificarPagoTienda @ID_Pago_Tienda = ?, @Pago = ?, @ID_Compra = ?, @ID_Empleado = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $idPagoTienda);
        $stmt->bindParam(2, $pago);
        $stmt->bindParam(3, $idCompra);
        $stmt->bindParam(4, $idEmpleado);
        $stmt->execute();
    }

    public function insertPagoYActualizarTienda($pago, $idCompra, $idEmpleado) {
        $query = "EXEC InsertarPagoYActualizarTienda @Pago = ?, @ID_Compra = ?, @ID_Empleado = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $pago);
        $stmt->bindParam(2, $idCompra);
        $stmt->bindParam(3, $idEmpleado);
        $stmt->execute();
    }

    public function insertCompraYActualizarTienda($fecha, $total, $idCompra, $idEmpleado) {
        $query = "EXEC InsertarCompraYActualizarTienda @Fecha = ?, @Total = ?, @ID_Compra = ?, @ID_Empleado = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $total);
        $stmt->bindParam(3, $idCompra);
        $stmt->bindParam(4, $idEmpleado);
        $stmt->execute();
    }

    public function updateCompra($compra, $fecha, $total, $idCompra, $idEmpleado) {
        $query = "EXEC ModificarCompra @Compra = ?, @Fecha = ?, @Total = ?, @ID_Compra = ?, @ID_Empleado = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $compra);
        $stmt->bindParam(2, $fecha);
        $stmt->bindParam(3, $total);
        $stmt->bindParam(4, $idCompra);
        $stmt->bindParam(5, $idEmpleado);
        $stmt->execute();
    }

    public function getComprasPorEmpleado($ID_Empleado) {
        try {
            $query = $this->connection->prepare("EXEC MostrarComprasPorEmpleado :ID_Empleado");
            $query->bindParam(':ID_Empleado', $ID_Empleado, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getPagosPorEmpleado($ID_Empleado) {
        try {
            $query = $this->connection->prepare("EXEC MostrarPagosPorEmpleado :ID_Empleado");
            $query->bindParam(':ID_Empleado', $ID_Empleado, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}
?>
