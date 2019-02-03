<?php
declare(strict_types=1);

namespace App\DataSource\Task;

use Atlas\Table\TableSelect;

/**
 * @method TaskRow|null fetchRow()
 * @method TaskRow[] fetchRows()
 */
class TaskTableSelect extends TableSelect
{
}
