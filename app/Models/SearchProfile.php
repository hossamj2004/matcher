<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SearchProfile extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'property_type',

    ];


    public function searchProfileFields()
    {
        return $this->hasMany(SearchProfileField::class);
    }

}
