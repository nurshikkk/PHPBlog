<!doctype html>
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
            <li><a href="/">Главная</a></li>
            <li><a href="#">Категории</a>
                <ul>
                    <li><a href="#">Спорт</a></li>
                    <li><a href="#">Культура</a></li>
                    <li><a href="#">Кино</a></li>
                    <li><a href="#">История</a></li>
                    <li><a href="#">Видеоигры</a></li>
                </ul>
            <li><a href="/popular">Популярное</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Поддержка</a></li>
        </ul>
        <form>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="auth">
                    <button formaction="/login" class="entry">Вход</button>
                    <button formaction="/register" class="reg">Регистрация</button>
                </div>
            <?php else: ?>
                <div class="prof">
                    <a href="/create_article" class="cr-art">Добавить статью</a>
                    <a href="/profile" class="profile"><?= $user['name'] . ' ' . $user['surname'] ?><img
                                src="/resources/styles/icon.png" class="icon"></a>
                    <button formaction="/exit" class="exit">Выход</button>
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
                        href="/register" class="regi">зарегистрируйтесь</a> или <a
                        href="/login" class="regi">войдите</a> в свой аккаунт.</p>
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
                <a href="/article?id=<?=$value['id']?>" class="show_com">Подробнее о статье</a>
            <? endif;?>
        <?endforeach;?>
    </div>
</div>
</body>
</html>