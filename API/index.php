<?php
require_once 'clases/coche.php';
// Incluimos el AUTOLOAD.
require_once '../vendor/autoload.php';

// Instanciamos un objeto de la clase SLIM:

$app = new \Slim\Slim();

// --------Servicio: ALTA
$app->get('/alta', function(){
    // 1. Instancia un objeto recibiendo los parámetros. 
	// 2. Emplea su método para cargar a la base de datos. 	
    var_dump($coche);
});
// --------Servicio: BAJA
$app->get('/baja', function(){
    // Ver algoritmo ideal.
    var_dump($coche);
});
// --------Servicio: LISTAR
$app->get('/listar', function(){
    // Método estatico de entidad que trae un Array de elementos de ese tipo de entidad. 
	// Transformamos ese array en JSON. 
    var_dump($coche);
});
// --------Servicio: MODIFICAR
$app->get('/modificar', function(){
    // 1. Se recibe el id. 
	// 2. Se reciben los datos y se los almacena en una entidad. 
	// 3. Se emplea el método de modificación de la clase en cuestión.
    $coche = new Coche("ASD123");
    var_dump($coche);
});

// --------Servicio: SALUDO.
$app->get('/', function(){
    // Instancia.
    echo 'Hello world';
});

// correr la app
$app->run();
?>