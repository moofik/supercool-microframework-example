<?php

namespace App\Service\Pagination;

use Atlas\Mapper\Exception;
use Atlas\Orm\Atlas;

class Paginator
{
    /**
     * @var Atlas
     */
    private $atlas;

    /**
     * Paginator constructor.
     * @param Atlas $atlas
     */
    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    /**
     * @param string $mapperClass
     * @param $perPage
     * @return float|int
     */
    public function getTotalPageCount(string $mapperClass, $perPage)
    {
        try {
            $countTasks = $this->atlas
                ->select($mapperClass)
                ->fetchCount();
        } catch (Exception $exception) {
            throw new PaginatorException('There is no mapper ' . $mapperClass);
        }

        return ceil($countTasks/$perPage);
    }
}
