<?php

namespace Jgile\Tasks\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jgile\Messenger\Contracts\Messenger;
use Jgile\Tasks\Http\Requests\CreateTasksRequest;
use Jgile\Tasks\Http\Requests\UpdateTasksRequest;
use Jgile\Tasks\Http\Resources\TasksResource;
use Jgile\Tasks\Models\Tasks;
use Jgile\Tasks\Repositories\TasksRepository;

class TasksController extends Controller
{
    /** @var \Jgile\Messenger\Messenger */
    protected $messenger;

    /** @var \App\Repositories\CartItemRepository */
    protected $repository;

    public function __construct(Messenger $messenger, TasksRepository $tasks_repo)
    {
        $this->messenger = $messenger;
        $this->repository = $tasks_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('list', Tasks::class);
        $collection = $this->repository->query()->paginate($request->input('perPage', 10));

        return TasksResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Jgile\Tasks\Http\Requests\CreateTasksRequest  $request
     *
     * @return \Jgile\Tasks\Http\Resources\TasksResource
     * @throws \Exception
     */
    public function store(CreateTasksRequest $request)
    {
        $tasks = $this->repository->create($request->all());
        $this->messenger->success(__("tasks::tasks.tasks_created"));
        $this->messenger->redirect(route("jgile.taskss.edit", ['tasks' => $tasks->id]));

        return TasksResource::make($tasks);
    }

    /**
     * Show the specified resource.
     *
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return \Jgile\Tasks\Http\Resources\TasksResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Tasks $tasks)
    {
        $this->authorize('view', $tasks);

        return TasksResource::make($tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Jgile\Tasks\Http\Requests\UpdateTasksRequest  $request
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return \Jgile\Messenger\Message|\Jgile\Tasks\Http\Resources\TasksResource
     * @throws \Exception
     */
    public function update(UpdateTasksRequest $request, Tasks $tasks = null)
    {
        if ($tasks) {
            $this->repository->update($request->all(), $tasks);
            $this->messenger->success(__("tasks::tasks.tasks_updated"));

            return new TasksResource($tasks);
        }

        $this->repository->query()->update($request->post());

        return $this->messenger->success(__("tasks::tasks.taskss_updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return \Jgile\Tasks\Http\Resources\TasksResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Tasks $tasks)
    {
        $this->authorize('delete', $tasks);
        $this->repository->delete($tasks);
        $this->messenger->success(__("tasks::tasks.tasks_deleted"));

        return new TasksResource($tasks);
    }

    /**
     * Run actions on collection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $action
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function action(Request $request, $action)
    {
        return $this->repository->action($action, $request->post());
    }
}
