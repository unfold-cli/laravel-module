<?php

namespace StubVendor\StubPackage;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StubVendor\StubPackage\StubPackageClass
 */
class StubPackageFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'stub-package';
    }
}
