<?php
declare(strict_types=1);

namespace App\DataSource\Task;

use Atlas\Mapper\RecordSet;

/**
 * @method TaskRecord offsetGet($offset)
 * @method TaskRecord appendNew(array $fields = [])
 * @method TaskRecord|null getOneBy(array $whereEquals)
 * @method TaskRecordSet getAllBy(array $whereEquals)
 * @method TaskRecord|null detachOneBy(array $whereEquals)
 * @method TaskRecordSet detachAllBy(array $whereEquals)
 * @method TaskRecordSet detachAll()
 * @method TaskRecordSet detachDeleted()
 */
class TaskRecordSet extends RecordSet
{
}
