<?php
/**
 * @var \App\DataSource\Task\TaskRecordSet $tasks
 * @var \App\DataSource\Task\TaskRecord $task
 */
?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Tasks</title>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<form class="p-5" action="/edit/1" method="post">
    <div class="form-group row">
        <div class="col-sm-10">
            <p>Автор: <?= $task->author ?></p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <p>E-mail: <?= $task->email ?></p>
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Описание</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="description" id="description" value="<?= $task->description ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">Статус</div>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input"
                       type="checkbox"
                       name="is_completed"
                       id="is_completed"
                       <?= $task->is_completed ? 'checked' : '' ?>
                >
                <label class="form-check-label" for="is_completed">
                    Выполнена
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>
</body>
</html>