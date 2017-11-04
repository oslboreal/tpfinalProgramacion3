<?php

require_once 'AccesoDatos.php';

class Vehiculo
{
    public $id;
    public $patente;
    public $marca;
    public $color;
    public $esEspecial; // Si es embarazada o discapacitado es Especial.
    public $estacionado; // Indica si está estacionado o no
    public $foto;


// Método de Instancia - Alta
    public function alta()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta(
        "INSERT into vehiculo (patente, color, foto, marca, especial, estacionado)".
        "values('$this->_patente','$this->_color','$this->_foto', '$this->_marca', '$this->_esEspecial', '$this->_estacionado')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

// Método de Instancia - Baja
    public function baja()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from vehiculo WHERE id=:id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
// Método de Clase - Baja por ID
    static public function bajaPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE from vehiculo WHERE id=:id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
    
// Método de Instancia - Modificacion
    public function modificar()
    {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
"UPDATE vehiculo SET patente=:patente, color=:color, foto=:foto, marca=:marca, especial=:especial, estacionado=:estacionado WHERE id=:id");
            // Declaro el valor de patente. 
            $consulta->bindValue(':patente', $this->patente, PDO::PARAM_STR);
            // Declaramos el ID.
			$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
            // Declaramos el Color. 
            $consulta->bindValue(':color', $this->color, PDO::PARAM_STR);
            // Declaramos la Foto. 
            $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
            // Declaramos la Marca. 
            $consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
            // Declaramos si es Especial. 
            $consulta->bindValue(':especial', $this->esEspecial, PDO::PARAM_BOOL);
            // Declaramos si esta estacionado o No. 
            $consulta->bindValue(':estacionado', $this->estacionado, PDO::PARAM_BOOL);
            return $consulta->execute();
    }

// Método de clase Listar. (Trae todos los Vehiculos almacenados en la base de datos.)
    static public function listar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT patente, id, color, foto, marca, especial, estacionado FROM vehiculo");
        // PDOStatement::fetchAll — Devuelve un array que contiene todas las filas del conjunto de resultados
        $consulta->execute();
        // Agarra el array de objetos obtenidos y los muestra como un array de Vehiculos.
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Vehiculo");
    }
}

?>