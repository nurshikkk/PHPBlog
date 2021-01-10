<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$connection = get_connection();
$new_password = $_REQUEST['new_p'];


if (!isset($new_password)) {
    $_SESSION['errors']['password'] = 'Пароль обязателен к заполнению!';
} elseif (strlen($new_password) < 5) {
    $_SESSION['errors']['password'] = 'Пароль должен быть в длину больше 5 символов.';
} else {
    $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $res = $connection->query('select `password` from `users`');
    $r = $res->fetch_all(MYSQLI_ASSOC);
    foreach ($r as $key => $value) {
        if ($new_hash == $value['password']){
            $_SESSION['errors']['password'] = 'Пароль не должен совпадать с прошлым.';
        }
        }
}

if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    header('Location: /resources/pages/public/profile.php');
    exit();
} else {
    $connection->query('update `users`
set `password` = \'' . $new_hash . '\' where `id` = \'' . $_SESSION['user_id'] . '\'');
    header('Location: /resources/pages/public/main.php');
}
