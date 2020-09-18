<?php
$id = $_GET['id'];
$name = $_GET['name'];

include '../DB/db_config.php';
include '../functions/translate.php';
include '../functions/client_instance_creation.php';
include '../functions/client_instance_cooltime2.php';



if ($id || $name) {
    $sql = $aionDB->query('SELECT * FROM instances where id = ? or name = ?', array($id, $name))->fetchAll();
}else {
    $sql = $aionDB->query('SELECT * FROM instances')->fetchAll();
}

$jsonArray = array();

foreach ($sql as $instance) {
    array_push($jsonArray, array(
        'id'                    => $instance['id'],
        'name'                  => $instance['name'],
        'KR'                    => translate($instance['description'], "ko", $aionDB),
        'EN'                    => translate($instance['description'], "en", $aionDB),
        'DE'                    => translate($instance['description'], "de", $aionDB),
        'FR'                    => translate($instance['description'], "fr", $aionDB),
        'indun_type'            => $instance['indun_type'],
        'race'                  => $instance['race'],
        'min_member_light'      => $instance['min_member_light'],
        'max_member_light'      => $instance['max_member_light'],
        'enter_min_level_light' => $instance['enter_min_level_light'],
        'min_member_dark'       => $instance['min_member_dark'],
        'max_member_dark'       => $instance['max_member_dark'],
        'enter_min_level_dark'  => $instance['enter_min_level_dark'],
        '...instancebyid'       => client_instance_creation($instance['name'], $aionDB),

        'coolt_tbl_id ('.$instance['coolt_tbl_id'].')'                => client_instance_cooltime2($instance['coolt_tbl_id'], $aionDB),
        'f2p_coolt_tbl_id ('.$instance['f2p_coolt_tbl_id'].')'        => client_instance_cooltime2($instance['f2p_coolt_tbl_id'], $aionDB),

        'coolt_tbl_id EU ('.$instance['coolt_tbl_id'].')'             => client_instance_cooltime2("9" . $instance['coolt_tbl_id'], $aionDB),
        'f2p_coolt_tbl_id EU ('.$instance['f2p_coolt_tbl_id'].')'     => client_instance_cooltime2("9" . $instance['f2p_coolt_tbl_id'], $aionDB),

        'coolt_tbl_id EU=KR ('.$instance['coolt_tbl_id'].')'          => client_instance_cooltime2("8" . $instance['coolt_tbl_id'], $aionDB),
        'f2p_coolt_tbl_id EU=KR ('.$instance['f2p_coolt_tbl_id'].')'  => client_instance_cooltime2("8" . $instance['f2p_coolt_tbl_id'], $aionDB)
    ));
}



header('Content-type: text/javascript; charset=utf-8');
echo json_encode($jsonArray, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
$aionDB->close();

