<?php

use Jgile\Tasks\Http\Controllers\TasksController;
use \Jgile\Tasks\Http\Controllers\Api\TasksController as ApiController;

Route::group(['middleware' => ['web', 'auth'], 'as' => 'jgile.'], function ($router) {
    Route::resource('taskss', TasksController::class);
});

Route::group(['middleware' => ['web', 'auth'], 'as' => 'jgile.taskss.', 'prefix' => 'api/resources'], function ($router) {
    Route::post('/taskss/action', ApiController::class."@action")->name('api.action');
    Route::put('/taskss/{tasks?}', ApiController::class."@update")->name('api.update');
    Route::apiResource('taskss', ApiController::class)->except(['update'])->names([
        'store' => 'api.store',
        'index' => 'api.index',
        'destroy' => 'api.destroy',
    ]);
});
