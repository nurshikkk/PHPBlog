<?php

class BanLController
{
    public function banPage()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();

        $res = $connection->query('select * from `users`');
        $b = $res->fetch_all(MYSQLI_ASSOC);

        $r = $connection->query('select `ban` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $c = $r->fetch_all(MYSQLI_ASSOC);

        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/ban_list.php';
    }
}