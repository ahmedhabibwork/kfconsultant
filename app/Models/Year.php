<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = "years";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "is_active",
        "sort_order",
    ];
}
