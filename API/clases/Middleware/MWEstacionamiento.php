<?php

require_once '../libsArchivos/AccesoDatos.php';
require_once '../Entidades/estacionamiento.php';
require_once '../libsArchivos/imageJmv.php';

class EstacionamientoApi extends Estacionamiento
{
    // Método que se encarga de traer todos los CDS y retorna un estado 200.
    public function MWTraerTodos($request, $response, $args)
    {
        $todosLosRegistros = Estacionamiento::listar();
        $nuevaRespuesta = $response->withJson($todosLosRegistros, 200);
        return $nuevaRespuesta;
    }

    // Método que trae un registro por ID.
    public static function MWTraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $arreglo = Estacionamiento::listarUno($id);
        if(!$arreglo)
        {
            $objetoError = new stdclass();
            $objetoError->error = "No se encontro el registro buscado.";
            return $response->withJson($objetoError, 500);
        }else
        {
            return $response->withJson($arreglo, 200);
        }
    }

    public static function MWCargar($request, $response, $args)
    {
         // Tomamos los datos necesarios para dar ALTA a un nuevo registro.
         //   public $id;
         //   public $idEmpleadoEntrada;
         //   public $idCochera;
         //   public $fechaEntrada;
         $respuesta = new stdclass();
         $direccion = "";
         $arreglo = $request->getParsedBody();
         $idEmpleadoEntrada = $arreglo['idEmpleadoEntrada'];
         $idCochera = $ararreglo['idCochera'];
         $fechaEntrada = $arreglo['fechaEntrada'];

         $estacionamientoTemp = new Estacionamiento();
         $estacionamientoTemp->idEmpleadoEntrada = $idEmpleadoEntrada;
         $estacionamientoTemp->idCochera = $idCochera;
         $estacionamientoTemp->fechaEntrada = $fechaEntrada;

         // Chequeamos foto. 
         $archivos = $request->getUploadedFiles();
         if(isset($archivos['foto']))
         {
            $foto = new imageJmv($archivos['foto'],1);
            $foto->imageCreate();
            $foto->imageSave('../autos/', $this->fechaEntrada."-".$this->id);
            $direccion = $this->fechaEntrada."-".$this->id.$foto->getType();
            //var_dump($direccion);
         }
         
         $estacionamientoTemp->foto = $direccion;
         if($estacionamientoTemp->alta() != 0)
         {
         $respuesta->mensaje = "El registro se cargo correctamente";
         return $response->withJson($respuesta, 200);
         }else
         {
             $respuesta->error = "No se cargo correctamente el registro";
             return $response->withJson($respuesta, 200);
         }
    }

    public static function MWBorrar($request, $response, $args)
    {

    }

    public static function MWModificar($request, $response, $args)
    {

    }
}

?>