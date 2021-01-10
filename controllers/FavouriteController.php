<?php

class FavouriteController
{
    public function favouritePage()
    {
        $user = get_user_data($_SESSION['user_id']);

        $connection = get_connection();

        $r = $connection->query('select *, `categories`.`name` as category_name, `users`.`name` as author_name from `articles`
inner join `favourite` on `articles`.`id` = `favourite`.`article_id`
inner join `categories` on `categories`.`id` = `articles`.`category_id`
inner join `users` on `users`.`id` = `articles`.`author_id`
where `user_id` = \'' .  $_SESSION['user_id'] . '\'');

        if ($r){
            $a = $r->fetch_all(MYSQLI_ASSOC);
        }
        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/favourite_art.php';
    }
}