<?php

namespace StubVendor\StubPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Jgile\LaravelVue\Traits\FormFields;

class StubPackage extends Model
{
    use FormFields;

    // protected $table = '';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    // protected $touches = [];
    // protected $dates = [];
    // protected $casts = [];
    // protected $with = [];
    // protected $hidden = [];
    // protected $appends = [];

    protected $fillable = [
        'name',
    ];

    public static function formFields(): array
    {
        return [
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
        ];
    }

    //region Relationships
    //endregion

    //region Scopes
    //endregion

    //region Accessors
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    //endregion

    //region Mutators
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }
    //endregion


}
