<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользователи</title>
    <link rel="stylesheet" href="/resources/css/ban.css">
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
    <?php else: ?>
    <div class="box-ban">
        <table border="1px" bgcolor="#a9a9a9" class="tab">
            <? if ($c[0]['ban'] == 1):?>
            <p>Вы забанены на этом блоге</p>
            <? else:?>
            <caption class="cap">Список пользователей</caption>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Логин</th>
                <th>Почта</th>
                <th></th>
            </tr>
            <?php foreach ($b as $key => $value):?>
            <tr><td><?= $value['name']?></td>
                <td><?= $value['surname']?></td>
                <td><?= $value['login']?></td>
                <td><?= $value['email']?></td>
                <? if ($value['ban'] == 0) :?>
                <td><a href="/ban?id=<?=$value['id']?>" class="ban">Забанить</a></td>
                <? else :?>
                <td><a href="/unban?id=<?=$value['id']?>" class="unban">Разбанить</a></td>
                <?endif;?>
                <?php endforeach;?>
            <? endif;?>
        </table>
    </div>
    <?endif;?>
</body>
</html>