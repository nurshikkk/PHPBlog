<?php

class DeleteFController
{
    public function deleteFAction()
    {
        $user = get_user_data($_SESSION['user_id']);
        $connection = get_connection();
        $r = $connection->query('delete from `favourite` where `article_id` = \'' . $_REQUEST['article_id'] . '\' and `user_id` = \'' . $_SESSION['user_id'] . '\'');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}