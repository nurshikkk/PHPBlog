<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование профиля</title>
    <link rel="stylesheet" href="/resources/css/edit_p.css">
</head>
<body>
<form action="/edit_profile" method="post" enctype="multipart/form-data">
<div class="box1">
    Имя: <input type="text" name="name">
    Фамилия: <input type="text" name="surname">
    Логин:<input type="text" name="login">
    <?php if (isset($_SESSION['errors']['login'])): ?>
        <p><?= $_SESSION['errors']['login']; ?></p>
        <?php unset($_SESSION['errors']['login']); ?>
    <?php endif; ?>
    Загрузить аватар: <input type="file" name="avatar">
    <input type="submit" class="sub" value="Изменить" name="sub1">
</div>
</form>
</body>
</html>