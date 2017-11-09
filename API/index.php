<?php
require_once 'clases/vehiculo.php';
require_once 'clases/empleado.php';
require_once 'clases/estacionamientoApi.php';
require_once 'clases/estacionamiento.php';
require_once 'clases/AccesoDatos.php';
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;
$app = new \Slim\Slim();

// Servicios.

$app->get('/', function(){
    
});

$app->post('/ingreso', function()
{
    // Datos necesarios para corroborar ingreso.
   $correo = $_POST['email'];
   $clave = $_POST['clave'];
    if($correo != "" && $clave != "")
    {
        $ver = Empleado::ChequearUsuario($correo, $clave);
        if($ver!= null)
        {
            $token = GestorToken::NuevoToken($ver);
            $resultado = GestorToken::ChequearToken($token);
            echo $token;
        }
    }
});


/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/estacionamiento', function() {
 
  $this->post('/', \EstacionamientoApi::class . ':CargarUno');
});






$app->run();
?>