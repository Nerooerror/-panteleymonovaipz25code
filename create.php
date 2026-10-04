<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Користувач натиснув "Зберегти" і відправив дані методом POST
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Створити завдання</title>
</head>
<body>

    <a href="index.php">Повернутись до списку</a>

    <h1>Додати нове завдання</h1>

    <form action="create.php" method="POST">

        <div>
            <label>Назва завдання:</label><br>
            <input type="text" name="title" required>
        </div>
        <br>

        <div>
            <label>Опис завдання:</label><br>
            <textarea name="description"></textarea>
        </div>
        <br>

        <div>
            <label>Пріоритет:</label><br>
            <select name="priority">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <br>

        <button type="submit">Зберегти</button>
    </form>

</body>
</html>