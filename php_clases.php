<?php


class php_clases
{


    private $tabla;
    private $columna_id;
    private $search_id;
    private $estado;

    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
        setlocale(LC_ALL, 'es_ES');
        setlocale(LC_TIME, 'es_ES');
    }


    function formatofehaF($fecha, $formato_entrada, $formato_salida) // convierte fecha desde base de datos a  $formato = 'd-m-Y'
    {
        $fechaF  = date($formato_entrada, strtotime($fecha));
        if ($fechaF) {
            return date($formato_salida, strtotime($fechaF));
        } else {
            return $fecha;
        }
    }

    function formatofeha($fecha, $formato) // convierte fecha desde base de datos a  $formato = 'd-m-Y'
    {
        $fechaF  = date('Y-m-d', strtotime($fecha));
        if ($fechaF) {
            return date('d-m-Y', strtotime($fechaF));
        } else {
            return $fecha;
        }
    }

    function permisos($rol_user, $array_roles)
    {
        if (in_array($rol_user, $array_roles)) {
            $permisos = "";
        } else {
            $permisos = " disabled='true'";
        }
        return $permisos;
    }
    function generar_tabla($datos_remi)
    {
        $etiqueta_table1 = "<table>";
        $thead1 = "<thead>";
        $tr1 = "<tr>";
        $th1 = "<th>";

        $th2 = "</th>";
        $tr2 = "</tr>";
        $thead2 = "</thead>";


        $columna1 = $th1 . "No" . $th2;
        $columna2 = $th1 . "Codigo Remision" . $th2;
        $columna3 = $th1 . "Imagen" . $th2;

        $tbody1 = "<tbody>";
        $td1 = "<td>";
        $td2 = "</td>";
        $tbody2 = "</tbody>";

        foreach ($datos_remi as $fila_remi) {
            $id_remi = $fila_remi['ct26_id_remision'];
            $codigo_remi = $fila_remi['ct26_codigo_remi'];
            $archivo = $fila_remi['ct26_imagen_remi'];

            $fila = $tr1 . $td1 . $codigo_remi . $td2 . $td1 . $td2 . $tr2;
        }




        $etiqueta_table2 = "</table>";

        $tabla = $etiqueta_table1 . $thead1 . $tr1 . $tr2 . $thead2 . $etiqueta_table2;
    }


    function quitar_dv($numero)
    {
        $numero = intval($numero);

        $rst = substr($numero, 0, 1 - strlen($numero));

        if ($rst == 9 || $rst == 8) {
            if (strlen($numero) > 9) {
                $numero_final = substr($numero, 0, - (strlen($numero) - 9));
                return $numero_final;
            } else {
                return $numero;
            }
        } else {
            return $numero;
        }
    }

    function HR_Crypt($valor, $encode_decode)
    {
        $secret_key = 'my_195501421';
        $secret_iv = 'my_195501421';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($encode_decode == 1) {
            $this->hashnum = base64_encode(openssl_encrypt($valor, $encrypt_method, $key, 0, $iv));
        }
        if ($encode_decode == 2) {
            $this->hashnum = openssl_decrypt(base64_decode($valor), $encrypt_method, $key, 0, $iv);
        }
        return $this->hashnum;
    }



    function validar_rol($array_permiso, $rol_usuario)
    { // en desarrollo
        $rol_usuario = intval($rol_usuario);

        if (in_array($array_permiso, $rol_usuario)) {
            return true;
        } else {
            return false;
        }
    }


    function estado_remi_table($estado)
    {
        $this->estado = $estado;

        switch ($estado) {
            case 1:
                $state = '<small class="badge badge-success"> Facturada </small>';
                break;
            case 2:
                $state = '<small class="badge badge-success"> Firmada </small>';
                break;

            case 3:
                $state = '<small class="badge badge-warning"> Faltan Firma cliente </small>';
                break;

            case 4:
                $state = '<small class="badge badge-warning"> Falta Sincronizacion de datos </small>';
                break;

            default:
                $state = '<small class="badge badge-info">  </small>';
                break;
        }
        return $state;
    }

    function estado_remi($estado)
    {
        $this->estado = $estado;

        switch ($estado) {
            case 1:
                $state = '<small class="badge badge-success"> Facturada </small>';
                break;
            case 2:
                $state = '<small class="badge badge-info"> Pendiente de Facturacion </small>';
                break;

            case 3:
                $state = '<small class="badge badge-warning"> Faltan Firma cliente </small>';
                break;

            case 4:
                $state = '<small class="badge badge-warning"> Falta Sincronizacion de datos </small>';
                break;

            default:
                $state = '<small class="badge badge-info">  </small>';
                break;
        }
        return $state;
    }


    function estado_batch($estado)
    {
        $this->estado = $estado;

        switch ($estado) {
            case 1:
                $state = '<small class="badge badge-success"> Activo </small>';
                break;
            case 2:
                $state = '<small class="badge badge-warning"> Anulado </small>';
                break;

            default:
                $state = '<small class="badge badge-info">  </small>';
                break;
        }
        return $state;
    }






    function estado($estado)
    {
        $this->estado = $estado;

        switch ($estado) {
            case 1:
                $state = '<small class="badge badge-success"> Activo </small>';
                break;
            case 2:
                $state = '<small class="badge badge-warning"> Inactivo </small>';
                break;

            default:
                $state = '<small class="badge badge-info">  </small>';
                break;
        }
        return $state;
    }
}
