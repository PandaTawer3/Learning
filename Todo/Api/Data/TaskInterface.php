<?php

declare(strict_types=1);

namespace MageMastery\Todo\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface TaskInterface extends SearchResultsInterface
{
    /**
     * @return TaskInterface[]
     */
    public function getItems();

    /**
     * @param TaskInterface[] $items
     * @return SearchResultsInterface
     */
    public function setItems(array $items);
}