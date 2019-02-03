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
<form class="p-5" action="/login" method="post">
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Логин</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" id="username">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Пароль</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button class="btn btn-primary">Войти</button>
        </div>
    </div>
</form>
</body>
</html>