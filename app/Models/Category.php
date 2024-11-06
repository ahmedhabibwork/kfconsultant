<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "description",
        "is_active",
        "sort_order",
    ];
}
