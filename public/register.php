<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$connection = get_connection();

$res = $connection->query('select * from `users`');
$b = $res->fetch_all(MYSQLI_ASSOC);

$email = $_REQUEST['email'];
$login = $_REQUEST['login'];
$surname = $_REQUEST['surname'];
$name = $_REQUEST['name'];
$password = $_REQUEST['password'];

if (!isset($email)){
    $_SESSION['errors']['email'] = 'Почта обязательна к заполнению!';
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['errors']['email'] = 'Почта введена некорректно.';
} else {
    foreach ($b as $key => $value){
        if ($value['email'] == $_REQUEST['email']){
            $_SESSION['errors']['email'] = 'Такая почта уже существует!';
        }
    }
}

if (!isset($login)){
    $_SESSION['errors']['login'] = 'Логин обязателен к заполнению!';
} elseif(!preg_match('/[a-zA-Z_][a-zA-Z\d_]{3,}[a-zA-Z\d]/', $login)){
    $_SESSION['errors']['login'] = 'Логин введен некорректно';
} else {
    foreach ($b as $key => $value){
        if ($value['login'] == $_REQUEST['login']){
            $_SESSION['errors']['login'] = 'Такой логин уже существует!';
        }
    }
}
if (!isset($surname)){
    $_SESSION['errors']['surname'] = 'Фамилия обязательна к заполнению!';
}
if (!isset($name)){
    $_SESSION['errors']['name'] = 'Имя обязательна к заполнению!';
}
if (!isset($password)){
    $_SESSION['errors']['password'] = 'Пароль обязателен к заполнению!';
} elseif (strlen($password) < 5){
    $_SESSION['errors']['password'] = 'Пароль должен быть в длину больше 5 символов.';
} else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
}

if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
} else {
    $connection->query('insert into `users` (`role_id`,`email`, `login`, `surname`, `name`, `password`)
    values (3, \'' . $_REQUEST['email'] . '\', \'' . $_REQUEST['login'] . '\', \'' . $_REQUEST['surname'] . '\',\'' . $_REQUEST['name'] . '\', \'' . $hash . '\')');
    $res = $connection->query('select * from `users` where `login` = \'' . $login . '\'');
    $b = $res->fetch_all(MYSQLI_ASSOC);
    $_SESSION['user_id'] = $b[0]['id'];
    $_SESSION['name'] = $b[0]['name'];
    $_SESSION['surname'] = $b[0]['surname'];
    header('Location: /resources/pages/public/main.php');
}