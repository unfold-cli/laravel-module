<?php

namespace Jgile\Tasks;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jgile\Tasks\TasksClass
 */
class TasksFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tasks';
    }
}
