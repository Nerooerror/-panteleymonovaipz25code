<?php
$appName = "Task Manager";
$taskTitle = "Вивчити основи PHP";
$taskTimeEstimate = 3;
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
    </header>
    <main>
        <h2>Список завдань</h2>
        <ul>
            <li>Завдання: <?= $taskTitle ?></li>
            <li>Очікуваний час: <?= $taskTimeEstimate ?> год.</li>
        </ul>
    </main>
</body>
</html>