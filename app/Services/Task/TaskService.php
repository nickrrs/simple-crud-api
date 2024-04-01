<?php

namespace App\Services\Task;

use App\Contracts\Services\TaskServiceInterface;
use App\Models\Task;
use App\Repositories\Task\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService implements TaskServiceInterface
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function newTask(array $payload): Task
    {
        $payload['user_id'] = Auth::guard('api')->user()->id ?? $payload['user_id'];
        return $this->taskRepository->store($payload);
    }

    public function listTasks(): Collection
    {
        return $this->taskRepository->index();
    }

    public function getTask(int $taskId): Task
    {
        return $this->taskRepository->get($taskId);
    }

    public function updateTask(int $taskId, array $payload): Task
    {
        return $this->taskRepository->update($taskId, $payload);
    }

    public function deleteTask(int $taskId): bool
    {
        return $this->taskRepository->delete($taskId);
    }
}
