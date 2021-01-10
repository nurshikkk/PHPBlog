<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$connection = get_connection();

$login = $_REQUEST['login'];
$password = $_REQUEST['password'];

if (!isset($_REQUEST['login'])) {
    $_SESSION['error']['login'] = 'Логин обязателен к заполнению!';
} else {
    $_SESSION['login'] = $login;
}

$res = $connection->query('select * from `users` where `login` = \'' . $login . '\'');
$a = $res->num_rows;
$b = $res->fetch_all(MYSQLI_ASSOC);

if ($a == 0) {
    $_SESSION['error']['login'] = 'Такой логин не существует!';
}

if (!isset($password)) {
    $_SESSION['error']['password'] = 'Пароль обязателен для заполнения!';
}

if (!password_verify($password, $b[0]['password'])) {
    $_SESSION['error']['password'] = 'Пароль не верный!';
} else {
    $_SESSION['user_id'] = $b[0]['id'];
    $_SESSION['name'] = $b[0]['name'];
    $_SESSION['surname'] = $b[0]['surname'];
    header('Location: /resources/pages/public/main.php');
    echo 'Пароль введен верно!';
}

if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}