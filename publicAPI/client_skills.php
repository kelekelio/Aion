<?php
include '../DB/db_config.php';

$id = $_GET['id'];
$name = $_GET['name'];

if ($id == null && $name == null) {

    echo "provide ID or name.\n";

} else {

    $sql = $aionDB->query('SELECT * FROM client_skills WHERE id = ? or name = ? ', array($id, $name))->fetchArray();


    header('Content-type: text/javascript; charset=utf-8');
    echo json_encode($sql, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    $aionDB->close();
}


