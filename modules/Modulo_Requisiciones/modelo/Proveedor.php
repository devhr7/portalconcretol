<?php 
class Proveedor
{
    private $id;
	private $razonSocial;
	private $ubicacion;

	public function __construct($id,$razonSocial,$ubicacion){
        $this->id = $id;
        $this->razonSocial = $razonSocial;
        $this->ubicacion = $ubicacion;

	}

	public function getRazonSocial()
	{
		return $this->razonSocial;
	}

	public function setUbicacion($ubicacion)
	{
		$this->ubicacion = $ubicacion;

		return $this;
	}
   public function getUbicacion()
    {
        return $this->ubicacion;
    }

    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

 
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

 
    }
}

 ?>