<?php
$appName = "Task Manager";
$taskTitle = "Вивчити основи PHP";
$taskTimeEstimate = 3;
$isCompleted = true;
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $appName ?></title>
</head>
<body>
    <header>
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
                Завдання: <?= $taskTitle ?> 
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