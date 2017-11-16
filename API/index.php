<?php
require_once 'clases/Entidades/vehiculo.php';
require_once 'clases/Entidades/empleado.php';
require_once 'clases/Middleware/MWEstacionamiento.php';
require_once 'clases/Entidades/estacionamiento.php';
require_once 'clases/libsArchivos/AccesoDatos.php';
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new Slim\App();

// Registros de Estacionamiento
$app->group('/estacionamiento', function () use ($app) {

    $app->get('/', \EstacionamientoApi::class . ':MWTraerTodos');
    $app->get('/{id}', \EstacionamientoApi::class . ':MWTraerUno');
    $app->post('/cargar', \EstacionamientoApi::class . ':MWCargar');
    
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

$app->run();
?>