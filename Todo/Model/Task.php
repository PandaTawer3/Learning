<?php

namespace MageMastery\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use MageMastery\Todo\Model\ResourceModel\Task as ResourceTask;

class Task extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceTask::class);
    }
}