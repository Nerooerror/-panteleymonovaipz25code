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
$tasks = [
    [
        'id' => 1,
        'title' => 'Виконати лабораторну роботу №5 з PHP',
        'priority' => 'High',
        'is_completed' => false
    ],
    [
        'id' => 2,
        'title' => 'Розібратися з циклами foreach та масивами',
        'priority' => 'Medium',
        'is_completed' => true
    ],
    [
        'id' => 3,
        'title' => 'Зробити коміт і пуш на GitHub',
        'priority' => 'High',
        'is_completed' => false
    ],
    [
        'id' => 4,
        'title' => 'Підготувати звіт lab5.md',
        'priority' => 'Low',
        'is_completed' => false
    ]
];
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
            <?php foreach ($tasks as $task): ?>
                <li class="<?= $task['is_completed'] ? 'task-done' : 'task-pending' ?>">
                    Завдання: <?= formatTitle($task['title']) ?> 
                    (Пріоритет: <?= $task['priority'] ?>) — 
                    <?php if ($task['is_completed']): ?>
                        ✔️ Виконано
                    <?php else: ?>
                        🕒 В процесі
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>