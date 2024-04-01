<?php

namespace App\Contracts\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function newTask(array $payload): Task;
    public function listTasks(): Collection;
    public function getTask(int $taskId): Task;
    public function updateTask(int $taskId, array $payload): Task;
    public function deleteTask(int $taskId): bool;
}
