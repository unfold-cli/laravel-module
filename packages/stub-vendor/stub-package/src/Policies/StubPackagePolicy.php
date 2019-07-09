<?php

namespace StubVendor\StubPackage\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use StubVendor\StubPackage\Models\StubPackage;

class StubPackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the StubPackage.
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
     * Determine whether the user can view the StubPackage.
     *
     * @param  \App\User  $user
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return mixed
     */
    public function view(User $user, StubPackage $stub_package)
    {
        return true;
    }

    /**
     * Determine whether the user can create StubPackage.
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
     * Determine whether the user can update the StubPackage.
     *
     * @param  \App\User  $user
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return mixed
     */
    public function update(User $user, StubPackage $stub_package)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the StubPackage.
     *
     * @param  \App\User  $user
     * @param  \StubVendor\StubPackage\Models\StubPackage  $stub_package
     *
     * @return mixed
     */
    public function delete(User $user, StubPackage $stub_package)
    {
        return true;
    }
}
