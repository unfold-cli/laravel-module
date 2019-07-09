<?php

namespace StubVendor\StubPackage\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Jgile\Messenger\Contracts\Messenger;
use StubVendor\StubPackage\Http\Requests\CreateStubPackageRequest;
use StubVendor\StubPackage\Http\Requests\UpdateStubPackageRequest;
use StubVendor\StubPackage\Models\StubPackage;
use StubVendor\StubPackage\Repositories\StubPackageRepository;

class StubPackageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var \Jgile\Messenger\Messenger */
    protected $messenger;

    /** @var \App\Repositories\CartItemRepository */
    protected $repository;

    public function __construct(Messenger $messenger, StubPackageRepository $stub_package_repo)
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
        $this->authorize('list', StubPackage::class);
        $stub_packages = $this->repository->query()->get();

        return view('stub-package::index', [
            'stub_packages' => $stub_packages,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(StubPackage $stub_package)
    {
        $this->authorize('view', $stub_package);

        return view('stub-package::show', [
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
        $this->authorize('create', StubPackage::class);

        return view('stub-package::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \StubVendor\StubPackage\Http\Requests\CreateStubPackageRequest  $request
     *
     * @return Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(CreateStubPackageRequest $request)
    {
        $stub_package = $this->messenger->transaction(function () use ($request) {
            return $this->repository->create($request->all());
        });

        $this->messenger->success(__("stub-package.stub_package_created"));

        return redirect()->name("stub-vendor.stub-package.show", ['stub_package' => $stub_package->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(StubPackage $stub_package)
    {
        $this->authorize('update', $stub_package);

        return view('stub-package::update', ['stub_package' => $stub_package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \StubVendor\StubPackage\Http\Requests\UpdateStubPackageRequest  $request
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(UpdateStubPackageRequest $request, StubPackage $stub_package)
    {
        $this->messenger->transaction(function () use ($request, $stub_package) {
            $this->repository->update($request->all(), $stub_package);
        });

        $this->messenger->success(__("stub-package.stub_package_updated"));

        return redirect()->name("stub-vendor.stub-package.show", ['stub_package' => $stub_package->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return \StubVendor\StubPackage\Http\Resources\StubPackageResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy(StubPackage $stub_package)
    {
        $this->authorize('delete', $stub_package);
        $this->messenger->transaction(function () use ($stub_package) {
            $this->repository->delete($stub_package);
        });

        $this->messenger->success(__("stub-package.stub_package_deleted"));

        return redirect()->name("stub-vendor.stub-package.index");
    }
}
