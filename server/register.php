<?php

require_once 'header.php';
require_once './config/db_connect.php';
require_once './src/Database.php';

use htdocs\helio\server\src\Database;

$response = [];
$email_pattern = '/^.+@.+\.[a-z]{2,}$/';

$db = new Database(
    $connection_datas['mysql']['host'],
    $connection_datas['mysql']['db_name'],
    $connection_datas['mysql']['charset'], 
    $connection_datas['mysql']['user'], 
    $connection_datas['mysql']['pass']
);

if (isset($_POST['reg-email']) && preg_match($email_pattern, $_POST['reg-email']) && isset($_POST['reg-passwd']) && !empty($_POST['reg-passwd'])) {
    $passwd = hash('md5',$_POST['reg-passwd']);
    $db->registerUser($_POST['reg-email'], $passwd);
    $response = ['message' => 'Successful'];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);