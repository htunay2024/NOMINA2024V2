<?php
require_once 'SQLSRVConnector.php';
require_once '../Model/Produccion.php';

class Produccion_C {
    private $connection;
    public function __construct() {
        $this->connection = SQLSRVConnector::getInstance()->getConnection();
        if ($this->connection === null) {
            die("Error: No se pudo establecer la conexión con la base de datos.");
        }
    }

    public function mostrarProduccion() : array {
        $query = "EXEC MostrarProduccionPorEmpleado";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $producciones = [];
        foreach ($result as $row) {
            $produccion = new Produccion(
                $row['ID_Produccion'],
                $row['Fecha'],
                $row['Piezas_Elaboradas'],
                $row['Bonificacion'],
                $row['ID_Empleado'],
                $row['ID_Poliza'],
                $row['NombreCompleto'],
                $row['Cuenta_Contable']
            );
            array_push($producciones, $produccion);
        }
        return $producciones;
    }

    public function buscarProduccionPorId($idProduccion) {
        $query = "EXEC BuscarProduccionPorEmpleado ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $idProduccion);
        $stmt->execute();
        $row = $stmt->fetch();
        return new Produccion(
            $row['ID_Produccion'],
            $row['Fecha'],
            $row['Piezas_Elaboradas'],
            $row['Bonificacion'],
            $row['ID_Empleado'],
            $row['ID_Poliza']
        );
    }

    public function modificarProduccion($idProduccion, $piezasElaboradas, $bonificacion, $idEmpleado, $descripcion) {
        $query = "EXEC ModificarProduccion ?, ?, ?, ?, ?";
        $stmt = $this->connection->prepare($query);
        // Asignar los parámetros a la consulta
        $stmt->bindParam(1, $idProduccion);
        $stmt->bindParam(2, $piezasElaboradas);  
        $stmt->bindParam(3, $bonificacion);
        $stmt->bindParam(4, $idEmpleado);
        $stmt->bindParam(5, $descripcion);

        $stmt->execute();
    }
    
    public function insertarProduccionYPoliza($piezasElaboradas, $bonificacion, $idEmpleado, $descripcion) {
        $query = "EXEC InsertarProduccionYPoliza ?, ?, ?, ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $piezasElaboradas);
        $stmt->bindParam(2, $bonificacion);
        $stmt->bindParam(3, $idEmpleado);
        $stmt->bindParam(4, $descripcion);
        $stmt->execute();
    }

    public function borrarProduccion($idProduccion) {
        $query = "EXEC BorrarProduccion ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $idProduccion);
        $stmt->execute();
    }

    public function getProduccionesByPoliza(int $idPoliza): array {
        $query = "EXEC BuscarProduccionPorPoliza @ID_Poliza = :idPoliza";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':idPoliza', $idPoliza, PDO::PARAM_INT);
        $stmt->execute();
        $producciones = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produccion = new Produccion(
                $row['ID_Produccion'],
                $row['Fecha'],
                $row['Piezas_Elaboradas'],
                $row['Bonificacion'],
                $row['ID_Empleado'],
                $row['NombreCompleto'],
                $row['Cuenta_Contable']
            );
            array_push($producciones, $produccion);
        }
        return $producciones;
    }
}
?>
