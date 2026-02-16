<?php
class cls_importdata extends conexionPDO
{

    public $con;
    protected $PDO;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function insert_ordenpyg(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = "INSERT INTO `ordenpyg`(`puc`, `cuenta`, `niv1pyg`, `niv2pyg`, `niv3pyg`, `niv4pyg`, `idniv4`, `idniv3`, `idniv2`, `idniv1`, `nomniv1`, `nomniv2`, `nomniv3`, `nomniv4`) VALUES (:puc,:cuenta,:niv1pyg,:niv2pyg,:niv3pyg,:niv4pyg,:idniv4,:idniv3,:idniv2,:idniv1,:nomniv1,:nomniv2,:nomniv3,:nomniv4)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':puc', $row['puc'], PDO::PARAM_INT);
                $stmt->bindParam(':cuenta', $row['cuenta'], PDO::PARAM_STR);
                $stmt->bindParam(':niv1pyg', $row['niv1pyg'], PDO::PARAM_STR);
                $stmt->bindParam(':niv2pyg', $row['niv2pyg'], PDO::PARAM_STR);
                $stmt->bindParam(':niv3pyg', $row['niv3pyg'], PDO::PARAM_STR);
                $stmt->bindParam(':niv4pyg', $row['niv4pyg'], PDO::PARAM_STR);
                $stmt->bindParam(':idniv4', $row['idniv4'], PDO::PARAM_INT);
                $stmt->bindParam(':idniv3', $row['idniv3'], PDO::PARAM_INT);
                $stmt->bindParam(':idniv2', $row['idniv2'], PDO::PARAM_INT);
                $stmt->bindParam(':idniv1', $row['idniv1'], PDO::PARAM_INT);
                $stmt->bindParam(':nomniv1', $row['nomniv1'], PDO::PARAM_STR);
                $stmt->bindParam(':nomniv2', $row['nomniv2'], PDO::PARAM_STR);
                $stmt->bindParam(':nomniv3', $row['nomniv3'], PDO::PARAM_STR);
                $stmt->bindParam(':nomniv4', $row['nomniv4'], PDO::PARAM_STR);

                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_pptoprod(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = "INSERT INTO `pptoprod`(`fechames`, `unidadnegocio`, `topcliente`, `ciudad`, `m3prod`) VALUES (:fechames,:unidadnegocio,:topcliente,:ciudad,:m3prod)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion

                $stmt->bindParam(':fechames', $row['fechames'], PDO::PARAM_STR);
                $stmt->bindParam(':unidadnegocio', $row['unidadnegocio'], PDO::PARAM_STR);
                $stmt->bindParam(':topcliente', $row['topcliente'], PDO::PARAM_STR);
                $stmt->bindParam(':ciudad', $row['ciudad'], PDO::PARAM_STR);
                $stmt->bindParam(':m3prod', $row['m3prod'], PDO::PARAM_INT);

                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_prod(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = "INSERT INTO `prod`(`fechames`, `unidadnegocio`, `topcliente`, `ciudad`, `m3prod`) VALUES (:fechames,:unidadnegocio,:topcliente,:ciudad,:m3prod)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':fechames', $row['fechames'], PDO::PARAM_STR);
                $stmt->bindParam(':unidadnegocio', $row['unidadnegocio'], PDO::PARAM_STR);
                $stmt->bindParam(':topcliente', $row['topcliente'], PDO::PARAM_STR);
                $stmt->bindParam(':ciudad', $row['ciudad'], PDO::PARAM_STR);
                $stmt->bindParam(':m3prod', $row['m3prod'], PDO::PARAM_INT);

                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_terceros(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `terceros`(`nit`, `digver`, `claseid`, `codigo`, `nombre`, `nombrec`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `perjuridic`, `inactivo`, `dir`, `dir2`, `tel`, `telmovil`, `fax`, `email`, `email2`, `ciudad`, `pais`, `barrio`, `escliente`, `especliente`, `esproveedor`, `esvendedor`, `esasociado`, `exasociado`, `esempleado`, `escobrador`, `escomision`, `escodeudor`, `estranspor`, `esingotter`, `esvehiculo`, `esbanco`, `esoficial`, `esuniofi`, `espatronal`, `esssalud`, `esriesgo`, `escaja`, `espension`, `escesantia`, `esbenefi`, `esasegura`, `vendedor`, `cobrador`, `propieta`, `agnete`, `banco`, `grupo`, `subgrupo`, `claseter`, `codpostal`, `zona`, `cupo`, `cupo2`, `califica`, `regimen`, `regiment`, `retefte`, `rettodo`, `noretecre`, `granconte`, `autorete`, `reteica`, `tarica`, `noiva`, `actiecon`, `conpub`, `encargado`, `replegar`, `nacio`, `precio`, `fpago`, `condpago`, `nodatacred`, `passcli`, `plazomax`, `plazo`, `plazo2`, `plazo3`, `pdtocli`, `pdtocli2`, `pdtocli3`, `tdtocli`, `tdtocli2`, `tdtocli3`, `pdtocond`, `pdtocond2`, `pdtocond3`, `usuario1`, `fechar`, `fupdateu`, `fupdate`, `cuentab`, `cuentabac`, `codsocial`, `codseps`, `codafp`, `codarp`, `codccf`, `trecipro`, `latitud`, `longitud`, `usuario2`, `diaconv`, `conveniop`, `porcaiua`, `porcaiui`, `porcariuu`, `nodesctos`, `foto`, `ultventa`, `pfinancia`, `declara`, `codpub2`, `prvtas`, `transporte`, `nit2`, `ccostos`, `scostos`, `lugarnac`, `difcobro`, `reteiva`, `valdiasm`, `nobomberil`, `bodega`) VALUES (:nit,:digver,:claseid,:codigo,:nombre,:nombrec,:nombre1,:nombre2,:apellido1,:apellido2,:perjuridic,:inactivo,:dir,:dir2,:tel,:telmovil,:fax,:email,:email2,:ciudad,:pais,:barrio, :escliente,:especliente,:esproveedor,:esvendedor,:esasociado,:exasociado,:esempleado,:escobrador,:escomision,:escodeudor,:estranspor,:esingotter,:esvehiculo,:esbanco,:esoficial,:esuniofi,:espatronal,:esssalud,:esriesgo,:escaja,:espension,:escesantia,:esbenefi,:esasegura,:vendedor,:cobrador,:propieta,:agnete,:banco,:grupo,:subgrupo,:claseter,:codpostal,:zona,:cupo,:cupo2,:califica,:regimen,:regiment,:retefte,:rettodo,:noretecre,:granconte,:autorete,:reteica,:tarica,:noiva,:actiecon,:conpub,:encargado,:replegar,:nacio,:precio,:fpago,:condpago,:nodatacred,:passcli,:plazomax,:plazo,:plazo2,:plazo3,:pdtocli,:pdtocli2,:pdtocli3,:tdtocli,:tdtocli2,:tdtocli3,:pdtocond,:pdtocond2,:pdtocond3,:usuario1,:fechar,:fupdateu,:fupdate,:cuentab,:cuentabac,:codsocial,:codseps,:codafp,:codarp,:codccf,:trecipro,:latitud,:longitud,:usuario2,:diaconv,:conveniop,:porcaiua,:porcaiui,:porcariuu,:nodesctos,:foto,:ultventa,:pfinancia,:declara,:codpub2,:prvtas,:transporte,:nit2,:ccostos,:scostos,:lugarnac,:difcobro,:reteiva,:valdiasm,:nobomberil,:bodega)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':digver', $row['digver'], PDO::PARAM_INT);
                $stmt->bindParam(':claseid', $row['claseid'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':nombrec', $row['nombrec'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre1', $row['nombre1'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre2', $row['nombre2'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido1', $row['apellido1'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido2', $row['apellido2'], PDO::PARAM_STR);
                $stmt->bindParam(':perjuridic', $row['perjuridic'], PDO::PARAM_STR);
                $stmt->bindParam(':inactivo', $row['inactivo'], PDO::PARAM_STR);
                $stmt->bindParam(':dir', $row['dir'], PDO::PARAM_STR);
                $stmt->bindParam(':dir2', $row['dir2'], PDO::PARAM_STR);

                $stmt->bindParam(':tel', $row['tel'], PDO::PARAM_INT);

                $stmt->bindParam(':telmovil', $row['telmovil'], PDO::PARAM_INT);
                $stmt->bindParam(':fax', $row['fax'], PDO::PARAM_INT);
                $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
                $stmt->bindParam(':email2', $row['email2'], PDO::PARAM_STR);
                $stmt->bindParam(':ciudad', $row['ciudad'], PDO::PARAM_INT);
                $stmt->bindParam(':pais', $row['pais'], PDO::PARAM_INT);
                $stmt->bindParam(':barrio', $row['barrio'], PDO::PARAM_INT);
                $stmt->bindParam(':escliente', $row['escliente'], PDO::PARAM_STR);
                $stmt->bindParam(':especliente', $row['especliente'], PDO::PARAM_STR);
                $stmt->bindParam(':esproveedor', $row['esproveedor'], PDO::PARAM_STR);
                $stmt->bindParam(':esvendedor', $row['esvendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':esasociado', $row['esasociado'], PDO::PARAM_STR);
                $stmt->bindParam(':exasociado', $row['exasociado'], PDO::PARAM_STR);
                $stmt->bindParam(':esempleado', $row['esempleado'], PDO::PARAM_STR);
                $stmt->bindParam(':escobrador', $row['escobrador'], PDO::PARAM_STR);
                $stmt->bindParam(':escomision', $row['escomision'], PDO::PARAM_STR);
                $stmt->bindParam(':escodeudor', $row['escodeudor'], PDO::PARAM_STR);
                $stmt->bindParam(':estranspor', $row['estranspor'], PDO::PARAM_STR);
                $stmt->bindParam(':esingotter', $row['esingotter'], PDO::PARAM_STR);
                $stmt->bindParam(':esvehiculo', $row['esvehiculo'], PDO::PARAM_STR);
                $stmt->bindParam(':esbanco', $row['esbanco'], PDO::PARAM_STR);
                $stmt->bindParam(':esoficial', $row['esoficial'], PDO::PARAM_STR);
                $stmt->bindParam(':esuniofi', $row['esuniofi'], PDO::PARAM_STR);
                $stmt->bindParam(':espatronal', $row['espatronal'], PDO::PARAM_STR);
                $stmt->bindParam(':esssalud', $row['esssalud'], PDO::PARAM_STR);
                $stmt->bindParam(':esriesgo', $row['esriesgo'], PDO::PARAM_STR);
                $stmt->bindParam(':escaja', $row['escaja'], PDO::PARAM_STR);
                $stmt->bindParam(':espension', $row['espension'], PDO::PARAM_STR);
                $stmt->bindParam(':escesantia', $row['escesantia'], PDO::PARAM_STR);
                $stmt->bindParam(':esbenefi', $row['esbenefi'], PDO::PARAM_STR);
                $stmt->bindParam(':esasegura', $row['esasegura'], PDO::PARAM_STR);
                $stmt->bindParam(':vendedor', $row['vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':cobrador', $row['cobrador'], PDO::PARAM_STR);
                $stmt->bindParam(':propieta', $row['propieta'], PDO::PARAM_STR);
                $stmt->bindParam(':agnete', $row['agnete'], PDO::PARAM_STR);
                $stmt->bindParam(':banco', $row['banco'], PDO::PARAM_INT);
                $stmt->bindParam(':grupo', $row['grupo'], PDO::PARAM_STR);
                $stmt->bindParam(':subgrupo', $row['subgrupo'], PDO::PARAM_STR);
                $stmt->bindParam(':claseter', $row['claseter'], PDO::PARAM_STR);
                $stmt->bindParam(':codpostal', $row['codpostal'], PDO::PARAM_STR);
                $stmt->bindParam(':zona', $row['zona'], PDO::PARAM_STR);
                $stmt->bindParam(':cupo', $row['cupo'], PDO::PARAM_INT);
                $stmt->bindParam(':cupo2', $row['cupo2'], PDO::PARAM_INT);
                $stmt->bindParam(':califica', $row['califica'], PDO::PARAM_STR);
                $stmt->bindParam(':regimen', $row['regimen'], PDO::PARAM_STR);
                $stmt->bindParam(':regiment', $row['regiment'], PDO::PARAM_STR);
                $stmt->bindParam(':retefte', $row['retefte'], PDO::PARAM_STR);
                $stmt->bindParam(':rettodo', $row['rettodo'], PDO::PARAM_STR);
                $stmt->bindParam(':noretecre', $row['noretecre'], PDO::PARAM_STR);
                $stmt->bindParam(':granconte', $row['granconte'], PDO::PARAM_STR);
                $stmt->bindParam(':autorete', $row['autorete'], PDO::PARAM_STR);
                $stmt->bindParam(':reteica', $row['reteica'], PDO::PARAM_STR);
                $stmt->bindParam(':tarica', $row['tarica'], PDO::PARAM_STR);
                $stmt->bindParam(':noiva', $row['noiva'], PDO::PARAM_STR);
                $stmt->bindParam(':actiecon', $row['actiecon'], PDO::PARAM_INT);
                $stmt->bindParam(':conpub', $row['conpub'], PDO::PARAM_STR);
                $stmt->bindParam(':encargado', $row['encargado'], PDO::PARAM_STR);
                $stmt->bindParam(':replegar', $row['replegar'], PDO::PARAM_STR);
                $stmt->bindParam(':nacio', $row['nacio'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':fpago', $row['fpago'], PDO::PARAM_STR);
                $stmt->bindParam(':condpago', $row['condpago'], PDO::PARAM_STR);
                $stmt->bindParam(':nodatacred', $row['nodatacred'], PDO::PARAM_STR);
                $stmt->bindParam(':passcli', $row['passcli'], PDO::PARAM_STR);
                $stmt->bindParam(':plazomax', $row['plazomax'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo', $row['plazo'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo2', $row['plazo2'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo3', $row['plazo3'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocli', $row['pdtocli'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocli2', $row['pdtocli2'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocli3', $row['pdtocli3'], PDO::PARAM_INT);
                $stmt->bindParam(':tdtocli', $row['tdtocli'], PDO::PARAM_STR);
                $stmt->bindParam(':tdtocli2', $row['tdtocli2'], PDO::PARAM_STR);
                $stmt->bindParam(':tdtocli3', $row['tdtocli3'], PDO::PARAM_STR);
                $stmt->bindParam(':pdtocond', $row['pdtocond'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocond2', $row['pdtocond2'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocond3', $row['pdtocond3'], PDO::PARAM_INT);
                $stmt->bindParam(':usuario1', $row['usuario1'], PDO::PARAM_STR);
                $stmt->bindParam(':fechar', $row['fechar'], PDO::PARAM_STR);
                $stmt->bindParam(':fupdateu', $row['fupdateu'], PDO::PARAM_STR);
                $stmt->bindParam(':fupdate', $row['fupdate'], PDO::PARAM_STR);
                $stmt->bindParam(':cuentab', $row['cuentab'], PDO::PARAM_INT);
                $stmt->bindParam(':cuentabac', $row['cuentabac'], PDO::PARAM_STR);
                $stmt->bindParam(':codsocial', $row['codsocial'], PDO::PARAM_STR);
                $stmt->bindParam(':codseps', $row['codseps'], PDO::PARAM_STR);
                $stmt->bindParam(':codafp', $row['codafp'], PDO::PARAM_STR);
                $stmt->bindParam(':codarp', $row['codarp'], PDO::PARAM_STR);
                $stmt->bindParam(':codccf', $row['codccf'], PDO::PARAM_STR);
                $stmt->bindParam(':trecipro', $row['trecipro'], PDO::PARAM_STR);
                $stmt->bindParam(':latitud', $row['latitud'], PDO::PARAM_STR);
                $stmt->bindParam(':longitud', $row['longitud'], PDO::PARAM_STR);
                $stmt->bindParam(':usuario2', $row['usuario2'], PDO::PARAM_STR);
                $stmt->bindParam(':diaconv', $row['diaconv'], PDO::PARAM_STR);
                $stmt->bindParam(':conveniop', $row['conveniop'], PDO::PARAM_STR);
                $stmt->bindParam(':porcaiua', $row['porcaiua'], PDO::PARAM_STR);
                $stmt->bindParam(':porcaiui', $row['porcaiui'], PDO::PARAM_STR);
                $stmt->bindParam(':porcariuu', $row['porcariuu'], PDO::PARAM_STR);
                $stmt->bindParam(':nodesctos', $row['nodesctos'], PDO::PARAM_STR);
                $stmt->bindParam(':foto', $row['foto'], PDO::PARAM_STR);
                $stmt->bindParam(':ultventa', $row['ultventa'], PDO::PARAM_STR);
                $stmt->bindParam(':pfinancia', $row['pfinancia'], PDO::PARAM_STR);
                $stmt->bindParam(':declara', $row['declara'], PDO::PARAM_STR);
                $stmt->bindParam(':codpub2', $row['codpub2'], PDO::PARAM_STR);
                $stmt->bindParam(':prvtas', $row['prvtas'], PDO::PARAM_STR);
                $stmt->bindParam(':transporte', $row['transporte'], PDO::PARAM_STR);
                $stmt->bindParam(':nit2', $row['nit2'], PDO::PARAM_STR);
                $stmt->bindParam(':ccostos', $row['ccostos'], PDO::PARAM_STR);
                $stmt->bindParam(':scostos', $row['scostos'], PDO::PARAM_STR);
                $stmt->bindParam(':lugarnac', $row['lugarnac'], PDO::PARAM_STR);
                $stmt->bindParam(':difcobro', $row['difcobro'], PDO::PARAM_STR);
                $stmt->bindParam(':reteiva', $row['reteiva'], PDO::PARAM_STR);
                $stmt->bindParam(':valdiasm', $row['valdiasm'], PDO::PARAM_INT);
                $stmt->bindParam(':nobomberil', $row['nobomberil'], PDO::PARAM_STR);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = true;
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_centro_costo(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = " INSERT IGNORE INTO `centrocostos`( `codigo`, `nombre`, `codigocompleto`) VALUES (:codigo, :nombre,:codigocompleto)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':codigocompleto', $row['nombre_completo'], PDO::PARAM_STR);

                if ($stmt->execute()) { // Ejecutar
                    $php_result = true;
                } else {
                    $php_result = true;
                }
            }
            return $php_result;
        } else {
            return false;
        }
    }

    function insert_alance_comprobacion(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = " INSERT INTO `balance_corporativo`( `puc`, `terceros`, `cco`, `scc`, `nombre`, `saldo_anterior`, `movimiento_debito`, `movimiento_credito`, `nuevo_saldo`, `fecha_corte`) VALUES  (:puc, :terceros, :cco, :scc, :nombre, :saldo_anterior, :movimiento_debito, :movimiento_credito, :nuevo_saldo , :fecha_corte)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':puc', $row['puc'], PDO::PARAM_STR);
                $stmt->bindParam(':terceros', $row['tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':cco', $row['cco'], PDO::PARAM_STR);
                $stmt->bindParam(':scc', $row['scc'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':saldo_anterior', $row['saldo_anterior'], PDO::PARAM_STR);
                $stmt->bindParam(':movimiento_debito', $row['mov_debito'], PDO::PARAM_STR);
                $stmt->bindParam(':movimiento_credito', $row['mov_credito'], PDO::PARAM_STR);
                $stmt->bindParam(':nuevo_saldo', $row['nuevo_saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_corte', $row['fecha_corte'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_movimiento_diario(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = "INSERT INTO `movimiento_diario`(`tipo`, `numero`, `numero_cheque`, `Num_extension`, `anio`, `mes`, `dia`, `cuenta`, `nit`, `terceros`, `suc_pto`, `drocela`, `c_costo`, `sc_costo`, `detalles`, `debito`, `credito`, `elaborado`) VALUES(:tipo, :numero, :numero_cheque, :num_extension, :anio, :mes, :dia, :cuenta, :nit, :terceros, :suc_pto, :drocela, :c_costo, :sc_costo, :detalles, :debito, :credito, :elaborado)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':tipo', $row['tipo'], PDO::PARAM_STR);
                $stmt->bindParam(':numero', $row['numero'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_cheque', $row['numero_cheque'], PDO::PARAM_INT);
                $stmt->bindParam(':num_extension', $row['num_extension'], PDO::PARAM_INT);
                $stmt->bindParam(':anio', $row['anio'], PDO::PARAM_INT);
                $stmt->bindParam(':mes', $row['mes'], PDO::PARAM_INT);
                $stmt->bindParam(':dia', $row['dia'], PDO::PARAM_INT);
                $stmt->bindParam(':cuenta', $row['cuenta'], PDO::PARAM_INT);
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':terceros', $row['terceros'], PDO::PARAM_STR);
                $stmt->bindParam(':suc_pto', $row['suc_pto'], PDO::PARAM_STR);
                $stmt->bindParam(':drocela', $row['drocela'], PDO::PARAM_STR);
                $stmt->bindParam(':c_costo', $row['c_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':sc_costo', $row['sc_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':detalles', $row['detalles'], PDO::PARAM_STR);
                $stmt->bindParam(':debito', $row['debito'], PDO::PARAM_STR);
                $stmt->bindParam(':credito', $row['credito'], PDO::PARAM_STR);
                $stmt->bindParam(':elaborado', $row['elaborado'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_notas_inventario(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `notas_inventario`(`referencia`, `servicio`, `detalle`, `cantidad`, `precio`, `valor_unidad`, `valor_iva`, `total_mas_valor_iva`, `iva`, `base_iva`, `t_iva`, `ico`, `referencia1`, `referencia2`, `referencia3`, `referencia4`, `unidad`, `referencia_proveedor`, `tercero`, `descripcion_adicional`, `fecha_mes`, `planta`) VALUES (:referencia, :servicio, :detalle, :cantidad, :precio, :valor_unidad, :valor_iva, :total_mas_valor_iva, :iva, :base_iva, :t_iva, :ico, :referencia1, :referencia2, :referencia3, :referencia4, :unidad, :referencia_proveedor, :tercero, :descripcion_adicional, :fecha_mes, :planta)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':referencia', $row['referencia'], PDO::PARAM_INT);
                $stmt->bindParam(':servicio', $row['servicio'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle', $row['detalle'], PDO::PARAM_STR);
                $stmt->bindParam(':cantidad', $row['cantidad'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_unidad', $row['valor_unidad'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_iva', $row['valor_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':total_mas_valor_iva', $row['total_mas_valor_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':iva', $row['iva'], PDO::PARAM_STR);
                $stmt->bindParam(':base_iva', $row['base_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':t_iva', $row['t_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':ico', $row['ico'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia1', $row['referencia1'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia2', $row['referencia2'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia3', $row['referencia3'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia4', $row['referencia4'], PDO::PARAM_STR);
                $stmt->bindParam(':unidad', $row['unidad'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_proveedor', $row['referencia_proveedor'], PDO::PARAM_STR);
                $stmt->bindParam(':tercero', $row['tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':descripcion_adicional', $row['descripcion_adicional'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_mes', $row['fecha_mes'], PDO::PARAM_STR);
                $stmt->bindParam(':planta', $row['planta'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = true;
                } else {
                    $result = false;
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_kardex(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `kardex`(`l`, `fecha`, `comprobante`, `entradas`, `salidas`, `saldo`, `costo_aplicacion`, `costo_promedio`, `costo_total_saldo`, `detalle1`, `numero_ext`, `bodega`, `tercero`, `nit`, `elaborado`, `referencia`, `detalle2`, `periodo`, `cuenta`, `unidad_medida`) VALUES (:l, :fecha, :comprobante, :entradas, :salidas, :saldo, :costo_aplicacion, :costo_promedio, :costo_total_saldo, :detalle1, :numero_ext, :bodega, :tercero, :nit, :elaborado, :referencia, :detalle2, :periodo, :cuenta, :unidad_medida)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':l', $row['l'], PDO::PARAM_INT);
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':comprobante', $row['comprobante'], PDO::PARAM_STR);
                $stmt->bindParam(':entradas', $row['entradas'], PDO::PARAM_STR);
                $stmt->bindParam(':salidas', $row['salidas'], PDO::PARAM_STR);
                $stmt->bindParam(':saldo', $row['saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_aplicacion', $row['costo_aplicacion'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_promedio', $row['costo_promedio'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_total_saldo', $row['costo_total_saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle1', $row['detalle1'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_ext', $row['numero_ext'], PDO::PARAM_INT);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR);
                $stmt->bindParam(':tercero', $row['tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':elaborado', $row['elaborado'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia', $row['referencia'], PDO::PARAM_INT);
                $stmt->bindParam(':detalle2', $row['detalle2'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo', $row['periodo'], PDO::PARAM_STR);
                $stmt->bindParam(':cuenta', $row['cuenta'], PDO::PARAM_INT);
                $stmt->bindParam(':unidad_medida', $row['unidad_medida'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_cuentas_por_cobrar_clientes(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `cuentas_por_cobrar_clientes`(`nit`, `suc_pto`, `codigo`, `nombre`, `nom_comerc`, `telefono`, `celular`, `direccion`, `fecha`, `vence`, `saldo`, `sin_vencer`, `periodo_1_30`, `periodo_31_60`, `periodo_61_90`, `periodo_91_120`, `periodo_121_360`, `periodo_mas_361`, `meses_vencidos`, `plazo`, `mora`, `numero_externo`, `zona`, `fax`, `anticipos`, `cupo`, `fecha_ultimo_pago`, `observaciones`, `fecha_corte`) 
                VALUES (:nit, :suc_pto, :codigo, :nombre, :nom_comerc, :telefono, :celular, :direccion, :fecha, :vence, :saldo, :sin_vencer, :periodo_1_30, :periodo_31_60, :periodo_61_90, :periodo_91_120, :periodo_121_360, :periodo_mas_361, :meses_vencidos, :plazo, :mora, :numero_externo, :zona, :fax, :anticipos, :cupo, :fecha_ultimo_pago, :observaciones, :fecha_corte)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':suc_pto', $row['suc_pto'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':nom_comerc', $row['nom_comerc'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $row['telefono'], PDO::PARAM_STR);
                $stmt->bindParam(':celular', $row['celular'], PDO::PARAM_STR);
                $stmt->bindParam(':direccion', $row['direccion'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':vence', $row['vence'], PDO::PARAM_STR);
                $stmt->bindParam(':saldo', $row['saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':sin_vencer', $row['sin_vencer'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_1_30', $row['periodo_1_30'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_31_60', $row['periodo_31_60'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_61_90', $row['periodo_61_90'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_91_120', $row['periodo_91_120'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_121_360', $row['periodo_121_360'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_mas_361', $row['periodo_mas_361'], PDO::PARAM_STR);
                $stmt->bindParam(':meses_vencidos', $row['meses_vencidos'], PDO::PARAM_STR);
                $stmt->bindParam(':plazo', $row['plazo'], PDO::PARAM_STR);
                $stmt->bindParam(':mora', $row['mora'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_externo', $row['numero_externo'], PDO::PARAM_STR);
                $stmt->bindParam(':zona', $row['zona'], PDO::PARAM_STR);
                $stmt->bindParam(':fax', $row['fax'], PDO::PARAM_STR);
                $stmt->bindParam(':anticipos', $row['anticipos'], PDO::PARAM_STR);
                $stmt->bindParam(':cupo', $row['cupo'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_ultimo_pago', $row['fecha_ultimo_pago'], PDO::PARAM_STR);
                $stmt->bindParam(':observaciones', $row['observaciones'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_corte', $row['fecha_corte'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_plan_unico_cuentas(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `plan_unico_cuentas`(`codigo_puc`, `nombre`, `nat`, `terc`, `c_cost`, `doc`, `art`, `deprecia`) 
                VALUES (:codigo_puc, :nombre, :nat, :terc, :c_cost, :doc, :art, :deprecia)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo_puc', $row['codigo_puc'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':nat', $row['nat'], PDO::PARAM_STR);
                $stmt->bindParam(':terc', $row['terc'], PDO::PARAM_STR);
                $stmt->bindParam(':c_cost', $row['c_cost'], PDO::PARAM_STR);
                $stmt->bindParam(':doc', $row['doc'], PDO::PARAM_STR);
                $stmt->bindParam(':art', $row['art'], PDO::PARAM_STR);
                $stmt->bindParam(':deprecia', $row['deprecia'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_venta(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `venta`(`venta_devolucion`, `tipo_comprobante`, `numero`, `numero_externo`, `anio`, `mes`, `dia`, `fecha`, `cliente`, `razon_social`, `persona_juridica`, `nombre_comercial`, `cod_tercero`, `suc_pto`, `grupo_cliente`, `subgrupo_cliente`, `codigo_vendedor`, `identificador_vendedor`, `vendedor`, `anexo_1`, `anexo_2`, `anexo_3`, `referencia`, `referencia2`, `servicio`, `codigo_barras`, `referencia_proveedor`, `detalle_comprobante`, `detalle_item`, `informacion_adicional_item`, `unidad`, `linea`, `marca`, `grupo`, `subgrupo`, `grupo_produccion`, `grupo_servicio`, `serial`, `cantidad_venta`, `cantidad_factor_1`, `cantidad_factor_2`, `unidad_ensamble`, `cajas`, `cantidad_devolucion`, `peso`, `valor_unidad_venta`, `valor_total_venta`, `precio_sugerido`, `porcentaje_iva`, `valor_iva`, `valor_impoconsumo`, `costo_unitario`, `costo_total`, `utilidad`, `porcentaje_utilidad`, `porcentaje_rentabilidad`, `valor_fletes`, `valor_fletes_catalogo_articulo`, `valor_descuento_comercial`, `porcentaje_descuento_comercial`, `porcentaje_descuento_especial`, `valor_descuento_financiero`, `porcentaje_descuento_financiero`, `ciudad`, `departamento`, `zona`, `dia_vencimiento`, `mes_vencimiento`, `anio_vencimiento`, `codigo_linea_credito`, `linea_credito`, `dias_plazo`, `dia_pago`, `mes_pago`, `anio_pago`, `dias_pago`, `forma_pago`, `precio`, `referencia_pago_1`, `referencia_pago_2`, `referencia_pago_3`, `referencia_pago_4`, `descripcion_item`, `numero_lote`, `talla_identificador`, `talla`, `direccion`, `telefono`, `bodega`, `bodega_item`, `proyecto`, `centro_costos`, `nit`, `dig_verificacion`, `tipo_id`, `cod_suc`, `semana_anio`, `semana_mes`, `codigo_departamento`, `codigo_ciudad`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `telefonos`, `telefono_movil`, `email`, `cliente_inactivo`, `dia_semana`, `barrio`, `usuario_elaboro`, `agente_comercial`, `regimen_ventas`, `declaracion_renta`, `agente_retenedor`, `auto_retenedor`, `no_aplica_impuesto_cree`, `agente_retenedor_ica`, `causas_devolucion`, `base_calculo_interes_fac_lote`, `porcentaje_interes_fact_lote`, `hora_elaboracion_factura`, `fecha_ingreso`, `estado_subtercero`, `ficha_catastral`, `num_medidor`, `centro_costos_item`, `subcentro_costos_item`, `tercero_item`, `tarifa_iva_catalogo_servicio_articulo`, `porcentaje_iva_catalogo_servicio_articulo`, `nombre_tarifa_iva_aplicada`, `direccion_area`, `telefono_area`, `fax_area`, `ciudad_area`, `email_area`, `email_fe_area`, `barrio_area`, `afecta`, `cantidad_parcial_entregada`) VALUES (:venta_devolucion, :tipo_comprobante, :numero, :numero_externo, :anio, :mes, :dia, :fecha, :cliente, :razon_social, :persona_juridica, :nombre_comercial, :cod_tercero, :suc_pto, :grupo_cliente, :subgrupo_cliente, :codigo_vendedor, :identificador_vendedor, :vendedor, :anexo_1, :anexo_2, :anexo_3, :referencia, :referencia2, :servicio, :codigo_barras, :referencia_proveedor, :detalle_comprobante, :detalle_item, :informacion_adicional_item, :unidad, :linea, :marca, :grupo, :subgrupo, :grupo_produccion, :grupo_servicio, :serial, :cantidad_venta, :cantidad_factor_1, :cantidad_factor_2, :unidad_ensamble, :cajas, :cantidad_devolucion, :peso, :valor_unidad_venta, :valor_total_venta, :precio_sugerido, :porcentaje_iva, :valor_iva, :valor_impoconsumo, :costo_unitario, :costo_total, :utilidad, :porcentaje_utilidad, :porcentaje_rentabilidad, :valor_fletes, :valor_fletes_catalogo_articulo, :valor_descuento_comercial, :porcentaje_descuento_comercial, :porcentaje_descuento_especial, :valor_descuento_financiero, :porcentaje_descuento_financiero, :ciudad, :departamento, :zona, :dia_vencimiento, :mes_vencimiento,:anio_vencimiento, :codigo_linea_credito, :linea_credito, :dias_plazo, :dia_pago, :mes_pago, :anio_pago, :dias_pago, :forma_pago, :precio, :referencia_pago_1, :referencia_pago_2, :referencia_pago_3, :referencia_pago_4, :descripcion_item, :numero_lote, :talla_identificador, :talla, :direccion, :telefono, :bodega, :bodega_item, :proyecto, :centro_costos, :nit, :dig_verificacion, :tipo_id, :cod_suc, :semana_anio, :semana_mes, :codigo_departamento, :codigo_ciudad, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :telefonos, :telefono_movil, :email, :cliente_inactivo, :dia_semana, :barrio, :usuario_elaboro, :agente_comercial, :regimen_ventas, :declaracion_renta, :agente_retenedor, :auto_retenedor, :no_aplica_impuesto_cree, :agente_retenedor_ica, :causas_devolucion, :base_calculo_interes_fac_lote, :porcentaje_interes_fact_lote, :hora_elaboracion_factura, :fecha_ingreso, :estado_subtercero, :ficha_catastral, :num_medidor, :centro_costos_item, :subcentro_costos_item, :tercero_item, :tarifa_iva_catalogo_servicio_articulo, :porcentaje_iva_catalogo_servicio_articulo, :nombre_tarifa_iva_aplicada, :direccion_area, :telefono_area, :fax_area, :ciudad_area, :email_area, :email_fe_area, :barrio_area, :afecta, :cantidad_parcial_entregada)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':venta_devolucion', $row['venta_devolucion'], PDO::PARAM_STR);
                $stmt->bindParam(':tipo_comprobante', $row['tipo_comprobante'], PDO::PARAM_STR);
                $stmt->bindParam(':numero', $row['numero'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_externo', $row['numero_externo'], PDO::PARAM_INT);
                $stmt->bindParam(':anio', $row['anio'], PDO::PARAM_INT);
                $stmt->bindParam(':mes', $row['mes'], PDO::PARAM_INT);
                $stmt->bindParam(':dia', $row['dia'], PDO::PARAM_INT);
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':cliente', $row['cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':razon_social', $row['razon_social'], PDO::PARAM_STR);
                $stmt->bindParam(':persona_juridica', $row['persona_juridica'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre_comercial', $row['nombre_comercial'], PDO::PARAM_STR);
                $stmt->bindParam(':cod_tercero', $row['cod_tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':suc_pto', $row['suc_pto'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_cliente', $row['grupo_cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':subgrupo_cliente', $row['subgrupo_cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo_vendedor', $row['codigo_vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':identificador_vendedor', $row['identificador_vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':vendedor', $row['vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_1', $row['anexo_1'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_2', $row['anexo_2'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_3', $row['anexo_3'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia', $row['referencia'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia2', $row['referencia2'], PDO::PARAM_STR);
                $stmt->bindParam(':servicio', $row['servicio'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo_barras', $row['codigo_barras'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_proveedor', $row['referencia_proveedor'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle_comprobante', $row['detalle_comprobante'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle_item', $row['detalle_item'], PDO::PARAM_STR);
                $stmt->bindParam(':informacion_adicional_item', $row['informacion_adicional_item'], PDO::PARAM_STR);
                $stmt->bindParam(':unidad', $row['unidad'], PDO::PARAM_STR);
                $stmt->bindParam(':linea', $row['linea'], PDO::PARAM_STR);
                $stmt->bindParam(':marca', $row['marca'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo', $row['grupo'], PDO::PARAM_STR);
                $stmt->bindParam(':subgrupo', $row['subgrupo'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_produccion', $row['grupo_produccion'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_servicio', $row['grupo_servicio'], PDO::PARAM_STR);
                $stmt->bindParam(':serial', $row['serial'], PDO::PARAM_STR);
                $stmt->bindParam(':cantidad_venta', $row['cantidad_venta'], PDO::PARAM_INT);
                $stmt->bindParam(':cantidad_factor_1', $row['cantidad_factor_1'], PDO::PARAM_INT);
                $stmt->bindParam(':cantidad_factor_2', $row['cantidad_factor_2'], PDO::PARAM_INT);
                $stmt->bindParam(':unidad_ensamble', $row['unidad_ensamble'], PDO::PARAM_INT);
                $stmt->bindParam(':cajas', $row['cajas'], PDO::PARAM_INT);
                $stmt->bindParam(':cantidad_devolucion', $row['cantidad_devolucion'], PDO::PARAM_INT);
                $stmt->bindParam(':peso', $row['peso'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_unidad_venta', $row['valor_unidad_venta'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_total_venta', $row['valor_total_venta'], PDO::PARAM_STR);
                $stmt->bindParam(':precio_sugerido', $row['precio_sugerido'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_iva', $row['porcentaje_iva'], PDO::PARAM_INT);
                $stmt->bindParam(':valor_iva', $row['valor_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_impoconsumo', $row['valor_impoconsumo'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_unitario', $row['costo_unitario'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_total', $row['costo_total'], PDO::PARAM_STR);
                $stmt->bindParam(':utilidad', $row['utilidad'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_utilidad', $row['porcentaje_utilidad'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_rentabilidad', $row['porcentaje_rentabilidad'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_fletes', $row['valor_fletes'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_fletes_catalogo_articulo', $row['valor_fletes_catalogo_articulo'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_descuento_comercial', $row['valor_descuento_comercial'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_descuento_comercial', $row['porcentaje_descuento_comercial'], PDO::PARAM_INT);
                $stmt->bindParam(':porcentaje_descuento_especial', $row['porcentaje_descuento_especial'], PDO::PARAM_INT);
                $stmt->bindParam(':valor_descuento_financiero', $row['valor_descuento_financiero'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_descuento_financiero', $row['porcentaje_descuento_financiero'], PDO::PARAM_INT);
                $stmt->bindParam(':ciudad', $row['ciudad'], PDO::PARAM_STR);
                $stmt->bindParam(':departamento', $row['departamento'], PDO::PARAM_STR);
                $stmt->bindParam(':zona', $row['zona'], PDO::PARAM_STR);
                $stmt->bindParam(':dia_vencimiento', $row['dia_vencimiento'], PDO::PARAM_INT);
                $stmt->bindParam(':mes_vencimiento', $row['mes_vencimiento'], PDO::PARAM_INT);
                $stmt->bindParam(':anio_vencimiento', $row['anio_vencimiento'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo_linea_credito', $row['codigo_linea_credito'], PDO::PARAM_STR);
                $stmt->bindParam(':linea_credito', $row['linea_credito'], PDO::PARAM_STR);
                $stmt->bindParam(':dias_plazo', $row['dias_plazo'], PDO::PARAM_INT);
                $stmt->bindParam(':dia_pago', $row['dia_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':mes_pago', $row['mes_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':anio_pago', $row['anio_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':dias_pago', $row['dias_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':forma_pago', $row['forma_pago'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_1', $row['referencia_pago_1'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_2', $row['referencia_pago_2'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_3', $row['referencia_pago_3'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_4', $row['referencia_pago_4'], PDO::PARAM_STR);
                $stmt->bindParam(':descripcion_item', $row['descripcion_item'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_lote', $row['numero_lote'], PDO::PARAM_STR);
                $stmt->bindParam(':talla_identificador', $row['talla_identificador'], PDO::PARAM_STR);
                $stmt->bindParam(':talla', $row['talla'], PDO::PARAM_STR);
                $stmt->bindParam(':direccion', $row['direccion'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $row['telefono'], PDO::PARAM_INT);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR);
                $stmt->bindParam(':bodega_item', $row['bodega_item'], PDO::PARAM_STR);
                $stmt->bindParam(':proyecto', $row['proyecto'], PDO::PARAM_STR);
                $stmt->bindParam(':centro_costos', $row['centro_costos'], PDO::PARAM_STR);
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':dig_verificacion', $row['dig_verificacion'], PDO::PARAM_INT);
                $stmt->bindParam(':tipo_id', $row['tipo_id'], PDO::PARAM_INT);
                $stmt->bindParam(':cod_suc', $row['cod_suc'], PDO::PARAM_STR);
                $stmt->bindParam(':semana_anio', $row['semana_anio'], PDO::PARAM_INT);
                $stmt->bindParam(':semana_mes', $row['semana_mes'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo_departamento', $row['codigo_departamento'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo_ciudad', $row['codigo_ciudad'], PDO::PARAM_INT);
                $stmt->bindParam(':primer_nombre', $row['primer_nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':segundo_nombre', $row['segundo_nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':primer_apellido', $row['primer_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':segundo_apellido', $row['segundo_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':telefonos', $row['telefonos'], PDO::PARAM_INT);
                $stmt->bindParam(':telefono_movil', $row['telefono_movil'], PDO::PARAM_INT);
                $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
                $stmt->bindParam(':cliente_inactivo', $row['cliente_inactivo'], PDO::PARAM_STR);
                $stmt->bindParam(':dia_semana', $row['dia_semana'], PDO::PARAM_STR);
                $stmt->bindParam(':barrio', $row['barrio'], PDO::PARAM_STR);
                $stmt->bindParam(':usuario_elaboro', $row['usuario_elaboro'], PDO::PARAM_STR);
                $stmt->bindParam(':agente_comercial', $row['agente_comercial'], PDO::PARAM_STR);
                $stmt->bindParam(':regimen_ventas', $row['regimen_ventas'], PDO::PARAM_STR);
                $stmt->bindParam(':declaracion_renta', $row['declaracion_renta'], PDO::PARAM_STR);
                $stmt->bindParam(':agente_retenedor', $row['agente_retenedor'], PDO::PARAM_STR);
                $stmt->bindParam(':auto_retenedor', $row['auto_retenedor'], PDO::PARAM_STR);
                $stmt->bindParam(':no_aplica_impuesto_cree', $row['no_aplica_impuesto_cree'], PDO::PARAM_STR);
                $stmt->bindParam(':agente_retenedor_ica', $row['agente_retenedor_ica'], PDO::PARAM_STR);
                $stmt->bindParam(':causas_devolucion', $row['causas_devolucion'], PDO::PARAM_STR);
                $stmt->bindParam(':base_calculo_interes_fac_lote', $row['base_calculo_interes_fac_lote'], PDO::PARAM_INT);
                $stmt->bindParam(':porcentaje_interes_fact_lote', $row['porcentaje_interes_fact_lote'], PDO::PARAM_INT);
                $stmt->bindParam(':hora_elaboracion_factura', $row['hora_elaboracion_factura'], PDO::PARAM_INT);
                $stmt->bindParam(':fecha_ingreso', $row['fecha_ingreso'], PDO::PARAM_STR);
                $stmt->bindParam(':estado_subtercero', $row['estado_subtercero'], PDO::PARAM_STR);
                $stmt->bindParam(':ficha_catastral', $row['ficha_catastral'], PDO::PARAM_STR);
                $stmt->bindParam(':num_medidor', $row['num_medidor'], PDO::PARAM_STR);
                $stmt->bindParam(':centro_costos_item', $row['centro_costos_item'], PDO::PARAM_STR);
                $stmt->bindParam(':subcentro_costos_item', $row['subcentro_costos_item'], PDO::PARAM_STR);
                $stmt->bindParam(':tercero_item', $row['tercero_item'], PDO::PARAM_STR);
                $stmt->bindParam(':tarifa_iva_catalogo_servicio_articulo', $row['tarifa_iva_catalogo_servicio_articulo'], PDO::PARAM_INT);
                $stmt->bindParam(':porcentaje_iva_catalogo_servicio_articulo', $row['porcentaje_iva_catalogo_servicio_articulo'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre_tarifa_iva_aplicada', $row['nombre_tarifa_iva_aplicada'], PDO::PARAM_STR);
                $stmt->bindParam(':direccion_area', $row['direccion_area'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono_area', $row['telefono_area'], PDO::PARAM_INT);
                $stmt->bindParam(':fax_area', $row['fax_area'], PDO::PARAM_STR);
                $stmt->bindParam(':ciudad_area', $row['ciudad_area'], PDO::PARAM_STR);
                $stmt->bindParam(':email_area', $row['email_area'], PDO::PARAM_STR);
                $stmt->bindParam(':email_fe_area', $row['email_fe_area'], PDO::PARAM_STR);
                $stmt->bindParam(':barrio_area', $row['barrio_area'], PDO::PARAM_STR);
                $stmt->bindParam(':afecta', $row['afecta'], PDO::PARAM_STR);
                $stmt->bindParam(':cantidad_parcial_entregada', $row['cantidad_parcial_entregada'], PDO::PARAM_INT);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_tipo_documento(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `tipo_documento`(`codigo`, `clase_doc`, `grupo_td`, `libro`, `nombre`, `consec`, `consec_manu`, `conse_nume`, `cero_sconse`, `cambiar`, `inactivo`, `imppos`, `imppos_alt`, `impsermov`, `impper`, `impperx`, `noimp`, `modalidad`, `prfrel`, `prefijo`, `fech_resol`, `resol_dian`, `desde`, `hasta`, `eanref_pago`, `vres_vence`, `vrescon`, `noiva`, `encabe1`, `encabe2`, `encabe3`, `encabe4`, `encabe5`, `det_pie1`, `det_pie2`, `det_pie3`, `det_pie4`, `det_pie5`, `fpago`, `impnom`, `impdivs`, `precio`, `pre_coniva`, `no_desctos`, `iva_consu`, `maxitems`, `maxitemsx`, `c_costo`, `su_costo`, `c_coxitem`, `impuespec`, `bodega`, `bodega2`, `forbodega`, `conseevent`, `dataevent`, `idsred`, `usuper`, `usuper2`, `usuper3`, `usuper4`, `maneserv`, `ctarete`, `open_cajon`, `utiref1`, `utiref2`, `utiref3`, `utiref4`, `nom_ref1`, `nom_ref2`, `nom_ref3`, `nom_ref4`, `cta1`, `cta2`, `cta3`, `cta4`, `cta5`, `cta6`, `cta7`, `cta8`, `cta9`, `cta10`, `ncta1`, `ncta2`, `ncta3`, `ncta4`, `ncta5`, `ncta6`, `ncta7`, `ncta8`, `ncta9`, `ncta10`, `externo`, `lprefij`, `modo`, `noimpnit`, `impposval`, `impitagru`, `impitagrux`, `impobli`, `inveperio`, `porfpago`, `bodega_item`, `recostea`, `vendedor`, `ctaretev`, `ctaretem`, `ctaretes`, `ctaretec`, `retiva`, `noitdocu`, `contabtr`, `pda`, `aiu`, `esentrada`, `esbaja`, `estransfer`, `esresponsa`, `contaimport`, `dias_plazo`, `ver_colter`, `ver_colref`, `nsalconsec`, `imp_copias`, `for_vende`, `lretfte`, `lretcre`, `lretiva`, `lretica`, `tarica`, `solo_fechoy`, `depend`, `momod_costo`, `trasla`, `traslasuc`, `vrletras`, `sermov`, `smconsecl`, `olectura`, `noconsolid`, `notainv`, `creeuti`, `columniif`, `ctareteiva`, `imprimeniif`, `espcdesc`, `bodemanu`, `meses_hab`, `anexo_obli`, `cambios`, `anop`, `impitdagr`, `fe_nomline`, `fe_nnotify`, `fe_csfe`, `fe_version`, `fe_exporta`, `fe_xmldtos`, `fe_salud`, `fe_saludti`, `causadev`, `refinven`, `nodtos`, `ver_refpro`, `tpexclrede`, `sermovfe`, `grupoper`, `refcompon`, `autoica`, `ver_periodo`, `valnega`, `no_importa`) VALUES (:codigo, :clase_doc, :grupo_td, :libro, :nombre, :consec, :consec_manu, :conse_nume, :cero_sconse, :cambiar, :inactivo, :imppos, :imppos_alt, :impsermov, :impper, :impperx, :noimp, :modalidad, :prfrel, :prefijo, :fech_resol, :resol_dian, :desde, :hasta, :eanref_pago, :vres_vence, :vrescon, :noiva, :encabe1, :encabe2, :encabe3, :encabe4, :encabe5, :det_pie1, :det_pie2, :det_pie3, :det_pie4, :det_pie5, :fpago, :impnom, :impdivs, :precio, :pre_coniva, :no_desctos, :iva_consu, :maxitems, :maxitemsx, :c_costo, :su_costo, :c_coxitem, :impuespec, :bodega, :bodega2, :forbodega, :conseevent, :dataevent, :idsred, :usuper, :usuper2, :usuper3, :usuper4, :maneserv, :ctarete, :open_cajon, :utiref1, :utiref2, :utiref3, :utiref4, :nom_ref1, :nom_ref2, :nom_ref3, :nom_ref4, :cta1, :cta2, :cta3, :cta4, :cta5, :cta6, :cta7, :cta8, :cta9, :cta10, :ncta1, :ncta2, :ncta3, :ncta4, :ncta5, :ncta6, :ncta7, :ncta8, :ncta9, :ncta10, :externo, :lprefij, :modo, :noimpnit, :impposval, :impitagru, :impitagrux, :impobli, :inveperio, :porfpago, :bodega_item, :recostea, :vendedor, :ctaretev, :ctaretem, :ctaretes, :ctaretec, :retiva, :noitdocu, :contabtr, :pda, :aiu, :esentrada, :esbaja, :estransfer, :esresponsa, :contaimport, :dias_plazo, :ver_colter, :ver_colref, :nsalconsec, :imp_copias, :for_vende, :lretfte, :lretcre, :lretiva, :lretica, :tarica, :solo_fechoy, :depend, :momod_costo, :trasla, :traslasuc,:vrletras, :sermov, :smconsecl, :olectura, :noconsolid, :notainv, :creeuti, :columniif, :ctareteiva, :imprimeniif, :espcdesc, :bodemanu, :meses_hab, :anexo_obli, :cambios, :anop, :impitdagr, :fe_nomline, :fe_nnotify, :fe_csfe, :fe_version, :fe_exporta, :fe_xmldtos, :fe_salud, :fe_saludti, :causadev, :refinven, :nodtos, :ver_refpro,:tpexclrede, :sermovfe, :grupoper, :refcompon, :autoica, :ver_periodo, :valnega, :no_importa)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_STR);
                $stmt->bindParam(':clase_doc', $row['clase_doc'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_td', $row['grupo_td'], PDO::PARAM_STR);
                $stmt->bindParam(':libro', $row['libro'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':consec', $row['consec'], PDO::PARAM_INT);
                $stmt->bindParam(':consec_manu', $row['consec_manu'], PDO::PARAM_STR);
                $stmt->bindParam(':conse_nume', $row['conse_nume'], PDO::PARAM_STR);
                $stmt->bindParam(':cero_sconse', $row['cero_sconse'], PDO::PARAM_INT);
                $stmt->bindParam(':cambiar', $row['cambiar'], PDO::PARAM_STR);
                $stmt->bindParam(':inactivo', $row['inactivo'], PDO::PARAM_STR);
                $stmt->bindParam(':imppos', $row['imppos'], PDO::PARAM_STR);
                $stmt->bindParam(':imppos_alt', $row['imppos_alt'], PDO::PARAM_STR);
                $stmt->bindParam(':impsermov', $row['impsermov'], PDO::PARAM_STR);
                $stmt->bindParam(':impper', $row['impper'], PDO::PARAM_STR);
                $stmt->bindParam(':impperx', $row['impperx'], PDO::PARAM_STR);
                $stmt->bindParam(':noimp', $row['noimp'], PDO::PARAM_STR);
                $stmt->bindParam(':modalidad', $row['modalidad'], PDO::PARAM_STR);
                $stmt->bindParam(':prfrel', $row['prfrel'], PDO::PARAM_STR);
                $stmt->bindParam(':prefijo', $row['prefijo'], PDO::PARAM_STR);
                $stmt->bindParam(':fech_resol', $row['fech_resol'], PDO::PARAM_STR);
                $stmt->bindParam(':resol_dian', $row['resol_dian'], PDO::PARAM_STR);
                $stmt->bindParam(':desde', $row['desde'], PDO::PARAM_STR);
                $stmt->bindParam(':hasta', $row['hasta'], PDO::PARAM_STR);
                $stmt->bindParam(':eanref_pago', $row['eanref_pago'], PDO::PARAM_STR);
                $stmt->bindParam(':vres_vence', $row['vres_vence'], PDO::PARAM_STR);
                $stmt->bindParam(':vrescon', $row['vrescon'], PDO::PARAM_INT);
                $stmt->bindParam(':noiva', $row['noiva'], PDO::PARAM_STR);
                $stmt->bindParam(':encabe1', $row['encabe1'], PDO::PARAM_STR);
                $stmt->bindParam(':encabe2', $row['encabe2'], PDO::PARAM_STR);
                $stmt->bindParam(':encabe3', $row['encabe3'], PDO::PARAM_STR);
                $stmt->bindParam(':encabe4', $row['encabe4'], PDO::PARAM_STR);
                $stmt->bindParam(':encabe5', $row['encabe5'], PDO::PARAM_STR);
                $stmt->bindParam(':det_pie1', $row['det_pie1'], PDO::PARAM_STR);
                $stmt->bindParam(':det_pie2', $row['det_pie2'], PDO::PARAM_STR);
                $stmt->bindParam(':det_pie3', $row['det_pie3'], PDO::PARAM_STR);
                $stmt->bindParam(':det_pie4', $row['det_pie4'], PDO::PARAM_STR);
                $stmt->bindParam(':det_pie5', $row['det_pie5'], PDO::PARAM_STR);
                $stmt->bindParam(':fpago', $row['fpago'], PDO::PARAM_STR);
                $stmt->bindParam(':impnom', $row['impnom'], PDO::PARAM_STR);
                $stmt->bindParam(':impdivs', $row['impdivs'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':pre_coniva', $row['pre_coniva'], PDO::PARAM_STR);
                $stmt->bindParam(':no_desctos', $row['no_desctos'], PDO::PARAM_STR);
                $stmt->bindParam(':iva_consu', $row['iva_consu'], PDO::PARAM_STR);
                $stmt->bindParam(':maxitems', $row['maxitems'], PDO::PARAM_INT);
                $stmt->bindParam(':maxitemsx', $row['maxitemsx'], PDO::PARAM_STR);
                $stmt->bindParam(':c_costo', $row['c_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':su_costo', $row['su_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':c_coxitem', $row['c_coxitem'], PDO::PARAM_STR);
                $stmt->bindParam(':impuespec', $row['impuespec'], PDO::PARAM_INT);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR);
                $stmt->bindParam(':bodega2', $row['bodega2'], PDO::PARAM_STR);
                $stmt->bindParam(':forbodega', $row['forbodega'], PDO::PARAM_STR);
                $stmt->bindParam(':conseevent', $row['conseevent'], PDO::PARAM_INT);
                $stmt->bindParam(':dataevent', $row['dataevent'], PDO::PARAM_STR);
                $stmt->bindParam(':idsred', $row['idsred'], PDO::PARAM_STR);
                $stmt->bindParam(':usuper', $row['usuper'], PDO::PARAM_STR);
                $stmt->bindParam(':usuper2', $row['usuper2'], PDO::PARAM_STR);
                $stmt->bindParam(':usuper3', $row['usuper3'], PDO::PARAM_STR);
                $stmt->bindParam(':usuper4', $row['usuper4'], PDO::PARAM_STR);
                $stmt->bindParam(':maneserv', $row['maneserv'], PDO::PARAM_STR);
                $stmt->bindParam(':ctarete', $row['ctarete'], PDO::PARAM_STR);
                $stmt->bindParam(':open_cajon', $row['open_cajon'], PDO::PARAM_STR);
                $stmt->bindParam(':utiref1', $row['utiref1'], PDO::PARAM_STR);
                $stmt->bindParam(':utiref2', $row['utiref2'], PDO::PARAM_STR);
                $stmt->bindParam(':utiref3', $row['utiref3'], PDO::PARAM_STR);
                $stmt->bindParam(':utiref4', $row['utiref4'], PDO::PARAM_STR);
                $stmt->bindParam(':nom_ref1', $row['nom_ref1'], PDO::PARAM_STR);
                $stmt->bindParam(':nom_ref2', $row['nom_ref2'], PDO::PARAM_STR);
                $stmt->bindParam(':nom_ref3', $row['nom_ref3'], PDO::PARAM_STR);
                $stmt->bindParam(':nom_ref4', $row['nom_ref4'], PDO::PARAM_STR);
                $stmt->bindParam(':cta1', $row['cta1'], PDO::PARAM_STR);
                $stmt->bindParam(':cta2', $row['cta2'], PDO::PARAM_STR);
                $stmt->bindParam(':cta3', $row['cta3'], PDO::PARAM_STR);
                $stmt->bindParam(':cta4', $row['cta4'], PDO::PARAM_STR);
                $stmt->bindParam(':cta5', $row['cta5'], PDO::PARAM_STR);
                $stmt->bindParam(':cta6', $row['cta6'], PDO::PARAM_STR);
                $stmt->bindParam(':cta7', $row['cta7'], PDO::PARAM_STR);
                $stmt->bindParam(':cta8', $row['cta8'], PDO::PARAM_STR);
                $stmt->bindParam(':cta9', $row['cta9'], PDO::PARAM_STR);
                $stmt->bindParam(':cta10', $row['cta10'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta1', $row['ncta1'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta2', $row['ncta2'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta3', $row['ncta3'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta4', $row['ncta4'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta5', $row['ncta5'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta6', $row['ncta6'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta7', $row['ncta7'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta8', $row['ncta8'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta9', $row['ncta9'], PDO::PARAM_STR);
                $stmt->bindParam(':ncta10', $row['ncta10'], PDO::PARAM_STR);
                $stmt->bindParam(':externo', $row['externo'], PDO::PARAM_STR);
                $stmt->bindParam(':lprefij', $row['lprefij'], PDO::PARAM_STR);
                $stmt->bindParam(':modo', $row['modo'], PDO::PARAM_STR);
                $stmt->bindParam(':noimpnit', $row['noimpnit'], PDO::PARAM_STR);
                $stmt->bindParam(':impposval', $row['impposval'], PDO::PARAM_STR);
                $stmt->bindParam(':impitagru', $row['impitagru'], PDO::PARAM_STR);
                $stmt->bindParam(':impitagrux', $row['impitagrux'], PDO::PARAM_STR);
                $stmt->bindParam(':impobli', $row['impobli'], PDO::PARAM_INT);
                $stmt->bindParam(':inveperio', $row['inveperio'], PDO::PARAM_STR);
                $stmt->bindParam(':porfpago', $row['porfpago'], PDO::PARAM_STR);
                $stmt->bindParam(':bodega_item', $row['bodega_item'], PDO::PARAM_STR);
                $stmt->bindParam(':recostea', $row['recostea'], PDO::PARAM_STR);
                $stmt->bindParam(':vendedor', $row['vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':ctaretev', $row['ctaretev'], PDO::PARAM_STR);
                $stmt->bindParam(':ctaretem', $row['ctaretem'], PDO::PARAM_STR);
                $stmt->bindParam(':ctaretes', $row['ctaretes'], PDO::PARAM_STR);
                $stmt->bindParam(':ctaretec', $row['ctaretec'], PDO::PARAM_STR);
                $stmt->bindParam(':retiva', $row['retiva'], PDO::PARAM_STR);
                $stmt->bindParam(':noitdocu', $row['noitdocu'], PDO::PARAM_STR);
                $stmt->bindParam(':contabtr', $row['contabtr'], PDO::PARAM_STR);
                $stmt->bindParam(':pda', $row['pda'], PDO::PARAM_STR);
                $stmt->bindParam(':aiu', $row['aiu'], PDO::PARAM_STR);
                $stmt->bindParam(':esentrada', $row['esentrada'], PDO::PARAM_STR);
                $stmt->bindParam(':esbaja', $row['esbaja'], PDO::PARAM_STR);
                $stmt->bindParam(':estransfer', $row['estransfer'], PDO::PARAM_STR);
                $stmt->bindParam(':esresponsa', $row['esresponsa'], PDO::PARAM_STR);
                $stmt->bindParam(':contaimport', $row['contaimport'], PDO::PARAM_STR);
                $stmt->bindParam(':dias_plazo', $row['dias_plazo'], PDO::PARAM_INT);
                $stmt->bindParam(':ver_colter', $row['ver_colter'], PDO::PARAM_STR);
                $stmt->bindParam(':ver_colref', $row['ver_colref'], PDO::PARAM_STR);
                $stmt->bindParam(':nsalconsec', $row['nsalconsec'], PDO::PARAM_STR);
                $stmt->bindParam(':imp_copias', $row['imp_copias'], PDO::PARAM_INT);
                $stmt->bindParam(':for_vende', $row['for_vende'], PDO::PARAM_STR);
                $stmt->bindParam(':lretfte', $row['lretfte'], PDO::PARAM_STR);
                $stmt->bindParam(':lretcre', $row['lretcre'], PDO::PARAM_STR);
                $stmt->bindParam(':lretiva', $row['lretiva'], PDO::PARAM_STR);
                $stmt->bindParam(':lretica', $row['lretica'], PDO::PARAM_STR);
                $stmt->bindParam(':tarica', $row['tarica'], PDO::PARAM_STR);
                $stmt->bindParam(':solo_fechoy', $row['solo_fechoy'], PDO::PARAM_STR);
                $stmt->bindParam(':depend', $row['depend'], PDO::PARAM_STR);
                $stmt->bindParam(':momod_costo', $row['momod_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':trasla', $row['trasla'], PDO::PARAM_STR);
                $stmt->bindParam(':traslasuc', $row['traslasuc'], PDO::PARAM_STR);
                $stmt->bindParam(':vrletras', $row['vrletras'], PDO::PARAM_STR);
                $stmt->bindParam(':sermov', $row['sermov'], PDO::PARAM_STR);
                $stmt->bindParam(':smconsecl', $row['smconsecl'], PDO::PARAM_STR);
                $stmt->bindParam(':olectura', $row['olectura'], PDO::PARAM_STR);
                $stmt->bindParam(':noconsolid', $row['noconsolid'], PDO::PARAM_STR);
                $stmt->bindParam(':notainv', $row['notainv'], PDO::PARAM_STR);
                $stmt->bindParam(':creeuti', $row['creeuti'], PDO::PARAM_STR);
                $stmt->bindParam(':columniif', $row['columniif'], PDO::PARAM_STR);
                $stmt->bindParam(':ctareteiva', $row['ctareteiva'], PDO::PARAM_STR);
                $stmt->bindParam(':imprimeniif', $row['imprimeniif'], PDO::PARAM_STR);
                $stmt->bindParam(':espcdesc', $row['espcdesc'], PDO::PARAM_STR);
                $stmt->bindParam(':bodemanu', $row['bodemanu'], PDO::PARAM_STR);
                $stmt->bindParam(':meses_hab', $row['meses_hab'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_obli', $row['anexo_obli'], PDO::PARAM_STR);
                $stmt->bindParam(':cambios', $row['cambios'], PDO::PARAM_STR);
                $stmt->bindParam(':anop', $row['anop'], PDO::PARAM_STR);
                $stmt->bindParam(':impitdagr', $row['impitdagr'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_nomline', $row['fe_nomline'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_nnotify', $row['fe_nnotify'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_csfe', $row['fe_csfe'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_version', $row['fe_version'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_exporta', $row['fe_exporta'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_xmldtos', $row['fe_xmldtos'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_salud', $row['fe_salud'], PDO::PARAM_STR);
                $stmt->bindParam(':fe_saludti', $row['fe_saludti'], PDO::PARAM_STR);
                $stmt->bindParam(':causadev', $row['causadev'], PDO::PARAM_STR);
                $stmt->bindParam(':refinven', $row['refinven'], PDO::PARAM_STR);
                $stmt->bindParam(':nodtos', $row['nodtos'], PDO::PARAM_STR);
                $stmt->bindParam(':ver_refpro', $row['ver_refpro'], PDO::PARAM_STR);
                $stmt->bindParam(':tpexclrede', $row['tpexclrede'], PDO::PARAM_STR);
                $stmt->bindParam(':sermovfe', $row['sermovfe'], PDO::PARAM_STR);
                $stmt->bindParam(':grupoper', $row['grupoper'], PDO::PARAM_STR);
                $stmt->bindParam(':refcompon', $row['refcompon'], PDO::PARAM_STR);
                $stmt->bindParam(':autoica', $row['autoica'], PDO::PARAM_STR);
                $stmt->bindParam(':ver_periodo', $row['ver_periodo'], PDO::PARAM_STR);
                $stmt->bindParam(':valnega', $row['valnega'], PDO::PARAM_STR);
                $stmt->bindParam(':no_importa', $row['no_importa'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }
    // ///////////////////////////////////////////////////////////////////////////
    function insert_biometrico(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = " INSERT INTO `registro_biometrico`(`fecha`, `id_empleado`, `id_rol`, `numero_nomina`, `nombre`, `entrada_1`, `salida_1`, `entrada_2`, `salida_2`, `entrada_3`, `salida_3`, `h_normales`, `h_ausencias`, `h_extra`, `noc`) VALUES   (:fecha,:id_empleado, :id_rol, :numero_nomina, :nombre, :entrada_1, :salida_1, :entrada_2, :salida_2, :entrada_3, :salida_3 , :h_normales, :h_ausencias, :h_extra, :noc)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':id_empleado', $row['id_empleado'], PDO::PARAM_STR);
                $stmt->bindParam(':id_rol', $row['rol_empleado'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_nomina', $row['numero_nomina'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':entrada_1', $row['entrada_1'], PDO::PARAM_STR);
                $stmt->bindParam(':salida_1', $row['salida_1'], PDO::PARAM_STR);
                $stmt->bindParam(':entrada_2', $row['entrada_2'], PDO::PARAM_STR);
                $stmt->bindParam(':salida_2', $row['salida_2'], PDO::PARAM_STR);
                $stmt->bindParam(':entrada_3', $row['entrada_3'], PDO::PARAM_STR);
                $stmt->bindParam(':salida_3', $row['salida_3'], PDO::PARAM_STR);
                $stmt->bindParam(':h_normales', $row['h_normales'], PDO::PARAM_STR);
                $stmt->bindParam(':h_ausencias', $row['h_ausencias'], PDO::PARAM_STR);
                $stmt->bindParam(':h_extra', $row['h_extra'], PDO::PARAM_STR);
                $stmt->bindParam(':noc', $row['noc'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function select_get_id_terceros($numero_nomina)
    {
        $sql = "SELECT `ct1_IdTerceros`, `ct1_rol` FROM `ct1_terceros` WHERE  `ct1_NumeroIdentificacion` = '$numero_nomina'";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct1_IdTerceros'];
                    $datos['rol'] = $fila['ct1_rol'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function select_get_biometrico_id($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM `registro_biometrico` WHERE  `id` = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_datatable_biometrico()
    {
        $sql = "SELECT `id`, `fecha`, `numero_nomina`, `nombre`, `entrada_1`, `salida_1`, `entrada_2`, `salida_2`, `entrada_3`, `salida_3`, `h_normales`, `h_ausencias`, `h_extra`, `noc` FROM `registro_biometrico`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha'];
                    $datos['numero_nomina'] = $fila['numero_nomina'];
                    $datos['nombre'] = $fila['nombre'];
                    $datos['entrada_1'] = $fila['entrada_1'];
                    $datos['salida_1'] = $fila['salida_1'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function modificar_datos_biometrico($id, $fecha, $entrada_1, $salida_1)
    {
        $this->fecha = $fecha;
        $this->entrada_1 = $entrada_1;
        $this->salida_1 = $salida_1;
        $this->id = $id;

        $sql = "UPDATE `registro_biometrico` SET `fecha`= :fecha,`entrada_1`= :entrada_1, `salida_1` = :salida_1 WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
        $stmt->bindParam(':entrada_1', $this->entrada_1, PDO::PARAM_STR);
        $stmt->bindParam(':salida_1', $this->salida_1, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $result;
    }

    function eliminar_datos_biometrico($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `registro_biometrico` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
}
