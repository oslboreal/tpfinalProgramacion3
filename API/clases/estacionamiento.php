<?php
require_once 'AccesoDatos.php';
class Estacionamiento{
   private $_id;
   private $_idEmpleadoEntrada;
   private $_idCochera;
   private $_fechaEntrada;
   private $_capacidad;
   //campos null
   private $_idEmpleadoSalida;
   private $_fechaSalida;
   //constructor
   public function Estacionamiento($idEmpleadoEntrada, $idCochera, $fechaEntrada, $capacidad, $id = null)
   {
        $this->setIdEmpleadoEntrada($idEmpleadoEntrada);
        $this->setIdCochera($idCochera);
        $this->setFechaEntrada($fechaEntrada);
        $this->setCapacidad($capacidad);
        $this->setId($id);
   }
   //Setters y Getters
   public function setId($id){
        $this->_id = $id;
   }
   
   public function getId(){
       return $this->_id;
   }
    public function setIdEmpleadoEntrada($idEmpleado){
        $this->_idEmpleadoEntrada = $idEmpleado;
    }
    public function getIdEmpleadoEntrada(){
        return $this->_idEmpleadoEntrada;
    }
   public function setIdCochera($idCochera){
        $this->_idCochera = $idCochera;
    }
    public function getIdCochera(){
        return $this->_idCochera;
    }
    public function setFechaEntrada($fecha){
        $this->_fechaEntrada = $fecha;
    }
    public function getFechaEntrada(){
        return $this->_fechaEntrada;
    }
    public function setCapacidad($capacidad){
        $this->_capacidad = $capacidad;
    }
    public function getCapacidad(){
        return $this->_capacidad;
    }
    public function setIdEmpleadoSalida($idEmpleado){
        $this->_idEmpleadoSalida = $idEmpleado;
    }
    public function getIdEmpleadoSalida(){
        return $this->_idEmpleadoSalida;
    }
    public function setFechaSalida($fecha){
        $this->_fechaSalida = $fecha;
    }
    public function getFechaSalida(){
        return $this->_fechaSalida;
    }
    
    /*
    public static function TraerTodosLosRegistros()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from estacionamiento");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Estacionamiento");		
    }
    */
}
?>