<?php
require_once '../../vendor/autoload.php';
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

$resultado = Empleado::ChequearUsuario($empleado->email, $empleado->clave);

$token = GestorToken::NuevoToken($empleado);

var_dump(GestorToken::ChequearToken($token));

?>