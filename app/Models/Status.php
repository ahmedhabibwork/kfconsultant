<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "is_active",
        "sort_order",
    ];
}
