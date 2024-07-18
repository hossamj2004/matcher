<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'address',
        'property_type',

    ];

    public function propertyFields()
    {
        return $this->hasMany(PropertyField::class);
    }

}
