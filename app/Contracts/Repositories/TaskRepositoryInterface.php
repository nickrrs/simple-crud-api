<?php

namespace App\Contracts\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function store(array $payload): Task;
    public function index(): Collection;
    public function get(int $taskId);
    public function update(int $taskId, array $payload): Task;
    public function delete(int $taskId): bool;
}
