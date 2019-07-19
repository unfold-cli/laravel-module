<?php

namespace StubVendor\StubPackage\Repositories;

use Jgile\LaravelRepositories\BaseRepository;
use StubVendor\StubPackage\Models\StubModel;

class StubModelRepository extends BaseRepository
{

    /**
     * @var array Searchable fields
     */
    protected $searchable = [
        'id',
        'name' => 'like'
    ];

    /**
     * Specify StubModel class name
     *
     * @return string
     */
    protected function model(): string
    {
        return StubModel::class;
    }
}
