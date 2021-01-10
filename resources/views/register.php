<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Аутентификация</title>
    <link rel="stylesheet" href="/resources/css/styles.css">
</head>
<body>
<div class="container">
    <div class="sign-up">
        <h2>Регистрация</h2>
        <form action="/register" method="post">
            <div class="form-group">
                <?php if (isset($_SESSION['errors']['email'])): ?>
                    <p><?= $_SESSION['errors']['email']; ?></p>
                    <?php unset($_SESSION['errors']['email']); ?>
                <?php endif; ?>
                <label>Email:</label>
                <input type="text" name="email" placeholder="Введите email" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Логин:</label>
                <?php if (isset($_SESSION['errors']['login'])): ?>
                    <p><?= $_SESSION['errors']['login']; ?></p>
                    <?php unset($_SESSION['errors']['login']); ?>
                <?php endif; ?>
                <input type="text" name="login" placeholder="Введите логин">
            </div>
            <div class="form-group">
                <label>Фамилия:</label>
                <?php if (isset($_SESSION['errors']['surname'])): ?>
                    <p><?= $_SESSION['errors']['surname']; ?></p>
                    <?php unset($_SESSION['errors']['surname']); ?>
                <?php endif; ?>
                <input type="text" name="surname" placeholder="Введите фамилию">
            </div>
            <div class="form-group">
                <label>Имя:</label>
                <?php if (isset($_SESSION['errors']['name'])): ?>
                    <p><?= $_SESSION['errors']['name']; ?></p>
                    <?php unset($_SESSION['errors']['name']); ?>
                <?php endif; ?>
                <input type="text" name="name" placeholder="Введите имя">
            </div>
            <div class="form-group">
                <label>Пароль:</label>
                <?php if (isset($_SESSION['errors']['password'])): ?>
                    <p><?= $_SESSION['errors']['password']; ?></p>
                    <?php unset($_SESSION['errors']['password']); ?>
                <?php endif; ?>
                <input type="password" name="password" placeholder="Введите пароль" autocomplete="off">
            </div>
            <div style="text-align: center;"><button formaction="/register" name="submit">Зарегистрироваться</button></div>
        </form>
    </div>
    <div class="sing-in">
        <h2>Авторизация</h2>
        <form action="/login" method="post">
            <div class="form-group">
                <label>Логин:</label>
                <?php if (isset($_SESSION['error']['login'])): ?>
                    <p><?= $_SESSION['error']['login']; ?></p>
                    <?php unset($_SESSION['error']['login']); ?>
                <?php endif; ?>
                <input type="text" name="login" placeholder="Введите логин" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Пароль:</label>
                <?php if (isset($_SESSION['error']['password'])): ?>
                    <p><?= $_SESSION['error']['password']; ?></p>
                    <?php unset($_SESSION['error']['password']); ?>
                <?php endif; ?>
                <input type="password" name="password" placeholder="Введите пароль" autocomplete="off">
            </div>
            <div class="form-group">
                <a href="forgot_password.php" class="forgot">Забыли пароль?</a>
            </div>
            <div style="text-align: center;"><button formaction="/login" name="submit">Авторизоваться</button></div>
        </form>
    </div>
</div>
</body>
</html>