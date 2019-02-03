<?php
declare(strict_types=1);

namespace App\DataSource\Task;

use Atlas\Mapper\MapperSelect;

/**
 * @method TaskRecord|null fetchRecord()
 * @method TaskRecord[] fetchRecords()
 * @method TaskRecordSet fetchRecordSet()
 */
class TaskSelect extends MapperSelect
{
}
