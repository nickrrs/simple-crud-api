<?php

namespace App\Repositories\Task;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function store(array $payload): Task
    {
        return Task::create($payload);
    }

    public function index(): Collection
    {
        return Task::all();
    }

    public function get(int $taskId)
    {
        return Task::findOrFail($taskId);
    }

    public function update(int $taskId, array $payload): Task
    {
        $task = $this->get($taskId);
        $task->update($payload);

        return $task;
    }

    public function delete(int $taskId): bool
    {
        $task = $this->get($taskId);
        return $task->delete();
    }
}
