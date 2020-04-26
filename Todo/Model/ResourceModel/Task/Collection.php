<?php

namespace MageMastery\Todo\Model\ResourceModel\Task;

use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MageMastery\Todo\Model\Task as ModelTask;
use MageMastery\Todo\Model\ResourceModel\Task as ResourceTask;

class Collection extends AbstractCollection implements TaskSearchResultInterface
{
    /**
     * @var SearchCriteriaInterface
     */
    protected $searchCriteria;

    protected function _construct()
    {
        $this->_init(ModelTask::class, ResourceTask::class);
    }

    /**
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this|Collection
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return$this->getSize();
    }

    /**
     * @param int $totalCount
     * @return $this|Collection
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * @param array|null $items
     * @return $this|TaskSearchResultInterface
     * @throws \Exception
     */
    public function setItems(array $items = null)
    {
        if (!$items) {
            return$this;
        }
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }
}