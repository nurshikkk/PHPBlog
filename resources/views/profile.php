<html lang="ru">
<head>
    <meta charset=utf-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="/resources/css/profile_style.css">
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
<div class="info-box">
    <div class="photo">
        <? foreach ($d as $key => $value) : ?>
            <p>Ваш аватар: <a><img src="/resources/uploads/<?= $value['avatar'] ?>" class="ava"></a></p>
        <? endforeach; ?>
    </div>
    <form action="/change_pass" method="post" class="form1">
        <? foreach ($b as $key => $value) : ?>
            <p>Ваше имя: <?= $value['name'] ?></p>
            <p>Ваша фамилия: <?= $value['surname'] ?></p>
            <p>Ваш логин: <?= $value['login'] ?></p>
            <p>Ваша роль: <?= $value['role_name'] ?></p>
            <p>Почта на которую привязан аккаунт: <?= $value['email'] ?></p>
            <? if ($value['ban'] == 0):?>
            <button class="edit"><a href="/edit_profile" class="ed" name="edit_prof">Редактировать профиль</a></button>
            <? endif;?>
            <button class="fav_articles"><a href="/favourite" class="ed">Избранные статьи</a></button>
            <? if ($value['ban'] == 0):?>
            <? if ($c[0]['role_id'] == 1) : ?>
            <button class="ban"><a href="/ban_list" class="ed">Забаненные пользователи</a></button>
            <? endif; ?>
            <h1>Изменить пароль:</h1>
            <input type="password" class="change_p" name="new_p" placeholder="Пароль" autocomplete="off">
            <?php if (isset($_SESSION['errors']['password'])): ?>
                <p class="error"><?= $_SESSION['errors']['password']; ?></p>
                <?php unset($_SESSION['errors']['password']); ?>
            <?php endif; ?>
            <button type="submit" class="edit_p" name="new_pass">Изменить пароль</button>
            <? else:?>
            <p class="ban_text">Вы были забанены на этом блоге</p>
        <?endif;?>
        <? endforeach; ?>
    </form>
    <? if ($value['ban'] == 0):?>
    <? if ($c[0]['role_id'] == 1) : ?>
        <button><a href="/articles_list" class="a">Статьи на модерации</a></button>
    <? endif; ?>
    <? endif;?>
</div>
</body>
</html>