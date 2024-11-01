<?php
require_once 'SQLSRVConnector.php';
require_once '../Model/HistorialPagosPrestamos.php';

class HistorialPagosPrestamos_C
{
    private $connection;
    public function __construct()
    {
        $this->connection = SQLSRVConnector::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    // Obtener todo el historial de pagos
    public function getAllByPrestamoId(int $idPrestamo): array
    {
        $query = "EXEC MostrarHistorialDePagos @ID_Prestamo = :idPrestamo";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':idPrestamo', $idPrestamo, PDO::PARAM_INT);
        $stmt->execute();

        $pagos = [];
        while ($row = $stmt->fetch()) {
            // Crea un nuevo objeto HistorialPagosPrestamos
            $pago = new HistorialPagosPrestamos(
                $row['ID_Pago'],
                $row['Fecha'],
                $row['Monto'],
                $row['No_cuota'],
                $row['Saldo_Pendiente'],
                $row['ID_Poliza'],
                $row['ID_Prestamos'],
                $row['NombreCompleto']
            );
            array_push($pagos, $pago);
        }
        return $pagos;
    }
    
    // Insertar un nuevo pago
    public function insert($pago)
    {
        $query = "EXEC InsertarHistorialYActualizarPrestamo @Fecha = ?, @Monto = ?, @No_cuota = ?, @Saldo_Pendiente = ?, @ID_Empleado = ?, @ID_Poliza = ?, @ID_Prestamos = ?";
        $stmt = $this->connection->prepare($query);
        $fecha = $pago->getFecha();
        $monto = $pago->getMonto();
        $noCuota = $pago->getNoCuota();
        $saldoPendiente = $pago->getSaldoPendiente();
        $idEmpleado = $pago->getIdEmpleado();
        $idPoliza = $pago->getIdPoliza();
        $idPrestamo = $pago->getIdPrestamo();

        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $monto);
        $stmt->bindParam(3, $noCuota);
        $stmt->bindParam(4, $saldoPendiente);
        $stmt->bindParam(5, $idEmpleado);
        $stmt->bindParam(6, $idPoliza);
        $stmt->bindParam(7, $idPrestamo);

        $stmt->execute();
    }
}
