<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$connection = get_connection();
$login = $_REQUEST['login'];
$surname = $_REQUEST['surname'];
$name = $_REQUEST['name'];

$res = $connection->query('select * from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
$b = $res->fetch_all(MYSQLI_ASSOC);

foreach ($b as $key => $value) {
    if (!isset($_REQUEST['login'])) {
        $value['login'] = $_REQUEST['login'];
    } elseif (!isset($_REQUEST['name'])) {
        $value['name'] = $_REQUEST['name'];
    } elseif (!isset($_REQUEST['surname'])) {
        $value['surname'] = $_REQUEST['surname'];
    } elseif (!isset($_REQUEST['avatar'])) {
        $value['avatar'] = $_REQUEST['avatar'];
    } else {
        if (!preg_match('/[a-zA-Z_][a-zA-Z\d_]{3,}[a-zA-Z\d]/', $login)) {
            $_SESSION['errors']['login'] = 'Логин введен некорректно';
            if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }
    $connection->query('update `users` 
    set `name` = \'' . $_REQUEST['name'] . '\',
`surname` = \'' . $_REQUEST['surname'] . '\',
`login` = \'' . $_REQUEST['login'] . '\',
`avatar` = \'' . $_REQUEST['avatar'] . '\'
where `id` = \'' . $_SESSION['user_id'] . '\'');
    header('Location:/resources/pages/public/profile.php');
}


