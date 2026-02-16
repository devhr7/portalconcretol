<?php
// DB table to use
$table = 'ct26_remisiones';

// Table's primary key
$primaryKey = 'ct26_id_remision';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'ct26_id_remision', 'dt' => 0 ),
    array( 'db' => 'ct26_idObra',  'dt' => 1 ),
    array( 'db' => 'ct26_estado',   'dt' => 2 ),
     
        );

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'concretolimasa',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    );