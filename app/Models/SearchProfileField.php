<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchProfileField extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'search_profile_id',
        'field_name',
        'min_range_value',
        'max_range_value',
        'exact_value',
        'field_type',

    ];

    public function searchProfile()
    {
       return $this->belongsTo(SearchProfile::class);
    }

}
