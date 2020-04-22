<?php

namespace MageMastery\Todo\Api;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function get(int $taskId);
    public function getList();
}