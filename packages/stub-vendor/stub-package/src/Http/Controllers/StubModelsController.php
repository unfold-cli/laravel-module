<?php

namespace StubVendor\StubPackage\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Jgile\Messenger\Contracts\Messenger;
use StubVendor\StubPackage\Http\Requests\CreateStubModelRequest;
use StubVendor\StubPackage\Http\Requests\UpdateStubModelRequest;
use StubVendor\StubPackage\Models\StubModel;
use StubVendor\StubPackage\Repositories\StubModelRepository;

class StubModelsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var \Jgile\Messenger\Messenger */
    protected $messenger;

    /** @var \App\Repositories\CartItemRepository */
    protected $repository;

    public function __construct(Messenger $messenger, StubModelRepository $stub_package_repo)
    {
        $this->messenger = $messenger;
        $this->repository = $stub_package_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('list', StubModel::class);
        $stub_packages = $this->repository->query()->get();

        return view('stub-model::index', [
            'stub_packages' => $stub_packages,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(StubModel $stub_package)
    {
        $this->authorize('view', $stub_package);

        return view('stub-model::show', [
            'stub_package' => $stub_package,
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
        $this->authorize('create', StubModel::class);

        return view('stub-model::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \StubVendor\StubPackage\Http\Requests\CreateStubModelRequest  $request
     *
     * @return Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(CreateStubModelRequest $request)
    {
        $stub_package = $this->messenger->transaction(function () use ($request) {
            return $this->repository->create($request->all());
        });

        $this->messenger->success(__("stub-model.stub_package_created"));

        return redirect()->name("stub-vendor.stub-model.show", ['stub_package' => $stub_package->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(StubModel $stub_package)
    {
        $this->authorize('update', $stub_package);

        return view('stub-model::update', ['stub_package' => $stub_package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \StubVendor\StubPackage\Http\Requests\UpdateStubModelRequest  $request
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(UpdateStubModelRequest $request, StubModel $stub_package)
    {
        $this->messenger->transaction(function () use ($request, $stub_package) {
            $this->repository->update($request->all(), $stub_package);
        });

        $this->messenger->success(__("stub-model.stub_package_updated"));

        return redirect()->name("stub-vendor.stub-model.show", ['stub_package' => $stub_package->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return \StubVendor\StubPackage\Http\Resources\StubModelResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy(StubModel $stub_package)
    {
        $this->authorize('delete', $stub_package);
        $this->messenger->transaction(function () use ($stub_package) {
            $this->repository->delete($stub_package);
        });

        $this->messenger->success(__("stub-model.stub_package_deleted"));

        return redirect()->name("stub-vendor.stub-model.index");
    }
}
