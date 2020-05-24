<?php

namespace MageMastery\Todo\Api;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    /**
     * @param int $taskId
     * @return TaskInterface
     */
    public function get(int $taskId): TaskInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TaskSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface;
}