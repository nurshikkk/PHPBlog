<?php

class DeleteAController
{
    public function deleteAction()
    {
        $connection = get_connection();

        $res = $connection->query('delete from `articles` where `id` = \'' . $_REQUEST['id'] . '\'');
        header('Location: /resources/pages/admin/articles_list.php');
    }
}