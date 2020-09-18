<?php

// start up the app
use PowerBook\ItemRepository;

require_once 'autoload.php';
//require_once 'config.php';
require_once '../aionpb/DB/db_config.php';


$services = array();
$config = '';


function __init_services(&$services, $dbhost, $dbuser, $dbpass, $dbname)
{

    $pdo = new PDO(
        "mysql:dbname={$dbname};host={$dbhost}",
        $dbuser,
        $dbpass
    );

    $services = array(
        'app.repository.item_model' => new ItemRepository($pdo),
    );
};

__init_services($services, $dbhost, $dbuser, $dbpass, $dbname);
