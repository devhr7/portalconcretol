<?PHP
require '../../../../vendor/autoload.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$cls_laboratorio = new cls_laboratorio;

if ($stmt_muestras = $cls_laboratorio->GetDataMuestaConsolidadoBDsXLXS($_GET['fecha_ini'], $_GET['fecha_fin'], $_GET['txt_sede'])) {
    while ($row_muestra = $stmt_muestras->fetch(PDO::FETCH_ASSOC)) {
    }
    echo "Si";
    echo "<br>";
    var_dump($stmt_muestras);
    var_dump($row_muestra);
} else {
    var_dump($stmt_muestras);
}
