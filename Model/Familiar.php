<?php
class Familiar {
    private $idFamiliar, $nombre, $apellido, $relacion, $fechaNacimiento, $idEmpleado, $NombreCompleto;

    public function __construct($idFamiliar = null, $nombre, $apellido, $relacion, $fechaNacimiento, $idEmpleado, $NombreCompleto = null) {
        $this->idFamiliar = $idFamiliar; $this->nombre = $nombre; $this->apellido = $apellido; $this->relacion = $relacion; $this->fechaNacimiento = $fechaNacimiento; $this->idEmpleado = $idEmpleado; $this->NombreCompleto = $NombreCompleto;
    }

    public function getIdFamiliar() { return $this->idFamiliar; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getRelacion() { return $this->relacion; }
    public function getFechaNacimiento() { return $this->fechaNacimiento; }
    public function getIdEmpleado() { return $this->idEmpleado; }
    public function getNombreCompleto() { return $this->NombreCompleto; }
    
    public function setIdFamiliar($idFamiliar) { $this->idFamiliar = $idFamiliar; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellido($apellido) { $this->apellido = $apellido; }
    public function setRelacion($relacion) { $this->relacion = $relacion; }
    public function setFechaNacimiento($fechaNacimiento) { $this->fechaNacimiento = $fechaNacimiento; }
    public function setIdEmpleado($idEmpleado) { $this->idEmpleado = $idEmpleado; }
    public function setNombreCompleto($NombreCompleto) { $this->NombreCompleto = $NombreCompleto; }
}
?>
