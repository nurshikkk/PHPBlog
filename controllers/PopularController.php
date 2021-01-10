<?php

class PopularController
{
    public function popularPage()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();

        $res = $connection->query('select `users`.`name` as user_name, `categories`.`name` as category_name, avg(`rating`) as average_rating, `articles`.*
from `articles`
inner join `users` on `users`.`id` = `articles`.`author_id`
inner join `categories` on `categories`.`id` = `articles`.`category_id`
inner join `ratings` on `ratings`.`article_id` = `articles`.`id`
where `published` = 1 group by `articles`.`id`');
        $d = $res->fetch_all(MYSQLI_ASSOC);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/popular.php';
    }
}