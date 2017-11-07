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

// ALTA USUARIOS CON CAMPOS QUE SEAN NECESARIOS. 
// REGISTRO, DOBLE PASSWORD. 
// VALIDARLO, CREAR UN TOKEN
// SI ES UN TIPO DE USUARIO U OTRO TRAER DISTINTOS TIPOS DE DATOS. 
// VAMOS A TENER QUE USAR LOS MIDDLEWARES QUE SEAN NECESARIOS PARA LOS PRIVILEGIOS 
// DAR ALTA INJGRESAR AL SISTEMA, GESTIONAR, VENTA, LISTAR, FILTRAR. 
// API REST --> GRUPOS, MIDDLEWARE
// LOS METODOS VAN A TENER UN LINEAMIENTO, PERO SON GENERICOS. 

$app->post('/ingreso', function()
{
    // Datos necesarios para corroborar ingreso.
    $correo = $_POST['email'];
    $clave = $_POST['clave'];
    if($correo != "" && $clave != "")
    $ver = Empleado::ChequearUsuario($correo, $clave);
  
    // En caso de que la validación haya retornado "DATOS" para poner en nuestro Payload.
    // Procedemos a brindarle su JWT a nuestro CLIENTE
    if(!empty($ver))
    {
        $token = GestorToken::NuevoToken($ver);
        echo $token;
    }
});

// correr la app
$app->run();
?>