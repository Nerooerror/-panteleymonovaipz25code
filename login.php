<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === '12345') {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_name'] = 'Адміністратор';
        header('Location: index.php'); 
        exit;
    } else {
        $error = "Невірний логін або пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід до системи</title>
</head>
<body>
    <h1>Сторінка входу</h1>

    <form action="login.php" method="POST">
        <div>
            <label>Логін:</label><br>
            <input type="text" name="username" required>
        </div>
        <br>
        <div>
            <label>Пароль:</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Увійти</button>
    </form>
</body>
</html>