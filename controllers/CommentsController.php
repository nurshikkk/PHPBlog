<?php

class CommentsController
{
    public function commentAction()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();

        $res = $connection->query('select `users`.`ban` from `users` where `id` = \'' . $_SESSION['user_id'] . '\'');
        $a = $res->fetch_all(MYSQLI_ASSOC);
        if ($a[0]['ban'] == 0){
            if (!isset($_REQUEST['comment'])){
                $_SESSION['errors']['comment'][$_REQUEST['comment']] = 'Комментарий пуст!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $connection->query('insert into `comments` (`article_id`, `user_id`, `comment`) 
values (\'' . $_REQUEST['article_id'] . '\',\'' . $_SESSION['user_id'] . '\', \'' . $_REQUEST['comment'] . '\')');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['errors']['comment'][$_REQUEST['comment']] = 'Вы забанены и не можете добавлять комментарии!';
            header('Location: /');
        }
    }
}