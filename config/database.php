<?php

return [
    'pdo' => [
        'sqlite:' . __DIR__ . '/../var/database.sqlite',
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