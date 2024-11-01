<?php

require_once '../Modelos/INTECAP.php';
require_once 'Connector_C.php';

class INTECAP_C
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connector_C::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    public function getAll() {
        $sql = "EXEC MostrarIntecap";
        $stmt = $this->connection->query($sql);
        $intecapList = [];

        while ($row = $stmt->fetch()) {
            $intecapList[] = new Intecap(
                $row['Mes'],
                $row['Anio'],
                $row['Monto_Patronal'],
                $row['ID_Empleado'],
                $row['ID_Poliza'],
                $row['NombreCompleto']
            );
        }

        return $intecapList;
    }

}