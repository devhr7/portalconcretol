<?php
class Cotizacion{
    private $idCotizacion;
    private $archivo;
    private $precio; 
    private $fecha;
    
    public function __construct($archivo,$precio,$fecha){
        $this->precio =$precio;
        $this->archivo = $archivo;
        $this->fecha = $fecha;

	}
    public function getFecha()
    {
        return $this->fecha;
    }


    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
    public function getArchivo()
    {
        return $this->archivo;
    }


    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }


    public function getIdCotizacion()
    {
        return $this->idCotizacion;
    }

    public function setIdCotizacion($idCotizacion)
    {
        $this->idCotizacion = $idCotizacion;

        return $this;
    }
}




?>