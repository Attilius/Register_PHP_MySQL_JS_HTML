<?php

require_once 'header.php';
require_once './config/db_connect.php';
require_once './src/Database.php';

use htdocs\helio\server\src\Database;

$response = [];

//Service

$db = new Database(
    $connection_datas['mysql']['host'],
    $connection_datas['mysql']['db_name'],
    $connection_datas['mysql']['charset'], 
    $connection_datas['mysql']['user'], 
    $connection_datas['mysql']['pass']
);



if (isset($_POST['login-email']) && isset(($_POST['login-passwd']))) {
    $user_datas = $db->loginUser($_POST['login-email']);
    if (md5($_POST['login-passwd']) == $user_datas[0]['passwd']) {
        $response = ['message' => 'Successful', 'user' => $user_datas[0]['email']];
    }
}


echo json_encode($response, JSON_UNESCAPED_UNICODE);