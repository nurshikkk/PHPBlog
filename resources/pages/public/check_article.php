<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';

$connection = get_connection();

move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/resources/uploads/' . $_FILES['photo']['name']);


if (preg_match('/[a-zA-ZА-Яа-я]{3,}/', $_REQUEST['article_name'])){
    $connection->query('insert into `articles` (`author_id`, `category_id`, `title`, `image_path`, `content`)
 values (\'' . $_SESSION['user_id'] . '\',
\'' . $_REQUEST['category'] . '\',
\'' . $_REQUEST['article_name'] . '\',
\'' . $_FILES['photo']['name'] . '\',
\'' . $_REQUEST['article_text'] . '\')');
} else {
    $_SESSION['errors']['article'] = 'Название статьи введено неккоректно!';
    header('Location: /resources/pages/public/create_article.php');
}

if (!isset($_SESSION['errors']) && count($_SESSION['errors']) == 0){
    header('Location: /resources/pages/public/create_article.php');
    die();
} else {
    header('Location: /resources/pages/public/main.php');
}