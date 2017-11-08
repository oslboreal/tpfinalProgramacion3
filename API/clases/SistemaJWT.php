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
        $ahora = time();
        /*
         parametros del payload
         https://tools.ietf.org/html/rfc7519#section-4.1
         + los que quieras ej="'app'=> "API REST CD 2017" 
        */
        $payload = array(
        	'iat'=>$ahora,
            'exp' => $ahora + (60*60),
            'aud' => self::Aud(),
            'data' => $datos,
            'app'=> "API REST CD 2017"
        );
     
        return JWT::encode($payload, self::$clave);
    }

    public static function ChequearToken($jwt)
    {
        if(empty($jwt) || $jwt == "")
        {
            throw new Exception("Error: El JWT está vacio.");
        }
        try
        {
          self::ObtenerPayload($jwt);
        } catch(ExpiredException $e)
        {
            throw new Exception("Error Processing Request", 1);
        }
        // Si llega a esta instancia es por que no cayó en ninguna exception, por lo tanto el TOKEN es válido.
        return true;
    }

    public static function ObtenerPayload($jwt)
    {
            $payload = JWT::decode($jwt, self::$clave, array('HS256'));
            return $payload;
    }

    public static function ObtenerDatos($jwt)
    {
        return self::ObtenerPayload($jwt)->data;
    }   


    private static function Aud()
    {
        $aud = '';
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();
        
        return sha1($aud);
    }
}



?>