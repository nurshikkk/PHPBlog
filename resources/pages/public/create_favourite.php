<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';

$connection = get_connection();



$res = $connection->query('insert into `favourite` (`article_id`, `user_id`) 
values (\'' . $_REQUEST['article_id'] . '\', \'' . $_SESSION['user_id'] . '\')');
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
