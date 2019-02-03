<?php
/**
 * @var \App\DataSource\Task\TaskRecordSet $tasks
 * @var \App\DataSource\Task\TaskRecord $task
 * @var string|null $successMessage
 * @var string|null $errorMessage
 */
?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Tasks</title>
    <script src="/public/js/jquery-3.3.1.min.js"></script>
    <script src="/public/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
</head>
<body>
<?php if ($successMessage): ?>
<div class="alert alert-success" role="alert">
    <?= $successMessage ?>
</div>
<?php endif; ?>

<?php if ($errorMessage): ?>
<div class="alert alert-danger" role="alert">
    <?= $errorMessage ?>
</div>
<?php endif; ?>

<div class="list-group">
<?php foreach ($tasks as $task): ?>
    <a href="/edit/<?= $task->id ?>" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Автор: <?= $task->author ?></h5>
        </div>
        <p class="mb-1">Описание: <?= $task->description ?></p>
        <small>Выполнена: <?= $task->is_completed ? 'Да' : 'Нет' ?></small>
    </a>
<?php endforeach; ?>
</div>
<div class="text-center">
    <a href="/add" class="btn btn-success">Добавить новую задачу</a>
    <a href="/login" class="btn btn-primary">Войти на сайт</a>
    <?php if ($isAdmin): ?>
    <a href="/logout" class="btn btn-warning">Выйти</a>
    <?php endif; ?>
</div>
</body>
</html>