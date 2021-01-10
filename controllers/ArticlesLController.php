<?php

class ArticlesLController
{
    public function articlesLPage()
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/articles_list.php';
    }

    public function articlesLAction()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();
        $res = $connection->query('select `users`.`name` as `user_name`, `categories`.`name` as `category_name`, `articles`.* from `articles`
inner join `users` on `users`.`id` = `articles`.`author_id`
inner join `categories` on `categories`.`id` = `articles`.`category_id`
where `published` = 0');
        $b = $res->fetch_all(MYSQLI_ASSOC);

        $r = $connection->query('select `ban` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $c = $r->fetch_all(MYSQLI_ASSOC);
    }
}