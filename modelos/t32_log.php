<?php

class t32_batch extends conexionPDO
{
    protected $PDO;
    public $id;

    public $con;

    public function __construct()
    {

        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function log_remision()
    {
    }
}
