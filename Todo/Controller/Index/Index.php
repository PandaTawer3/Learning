<?php

namespace MageMastery\Todo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\TaskFactory;
use MageMastery\Todo\Model\ResourceModel\Task as ResourceTask;
use MageMastery\Todo\Service\TaskRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

class Index extends Action
{
    protected $taskResource;

    protected $taskFactory;

    protected $taskRepository;

    protected $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        TaskFactory $taskFactory,
        ResourceTask $taskResource,
        TaskRepository $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context);
    }

    public function execute()
    {
        $tasks = $this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems();

        var_dump($tasks);
        return;

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}