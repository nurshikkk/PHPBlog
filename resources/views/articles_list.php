<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обработка статьи</title>
    <link rel="stylesheet" href="/resources/css/art_list.css">
</head>
<body>
<div class="box">
    <div class="header">
        <nav class="table">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="#">Категории</a>
                    <ul>
                        <li><a href="#">Спорт</a></li>
                        <li><a href="#">Культура</a></li>
                        <li><a href="#">Кино</a></li>
                        <li><a href="#">В мире</a></li>
                        <li><a href="#">Видеоигры</a></li>
                    </ul>
                <li><a href="#">Популярное</a>
                    <ul>
                        <li><a href="#">Истории из жизни</a></li>
                        <li><a href="#">Чем заняться во время карантина?</a></li>
                        <li><a href="https://www.trackcorona.live/map">Распространение COVID-19 по миру</a></li>
                    </ul>
                </li>
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
                        <a href="/profile" class="profile"><?= $user['name'] . ' ' .  $user['surname']?><img src="/resources/styles/icon.png" class="icon"></a>
                        <button formaction="/exit" class="exit">Выход</button>
                    </div>
                <?php endif; ?>
            </form>
        </nav>
    </div>
</div>
<div class="bb">
    <? if ($c[0]['ban'] == 1):?>
    <p>Вы были забанены на этом блоге</p>
    <? else:?>
    <?php if (!$b) :?>
    <p class="none">Ещё никто не опубликовал статью</p>
    <?php else: ?>
    <table border="1px" bgcolor="#7fffd4">
        <caption>Неопубликованные статьи</caption>
        <tr>
            <th>Автор</th>
            <th>Категория</th>
            <th>Название статьи</th>
            <th>Содержание статьи</th>
            <th>Дата публикации</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($b as $key => $value):?>
        <tr><td><?= $value['user_name']?></td>
            <td><?= $value['category_name']?></td>
            <td><?= $value['title']?></td>
            <td class="content"><?= $value['content']?></td>
            <td><?= $value['created_at']?></td>
            <td><a href="/upload_article?id=<?=$value['id']?>" class="upload">Опубликовать</a></td>
            <td><a href="/delete_article?id=<?=$value['id']?>" class="delete">Удалить</a></td>
        <?php endforeach;?>
        <?php endif;?>
        <?endif;?>
    </table>
</div>
</body>
</html>