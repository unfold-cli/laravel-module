<?php

namespace StubVendor\StubPackage\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use StubVendor\StubPackage\Models\StubModel;

class StubModelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the StubModel.
     *
     * @param  \App\User  $user
     *
     * @return mixed
     */
    public function list(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the StubModel.
     *
     * @param  \App\User  $user
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return mixed
     */
    public function view(User $user, StubModel $stub_package)
    {
        return true;
    }

    /**
     * Determine whether the user can create StubModel.
     *
     * @param  \App\User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the StubModel.
     *
     * @param  \App\User  $user
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return mixed
     */
    public function update(User $user, StubModel $stub_package)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the StubModel.
     *
     * @param  \App\User  $user
     * @param  \StubVendor\StubPackage\Models\StubModel  $stub_package
     *
     * @return mixed
     */
    public function delete(User $user, StubModel $stub_package)
    {
        return true;
    }
}
