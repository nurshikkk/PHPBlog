<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Просмотр статьи</title>
    <link rel="stylesheet" href="/resources/css/view_art.css">
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
            <?php if (!$e): ?>
                <form method="post" action="/create_favourite" class="favourite">
                    <button name="article_id" value="<?= $value['id'] ?>">Добавить в избранные</button>
                </form>
            <?php else: ?>
                <form method="post" action="/delete_favourite" class="delete_box">
                    <button name="article_id" value="<?= $value['id'] ?>" class="delete_art">Удалить из избранных
                    </button>
                </form>
            <? endif; ?>
            <? foreach ($f as $key => $ban_value)?>
            <? if ($ban_value['ban'] == 0): ?>
                <form action="/rating" method="post" class="form2">
                    <input type="hidden" name="article_id" value="<?= $value['id'] ?>">
                    <?php if (isset($_SESSION['errors']['rating'][$value['id']])): ?>
                        <p class="error"><?= $_SESSION['errors']['rating'][$value['id']]; ?></p>
                        <?php unset($_SESSION['errors']['rating'][$value['id']]); ?>
                    <?php endif; ?>
                    <? foreach ($d as $key => $rating_value) : ?>
                        <div class="avg_rate">
                            <p>Рейтинг статьи: <?= $rating_value['average_rating'] ?></p>
                        </div>
                    <? endforeach; ?>
                    <p class="estimation">Оцените статью: <label>
                            <select name="rating">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </label></p>
                    <button class="button">Оценить</button>
                </form>
                <form action="/comments" method="post" class="form3">
                <input type="hidden" name="article_id" value="<?= $value['id'] ?>">
                <?php if (isset($_SESSION['errors']['comment'][$value['id']])): ?>
                    <p class="error"><?= $_SESSION['errors']['comments'][$value['id']]; ?></p>
                    <?php unset($_SESSION['errors']['comment'][$value['id']]); ?>
                <?php endif; ?>
                <label class="com">
                    <textarea rows="3" name="comment" placeholder="Написать комментарий" role="textbox"></textarea>
                    <button class="button2">Отправить</button>
                </label>
            <? endif; ?>
            <? foreach ($c as $key => $value) : ?>
                <div class="user_com">
                    <p class="comment"><?= $value['login'] ?>
                        : <?= $value['comment'] ?> <?= $value['created_at'] ?></p>
                </div>
            <? endforeach; ?>
            </form>
        <? endforeach; ?>
    </div>
</div>
</body>
</html>