<?php
declare(strict_types=1);

namespace App\DataSource\Task;

use Atlas\Mapper\Record;

/**
 * @method TaskRow getRow()
 */
class TaskRecord extends Record
{
    use TaskFields;
}
