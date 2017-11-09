<?php
require_once '../../vendor/autoload.php';
require_once 'estacionamiento.php';
require_once 'estacionamientoApi.php';
use \Firebase\JWT\JWT;
include_once 'empleado.php';
// ($patente, $marca, $color, $esEspecial, $estacionado, $id = null)

$empleado = new Empleado();
$empleado->email = "carlos@empleado";
$empleado->clave = "carlos";
$empleado->perfil = "Usuario";
$empleado->estado = true;
$empleado->nombre = "Carlos Gomez";
$empleado->sexo = "Masculino";
$empleado->turno = "Mañana";

/////////////////

$estaci = new Estacionamiento();
$estaci->id = 20;
$fecha = getdate();
$estaci->fechaEntrada = date("Y-m-d H:i:s");
$estaci->idCochera = 3;
$estaci->foto = "test.png";
$estaci->idEmpleadoEntrada = 6;
$arreglo = $estaci->modificar();

EstacionamientoApi::MWCargar();

?>