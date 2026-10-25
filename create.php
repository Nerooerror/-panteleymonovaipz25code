<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/TaskRepository.php';
?>

<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $priority = $_POST['priority'] ?? 'Low';
    $deadline = trim($_POST['deadline'] ?? '');

    if (empty($title)) {
        $errors[] = "Поле обов'язковим для заповнення";
    }
    if (empty($description)) {
        $errors[] = "Поле обов'язковим для заповнення";
    }

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        
        $maxSize = 2 * 1024 * 1024;
        if ($_FILES['avatar']['size'] > $maxSize) {
            $errors[] = "Файл завеликий! Максимальний розмір — 2 МБ";
        }

        $fileName = $_FILES['avatar']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "Дозволені лише файли .jpg, .jpeg або .png";
        }

    } else {
        $errors[] = "Оберіть зображення для завантаження";
    }

    if (empty($errors)) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $destination = 'uploads/' . $_FILES['avatar']['name'];

        if (move_uploaded_file($fileTmpPath, $destination)) {
            $repo = new TaskRepository(__DIR__ . '/tasks.json');

            $repo->add($title, $deadline !== '' ? $deadline : null);

            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Не вдалося перемістити завантажений файл";
        }
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

    <?php if (isset($successMessage)): ?>
        <p style="color: green;"><?= $successMessage ?></p>
    <?php endif; ?>

    <form action="create.php" method="POST" enctype="multipart/form-data">

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

        <div>
            <label>Зображення завдання:</label><br>
            <input type="file" name="avatar" accept="image/png, image/jpeg">
        </div>
        <br>

        <div>
            <label>Дедлайн:</label><br>
            <input type="date" name="deadline" value="<?= htmlspecialchars($deadline ?? "") ?>">
        </div>
        <br>

        <button type="submit">Зберегти</button>

    </form>

</body>
</html>