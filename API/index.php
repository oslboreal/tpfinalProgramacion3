<?php
require_once 'clases/vehiculo.php';
require_once 'clases/empleado.php';
// Incluimos el AUTOLOAD.
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

// Instanciamos un objeto de la clase SLIM:

$app = new \Slim\Slim();

// --------Servicio: ALTA DE REGISTROS
$app->get('/alta', function(){
    // 1. Instancia un objeto recibiendo los parámetros. 
	// 2. Emplea su método para cargar a la base de datos. 	

});
// --------Servicio: BAJA DE REGISTROS
$app->get('/baja', function(){
    // Ver algoritmo ideal.

});
// --------Servicio: LISTAR DE REGISTROS
$app->get('/listar', function(){
    // Método estatico de entidad que trae un Array de elementos de ese tipo de entidad. 
	// Transformamos ese array en JSON. 

});
// --------Servicio: MODIFICAR REGISTROS
$app->get('/modificar', function(){
    // 1. Se recibe el id. 
	// 2. Se reciben los datos y se los almacena en una entidad. 
	// 3. Se emplea el método de modificación de la clase en cuestión.
});

// --------Servicio: SALUDO.
$app->get('/', function(){
    // Instancia.
    echo 'Hello world';
});

$app->get('/ingreso', function()
{
    echo 'Aplicación de ingreso, aquí devuelvo un WEBTOKEN si los datos son válidos.';
    $clave = 'jmvserver';
    $payload = array(
        "id" => 1,
        "mail" => "correo@hot.com",
        "tipo" => "admin"
    );

    $token = JWT::encode($payload, $clave);
    echo $token;
});

// correr la app
$app->run();
?>