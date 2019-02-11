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
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        select {
            height: auto !important;
            padding: .6rem .8rem calc(.6rem + 1px) .8rem !important;
        }
    </style>
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
<div>
    <?php if ($pagesCount > 1): ?>
    <ul class="pagination">
        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a id='next_page' class="page-link" data-name="page" data-value="<?= $currentPage - 1 ?>">
                    Предыдущая страница
                </a>
            </li>
        <?php endif; ?>

        <?php if ($currentPage < $pagesCount): ?>
            <li class="page-item">
                <a id='prev_page' class="page-link" data-name="page" data-value="<?= $currentPage + 1 ?>">
                    Следующая страница
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>
</div>
<div>
    <label for="orderings">Сортировка:</label>
    <select name="orderings">
        <option disabled selected>Выберите параметр сортировки</option>
    <?php foreach ($orderings as $name => $value): ?>
        <option value="<?=$value?>" <?= $currentOrdering === $value ? 'selected' : '' ?>><?=$name?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="text-center">
    <a href="/add" class="btn btn-success">Добавить новую задачу</a>
    <a href="/login" class="btn btn-primary">Войти на сайт</a>
    <?php if ($isAdmin): ?>
    <a href="/logout" class="btn btn-warning">Выйти</a>
    <?php endif; ?>
</div>
<script>
    $('#next_page, #prev_page').on('click', function (e) {
        e.preventDefault();
        var pageParam = $(this).data('name');
        var pageValue = $(this).data('value');

        window.location = window.location.pathname + addToQueryString(pageParam, pageValue);
    });

    $('[name="orderings"]').on('change', function (e) {
        var ordering = $(this)
            .find("option:selected")
            .val();

        window.location = window.location.pathname + addToQueryString('sort', ordering);
    });

    /**
     * @param paramName
     * @param paramValue
     */
    function addToQueryString(paramName, paramValue) {
        var str = window.location.search;

        if (str.indexOf('&' + paramName) > -1 ||
            str.indexOf('?' + paramName) > -1
        ) {
            str = replaceQueryParam(paramName, paramValue, str);
        } else if (str.indexOf('?') > -1) {
            str += '&' + paramName + '=' + paramValue;
        } else {
            str += '?' + paramName + '=' + paramValue;
        }

        return str;
    }

    /**
     * @param param
     * @param newval
     * @param search
     * @return {string}
     */
    function replaceQueryParam(param, newval, search) {
        var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
        var query = search.replace(regex, "$1").replace(/&$/, '');

        return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
    }
</script>
</body>
</html>
