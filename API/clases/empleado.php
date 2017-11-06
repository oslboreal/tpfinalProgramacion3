<?php
require_once 'AccesoDatos.php';
class Empleado{
    public $id;
    public $nombre;
    public $email;
    public $sexo;
    public $clave;
    public $turno;
    public $perfil;
    
    // DATOS : ALTA - BAJA - MODIFICAR - LISTAR
    
    public function Alta(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,email,sexo,clave,turno,perfil)values('$this->_nombre','$this->_email','$this->_sexo','$this->_clave','$this->_turno','$this->_perfil')");
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
        $consulta->bindValue(':nombre',$this->_nombre,PDO::PARAM_STR);
        $consulta->bindValue(':email',$this->_email,PDO::PARAM_STR);
        $consulta->bindValue(':sexo',$this->_sexo,PDO::PARAM_STR);
        $consulta->bindValue(':clave',$this->_clave,PDO::PARAM_STR);
        $consulta->bindValue(':turno',$this->_turno,PDO::PARAM_STR);
        $consulta->bindValue(':perfil',$this->_perfil,PDO::PARAM_STR);
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
}
?>