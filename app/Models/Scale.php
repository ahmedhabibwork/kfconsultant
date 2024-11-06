<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    protected $table = "scales";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "is_active",
        "sort_order",
    ];
}
