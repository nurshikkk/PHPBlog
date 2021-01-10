<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$user = get_user_data($_SESSION['user_id']);
$connection = get_connection();

$res = $connection->query('update `users` set `ban` = 0 where `id` = \'' . $_REQUEST['id'] . '\'');
header('Location: ' . $_SERVER['HTTP_REFERER']);