<?php
class Item{

    private $idItem;
    private $nombreArticulo;
    private $descripcion;
    private $imagen;
    public function __construct($idItem,$nombreArticulo,$descripcion,$imagen){

        $this->idItem=$idItem;
        $this->nombreArticulo = $nombreArticulo;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        
	}

    public function getNombreArticulo()
    {
        return $this->nombreArticulo;
    }

    public function setNombreArticulo($nombreArticulo)
    {
        $this->nombreArticulo = $nombreArticulo;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getIdItem()
    {
        return $this->idItem;
    }


    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;

        return $this;
    }
}