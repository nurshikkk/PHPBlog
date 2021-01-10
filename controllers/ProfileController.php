<?php

class ProfileController
{
    public function profilePage()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();
        $res = $connection->query('select `roles`.`name` as `role_name`, `users`.* from `users`
 inner join `roles` on `roles`.`id` = `users`.`role_id` 
 where `users`.`id` = \'' . $_SESSION['user_id'] . '\'');
        $b = $res->fetch_all(MYSQLI_ASSOC);

        $r = $connection->query('select `role_id` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $c = $r->fetch_all(MYSQLI_ASSOC);

        $result = $connection->query('select `avatar` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $d = $result->fetch_all(MYSQLI_ASSOC);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/profile.php';

    }
}