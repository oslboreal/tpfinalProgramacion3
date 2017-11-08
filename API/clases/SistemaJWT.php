<?php
/*
    Middleware basado en el AutentificadorJWT
    --> github.com/oslboreal/tpfinalProgramacion3

*/

use \Firebase\JWT\JWT;

class GestorToken
{
    private static $clave = 'magistral';

    public static function NuevoToken($datos)
    {
        $now = time();
        $pl = array(
            'iat' => $now,
            'exp' => $now + 30,
            'data' => $datos,
            'vinfo' => self::visitorInfo()
        );
        // Retorno mi JWT. 
        $jwt = JWT::encode($pl, self::$clave);
        return $jwt;
    }

    public static function ChequearToken($jwt)
    {
        if(empty($jwt) || $jwt == "")
        {
            throw new Exception("Error: El JWT está vacio.");
        }
        try
        {
            $decode = JWT::decode($jwt, self::$clave);
        } catch(ExpiredException $e)
        {
            throw new Exception("Error Processing Request", 1);
        }
        // En caso de no haber caído en ninguna Exception podemos proceder a obtener el Payload.
        if($decode->aud !== self::visitorInfo())
        {
            throw new Exception("Se detecto un cambio en la informacion del visitante.");
        }
        return true;
    }

    public static function ObtenerPayload($jwt)
    {
        if(self::ChequearToken($jwt))
        {
            $payload = JWT::decode($jwt, self::$clave);
            return $payload;
        }
    }

    public static function ObtenerDatos($jwt)
    {
        return self::ObtenerPayload($jwt)->data;
    }

    public static function visitorInfo()
    {
        // Obtenemos datos de nuestro visitante.
        $infoVisitante = "";
        $infoVisitante = $infoVisitante.$_SERVER['HTTP_USER_AGENT'];
        // Generamos nuestro HASH md5 para corroborrar que el usuario sea el mismo.
        return md5($infoVisitante);
    }
}



?>