<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchAllModelsTrait;

class Category extends Model
{
    use SearchAllModelsTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    // --------  custom functions get and set data   --------- //



    // return name category capitalize

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
