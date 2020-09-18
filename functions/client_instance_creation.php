<?php

function client_instance_creation ($name, $aionDB) {

    $sql = $aionDB->query('SELECT * FROM client_instance_creation WHERE worldname = ? ', $name)->fetchAll();

    return $sql;
}