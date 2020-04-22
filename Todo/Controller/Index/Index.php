<?php

namespace MageMastery\Todo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\TaskFactory;
use MageMastery\Todo\Model\ResourceModel\Task as ResourceTask;

class Index extends Action
{
    protected $taskResource;

    protected $taskFactory;

    public function __construct(
        Context $context,
        TaskFactory $taskFactory,
        ResourceTask $taskResource
    ) {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;

        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}