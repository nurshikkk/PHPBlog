<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание статьи</title>
    <link rel="stylesheet" href="/resources/css/cr-art.css">
</head>
<body>
<div class="art">
    <h1>Создание статьи</h1>
        <form action="/check_article" method="post" enctype="multipart/form-data">
            <label>Название статьи:</label>
            <?php if (isset($_SESSION['errors']['article'])): ?>
                <p><?= $_SESSION['errors']['article']; ?></p>
                <?php unset($_SESSION['errors']['article']); ?>
            <?php endif; ?>
            <input type="text" name="article_name" maxlength="70" autocomplete="off" required>
            <label>Выберите категорию:</label>
            <select required name="category">
                <?php foreach ($c as $key => $value) :?>
                <option value="<?=$value['id']?>"><?=$value['name']?></option>
                <?php endforeach; ?>
            </select>
            <label>Загрузите фото статьи (не обязательно)</label>
            <input type="file" name="photo" autocomplete="off">
            <label>Содержание статьи:</label>
            <textarea rows="20" name="article_text" required></textarea>
            <button class="but" formaction="/check_article">Отправить</button>
        </form>
</div>
</body>
</html>