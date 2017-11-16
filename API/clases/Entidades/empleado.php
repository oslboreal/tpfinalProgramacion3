<?php
require_once '../libsArchivos/AccesoDatos.php';
require_once '../libsArchivos/SistemaJWT.php';
class Empleado{
    public $id;
    public $nombre;
    public $email;
    public $sexo;
    public $clave;
    public $turno;
    public $perfil;
    public $estado;

    // FALTA:
    // Agregar a las consultas la propiedad $estado
    // Mejorar los datos almacenados en el JWT. (Por ahora solo puse CLAVE y CORREO (SACAR CLAVE OBVIO))
    //

    // DATOS : ALTA - BAJA - MODIFICAR - LISTAR
    
    public function Alta(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $passw = md5($this->clave);
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,email,sexo,clave,turno,perfil)values('$this->nombre','$this->email','$this->sexo', '$passw' ,'$this->turno','$this->perfil')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
                   
    }
    public function Baja(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from empleado 				
            WHERE id=:id");	
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
    }
    public function Modificar(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleado
        set nombre=:nombre,
        email=:email,
        sexo=:sexo,
        clave=:clave,
        turno=:turno,
        perfil=:perfil
        WHERE id=:id");
        $consulta->bindValue(':id',$this->_id,PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':email',$this->email,PDO::PARAM_STR);
        $consulta->bindValue(':sexo',$this->sexo,PDO::PARAM_STR);
        $consulta->bindValue(':clave',$this->clave,PDO::PARAM_STR);
        $consulta->bindValue(':turno',$this->turno,PDO::PARAM_STR);
        $consulta->bindValue(':perfil',$this->perfil,PDO::PARAM_STR);
        return $consulta->execute();
    }
    public static function BajaPorId($id){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from empleado 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }
    public static function Listar(){
        $reflector = new ReflectionClass('Empleado');
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from empleado");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
    }

    public static function ChequearUsuario($correo, $clave)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM empleado WHERE email=:correo AND clave=:pass");
        $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
        $consulta->bindValue(':pass', md5($clave), PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
        // Como resultado en caso de que los datos sean correctos devuelve el usuario en cuestión. 
        // El cual será almacenado para crear el JWT.
    }
}
?>