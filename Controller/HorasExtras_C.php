<?php
require_once 'SQLSRVConnector.php';
require_once '../Model/HorasExtras.php';

class HorasExtras_C {
    private $connection;
    public function __construct() {
        $this->connection = SQLSRVConnector::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    // Obtener todas las horas extras
    public function getAll() : array {
        $query = "EXEC MostrarHorasExtras";
        $result = $this->connection->query($query);
        $horasExtras = [];
        while ($row = $result->fetch()) {
            $horaExtra = new HorasExtras(
                $row['ID_HoraExtra'],
                $row['Fecha'],
                $row['Hora_Normal'],
                $row['Hora_Doble'],
                $row['Total_Normal'],
                $row['Total_Doble'],
                $row['ID_Empleado'],
                $row['NombreCompleto']
            );
            array_push($horasExtras, $horaExtra);
        }
        return $horasExtras;
    }

    // Obtener hora extra
    public function getById($id) {
        $query = "EXEC BuscarHoraExtra ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch();
        return new HorasExtras(
            $row['ID_HoraExtra'],
            $row['Fecha'],
            $row['Hora_Normal'],
            $row['Hora_Doble'],
            $row['Total_Normal'],
            $row['Total_Doble'],
            $row['ID_Empleado']
        );
    }
    
    public function insert($horaExtra) {
        $query = "EXEC AgregarHorasExtras ?, ?, ?, ?, ?, ?";
        $stmt = $this->connection->prepare($query);

        $fecha = $horaExtra->getFecha();
        $horaNormal = $horaExtra->getHoraNormal();
        $horaDoble = $horaExtra->getHoraDoble();
        $totalNormal = $horaExtra->getTotalNormal();
        $totalDoble = $horaExtra->getTotalDoble();
        $idEmpleado = $horaExtra->getIDEmpleado();

        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $horaNormal);
        $stmt->bindParam(3, $horaDoble);
        $stmt->bindParam(4, $totalNormal);
        $stmt->bindParam(5, $totalDoble);
        $stmt->bindParam(6, $idEmpleado);
        
        return $stmt->execute();
    }

    // Actualizar hora extra
    public function update(HorasExtras $horasExtra) {
        $query = "EXEC ModificarHoraExtra ?, ?, ?, ?, ?, ?, ?";
        $stmt = $this->connection->prepare($query);

        $idHoraExtra = $horasExtra->getIdHoraExtra();
        $fecha = $horasExtra->getFecha();
        $horaNormal = $horasExtra->getHoraNormal();
        $horaDoble = $horasExtra->getHoraDoble();
        $totalNormal = $horasExtra->getTotalNormal();
        $totalDoble = $horasExtra->getTotalDoble();
        $idEmpleado = $horasExtra->getIdEmpleado();

        $stmt->bindParam(1, $idHoraExtra);
        $stmt->bindParam(2, $fecha);
        $stmt->bindParam(3, $horaNormal);
        $stmt->bindParam(4, $horaDoble);
        $stmt->bindParam(5, $totalNormal);
        $stmt->bindParam(6, $totalDoble);
        $stmt->bindParam(7, $idEmpleado);
        
        return $stmt->execute();
    }

    // Borrar hora extra por ID
    public function delete($id) {
        $query = "EXEC BorrarHoraExtra ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
