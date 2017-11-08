<?php

include_once 'empleado.php';
// ($patente, $marca, $color, $esEspecial, $estacionado, $id = null)

$empleado = new Empleado();
$empleado->email = "admin@admin";
$empleado->clave = "admin";
$empleado->perfil = "Administrador";
$empleado->estado = true;
$empleado->nombre = "Administrador";
$empleado->sexo = "Masculino";
$empleado->turno = "Mañana";

$empleado->Alta();

?>