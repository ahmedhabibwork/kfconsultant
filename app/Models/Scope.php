<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    protected $table = "scopes";

    protected $primaryKey = 'id';
       protected $fillable = [
        "id",
        "name",
        "is_active",
        "sort_order",
    ];
}
