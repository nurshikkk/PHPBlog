<?php session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
$user = get_user_data($_SESSION['user_id']);
$connection = get_connection();
$res = $connection->query('select `users`.`name` as `user_name`, `categories`.`name` as `category_name`, `articles`.*
from `articles`
inner join `users` on `users`.`id` = `articles`.`author_id`
inner join `categories` on `categories`.`id` = `articles`.`category_id`
where `published` = 1');
$b = $res->fetch_all(MYSQLI_ASSOC);

$r = $connection->query('select `comments`.`comment`, `comments`.`created_at`,
`users`.`login`
from `comments`
inner join `users` on `users`.`id` = `comments`.`user_id`
where `user_id` = \'' . $_SESSION['user_id'] . '\'');
$c = $r->fetch_all(MYSQLI_ASSOC);

?>
</<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="/resources/css/main_style.css">
</head>
<body>
<div class="header">
    <nav class="table">
        <ul>
            <li><a href="/resources/pages/public/main.php">Главная</a></li>
            <li><a href="#">Категории</a>
                <ul>
                    <li><a href="#">Спорт</a></li>
                    <li><a href="#">Культура</a></li>
                    <li><a href="#">Кино</a></li>
                    <li><a href="#">История</a></li>
                    <li><a href="#">Видеоигры</a></li>
                </ul>
            <li><a href="/resources/views/popular.php">Популярное</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Поддержка</a></li>
        </ul>
        <form>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="auth">
                    <button formaction="/resources/pages/public/auth.php" class="entry">Вход</button>
                    <button formaction="/resources/pages/public/auth.php" class="reg">Регистрация</button>
                </div>
            <?php else: ?>
                <div class="prof">
                    <a href="/resources/views/create_article.php" class="cr-art">Добавить статью</a>
                    <a href="../../views/profile.php" class="profile"><?= $user['name'] . ' ' . $user['surname'] ?><img
                                src="/resources/styles/icon.png" class="icon"></a>
                    <button formaction="/resources/pages/public/exit.php" class="exit">Выход</button>
                </div>
            <?php endif; ?>
        </form>
    </nav>
</div>
<div class="box-body">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="box-banner">
            <h1 class="banner">Добро пожаловать на блог!</h1>
            <p class="banner-description">Чтобы комментировать и оценивать статьи <a
                        href="/resources/pages/public/auth.php" class="regi">зарегистрируйтесь</a> или <a
                        href="/resources/pages/public/auth.php" class="regi">войдите</a> в свой аккаунт.</p>
        </div>
    <?php endif; ?>
    <div class="box-articles">
        <h1>Новости</h1>
        <?php foreach ($b as $key => $value) : ?>
            <h3>Категория: <?= $value['category_name'] ?></h3>
            <h2><?= $value['title'] ?></h2>
            <img src="/resources/uploads/<?= $value['image_path'] ?>">
            <p>Автор статьи: <?= $value['user_name'] ?></p>
            <p class="article1"><?= $value['content'] ?></p>
        <? if (isset($_SESSION['user_id'])) :?>
            <a href="../../views/view_article.php?id=<?=$value['id']?>" class="show_com">Подробнее о статье</a>
        <? endif;?>
        <?endforeach;?>
    </div>
</div>
</body>
</html>