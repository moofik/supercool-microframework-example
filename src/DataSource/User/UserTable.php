<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\DataSource\User;

use Atlas\Table\Table;

/**
 * @method UserRow|null fetchRow($primaryVal)
 * @method UserRow[] fetchRows(array $primaryVals)
 * @method UserTableSelect select(array $whereEquals = [])
 * @method UserRow newRow(array $cols = [])
 * @method UserRow newSelectedRow(array $cols)
 */
class UserTable extends Table
{
    const DRIVER = 'sqlite';

    const NAME = 'users';

    const COLUMNS = [
        'id' => [
            'name' => 'id',
            'type' => 'INTEGER',
            'size' => null,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => true,
            'options' => null,
        ],
        'username' => [
            'name' => 'username',
            'type' => 'VARCHAR',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'password' => [
            'name' => 'password',
            'type' => 'VARCHAR',
            'size' => 255,
            'scale' => null,
            'notnull' => true,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'token' => [
            'name' => 'token',
            'type' => 'VARCHAR',
            'size' => 255,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
        'is_admin' => [
            'name' => 'is_admin',
            'type' => 'BOOLEAN',
            'size' => null,
            'scale' => null,
            'notnull' => false,
            'default' => null,
            'autoinc' => false,
            'primary' => false,
            'options' => null,
        ],
    ];

    const COLUMN_NAMES = [
        'id',
        'username',
        'password',
        'token',
        'is_admin',
    ];

    const COLUMN_DEFAULTS = [
        'id' => null,
        'username' => null,
        'password' => null,
        'token' => null,
        'is_admin' => null,
    ];

    const PRIMARY_KEY = [
        'id',
    ];

    const AUTOINC_COLUMN = null;

    const AUTOINC_SEQUENCE = null;
}
