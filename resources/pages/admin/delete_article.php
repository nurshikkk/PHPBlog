<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';

$connection = get_connection();

$res = $connection->query('delete from `articles` where `id` = \'' . $_REQUEST['id'] . '\'');
header('Location: /resources/pages/admin/articles_list.php');