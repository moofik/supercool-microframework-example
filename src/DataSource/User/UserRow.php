<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace App\DataSource\User;

use Atlas\Table\Row;

/**
 * @property mixed $id INTEGER
 * @property mixed $username VARCHAR(255) NOT NULL
 * @property mixed $password VARCHAR(255) NOT NULL
 * @property mixed $token VARCHAR(255)
 * @property mixed $is_admin BOOLEAN
 */
class UserRow extends Row
{
    protected $cols = [
        'id' => null,
        'username' => null,
        'password' => null,
        'token' => null,
        'is_admin' => null,
    ];
}