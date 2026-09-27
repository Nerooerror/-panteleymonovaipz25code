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
        <h2>Список завдань</h2>
        <ul>
            <li class="<?= $isCompleted ? 'task-done' : 'task-pending' ?>"> 
                Завдання: <?= formatTitle($taskTitle) ?>
                <?php if ($isCompleted == true): ?> 
                    ✔️ Виконано 
                <?php else: ?> 
                    🕒 В процесі 
                <?php endif; ?> 
            </li>
            <li>Очікуваний час: <?= $taskTimeEstimate?> год.
        </li> 
    </ul> 
</main> 
</body> 
</html>