<?php
class HistorialPagosPrestamos {
    private $idPago, $fecha, $monto, $noCuota, $saldoPendiente, $idEmpleado, $idPoliza, $idPrestamo, $NombreCompleto, $cuentaContable;
    public function __construct($idPago = null, $fecha = null, $monto = null, $noCuota = null, $saldoPendiente = null, $idEmpleado = null, $idPoliza = null, $idPrestamo = null, $NombreCompleto = null, $cuentaContable = null) {
        $this->idPago = $idPago; $this->fecha = $fecha; $this->monto = $monto; $this->noCuota = $noCuota; $this->saldoPendiente = $saldoPendiente; $this->idEmpleado = $idEmpleado; $this->idPoliza = $idPoliza; $this->idPrestamo = $idPrestamo; $this->NombreCompleto = $NombreCompleto; $this->cuentaContable = $cuentaContable;
    }
    public function getIdPago() { return $this->idPago; }
    public function getFecha() { return $this->fecha; }
    public function getMonto() { return $this->monto; }
    public function getNoCuota() { return $this->noCuota; }
    public function getSaldoPendiente() { return $this->saldoPendiente; }
    public function getIdEmpleado() { return $this->idEmpleado; }
    public function getIdPoliza() { return $this->idPoliza; }
    public function getIdPrestamo() { return $this->idPrestamo; }
    public function getNombreCompleto() { return $this->NombreCompleto; }
    public function getCuentaContable() { return $this->cuentaContable; }
    public function setIdPago($idPago) { $this->idPago = $idPago; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setMonto($monto) { $this->monto = $monto; }
    public function setNoCuota($noCuota) { $this->noCuota = $noCuota; }
    public function setSaldoPendiente($saldoPendiente) { $this->saldoPendiente = $saldoPendiente; }
    public function setIdEmpleado($idEmpleado) { $this->idEmpleado = $idEmpleado; }
    public function setIdPoliza($idPoliza) { $this->idPoliza = $idPoliza; }
    public function setIdPrestamo($idPrestamo) { $this->idPrestamo = $idPrestamo; }
    public function setNombreCompleto($NombreCompleto) { $this->NombreCompleto = $NombreCompleto; }
    public function setCuentaContable($cuentaContable) { $this->cuentaContable = $cuentaContable; }
}
?>
