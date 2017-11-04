<?php

include_once 'vehiculo.php';
// ($patente, $marca, $color, $esEspecial, $estacionado, $id = null)
$a = new Vehiculo();
$a->color = "VERDE";
$a->esEspecial = false;
$a->estacionado = false;
$a->foto = "ADGARA";
$a->id = "7";
$a->marca = "FORD";
$a->patente = "JJJ555";

$a->modificar();

?>