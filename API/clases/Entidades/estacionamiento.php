<?php
require_once '../libsArchivos/AccesoDatos.php';
class Estacionamiento{
   public $id;
   public $idEmpleadoEntrada;
   public $idCochera;
   public $fechaEntrada;
   public $foto;

   // Comienzan nulos
   public $idEmpleadoSalida;
   public $fechaSalida;
 
    // Consultas a BASE DE DATOS 

    public function alta()
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta(
        "INSERT into estacionamiento (id,idEmpleadoIngreso,fechaingreso, idEmpleadoSalida,idCochera,fechaSalida, foto)values('$this->id','$this->idEmpleadoEntrada','$this->fechaEntrada','$this->idEmpleadoSalida','$this->idCochera','$this->fechaSalida', '$this->foto')");
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function baja()
    {
        $acceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $acceso->RetornarConsulta("DELETE from estacionamiento WHERE id=:identificacion");
        $consulta->bindValue(':identificacion', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function modificar()
    {
    // id,idEmpleadoIngreso,fechaingreso, idEmpleadoSalida,idCochera,fechaSalida
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE estacionamiento
        set idEmpleadoIngreso='$this->idEmpleadoEntrada',
        fechaIngreso='$this->fechaEntrada',
        idEmpleadoSalida='$this->idEmpleadoSalida',
        idCochera='$this->idCochera',
        fechaSalida='$this->fechaSalida',
        foto='$this->foto'
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function listar()
    {
        $objetoAcceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta("SELECT * FROM estacionamiento");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Estacionamiento");
    }

    public static function listarUno($id)
    {
        $objetoAcceso = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta("SELECT * FROM estacionamiento WHERE id='$id'");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Estacionamiento");
    }
}
?>