<?php

require_once '../Modelos/IGSS.php';
require_once 'Connector_C.php';

class IGSS_C
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connector_C::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    public function getAll()
    {
        $sql = "EXEC MostrarIGSS";
        $stmt = $this->connection->query($sql);
        $registrosIGSS = [];

        while ($row = $stmt->fetch()) {
            $registrosIGSS[] = new IGSS(
                $row['Mes'],
                $row['Anio'],
                $row['Monto_Patronal'],
                $row['Monto_Laboral'],
                $row['ID_Empleado'],
                $row['ID_Poliza'],
                $row['NombreCompleto']
            );
        }

        return $registrosIGSS;
    }
}