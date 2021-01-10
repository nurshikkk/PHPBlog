<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$connection = get_connection();

$res = $connection->query('update `articles` set `published` = 1 where `id` = \'' . $_REQUEST['id'] . '\'');
header('Location: /resources/pages/public/main.php');