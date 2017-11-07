<?php
require_once 'AccesoDatos.php';
class Estacionamiento{
   public $_id;
   public $_idEmpleadoEntrada;
   public $_idCochera;
   public $_fechaEntrada;
   public $_capacidad;
   public $_idEmpleadoSalida;
   public $_fechaSalida;

   public function Estacionamiento($idEmpleadoEntrada, $idCochera, $fechaEntrada, $capacidad, $id = null)
   {
        $this->setIdEmpleadoEntrada($idEmpleadoEntrada);
        $this->setIdCochera($idCochera);
        $this->setFechaEntrada($fechaEntrada);
        $this->setCapacidad($capacidad);
        $this->setId($id);
   }
 
    // Consultas a BASE DE DATOS 

    public function alta()
    {

    }

    public function baja()
    {

    }

    public function modificar()
    {
        
    }

    public function listar()
    {
        
    }
}
?>