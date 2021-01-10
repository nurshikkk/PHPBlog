<?php

class MainController
{
    public function mainPage()
    {
        $title = 'Hello from MainController';
        $message = '';
        $connection = get_connection();
        session_start();
        $user = get_user_data($_SESSION['user_id']);
        $res = $connection->query('select `users`.`name` as `user_name`, `categories`.`name` as `category_name`, `articles`.*
from `articles`
inner join `users` on `users`.`id` = `articles`.`author_id`
inner join `categories` on `categories`.`id` = `articles`.`category_id`
where `published` = 1');
        $b = $res->fetch_all(MYSQLI_ASSOC);

        $r = $connection->query('select `comments`.`comment`, `comments`.`created_at`,
`users`.`login`
from `comments`
inner join `users` on `users`.`id` = `comments`.`user_id`
where `user_id` = \'' . $_SESSION['user_id'] . '\'');
        $c = $r->fetch_all(MYSQLI_ASSOC);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/main.php';
    }
}