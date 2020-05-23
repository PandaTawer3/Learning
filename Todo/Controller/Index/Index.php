<?php

namespace MageMastery\Todo\Controller\Index;

use MageMastery\Todo\Api\TaskManagementInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\TaskFactory;
use MageMastery\Todo\Model\ResourceModel\Task as ResourceTask;
use MageMastery\Todo\Service\TaskRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

class Index extends Action
{
    /**
     * @var ResourceTask
     */
    protected $taskResource;

    /**
     * @var TaskFactory
     */
    protected $taskFactory;

    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var TaskManagementInterface
     */
    protected $taskManagement;

    /**
     * Index constructor.
     * @param Context $context
     * @param TaskFactory $taskFactory
     * @param ResourceTask $taskResource
     * @param TaskRepository $taskRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TaskManagementInterface $taskManagement
     */
    public function __construct(
        Context $context,
        TaskFactory $taskFactory,
        ResourceTask $taskResource,
        TaskRepository $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TaskManagementInterface $taskManagement
    ) {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->taskManagement = $taskManagement;

        parent::__construct($context);
    }

    public function execute()
    {
        $tasks = $this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems();

        $task = $this->taskRepository->get(1);
        $task->setData('status', 'complete');

        $this->taskManagement->save($task);

        var_dump($tasks);
        return;

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}