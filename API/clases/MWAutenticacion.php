<?php

require_once "SistemaJWT.php";
class MWAutenticacion
{
	// Llamando este Middleware se va a corroborar que si la Solicitud es de tipo POST el Usuario sea Admin 
	// Caso contrario le retornamos Error. 
	public function PermitirCargaAdministrador($request, $response, $next)
	{
		$isValidUser = false;
		if($request->isPost())
		{
			if($isValidUser)
			{
				// Recibo el TOKEN y lo verifico, si está todo bien vaya y pase.
				$response = $next($request, $response);
			}
		}
	}
	// Llamando este Middleware se va a corroborar que si la Solicitud es de tipo GET el Usuario sea Admin 
	// Caso contrario le retornamos Error. 
	public function PermitirVerAdministrador($request, $response, $next)
	{
		$isValidUser = false;
		if($request->isGet())
		{
			// Recibo el TOKEN y lo verifico, si está todo bien vaya y pase.
			$response = $next($request, $response);
		}
	}
	// Llamando este Middleware se va a corroborar que si la Solicitud es de tipo POST el Usuario sea Usuario 
	// Caso contrario le retornamos Error. 
	public function PermitirCargaUsuario($request, $response, $next)
	{
		$isValidUser = false;
		if($request->isPost())
		{
			// Recibo el TOKEN y lo verifico, si está todo bien vaya y pase.
			$response = $next($request, $response);
		}
	}
	// Llamando este Middleware se va a corroborar que si la Solicitud es de tipo GET el Usuario sea Usuario 
	// Caso contrario le retornamos Error. 
	public function PermitirVerUsuario($request, $response, $next)
	{
		$isValidUser = false;
		if($request->isGet())
		{
			// Recibo el TOKEN y lo verifico, si está todo bien vaya y pase.
			$response = $next($request, $response);
		}
	}


	
	// Llamando este Middleware básicamente cualquiera puede realizar una solicitud post.
	// Este método es prácticamente inútil por el hecho de que si sacamos todos los MW del grupo
	// Técnicamente haría lo mismo, pero nos brinda determinada proligidad a la hora de ver el index de la API. 
	// Viendo este MW invocado, sabríamos que clase de servicio es y podríamos modificar facilmente su comportamiento.
	public function PermitirCargaInvitado($request, $response, $next)
	{
		$isValidUser = true;
		if($request->isPost())
		{
			if($isValidUser)
			$response = $next($request, $response);
		}
	}
	// Llamando este Middleware básicamente cualquiera puede realizar una solicitud get.
	public function PermitirVerInvitado($request, $response, $next)
	{
		$isValidUser = false;
		if($request->isGet())
		{
			if($isValidUser)
			$response = $next($request, $response);
		}
	}


	public function VerificarUsuario($request, $response, $next) {
         
		// En el siguiente objeto se almacenaran los datos 
		$datos= new stdclass();
		$datos->respuesta="";
	   
		if($request->isGet())
		{
		 $response = $next($request, $response);
		}
		else
		{

			$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
			
			$token= AutentificadorJWT::CrearToken($datos);

			$objDelaRespuesta->esValido=true; 
			try 
			{
				AutentificadorJWT::verificarToken($token);
				$objDelaRespuesta->esValido=true;      
			}
			catch (Exception $e) {      
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;     
			}

			if($objDelaRespuesta->esValido)
			{						
				if($request->isPost())
				{				    
					$response = $next($request, $response);
				}
				else
				{
					$payload=AutentificadorJWT::ObtenerData($token);

					if($payload->perfil=="Administrador")
					{
						$response = $next($request, $response);
					}		           	
					else
					{	
						$objDelaRespuesta->respuesta="Solo administradores";
					}
				}		          
			}    
			else
			{
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
				$objDelaRespuesta->elToken=$token;

			}  
		}		  
		if($objDelaRespuesta->respuesta!="")
		{
			$nueva=$response->withJson($objDelaRespuesta, 401);  
			return $nueva;
		}

		 return $response;   
	}
}