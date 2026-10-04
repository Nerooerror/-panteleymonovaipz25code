<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $priority = $_POST['priority'] ?? 'Low';

    if (empty($title)) {
        $errors[] = "Поле Назва є обов'язковим для заповнення!";
    }
    if (empty($description)) {
        $errors[] = "Поле Опис є обов'язковим для заповнення!";
    }
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

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <form action="create.php" method="POST">

        <div>
            <label>Назва завдання:</label><br>
            <input type="text" name="title" value="<?= $title ?? "" ?>">
        </div>
        <br>

        <div>
            <label>Опис завдання:</label><br>
            <textarea name="description"><?= $description ?? "" ?></textarea>
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