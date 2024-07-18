<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyField extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'property_id',
        'field_name',
        'field_value',

    ];


    public function property()
    {
       return $this->belongsTo(Property::class);
    }

}
