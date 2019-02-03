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
    <script src="/public/js/jquery-3.3.1.min.js"></script>
    <script src="/public/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
</head>
<body>
<form class="p-5" action="/add" method="post">
    <div class="form-group row">
        <label for="author" class="col-sm-2 col-form-label">Автор</label>
        <div class="col-sm-10">
            <input type="text"
                   class="form-control"
                   name="author"
                   id="author"
                   required
            >
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="text"
                   class="form-control"
                   name="email"
                   id="email"
                   required
            >
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Описание</label>
        <div class="col-sm-10">
            <input type="text"
                   class="form-control"
                   name="description"
                   id="description"
                   required
            >
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
                >
                <label class="form-check-label" for="is_completed">
                    Выполнена
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </div>
</form>
</body>
</html>