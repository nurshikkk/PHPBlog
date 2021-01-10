<?php

class UploadAController
{
    public function uploadAction()
    {
        $connection = get_connection();

        $res = $connection->query('update `articles` set `published` = 1 where `id` = \'' . $_REQUEST['id'] . '\'');
        header('Location: /resources/pages/public/main.php');
    }
}