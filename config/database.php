<?php

return [
    'pdo' => [
        'sqlite:var/database.sqlite',
        '',
        ''
    ],
    'namespace' => 'App\\DataSource',
    'directory' => './src/DataSource',
    'transform' => new \Atlas\Cli\Transform([
        'tasks' => 'Task',
        'users' => 'User',
    ])
];