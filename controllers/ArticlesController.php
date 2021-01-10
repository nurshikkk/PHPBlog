<?php

class ArticlesController
{
    public function articlePage()
    {
        $connection = get_connection();
        $user = get_user_data($_SESSION['user_id']);
        $res = $connection->query('select `users`.`name` as `user_name`, `categories`.`name` as `category_name`, `articles`.*
from `articles`
inner join `users` on `users`.`id` = `articles`.`author_id`
inner join `categories` on `categories`.`id` = `articles`.`category_id`
where `published` = 1 and `articles`.`id` = \'' . $_REQUEST['id'] . '\'');
        $b = $res->fetch_all(MYSQLI_ASSOC);

        $r = $connection->query('select `comments`.`comment`, `comments`.`created_at`,
`users`.`login`
from `comments`
inner join `users` on `users`.`id` = `comments`.`user_id`
where `article_id` = \'' . $_REQUEST['id'] . '\'');
        $c = $r->fetch_all(MYSQLI_ASSOC);

        $result = $connection->query('select avg(`rating`) as average_rating from `ratings` where `article_id` = \'' . $_REQUEST['id'] . '\'');
        $d = $result->fetch_all(MYSQLI_ASSOC);

        $res2 = $connection->query('select * from `favourite` where `article_id` = \'' . $_REQUEST['id'] . '\' and `user_id` = \'' . $_SESSION['user_id'] . '\'');
        $e = $res2->fetch_all(MYSQLI_ASSOC);

        $r2 = $connection->query('select `users`.`ban` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $f = $r2->fetch_all(MYSQLI_ASSOC);

        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/view_article.php';
    }
}