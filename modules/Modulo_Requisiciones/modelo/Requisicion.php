<?php 
class Requisicion{


    private $idRequisicion;
    private $fecha;
    private $cantidad;
	private $unidadMedida;
	private $item;
    private $status;
    private $prioridad;
    private $observacion;
    private $imagen;
    private $rolUser;
    private $lugat;

	public function __construct($fecha,$cantidad,$unidadMedida,$item,
    $observacion,$rolUser,$imagen,$lugar,$prioridad){

        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
        $this->unidadMedida = $unidadMedida;
        $this->item = $item;
        $this->observacion = $observacion;
        $this->imagen = $imagen;
        $this->rolUser = $rolUser;
        $this->lugar = $lugar;
        $this->prioridad = $prioridad;
	}
    public function getLugar()
    {
        return $this->lugar;
    }

    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

    }
    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

    }
    public function getRolUser()
    {
        return $this->rolUser;
    }

    public function setRolUser($rolUser)
    {
        $this->rolUser = $rolUser;

    }

    public function getIdRequisicion()
    {
        return $this->idRequisicion;
    }

    public function setIdRequisicion($idRequisicion)
    {
        $this->idRequisicion = $idRequisicion;

    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;


    }

	public function getCantidad()
	{
		return $this->cantidad;
	}

	public function setCantidad($cantidad)
	{
		$this->cantidad = $cantidad;


	}

	public function getUnidadMedida()
	{
		return $this->unidadMedida;
	}

	public function setUnidadMedida($unidadMedida)
	{
		$this->apellido = $apellido;

	}


    public function getItem()
    {
        return $this->item;
    }

    public function setItem($item)
    {
        $this->item = $item;

    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

    }

    public function getObservacion()
    {
        return $this->observacion;
    }

    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

    }
       public function getPrioridad()
    {
        return $this->prioridad;
    }

    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

    }
}
 ?>