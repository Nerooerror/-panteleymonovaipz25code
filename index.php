<?php // http://localhost/task_manager/index.php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/Task.php';
require_once __DIR__ . '/TaskRepository.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$repo = new TaskRepository(__DIR__ . '/tasks.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $title    = trim($_POST['title'] ?? '');
        $deadline = trim($_POST['deadline'] ?? '') ?: null;
        if (!empty($title)) {
            $repo->add($title, $deadline);
        }
    }

    if ($action === 'complete') {
        $repo->complete((int) ($_POST['id'] ?? 0));
    }

    if ($action === 'delete') {
        $repo->delete((int) ($_POST['id'] ?? 0));
    }

    header('Location: index.php');
    exit;
}

$tasks = $repo->findAll();
?>

<?php
function formatTitle($text, $maxLength = 20) {
    if (mb_strlen($text) > $maxLength) {
        return mb_substr($text, 0, $maxLength, 'UTF-8') . '...';
    }
    return $text;
}
  
function getCurrentGreeting() {
    $hour = (int)date('H');
    
    if ($hour >= 6 && $hour < 12) {
        return "Доброго ранку";
    } elseif ($hour >= 12 && $hour < 18) {
        return "Добрий день";
    } elseif ($hour >= 18 && $hour < 24) {
        return "Добрий вечір";
    } else {
        return "Доброї ночі";
    }
}

$appName = "Task Manager";
$taskTitle = "Вивчити основи PHP";
$taskTimeEstimate = 3;
$isCompleted = false;

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $appName ?></title>
</head>
<body>
    <header>

        <div style="background: #f4f4f4; padding: 8px; margin-bottom: 10px;">
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                Привіт, <?= $_SESSION['user_name'] ?>! <a href="logout.php">[Вийти]</a>
            <?php else: ?>
                Ви увійшли як Гість. <a href="login.php">[Увійти]</a>
            <?php endif; ?>
        </div>


        <h1><?= getCurrentGreeting() ?>, вітаємо у <?= $appName ?>!</h1>
        <h1><?= $appName ?></h1>
        <style>
            .task-done {
            color: green;
            }
            .task-pending{
                color:gray;
            }
        </style>
    </header>
    <main>

        <div class="stats">
            Всього: <?= count($tasks) ?> |
            Виконано: <?= $repo->countCompleted() ?> |
            Прострочено: <?= $repo->countOverdue() ?>
        </div>

        <a href="create.php">Додати нове завдання</a>

        <h2>Список завдань</h2>
        <ul>

            <?php foreach ($tasks as $task): ?>
                <li>
                    Завдання: <?= formatTitle(htmlspecialchars($task->getTitle())) ?> — 
                    <strong><?= $task->getStatusLabel() ?></strong>

                    <?php if (!$task->isCompleted()): ?>
                    <form method="POST" style="display:inline; margin-left: 10px;">
                        <input type="hidden" name="action" value="complete">
                        <input type="hidden" name="id" value="<?= $task->getId() ?>">
                        <button type="submit">✓</button>
                    </form>
                    <?php endif; ?>

                    <form method="POST" style="display:inline; margin-left: 5px;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $task->getId() ?>">
                    <button type="submit" style="color:red;">✕</button>
                    </form>

                </li>
            <?php endforeach; ?>

        </ul>
    </main>
</body>
</html>