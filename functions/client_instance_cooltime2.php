<?php

function client_instance_cooltime2 ($id, $aionDB) {

    $sql = $aionDB->query('SELECT * FROM client_instance_cooltime2 WHERE id = ? ', $id)->fetchAll();

    return $sql;
}