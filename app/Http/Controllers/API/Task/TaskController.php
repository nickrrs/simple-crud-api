<?php

namespace App\Http\Controllers\API\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\NewTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Services\Task\TaskService;
use App\Traits\HandleExceptionResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    use HandleExceptionResponse;

    public function __construct(private TaskService $taskService)
    {
        $this->middleware('auth:api');
    }

    public function newTask(NewTaskRequest $payload): JsonResponse
    {
        try {
            $task = $this->taskService->newTask($payload->validated());

            return response()->json([
                'message' => 'Task created successfully',
                'data' => $task
            ]);
        } catch (Exception $e) {
            Log::critical($e->getMessage());
            return $this->handleException($e);
        }
    }

    public function allTasks(): JsonResponse
    {
        try {
            $tasks = $this->taskService->listTasks();

            if ($tasks->count() == 0) {
                return response()->json([
                    'No task was found in the database, please try again later.'
                ], 422);
            }

            return response()->json([
                'data' => $tasks
            ]);
        } catch (Exception $e) {
            Log::critical($e->getMessage());
            return $this->handleException($e);
        }
    }

    public function getTask(Request $request): JsonResponse
    {
        try {
            $task = $this->taskService->getTask($request->id);

            return response()->json([
                'data' => $task
            ]);
        } catch (Exception $e) {
            Log::critical($e->getMessage());
            return $this->handleException($e);
        }
    }

    public function updateTask(Request $request, UpdateTaskRequest $payload): JsonResponse
    {
        try {
            $task = $this->taskService->updateTask($request->id, $payload->validated());

            return response()->json([
                'message' => 'Task successfully updated',
                'data' => $task
            ]);
        } catch (Exception $e) {
            Log::critical($e->getMessage());
            return $this->handleException($e);
        }
    }

    public function deleteTask(Request $request): JsonResponse
    {
        try {
            $this->taskService->deleteTask($request->id);

            return response()->json([
                'Task successfully deleted'
            ]);
        } catch (Exception $e) {
            Log::critical($e->getMessage());
            return $this->handleException($e);
        }
    }
}
