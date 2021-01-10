<?php

class RatingController
{
    public function rateAction()
    {
        $connection = get_connection();

        $r = $connection->query('select * from `ratings` where `user_id` = \'' . $_SESSION['user_id'] . '\' and `article_id` = \'' . $_REQUEST['article_id'] . '\'');
        $b = $r->num_rows;

        $res = $connection->query('select `users`.`ban` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $a = $res->fetch_all(MYSQLI_ASSOC);

        if ($a[0]['ban'] == 0){
            if ($b == 1) {
                $_SESSION['errors']['rating'][$_REQUEST['article_id']] = 'Вы уже оценили данную статью!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $res = $connection->query('insert into `ratings` (`article_id`, `user_id`, `rating`)
values (\'' . $_REQUEST['article_id'] . '\', \'' . $_SESSION['user_id'] . '\',
\'' . $_REQUEST['rating'] . '\')');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['errors']['rating'][$_REQUEST['article_id']] = 'Вы были забанены и не можете оценивать статьи!';
            header('Location: /');
        }
    }
}