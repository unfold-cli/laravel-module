<?php

namespace Jgile\Tasks\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Jgile\Messenger\Contracts\Messenger;
use Jgile\Tasks\Http\Requests\CreateTasksRequest;
use Jgile\Tasks\Http\Requests\UpdateTasksRequest;
use Jgile\Tasks\Models\Tasks;
use Jgile\Tasks\Repositories\TasksRepository;

class TasksController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('list', Tasks::class);
        $taskss = $this->repository->query()->get();

        return view('tasks::index', [
            'taskss' => $taskss,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Tasks $tasks)
    {
        $this->authorize('view', $tasks);

        return view('tasks::show', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Tasks::class);

        return view('tasks::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Jgile\Tasks\Http\Requests\CreateTasksRequest  $request
     *
     * @return Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(CreateTasksRequest $request)
    {
        $tasks = $this->messenger->transaction(function () use ($request) {
            return $this->repository->create($request->all());
        });

        $this->messenger->success(__("tasks.tasks_created"));

        return redirect()->name("jgile.tasks.show", ['tasks' => $tasks->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Tasks $tasks)
    {
        $this->authorize('update', $tasks);

        return view('tasks::update', ['tasks' => $tasks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Jgile\Tasks\Http\Requests\UpdateTasksRequest  $request
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(UpdateTasksRequest $request, Tasks $tasks)
    {
        $this->messenger->transaction(function () use ($request, $tasks) {
            $this->repository->update($request->all(), $tasks);
        });

        $this->messenger->success(__("tasks.tasks_updated"));

        return redirect()->name("jgile.tasks.show", ['tasks' => $tasks->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return \Jgile\Tasks\Http\Resources\TasksResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy(Tasks $tasks)
    {
        $this->authorize('delete', $tasks);
        $this->messenger->transaction(function () use ($tasks) {
            $this->repository->delete($tasks);
        });

        $this->messenger->success(__("tasks.tasks_deleted"));

        return redirect()->name("jgile.tasks.index");
    }
}
