<?php

class CreateAController
{
    public function createAPage()
    {
        $connection = get_connection();
        $res = $connection->query('select * from `categories`');
        $c = $res->fetch_all(MYSQLI_ASSOC);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/resources/views/create_article.php';
    }
}