<?php

class BanController
{
    public function banAction()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();

        $res = $connection->query('update `users` set `ban` = 1 where `id` = \'' . $_REQUEST['id'] . '\'');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}