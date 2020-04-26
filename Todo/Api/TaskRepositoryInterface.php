<?php

namespace MageMastery\Todo\Api;

use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function get(int $taskId);
    public function getList(SearchResultsInterface $searchCriteria): TaskSearchResultInterface;
}