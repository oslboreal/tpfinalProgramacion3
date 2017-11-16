<?php
require_once '../../vendor/autoload.php';
require_once 'estacionamiento.php';
require_once 'estacionamientoApi.php';
use \Firebase\JWT\JWT;
include_once 'empleado.php';
require_once 'sistema.php';

Sistema::LoadInfo();
var_dump(Sistema::ObtainSystemData());   

?>