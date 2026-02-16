<?php
session_start();
header('Content-Type: application/json');
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

$php_clases = new php_clases();
$t29_batch = new t29_batch();

if (
    isset($_POST['codigo_remi']) || !empty($_POST['codigo_remi']) ||
    isset($_POST['fecha_remi']) || !empty($_POST['fecha_remi'])
) {
    $cp_fecha = htmlspecialchars($_POST['fecha_remi']);
    $cp_codigo_remi = htmlspecialchars($_POST['codigo_remi']);
?>
    <table id="t_remisiones" class="display" style="width:100%">
        <thead>
            <tr>
                <th>N</th>
                <th>Remision2</th>
                <th>fecha </th>
                <th>Cliente</th>
                <th>Obra</th>
                <th>Codigo Producto</th>
                <th>Cantidad</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $datos_tabla = $t29_batch->select_batch_buscador($cp_codigo_remi, $cp_fecha);
            $i = 1;
            foreach ($datos_tabla as $datos) {
                $id =   intval($datos['ct29_Id']);
            ?>
                <tr>
                    <td><?php echo  $i++; ?></td>
                    <td><?php echo  $datos['ct29_Remision']; ?></td>
                    <td><?php echo  $datos['ct29_Fecha']; ?></td>
                    <td><?php echo  $datos['ct29_IdCliente']; ?></td>
                    <td><?php echo  $datos['ct29_IdObra']; ?></td>
                    <td><?php echo  $datos['ct29_NombreFormula']; ?></td>
                    <td><?php echo  $datos['ct29_MetrosCubicos']; ?></td>
                    <td class="project-actions">
                        <a class="btn btn-success btn-sm" href="remision.php?id=<?php echo $datos['ct29_Id']; ?>"> Vista previa</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfooter>
            <tr>
                <th>N</th>
                <th>Remision</th>
                <th>fecha </th>
                <th>Cliente</th>
                <th>Obra</th>
                <th>Codigo Producto</th>
                <th>Cantidad</th>
                <th>Descripcion</th>
            </tr>
        </tfooter>
    </table>

<?php
}
