<?php
require_once 'clases/vehiculo.php';
require_once 'clases/empleado.php';
// Incluimos el AUTOLOAD.
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

// Instanciamos un objeto de la clase SLIM:

$app = new \Slim\Slim();

// --------Servicio: ALTA DE REGISTROS
$app->post('/alta', function(){
    // 1. Instancia un objeto recibiendo los parámetros. 
	// 2. Emplea su método para cargar a la base de datos. 	

});
// --------Servicio: BAJA DE REGISTROS
$app->post('/baja', function(){
    // Ver algoritmo ideal.

});
// --------Servicio: LISTAR DE REGISTROS
$app->get('/listar', function(){
    // Método estatico de entidad que trae un Array de elementos de ese tipo de entidad. 
	// Transformamos ese array en JSON. 

});
// --------Servicio: MODIFICAR REGISTROS
$app->post('/modificar', function(){
    // 1. Se recibe el id. 
	// 2. Se reciben los datos y se los almacena en una entidad. 
	// 3. Se emplea el método de modificación de la clase en cuestión.
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

// correr la app
$app->run();
?>