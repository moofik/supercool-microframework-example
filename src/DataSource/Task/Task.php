<?php
declare(strict_types=1);

namespace App\DataSource\Task;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method TaskTable getTable()
 * @method TaskRelationships getRelationships()
 * @method TaskRecord|null fetchRecord($primaryVal, array $with = [])
 * @method TaskRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method TaskRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method TaskRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method TaskRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method TaskRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method TaskSelect select(array $whereEquals = [])
 * @method TaskRecord newRecord(array $fields = [])
 * @method TaskRecord[] newRecords(array $fieldSets)
 * @method TaskRecordSet newRecordSet(array $records = [])
 * @method TaskRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method TaskRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Task extends Mapper
{
}
