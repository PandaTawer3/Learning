<?php

namespace MageMastery\Todo\Api;

use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function get(int $taskId);
    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface;
}