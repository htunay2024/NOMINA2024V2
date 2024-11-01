<?php
class Expediente {
    private $idExpediente;
    private $tipoDocumento;
    private $archivo;
    private $idEmpleado;
    private $NombreCompleto;
    public function __construct($idExpediente = null, $tipoDocumento, $archivo, $idEmpleado, $NombreCompleto = null) {
        $this->idExpediente = $idExpediente;
        $this->tipoDocumento = $tipoDocumento;
        $this->archivo = $archivo;
        $this->idEmpleado = $idEmpleado;
        $this->NombreCompleto = $NombreCompleto;
    }
    public function getIdExpediente() {
        return $this->idExpediente;
    }
    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }
    public function getArchivo() {
        return $this->archivo;
    }
    public function getIdEmpleado() {
        return $this->idEmpleado;
    }
    public function getNombreCompleto() {
        return $this->NombreCompleto;
    }
    public function setIdExpediente($idExpediente) {
        $this->idExpediente = $idExpediente;
    }
    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
    public function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }
    public function setNombreCompleto($NombreCompleto) {
        return $this->NombreCompleto;
    }
}
?>
