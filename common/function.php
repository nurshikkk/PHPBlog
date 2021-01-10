<?php

include $_SERVER['DOCUMENT_ROOT'] . '/common/config.php';

function get_connection()
{
    $mysqli = new mysqli(
        DB_HOST,
        DB_USERNAME,
        DB_PASSWORD,
        DB_NAME,
        DB_PORT);
    return $mysqli;
}

function user_is_exist($email, $login)
{
    $connection = get_connection();
    $query = $connection->prepare('select count(*) from `users` where `email` = ? and `login` = ?');
    $query->bind_param('ss', $email, $login);
    # s = string
    # i = integer
    # d = double
    #b = binary database(файлы)
    if ($query->execute()){
        $result_object = $query->get_result();
        $result_data = $result_object->fetch_all(MYSQLI_ASSOC);
        if($result_data[0]['count'] != 0){
            return true;
        }
    }
    return false;
}
user_is_exist('email', 'login');


# Информация о пользователе дома
function get_user_data($id)
{
    $connection = get_connection();
    $query = $connection->prepare('select * from `users` where `id` = ?');
    $query->bind_param('i', $id);
    if ($query->execute()){
        $result_object = $query->get_result();
        $result_data = $result_object->fetch_all(MYSQLI_ASSOC);
        return $result_data[0];
        }
    return false;
}
get_connection();