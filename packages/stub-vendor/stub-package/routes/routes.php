<?php

use StubVendor\StubPackage\Http\Controllers\StubModelsController;
use StubVendor\StubPackage\Http\Controllers\Api\StubModelsController as ApiController;

Route::group(['middleware' => ['web', 'auth'], 'as' => 'stub-vendor.'], function ($router) {
    Route::resource('stub-models', StubModelsController::class);
});

Route::group(['middleware' => ['web', 'auth'], 'as' => 'stub-vendor.stub-models.', 'prefix' => 'api/resources'], function ($router) {
    Route::post('/stub-models/action', ApiController::class."@action")->name('api.action');
    Route::put('/stub-models/{stub_package?}', ApiController::class."@update")->name('api.update');
    Route::apiResource('stub-models', ApiController::class)->except(['update'])->names([
        'store' => 'api.store',
        'index' => 'api.index',
        'destroy' => 'api.destroy',
    ]);
});
