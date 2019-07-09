<?php

use StubVendor\StubPackage\Http\Controllers\StubPackageController;
use \StubVendor\StubPackage\Http\Controllers\Api\StubPackageController as ApiController;

Route::group(['middleware' => ['web', 'auth'], 'as' => 'stub-vendor.'], function ($router) {
    Route::resource('stub-packages', StubPackageController::class);
});

Route::group(['middleware' => ['web', 'auth'], 'as' => 'stub-vendor.stub-packages.', 'prefix' => 'api/resources'], function ($router) {
    Route::post('/stub-packages/action', ApiController::class."@action")->name('api.action');
    Route::put('/stub-packages/{stub_package?}', ApiController::class."@update")->name('api.update');
    Route::apiResource('stub-packages', ApiController::class)->except(['update'])->names([
        'store' => 'api.store',
        'index' => 'api.index',
        'destroy' => 'api.destroy',
    ]);
});
