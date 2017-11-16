<?php

require_once '../libsArchivos/AccesoDatos.php';

class Cochera
{
    private $_id;
    private $_idVehiculo;
    private $_especial;
    private $_disponible;

/* Método Constructor.
*/
    public function Cochera($idVeh, $especial, $disponible, $id = null)
    {
        // Seteamos el resto de los valores. 
        $this->setId($id);
        $this->setIdVehiculo($idVeh);
        $this->setEspecial($especial);
        $this->setDisponible($disponible);
        
    }

    // Getters y Setters. 
    public function setId($valor)
    {
        $this->_id = $valor;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setIdVehiculo($valor)
    {
        $this->_idVehiculo = $valor;
    }

    public function getIdVehiculo()
    {
        return $this->_idVehiculo;
    }

    public function setEspecial($valor)
    {
        $this->_especial = $valor;
    }
    
    public function getEspecial()
    {
        return $this->_especial;
    }

    public function setDisponible($valor)
    {
        $this->_disponible = $valor;
    }

    public function getDisponible()
    {
        return $this->_disponible;
    }
}

?>