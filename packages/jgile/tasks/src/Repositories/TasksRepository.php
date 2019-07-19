<?php

namespace Jgile\Tasks\Repositories;

use Jgile\LaravelRepositories\BaseRepository;
use Jgile\Tasks\Models\Tasks;

class TasksRepository extends BaseRepository
{

    /**
     * @var array Searchable fields
     */
    protected $searchable = [
        'id',
        'name' => 'like'
    ];

    /**
     * Specify Tasks class name
     *
     * @return string
     */
    protected function model(): string
    {
        return Tasks::class;
    }
}
