<?php
require_once '../Modelos/IRTRA.php';
require_once 'Connector_C.php';

class IRTRA_C
{

    private $connection;

    public function __construct() {
        $this->connection = Connector_C::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    public function getAll() {
        $sql = "EXEC MostrarIrtra";
        $stmt = $this->connection->query($sql);
        $registrosIRTRA = [];

        while ($row = $stmt->fetch()) {
            $registrosIRTRA[] = new IRTRA(
                $row['Mes'],
                $row['Anio'],
                $row['Monto_Patronal'],
                $row['ID_Empleado'],
                $row['ID_Poliza'],
                $row['NombreCompleto']
            );
        }

        return $registrosIRTRA;
    }

}