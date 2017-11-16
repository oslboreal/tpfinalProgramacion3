<?php
require_once '../libsArchivos/AccesoDatos.php';

// Clase estatica para gestionar los parametros del Estacionamiento.
class Sistema
{
    public static $costohora;
    public static $costomediaestadia;
    public static $costoestadia;
    public static $cocherasreservadas;
    public static $cantidadcocheras;
    private static $sistema;


    // Traer parametros

    public static function LoadInfo()
    {
        $objeto = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objeto->RetornarConsulta("SELECT * FROM sistema");
        $consulta->execute();
        self::$sistema = $consulta->fetchAll(PDO::FETCH_CLASS,"Sistema");
    }

        public static function Modificar($hora, $mediaEsta, $estaComple, $reservadas, $cantCocheras){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE sistema
        set costohora='$hora',
        costomediaestadia='$mediaEsta',
        costoestadia='$estaComple',
        cocherasreservadas='$reservadas',
        cantidadcocheras='$cantCocheras'");
        return $consulta->execute();
        }

    // Corroborar datos del sistema.

    public static function ObtainSystemData()
    {
        if(!self::$sistema)
        {
            self::LoadInfo();
            return self::$sistema;
        }else
        {
            return self::$sistema;
        }
    }

    // Obtener costo por hora.
    public static function ObtainCostPerHour()
    {
        self::LoadInfo();
        return self::$costohora;
    }

    // Obtener costo media estadia.
    public static function obtainCostHalfStay()
    {
        self::LoadInfo();
        return self::$costomediaestadia;
    }

    // Obtener costo estadia completa.
    public static function ObtainCostFullStay()
    {
        self::LoadInfo();
        return self::$costoestadia;
    }

    // Obtener lugares reservados.
    public static function ObtainReservedPlaces()
    {
        self::LoadInfo();
        return self::$cocherasreservadas;
    }
}

